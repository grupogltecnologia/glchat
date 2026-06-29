<?php
/**
 * Interface para serviços de WhatsApp
 * Permite implementar diferentes provedores (Evolution, Uazapi, etc)
 */
interface WhatsAppServiceInterface {
    // Gerenciamento de Instâncias
    public function criarInstancia(string $instanceName, string $token = null): array;
    public function conectarInstancia(string $instanceName): array;
    public function desconectarInstancia(string $instanceName): array;
    public function deletarInstancia(string $instanceName): array;
    public function verificarStatus(string $instanceName): array;
    public function obterQRCode(string $instanceName): array;
    
    // Envio de Mensagens
    public function enviarTexto(string $instanceName, string $numero, string $mensagem): array;
    public function enviarImagem(string $instanceName, string $numero, string $urlImagem, string $caption = ''): array;
    public function enviarAudio(string $instanceName, string $numero, string $urlAudio): array;
    public function enviarVideo(string $instanceName, string $numero, string $urlVideo, string $caption = ''): array;
    public function enviarDocumento(string $instanceName, string $numero, string $urlDocumento, string $filename = ''): array;
    
    // Contatos e Grupos
    public function sincronizarContatos(string $instanceName): array;
    public function obterInfoContato(string $instanceName, string $numero): array;
    public function listarGrupos(string $instanceName): array;
    public function obterParticipantesGrupo(string $instanceName, string $grupoId): array;
    
    // Utilidades
    public function marcarComoLida(string $instanceName, string $messageId): array;
    public function obterFotoPerfil(string $instanceName, string $numero): array;
    public function configurarWebhook(string $instanceName, string $webhookUrl, array $eventos = []): array;
    public function validarNumero(string $numero): bool;
}
