#!/usr/bin/env php
<?php
if (file_exists(__DIR__ . '/../.env')) {
    $lines = file(__DIR__ . '/../.env', FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
    }
}

require_once __DIR__ . '/../app/Core/Database.php';
require_once __DIR__ . '/../app/Services/QueueService.php';
require_once __DIR__ . '/../app/Services/EvolutionService.php';
require_once __DIR__ . '/../app/Services/AIService.php';
require_once __DIR__ . '/../app/Services/EmailService.php';
require_once __DIR__ . '/../app/Models/DisparoModel.php';
require_once __DIR__ . '/../app/Models/ContatoModel.php';
require_once __DIR__ . '/../app/Models/ConexaoModel.php';

class QueueWorker {
    private QueueService $queue;
    private EvolutionService $evolution;
    private AIService $ai;
    private EmailService $email;
    private DisparoModel $disparoModel;
    private ContatoModel $contatoModel;
    private ConexaoModel $conexaoModel;
    private bool $shouldStop = false;

    public function __construct() {
        $this->queue = new QueueService();
        $this->evolution = new EvolutionService();
        $this->ai = new AIService();
        $this->email = new EmailService();
        $this->disparoModel = new DisparoModel();
        $this->contatoModel = new ContatoModel();
        $this->conexaoModel = new ConexaoModel();
        
        pcntl_signal(SIGTERM, [$this, 'handleSignal']);
        pcntl_signal(SIGINT, [$this, 'handleSignal']);
    }

    public function handleSignal($signal): void {
        echo "\n[" . date('Y-m-d H:i:s') . "] Recebido sinal de parada. Finalizando...\n";
        $this->shouldStop = true;
    }

    public function run(string $queue = 'default', int $sleep = 3): void {
        echo "[" . date('Y-m-d H:i:s') . "] Worker iniciado. Fila: {$queue}\n";
        
        while (!$this->shouldStop) {
            pcntl_signal_dispatch();
            
            $job = $this->queue->pop($queue);
            
            if ($job === null) {
                sleep($sleep);
                continue;
            }
            
            echo "[" . date('Y-m-d H:i:s') . "] Processando job #{$job['id']}: {$job['payload']['job']}\n";
            
            try {
                $this->processJob($job);
                $this->queue->delete($job['id']);
                echo "[" . date('Y-m-d H:i:s') . "] Job #{$job['id']} concluído\n";
                
            } catch (Exception $e) {
                echo "[" . date('Y-m-d H:i:s') . "] Erro no job #{$job['id']}: {$e->getMessage()}\n";
                
                if ($job['attempts'] >= 3) {
                    $this->queue->fail($job['id'], $e->getMessage());
                    echo "[" . date('Y-m-d H:i:s') . "] Job #{$job['id']} movido para failed_jobs\n";
                } else {
                    $this->queue->release($job['id'], 60);
                    echo "[" . date('Y-m-d H:i:s') . "] Job #{$job['id']} reagendado\n";
                }
            }
        }
        
        echo "[" . date('Y-m-d H:i:s') . "] Worker finalizado\n";
    }

    private function processJob(array $job): void {
        $jobType = $job['payload']['job'];
        $data = $job['payload']['data'];
        
        switch ($jobType) {
            case 'enviar_mensagem':
                $this->enviarMensagem($data);
                break;
                
            case 'processar_disparo':
                $this->processarDisparo($data);
                break;
                
            case 'enviar_email':
                $this->enviarEmail($data);
                break;
                
            case 'processar_agente_ia':
                $this->processarAgenteIA($data);
                break;
                
            default:
                throw new Exception("Tipo de job desconhecido: {$jobType}");
        }
    }

    private function enviarMensagem(array $data): void {
        $instanceName = $data['instanceName'];
        $numero = $data['numero'];
        $mensagem = $data['mensagem'];
        $tipo = $data['tipo'] ?? 'text';
        
        if ($tipo === 'text') {
            $result = $this->evolution->enviarTexto($instanceName, $numero, $mensagem);
        } elseif ($tipo === 'image') {
            $result = $this->evolution->enviarImagem($instanceName, $numero, $data['url'], $mensagem);
        } elseif ($tipo === 'audio') {
            $result = $this->evolution->enviarAudio($instanceName, $numero, $data['url']);
        } elseif ($tipo === 'video') {
            $result = $this->evolution->enviarVideo($instanceName, $numero, $data['url'], $mensagem);
        } elseif ($tipo === 'document') {
            $result = $this->evolution->enviarDocumento($instanceName, $numero, $data['url'], $data['filename'] ?? '');
        }
        
        if (!$result['success']) {
            throw new Exception("Erro ao enviar mensagem: " . ($result['error'] ?? 'Desconhecido'));
        }
    }

    private function processarDisparo(array $data): void {
        $disparoId = $data['disparoId'];
        $contaId = $data['contaId'];
        
        $disparo = $this->disparoModel->buscarPorId($disparoId, $contaId);
        if (!$disparo) {
            throw new Exception("Disparo não encontrado");
        }
        
        $this->disparoModel->atualizarStatus($disparoId, $contaId, 'processando');
        
        $mensagens = json_decode($disparo['Mensagens'], true);
        $conexoes = json_decode($disparo['idConexoes'], true);
        $listas = json_decode($disparo['idListas'], true);
        
        $contatos = [];
        if (!empty($listas)) {
            foreach ($listas as $listaId) {
                $contatosLista = $this->contatoModel->listarPorConta($contaId, 10000);
                $contatos = array_merge($contatos, $contatosLista);
            }
        }
        
        $enviados = 0;
        foreach ($contatos as $contato) {
            foreach ($conexoes as $conexaoId) {
                $conexao = $this->conexaoModel->buscarPorId($conexaoId, $contaId);
                if (!$conexao) continue;
                
                foreach ($mensagens as $mensagem) {
                    $this->queue->push('enviar_mensagem', [
                        'instanceName' => $conexao['instanceName'],
                        'numero' => $contato['telefone'],
                        'mensagem' => $mensagem['texto'] ?? '',
                        'tipo' => $mensagem['tipo'] ?? 'text',
                        'url' => $mensagem['url'] ?? null
                    ], 'default', rand($disparo['intervaloMin'], $disparo['intervaloMax']));
                    
                    $enviados++;
                }
            }
        }
        
        $this->disparoModel->atualizarStatus($disparoId, $contaId, 'concluido', $enviados);
    }

    private function enviarEmail(array $data): void {
        $para = $data['para'];
        $assunto = $data['assunto'];
        $corpo = $data['corpo'];
        $isHtml = $data['isHtml'] ?? true;
        
        $result = $this->email->enviarComSMTP($para, $assunto, $corpo, $isHtml);
        
        if (!$result['success']) {
            throw new Exception("Erro ao enviar email: " . ($result['error'] ?? 'Desconhecido'));
        }
    }

    private function processarAgenteIA(array $data): void {
        $mensagem = $data['mensagem'];
        $historico = $data['historico'] ?? [];
        $config = $data['config'] ?? [];
        
        $result = $this->ai->gerarResposta($mensagem, $config);
        
        if (!$result['success']) {
            throw new Exception("Erro ao processar IA: " . ($result['error'] ?? 'Desconhecido'));
        }
    }
}

$queue = $argv[1] ?? 'default';
$sleep = (int)($argv[2] ?? 3);

$worker = new QueueWorker();
$worker->run($queue, $sleep);
