<?php
class AIService {
    private string $apiKey;
    private string $model;
    private float $temperature;

    public function __construct(?string $apiKey = null, string $model = 'gpt-4', float $temperature = 0.7) {
        $this->apiKey = $apiKey ?? getenv('OPENAI_API_KEY') ?? '';
        $this->model = $model;
        $this->temperature = $temperature;
    }

    private function request(string $endpoint, array $data): array {
        $url = 'https://api.openai.com/v1' . $endpoint;
        
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POST, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Authorization: Bearer ' . $this->apiKey
        ]);
        
        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        $error = curl_error($ch);
        curl_close($ch);
        
        if ($error) {
            return ['success' => false, 'error' => $error];
        }
        
        $result = json_decode($response, true);
        
        if ($httpCode !== 200) {
            return [
                'success' => false,
                'error' => $result['error']['message'] ?? 'Erro desconhecido',
                'httpCode' => $httpCode
            ];
        }
        
        return ['success' => true, 'data' => $result];
    }

    public function chatCompletion(array $mensagens, ?string $model = null, ?float $temperature = null, int $maxTokens = 1000): array {
        $response = $this->request('/chat/completions', [
            'model' => $model ?? $this->model,
            'messages' => $mensagens,
            'temperature' => $temperature ?? $this->temperature,
            'max_tokens' => $maxTokens
        ]);
        
        if (!$response['success']) {
            return $response;
        }
        
        return [
            'success' => true,
            'resposta' => $response['data']['choices'][0]['message']['content'] ?? '',
            'tokens' => $response['data']['usage']['total_tokens'] ?? 0,
            'promptTokens' => $response['data']['usage']['prompt_tokens'] ?? 0,
            'completionTokens' => $response['data']['usage']['completion_tokens'] ?? 0
        ];
    }

    public function responderMensagem(string $mensagemUsuario, array $historico = [], string $instrucoes = '', ?string $model = null): array {
        $mensagens = [];
        
        if (!empty($instrucoes)) {
            $mensagens[] = [
                'role' => 'system',
                'content' => $instrucoes
            ];
        }
        
        foreach ($historico as $msg) {
            $mensagens[] = [
                'role' => $msg['role'] ?? 'user',
                'content' => $msg['content'] ?? $msg['mensagem'] ?? ''
            ];
        }
        
        $mensagens[] = [
            'role' => 'user',
            'content' => $mensagemUsuario
        ];
        
        return $this->chatCompletion($mensagens, $model);
    }

    public function gerarEmbedding(string $texto, string $model = 'text-embedding-ada-002'): array {
        $response = $this->request('/embeddings', [
            'model' => $model,
            'input' => $texto
        ]);
        
        if (!$response['success']) {
            return $response;
        }
        
        return [
            'success' => true,
            'embedding' => $response['data']['data'][0]['embedding'] ?? [],
            'tokens' => $response['data']['usage']['total_tokens'] ?? 0
        ];
    }

    public function analisarDados(string $pergunta, array $dados, string $contexto = ''): array {
        $dadosFormatados = json_encode($dados, JSON_PRETTY_PRINT | JSON_UNESCAPED_UNICODE);
        
        $prompt = "Você é um analista de dados especializado. ";
        if ($contexto) {
            $prompt .= $contexto . "\n\n";
        }
        
        $prompt .= "Analise os seguintes dados e responda a pergunta de forma clara e objetiva.\n\n";
        $prompt .= "Dados:\n```json\n{$dadosFormatados}\n```\n\n";
        $prompt .= "Pergunta: {$pergunta}";
        
        return $this->responderMensagem($pergunta, [], $prompt);
    }

    public function extrairInformacoes(string $texto, array $campos): array {
        $camposJson = json_encode($campos, JSON_UNESCAPED_UNICODE);
        
        $instrucoes = "Extraia as seguintes informações do texto fornecido e retorne em formato JSON.\n";
        $instrucoes .= "Campos desejados: {$camposJson}\n";
        $instrucoes .= "Se alguma informação não estiver disponível, retorne null para esse campo.\n";
        $instrucoes .= "Retorne APENAS o JSON, sem texto adicional.";
        
        $response = $this->responderMensagem($texto, [], $instrucoes);
        
        if (!$response['success']) {
            return $response;
        }
        
        $jsonExtraido = json_decode($response['resposta'], true);
        
        return [
            'success' => true,
            'dados' => $jsonExtraido ?? [],
            'tokens' => $response['tokens']
        ];
    }

    public function resumirTexto(string $texto, int $maxPalavras = 100): array {
        $instrucoes = "Resuma o seguinte texto em no máximo {$maxPalavras} palavras, mantendo as informações mais importantes.";
        
        return $this->responderMensagem($texto, [], $instrucoes, 'gpt-3.5-turbo');
    }

    public function classificarTexto(string $texto, array $categorias): array {
        $categoriasStr = implode(', ', $categorias);
        
        $instrucoes = "Classifique o seguinte texto em uma das categorias: {$categoriasStr}.\n";
        $instrucoes .= "Retorne APENAS o nome da categoria, sem explicações.";
        
        return $this->responderMensagem($texto, [], $instrucoes, 'gpt-3.5-turbo');
    }

    public function gerarResposta(string $mensagem, array $config = []): array {
        $instrucoes = $config['instrucoes'] ?? '';
        $historico = $config['historico'] ?? [];
        $model = $config['modelo'] ?? $this->model;
        $temperature = $config['criatividade'] ?? $this->temperature;
        $maxTokens = $config['maxTokens'] ?? 1000;
        
        $mensagens = [];
        
        if (!empty($instrucoes)) {
            $mensagens[] = ['role' => 'system', 'content' => $instrucoes];
        }
        
        if (!empty($historico)) {
            foreach ($historico as $msg) {
                $mensagens[] = [
                    'role' => $msg['role'] ?? ($msg['fromMe'] ? 'assistant' : 'user'),
                    'content' => $msg['content'] ?? $msg['mensagem'] ?? ''
                ];
            }
        }
        
        $mensagens[] = ['role' => 'user', 'content' => $mensagem];
        
        return $this->chatCompletion($mensagens, $model, $temperature, $maxTokens);
    }

    public function calcularTokens(string $texto): int {
        return (int)ceil(strlen($texto) / 4);
    }

    public function validarApiKey(): bool {
        $response = $this->request('/models', []);
        return $response['success'] ?? false;
    }

    public function listarModelos(): array {
        $ch = curl_init('https://api.openai.com/v1/models');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Authorization: Bearer ' . $this->apiKey
        ]);
        
        $response = curl_exec($ch);
        curl_close($ch);
        
        $result = json_decode($response, true);
        
        if (!isset($result['data'])) {
            return ['success' => false, 'error' => 'Erro ao listar modelos'];
        }
        
        $modelos = array_filter($result['data'], function($model) {
            return strpos($model['id'], 'gpt') !== false;
        });
        
        return [
            'success' => true,
            'modelos' => array_column($modelos, 'id')
        ];
    }
}
