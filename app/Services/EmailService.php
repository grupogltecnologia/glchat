<?php
class EmailService {
    private string $smtpHost;
    private int $smtpPort;
    private string $smtpUser;
    private string $smtpPass;
    private string $fromEmail;
    private string $fromName;

    public function __construct() {
        $this->smtpHost = getenv('SMTP_HOST') ?: 'smtp.gmail.com';
        $this->smtpPort = (int)(getenv('SMTP_PORT') ?: 587);
        $this->smtpUser = getenv('SMTP_USER') ?: '';
        $this->smtpPass = getenv('SMTP_PASS') ?: '';
        $this->fromEmail = getenv('SMTP_FROM_EMAIL') ?: $this->smtpUser;
        $this->fromName = getenv('SMTP_FROM_NAME') ?: 'HUBLABEL';
    }

    public function enviar(string $para, string $assunto, string $corpo, bool $isHtml = true): array {
        $headers = $this->montarHeaders($isHtml);
        
        $corpo = $isHtml ? $this->wrapHtml($corpo) : $corpo;
        
        if (@mail($para, $assunto, $corpo, implode("\r\n", $headers))) {
            return ['success' => true, 'message' => 'Email enviado com sucesso'];
        }
        
        return ['success' => false, 'error' => 'Erro ao enviar email'];
    }

    public function enviarComSMTP(string $para, string $assunto, string $corpo, bool $isHtml = true): array {
        try {
            $socket = fsockopen($this->smtpHost, $this->smtpPort, $errno, $errstr, 30);
            
            if (!$socket) {
                return ['success' => false, 'error' => "Erro ao conectar: $errstr ($errno)"];
            }
            
            $this->lerResposta($socket);
            
            fputs($socket, "EHLO {$this->smtpHost}\r\n");
            $this->lerResposta($socket);
            
            if ($this->smtpPort == 587) {
                fputs($socket, "STARTTLS\r\n");
                $this->lerResposta($socket);
                stream_socket_enable_crypto($socket, true, STREAM_CRYPTO_METHOD_TLS_CLIENT);
                
                fputs($socket, "EHLO {$this->smtpHost}\r\n");
                $this->lerResposta($socket);
            }
            
            fputs($socket, "AUTH LOGIN\r\n");
            $this->lerResposta($socket);
            
            fputs($socket, base64_encode($this->smtpUser) . "\r\n");
            $this->lerResposta($socket);
            
            fputs($socket, base64_encode($this->smtpPass) . "\r\n");
            $this->lerResposta($socket);
            
            fputs($socket, "MAIL FROM: <{$this->fromEmail}>\r\n");
            $this->lerResposta($socket);
            
            fputs($socket, "RCPT TO: <{$para}>\r\n");
            $this->lerResposta($socket);
            
            fputs($socket, "DATA\r\n");
            $this->lerResposta($socket);
            
            $headers = "From: {$this->fromName} <{$this->fromEmail}>\r\n";
            $headers .= "To: {$para}\r\n";
            $headers .= "Subject: {$assunto}\r\n";
            $headers .= "MIME-Version: 1.0\r\n";
            
            if ($isHtml) {
                $headers .= "Content-Type: text/html; charset=UTF-8\r\n";
                $corpo = $this->wrapHtml($corpo);
            } else {
                $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";
            }
            
            $headers .= "\r\n";
            
            fputs($socket, $headers . $corpo . "\r\n.\r\n");
            $this->lerResposta($socket);
            
            fputs($socket, "QUIT\r\n");
            $this->lerResposta($socket);
            
            fclose($socket);
            
            return ['success' => true, 'message' => 'Email enviado com sucesso'];
            
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }

    public function enviarBoasVindas(string $email, string $nome, string $senha): array {
        $assunto = "Bem-vindo ao HUBLABEL!";
        
        $corpo = "
            <h2>Olá, {$nome}!</h2>
            <p>Sua conta foi criada com sucesso no HUBLABEL.</p>
            <p><strong>Email:</strong> {$email}</p>
            <p><strong>Senha temporária:</strong> {$senha}</p>
            <p>Por favor, altere sua senha no primeiro acesso.</p>
            <p><a href='" . (getenv('APP_URL') ?: 'http://localhost:8000') . "/login'>Acessar HUBLABEL</a></p>
        ";
        
        return $this->enviarComSMTP($email, $assunto, $corpo);
    }

    public function enviarRecuperacaoSenha(string $email, string $token): array {
        $assunto = "Recuperação de Senha - HUBLABEL";
        
        $link = (getenv('APP_URL') ?: 'http://localhost:8000') . "/redefinir-senha?token={$token}";
        
        $corpo = "
            <h2>Recuperação de Senha</h2>
            <p>Você solicitou a recuperação de senha da sua conta HUBLABEL.</p>
            <p>Clique no link abaixo para redefinir sua senha:</p>
            <p><a href='{$link}'>Redefinir Senha</a></p>
            <p>Se você não solicitou esta recuperação, ignore este email.</p>
            <p>Este link expira em 1 hora.</p>
        ";
        
        return $this->enviarComSMTP($email, $assunto, $corpo);
    }

    public function enviarNotificacao(string $email, string $titulo, string $mensagem): array {
        $assunto = "Notificação - HUBLABEL";
        
        $corpo = "
            <h2>{$titulo}</h2>
            <p>{$mensagem}</p>
            <p><a href='" . (getenv('APP_URL') ?: 'http://localhost:8000') . "/dashboard'>Acessar HUBLABEL</a></p>
        ";
        
        return $this->enviarComSMTP($email, $assunto, $corpo);
    }

    private function montarHeaders(bool $isHtml): array {
        $headers = [];
        $headers[] = "From: {$this->fromName} <{$this->fromEmail}>";
        $headers[] = "Reply-To: {$this->fromEmail}";
        $headers[] = "MIME-Version: 1.0";
        
        if ($isHtml) {
            $headers[] = "Content-Type: text/html; charset=UTF-8";
        } else {
            $headers[] = "Content-Type: text/plain; charset=UTF-8";
        }
        
        return $headers;
    }

    private function wrapHtml(string $corpo): string {
        return "
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset='UTF-8'>
            <meta name='viewport' content='width=device-width, initial-scale=1.0'>
            <style>
                body { font-family: Arial, sans-serif; line-height: 1.6; color: #333; }
                .container { max-width: 600px; margin: 0 auto; padding: 20px; }
                h2 { color: #3b82f6; }
                a { color: #3b82f6; text-decoration: none; }
                .button { display: inline-block; padding: 10px 20px; background: #3b82f6; color: white; border-radius: 5px; margin: 10px 0; }
            </style>
        </head>
        <body>
            <div class='container'>
                {$corpo}
                <hr style='margin: 30px 0; border: none; border-top: 1px solid #ddd;'>
                <p style='font-size: 12px; color: #666;'>
                    Este é um email automático do HUBLABEL. Por favor, não responda.
                </p>
            </div>
        </body>
        </html>
        ";
    }

    private function lerResposta($socket): string {
        $response = '';
        while ($line = fgets($socket, 515)) {
            $response .= $line;
            if (substr($line, 3, 1) == ' ') {
                break;
            }
        }
        return $response;
    }

    public function testarConexao(): array {
        try {
            $socket = @fsockopen($this->smtpHost, $this->smtpPort, $errno, $errstr, 10);
            
            if (!$socket) {
                return ['success' => false, 'error' => "Erro ao conectar: $errstr ($errno)"];
            }
            
            fclose($socket);
            return ['success' => true, 'message' => 'Conexão SMTP OK'];
            
        } catch (Exception $e) {
            return ['success' => false, 'error' => $e->getMessage()];
        }
    }
}
