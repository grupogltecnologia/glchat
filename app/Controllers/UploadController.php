<?php
require_once __DIR__ . '/../Core/Auth.php';
require_once __DIR__ . '/../Services/FileStorageService.php';

class UploadController {
    private FileStorageService $storage;

    public function __construct() {
        $this->storage = new FileStorageService();
    }

    public function uploadMedia(): void {
        Auth::requerAutenticacao();
        header('Content-Type: application/json');

        try {
            $file = $_FILES['file'] ?? $_FILES['arquivo'] ?? $_FILES['media'] ?? null;
            if (!$file) {
                echo json_encode(['success' => false, 'error' => 'Arquivo não enviado']);
                return;
            }

            $tipo = $_POST['tipo'] ?? $_POST['type'] ?? $this->inferirTipo($file['type'] ?? '', $file['name'] ?? '');
            $result = $this->storage->upload($file, $tipo, Auth::obterContaId());

            echo json_encode($result);
        } catch (Exception $e) {
            echo json_encode(['success' => false, 'error' => $e->getMessage()]);
        }
    }

    private function inferirTipo(string $mime, string $name): string {
        if (str_starts_with($mime, 'image/')) return 'image';
        if (str_starts_with($mime, 'audio/')) return 'audio';
        if (str_starts_with($mime, 'video/')) return 'video';

        $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
        if (in_array($ext, ['jpg', 'jpeg', 'png', 'gif', 'webp', 'svg'], true)) return 'image';
        if (in_array($ext, ['mp3', 'ogg', 'wav', 'opus'], true)) return 'audio';
        if (in_array($ext, ['mp4', 'avi', 'mov', 'webm'], true)) return 'video';

        return 'document';
    }
}
