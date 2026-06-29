-- Script para remover prefixo SAAS_ das tabelas
-- Execute este script no MySQL para renomear todas as tabelas

SET FOREIGN_KEY_CHECKS=0;

-- Renomear tabelas removendo prefixo SAAS_
RENAME TABLE `SAAS_AgentesIA` TO `agentes_ia`;
RENAME TABLE `SAAS_Campos_Personalizados` TO `campos_personalizados`;
RENAME TABLE `SAAS_Cards_Quadros` TO `cards_quadros`;
RENAME TABLE `SAAS_Conexoes` TO `conexoes`;
RENAME TABLE `SAAS_Contatos` TO `contatos`;
RENAME TABLE `SAAS_Conversas` TO `conversas`;
RENAME TABLE `SAAS_CRM_Etapas` TO `crm_etapas`;
RENAME TABLE `SAAS_CRM_Quadros` TO `crm_quadros`;
RENAME TABLE `SAAS_Disparos` TO `disparos`;
RENAME TABLE `SAAS_Email_Templates` TO `email_templates`;
RENAME TABLE `SAAS_Etiquetas` TO `etiquetas`;
RENAME TABLE `SAAS_Historico_AgenteIA` TO `historico_agente_ia`;
RENAME TABLE `SAAS_IntegracaoPagamento` TO `integracao_pagamento`;
RENAME TABLE `SAAS_Mensagens` TO `mensagens`;
RENAME TABLE `SAAS_Planos` TO `planos_saas`;
RENAME TABLE `SAAS_Quadros` TO `quadros`;
RENAME TABLE `SAAS_Resposta_Rapidas` TO `respostas_rapidas`;
RENAME TABLE `SAAS_Usuarios` TO `usuarios_saas`;
RENAME TABLE `SAAS_Valores_Campos_Personalizados` TO `valores_campos_personalizados`;
RENAME TABLE `SAAS_Versao` TO `versao`;
RENAME TABLE `SAAS_Webhook` TO `webhook`;

-- Tabelas específicas do sistema
RENAME TABLE `SAAS_Contas` TO `contas_saas`;
RENAME TABLE `SAAS_Contatos_Etiquetas` TO `contatos_etiquetas`;
RENAME TABLE `SAAS_Conversas_Agentes` TO `conversas_agentes`;
RENAME TABLE `SAAS_Detalhes_Disparos` TO `detalhes_disparos`;
RENAME TABLE `SAAS_Config_Emails` TO `config_emails`;
RENAME TABLE `SAAS_Conhecimentos` TO `conhecimentos`;

SET FOREIGN_KEY_CHECKS=1;

-- Verificar tabelas renomeadas
SHOW TABLES;
