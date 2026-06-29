<?php
require_once __DIR__ . '/../Core/Database.php';

class QueueService {
    private PDO $pdo;

    public function __construct() {
        $this->pdo = Database::pdo();
        $this->criarTabelasSeNecessario();
    }

    private function criarTabelasSeNecessario(): void {
        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS `jobs` (
                `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
                `queue` VARCHAR(255) NOT NULL DEFAULT 'default',
                `payload` JSON NOT NULL,
                `attempts` INT NOT NULL DEFAULT 0,
                `reserved_at` TIMESTAMP NULL,
                `available_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                `created_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_queue_reserved (`queue`, `reserved_at`),
                INDEX idx_available (`available_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");

        $this->pdo->exec("
            CREATE TABLE IF NOT EXISTS `failed_jobs` (
                `id` BIGINT AUTO_INCREMENT PRIMARY KEY,
                `queue` VARCHAR(255) NOT NULL,
                `payload` JSON NOT NULL,
                `exception` TEXT,
                `failed_at` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
                INDEX idx_failed_at (`failed_at`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci
        ");
    }

    public function push(string $job, array $data, string $queue = 'default', int $delay = 0): int {
        $availableAt = date('Y-m-d H:i:s', time() + $delay);
        
        $stmt = $this->pdo->prepare("
            INSERT INTO jobs (queue, payload, available_at)
            VALUES (:queue, :payload, :available_at)
        ");
        
        $stmt->execute([
            'queue' => $queue,
            'payload' => json_encode(['job' => $job, 'data' => $data]),
            'available_at' => $availableAt
        ]);
        
        return (int)$this->pdo->lastInsertId();
    }

    public function pop(string $queue = 'default'): ?array {
        $this->pdo->beginTransaction();
        
        try {
            $stmt = $this->pdo->prepare("
                SELECT * FROM jobs
                WHERE queue = :queue
                AND reserved_at IS NULL
                AND available_at <= NOW()
                ORDER BY id ASC
                LIMIT 1
                FOR UPDATE
            ");
            
            $stmt->execute(['queue' => $queue]);
            $job = $stmt->fetch();
            
            if (!$job) {
                $this->pdo->rollBack();
                return null;
            }
            
            $updateStmt = $this->pdo->prepare("
                UPDATE jobs
                SET reserved_at = NOW(), attempts = attempts + 1
                WHERE id = :id
            ");
            
            $updateStmt->execute(['id' => $job['id']]);
            
            $this->pdo->commit();
            
            $job['payload'] = json_decode($job['payload'], true);
            return $job;
            
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return null;
        }
    }

    public function delete(int $jobId): bool {
        $stmt = $this->pdo->prepare("DELETE FROM jobs WHERE id = :id");
        return $stmt->execute(['id' => $jobId]);
    }

    public function release(int $jobId, int $delay = 0): bool {
        $availableAt = date('Y-m-d H:i:s', time() + $delay);
        
        $stmt = $this->pdo->prepare("
            UPDATE jobs
            SET reserved_at = NULL, available_at = :available_at
            WHERE id = :id
        ");
        
        return $stmt->execute([
            'id' => $jobId,
            'available_at' => $availableAt
        ]);
    }

    public function fail(int $jobId, string $exception): bool {
        $this->pdo->beginTransaction();
        
        try {
            $stmt = $this->pdo->prepare("SELECT * FROM jobs WHERE id = :id");
            $stmt->execute(['id' => $jobId]);
            $job = $stmt->fetch();
            
            if ($job) {
                $failStmt = $this->pdo->prepare("
                    INSERT INTO failed_jobs (queue, payload, exception)
                    VALUES (:queue, :payload, :exception)
                ");
                
                $failStmt->execute([
                    'queue' => $job['queue'],
                    'payload' => $job['payload'],
                    'exception' => $exception
                ]);
            }
            
            $this->delete($jobId);
            
            $this->pdo->commit();
            return true;
            
        } catch (Exception $e) {
            $this->pdo->rollBack();
            return false;
        }
    }

    public function size(string $queue = 'default'): int {
        $stmt = $this->pdo->prepare("
            SELECT COUNT(*) as total FROM jobs
            WHERE queue = :queue AND reserved_at IS NULL
        ");
        $stmt->execute(['queue' => $queue]);
        return (int)$stmt->fetch()['total'];
    }

    public function clear(string $queue = 'default'): int {
        $stmt = $this->pdo->prepare("DELETE FROM jobs WHERE queue = :queue");
        $stmt->execute(['queue' => $queue]);
        return $stmt->rowCount();
    }

    public function limparJobsAntigos(int $dias = 7): int {
        $stmt = $this->pdo->prepare("
            DELETE FROM jobs
            WHERE created_at < DATE_SUB(NOW(), INTERVAL :dias DAY)
            AND reserved_at IS NOT NULL
        ");
        $stmt->execute(['dias' => $dias]);
        return $stmt->rowCount();
    }

    public function limparJobsFalhados(int $dias = 30): int {
        $stmt = $this->pdo->prepare("
            DELETE FROM failed_jobs
            WHERE failed_at < DATE_SUB(NOW(), INTERVAL :dias DAY)
        ");
        $stmt->execute(['dias' => $dias]);
        return $stmt->rowCount();
    }

    public function listarJobsFalhados(int $limit = 50): array {
        $stmt = $this->pdo->prepare("
            SELECT * FROM failed_jobs
            ORDER BY failed_at DESC
            LIMIT :limit
        ");
        $stmt->bindValue('limit', $limit, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll();
    }

    public function reprocessarJobFalhado(int $failedJobId): ?int {
        $stmt = $this->pdo->prepare("SELECT * FROM failed_jobs WHERE id = :id");
        $stmt->execute(['id' => $failedJobId]);
        $failedJob = $stmt->fetch();
        
        if (!$failedJob) {
            return null;
        }
        
        $payload = json_decode($failedJob['payload'], true);
        
        $newJobId = $this->push(
            $payload['job'],
            $payload['data'],
            $failedJob['queue']
        );
        
        $deleteStmt = $this->pdo->prepare("DELETE FROM failed_jobs WHERE id = :id");
        $deleteStmt->execute(['id' => $failedJobId]);
        
        return $newJobId;
    }
}
