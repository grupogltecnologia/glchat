<?php
class FileStorageService {
    private string $uploadPath;
    private array $allowedTypes;
    private int $maxFileSize;

    public function __construct() {
        $this->uploadPath = __DIR__ . '/../../storage/uploads/';
        $this->allowedTypes = [
            'image' => ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'],
            'audio' => ['mp3', 'ogg', 'wav', 'opus'],
            'video' => ['mp4', 'avi', 'mov', 'webm'],
            'document' => ['pdf', 'doc', 'docx', 'xls', 'xlsx', 'txt', 'csv']
        ];
        $this->maxFileSize = 50 * 1024 * 1024; // 50MB
        
        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0755, true);
        }
    }

    public function upload(array $file, string $tipo = 'image', ?string $contaId = null): array {
        if (!isset($file['tmp_name']) || !is_uploaded_file($file['tmp_name'])) {
            return ['success' => false, 'error' => 'Arquivo inválido'];
        }

        if ($file['error'] !== UPLOAD_ERR_OK) {
            return ['success' => false, 'error' => 'Erro no upload: ' . $file['error']];
        }

        if ($file['size'] > $this->maxFileSize) {
            return ['success' => false, 'error' => 'Arquivo muito grande. Máximo: 50MB'];
        }

        $extensao = strtolower(pathinfo($file['name'], PATHINFO_EXTENSION));
        
        if (!$this->validarExtensao($extensao, $tipo)) {
            return ['success' => false, 'error' => 'Tipo de arquivo não permitido'];
        }

        $nomeArquivo = $this->gerarNomeUnico($extensao, $contaId);

        $minioResult = $this->tentarUploadMinio($file['tmp_name'], $tipo, $nomeArquivo, $file['type'] ?? 'application/octet-stream', $contaId);
        if ($minioResult['success'] ?? false) {
            return [
                'success' => true,
                'filename' => $nomeArquivo,
                'path' => $minioResult['object_key'] ?? null,
                'url' => $minioResult['url'],
                'link' => $minioResult['url'],
                'size' => $file['size'],
                'type' => $tipo,
                'extension' => $extensao,
                'provider' => 'minio'
            ];
        }

        $diretorio = $this->criarDiretorioPorTipo($tipo, $contaId);
        $caminhoCompleto = $diretorio . $nomeArquivo;

        if (!move_uploaded_file($file['tmp_name'], $caminhoCompleto)) {
            return ['success' => false, 'error' => 'Erro ao salvar arquivo'];
        }

        $url = $this->gerarUrl($tipo, $nomeArquivo, $contaId);

        return [
            'success' => true,
            'filename' => $nomeArquivo,
            'path' => $caminhoCompleto,
            'url' => $url,
            'link' => $url,
            'size' => $file['size'],
            'type' => $tipo,
            'extension' => $extensao,
            'provider' => 'local'
        ];
    }

    public function uploadBase64(string $base64Data, string $tipo = 'image', ?string $contaId = null): array {
        if (strpos($base64Data, 'data:') === 0) {
            $parts = explode(',', $base64Data);
            if (count($parts) === 2) {
                preg_match('/data:([^;]+);base64/', $parts[0], $matches);
                $mimeType = $matches[1] ?? '';
                $base64Data = $parts[1];
            }
        }

        $data = base64_decode($base64Data);
        if ($data === false) {
            return ['success' => false, 'error' => 'Base64 inválido'];
        }

        $extensao = $this->obterExtensaoPorMime($mimeType ?? '');
        if (!$this->validarExtensao($extensao, $tipo)) {
            return ['success' => false, 'error' => 'Tipo de arquivo não permitido'];
        }

        $nomeArquivo = $this->gerarNomeUnico($extensao, $contaId);
        $tmp = tempnam(sys_get_temp_dir(), 'hublabel-b64-');
        file_put_contents($tmp, $data);
        $minioResult = $this->tentarUploadMinio($tmp, $tipo, $nomeArquivo, $mimeType ?? 'application/octet-stream', $contaId);
        @unlink($tmp);
        if ($minioResult['success'] ?? false) {
            return [
                'success' => true,
                'filename' => $nomeArquivo,
                'path' => $minioResult['object_key'] ?? null,
                'url' => $minioResult['url'],
                'link' => $minioResult['url'],
                'size' => strlen($data),
                'type' => $tipo,
                'extension' => $extensao,
                'provider' => 'minio'
            ];
        }

        $diretorio = $this->criarDiretorioPorTipo($tipo, $contaId);
        $caminhoCompleto = $diretorio . $nomeArquivo;

        if (file_put_contents($caminhoCompleto, $data) === false) {
            return ['success' => false, 'error' => 'Erro ao salvar arquivo'];
        }

        $url = $this->gerarUrl($tipo, $nomeArquivo, $contaId);

        return [
            'success' => true,
            'filename' => $nomeArquivo,
            'path' => $caminhoCompleto,
            'url' => $url,
            'link' => $url,
            'size' => strlen($data),
            'type' => $tipo,
            'extension' => $extensao,
            'provider' => 'local'
        ];
    }

    public function uploadUrl(string $url, string $tipo = 'image', ?string $contaId = null): array {
        $data = @file_get_contents($url);
        if ($data === false) {
            return ['success' => false, 'error' => 'Erro ao baixar arquivo da URL'];
        }

        $extensao = strtolower(pathinfo(parse_url($url, PHP_URL_PATH), PATHINFO_EXTENSION));
        if (empty($extensao)) {
            $extensao = 'jpg';
        }

        if (!$this->validarExtensao($extensao, $tipo)) {
            return ['success' => false, 'error' => 'Tipo de arquivo não permitido'];
        }

        $nomeArquivo = $this->gerarNomeUnico($extensao, $contaId);
        $tmp = tempnam(sys_get_temp_dir(), 'hublabel-url-');
        file_put_contents($tmp, $data);
        $minioResult = $this->tentarUploadMinio($tmp, $tipo, $nomeArquivo, 'application/octet-stream', $contaId);
        @unlink($tmp);
        if ($minioResult['success'] ?? false) {
            return [
                'success' => true,
                'filename' => $nomeArquivo,
                'path' => $minioResult['object_key'] ?? null,
                'url' => $minioResult['url'],
                'link' => $minioResult['url'],
                'size' => strlen($data),
                'type' => $tipo,
                'extension' => $extensao,
                'provider' => 'minio'
            ];
        }

        $diretorio = $this->criarDiretorioPorTipo($tipo, $contaId);
        $caminhoCompleto = $diretorio . $nomeArquivo;

        if (file_put_contents($caminhoCompleto, $data) === false) {
            return ['success' => false, 'error' => 'Erro ao salvar arquivo'];
        }

        $urlLocal = $this->gerarUrl($tipo, $nomeArquivo, $contaId);

        return [
            'success' => true,
            'filename' => $nomeArquivo,
            'path' => $caminhoCompleto,
            'url' => $urlLocal,
            'link' => $urlLocal,
            'size' => strlen($data),
            'type' => $tipo,
            'extension' => $extensao,
            'provider' => 'local'
        ];
    }

    public function deletar(string $caminho): bool {
        if (file_exists($caminho) && is_file($caminho)) {
            return unlink($caminho);
        }
        return false;
    }

    private function validarExtensao(string $extensao, string $tipo): bool {
        return isset($this->allowedTypes[$tipo]) && in_array($extensao, $this->allowedTypes[$tipo]);
    }

    private function gerarNomeUnico(string $extensao, ?string $contaId = null): string {
        $prefixo = $contaId ? substr($contaId, 0, 8) . '_' : '';
        return $prefixo . uniqid() . '_' . time() . '.' . $extensao;
    }

    private function criarDiretorioPorTipo(string $tipo, ?string $contaId = null): string {
        $subdir = $this->uploadPath . $tipo . '/';
        
        if ($contaId) {
            $subdir .= substr($contaId, 0, 8) . '/';
        }
        
        if (!is_dir($subdir)) {
            mkdir($subdir, 0755, true);
        }
        
        return $subdir;
    }

    private function gerarUrl(string $tipo, string $nomeArquivo, ?string $contaId = null): string {
        $baseUrl = getenv('APP_URL') ?: 'http://localhost:8000';
        $path = '/storage/uploads/' . $tipo . '/';
        
        if ($contaId) {
            $path .= substr($contaId, 0, 8) . '/';
        }
        
        return $baseUrl . $path . $nomeArquivo;
    }

    private function obterExtensaoPorMime(string $mimeType): string {
        $mimeMap = [
            'image/jpeg' => 'jpg',
            'image/png' => 'png',
            'image/gif' => 'gif',
            'image/webp' => 'webp',
            'audio/mpeg' => 'mp3',
            'audio/ogg' => 'ogg',
            'video/mp4' => 'mp4',
            'application/pdf' => 'pdf'
        ];
        
        return $mimeMap[$mimeType] ?? 'bin';
    }

    private function tentarUploadMinio(string $sourcePath, string $tipo, string $nomeArquivo, string $contentType, ?string $contaId = null): array {
        try {
            require_once __DIR__ . '/../Models/StorageConfigModel.php';
            require_once __DIR__ . '/MinioStorageService.php';

            $config = (new StorageConfigModel())->obter(true);
            if (($config['provider'] ?? 'local') !== 'minio' || empty($config['ativo'])) {
                return ['success' => false];
            }

            $prefix = $contaId ? substr($contaId, 0, 8) . '/' : 'public/';
            $objectKey = trim($prefix . $tipo . '/' . $nomeArquivo, '/');
            return (new MinioStorageService($config))->uploadFile($sourcePath, $objectKey, $contentType ?: 'application/octet-stream');
        } catch (Exception $e) {
            error_log('Falha no upload MinIO, usando storage local: ' . $e->getMessage());
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function obterTamanhoTotal(?string $contaId = null): int {
        $diretorio = $this->uploadPath;
        if ($contaId) {
            $diretorio .= '*/' . substr($contaId, 0, 8) . '/';
        }
        
        $tamanho = 0;
        foreach (glob($diretorio . '*') as $arquivo) {
            if (is_file($arquivo)) {
                $tamanho += filesize($arquivo);
            }
        }
        
        return $tamanho;
    }

    public function limparArquivosAntigos(int $dias = 90): int {
        $contador = 0;
        $dataLimite = time() - ($dias * 24 * 60 * 60);
        
        foreach (glob($this->uploadPath . '*/*') as $arquivo) {
            if (is_file($arquivo) && filemtime($arquivo) < $dataLimite) {
                if (unlink($arquivo)) {
                    $contador++;
                }
            }
        }
        
        return $contador;
    }
}
