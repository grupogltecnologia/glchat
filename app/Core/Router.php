<?php
class Router {
    private array $routes = ['GET'=>[], 'POST'=>[], 'PUT'=>[], 'DELETE'=>[]];
    
    public function get(string $path, callable $handler): void { 
        $this->routes['GET'][$path] = $handler; 
    }
    
    public function post(string $path, callable $handler): void { 
        $this->routes['POST'][$path] = $handler; 
    }
    
    public function put(string $path, callable $handler): void { 
        $this->routes['PUT'][$path] = $handler; 
    }
    
    public function delete(string $path, callable $handler): void { 
        $this->routes['DELETE'][$path] = $handler; 
    }
    
    public function dispatch(string $uri, string $method): void {
        $path = parse_url($uri, PHP_URL_PATH) ?: '/';

        $base = class_exists('App') ? App::basePath() : '/hublabel/public';
        if ($base !== '' && substr_count($path, $base) > 1) {
            $canonicalPath = preg_replace('#(?:' . preg_quote($base, '#') . ')+#', $base, $path);
            $query = parse_url($uri, PHP_URL_QUERY);
            header('Location: ' . $canonicalPath . ($query ? '?' . $query : ''));
            exit;
        }

        foreach (['/hublabel/public', '/glchat/public'] as $legacyBase) {
            if ($legacyBase === $base || substr_count($path, $legacyBase) <= 1) {
                continue;
            }

            $canonicalPath = preg_replace('#(?:' . preg_quote($legacyBase, '#') . ')+#', $base, $path);
            $query = parse_url($uri, PHP_URL_QUERY);
            header('Location: ' . $canonicalPath . ($query ? '?' . $query : ''));
            exit;
        }
        
        // Remover o caminho base atual ou caminhos legados se existirem.
        if ($base !== '' && str_starts_with($path, $base)) {
            $path = substr($path, strlen($base)) ?: '/';
        }
        $path = preg_replace('#^/(?:hublabel|glchat)/public#', '', $path) ?: '/';
        
        // Remover index.php do caminho
        $path = str_replace('/index.php', '', $path);
        
        // Garantir que sempre comece com /
        if (empty($path) || $path === '') {
            $path = '/';
        }
        
        if ($method === 'POST' && isset($_POST['_method'])) {
            $method = strtoupper($_POST['_method']);
        }
        
        // Debug: log para APIs
        if (str_starts_with($path, '/api/')) {
            error_log("Router: $method $path");
        }
        
        $handler = $this->routes[$method][$path] ?? null;
        
        if (!$handler) { 
            http_response_code(404); 
            if (str_starts_with($path, '/api/')) {
                header('Content-Type: application/json');
                echo json_encode(['success' => false, 'error' => '404 - Rota não encontrada', 'path' => $path]);
            } else {
                echo '<h1>404 - Página não encontrada</h1>';
                echo '<p>Caminho solicitado: ' . htmlspecialchars($path) . '</p>';
                $loginUrl = class_exists('App') ? App::url('/login') : '/hublabel/public/login';
                echo '<p><a href="' . htmlspecialchars($loginUrl) . '">Ir para Login</a></p>';
            }
            return; 
        }
        
        $handler();
    }
}
