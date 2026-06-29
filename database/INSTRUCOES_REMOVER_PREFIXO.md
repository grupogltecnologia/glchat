# Instruções para Remover Prefixo SAAS_ das Tabelas

## 📋 **Passo a Passo**

### **1. Backup do Banco de Dados**
Antes de executar qualquer alteração, faça backup:

```bash
# No phpMyAdmin: Exportar > Salvar como arquivo SQL
# Ou via linha de comando:
mysqldump -u root hublabel > backup_antes_rename.sql
```

---

### **2. Executar Script de Renomeação**

**Opção A - Via phpMyAdmin:**
1. Abra phpMyAdmin
2. Selecione o banco `hublabel`
3. Clique em "SQL"
4. Cole o conteúdo do arquivo `remove_saas_prefix.sql`
5. Clique em "Executar"

**Opção B - Via linha de comando:**
```bash
mysql -u root hublabel < database/remove_saas_prefix.sql
```

---

### **3. Atualizar Código PHP**

Após renomear as tabelas, você precisa atualizar as referências no código PHP.

**Arquivos que precisam ser atualizados:**

#### **a) AdminController.php**
```php
// ANTES:
$stmt = $this->pdo->query("SELECT * FROM SAAS_Planos");

// DEPOIS:
$stmt = $this->pdo->query("SELECT * FROM planos_saas");
```

#### **b) Outros Models (quando criar)**
- `AgentesIAModel.php` → usar `agentes_ia`
- `ConexoesModel.php` → usar `conexoes`
- `ContatosModel.php` → usar `contatos`
- `ConversasModel.php` → usar `conversas`
- `DisparosModel.php` → usar `disparos`
- etc.

---

### **4. Tabelas Renomeadas**

| Antes | Depois |
|-------|--------|
| `SAAS_AgentesIA` | `agentes_ia` |
| `SAAS_Campos_Personalizados` | `campos_personalizados` |
| `SAAS_Conexoes` | `conexoes` |
| `SAAS_Contatos` | `contatos` |
| `SAAS_Conversas` | `conversas` |
| `SAAS_CRM_Etapas` | `crm_etapas` |
| `SAAS_CRM_Quadros` | `crm_quadros` |
| `SAAS_Disparos` | `disparos` |
| `SAAS_Email_Templates` | `email_templates` |
| `SAAS_Etiquetas` | `etiquetas` |
| `SAAS_IntegracaoPagamento` | `integracao_pagamento` |
| `SAAS_Mensagens` | `mensagens` |
| `SAAS_Planos` | `planos_saas` |
| `SAAS_Usuarios` | `usuarios_saas` |
| `SAAS_Contas` | `contas_saas` |
| `SAAS_Webhook` | `webhook` |

---

### **5. Verificar Funcionamento**

Após executar, teste:

1. ✅ Login ainda funciona
2. ✅ Dashboard carrega
3. ✅ Admin > Clientes lista corretamente
4. ✅ Admin > Planos lista corretamente
5. ✅ Criar/Editar cliente funciona

---

### **6. Reverter (se necessário)**

Se algo der errado, restaure o backup:

```bash
mysql -u root hublabel < backup_antes_rename.sql
```

---

## ⚠️ **IMPORTANTE**

- **NÃO execute** este script se já tiver dados importantes no banco
- Faça **SEMPRE** backup antes
- Teste em ambiente de desenvolvimento primeiro
- Algumas tabelas como `usuarios`, `contas`, `planos`, `assinaturas`, `transacoes` **NÃO** têm prefixo SAAS_ porque já foram criadas sem ele

---

## 🎯 **Resultado Final**

Todas as tabelas terão nomes limpos, sem prefixo:
- ✅ `agentes_ia` em vez de `SAAS_AgentesIA`
- ✅ `conexoes` em vez de `SAAS_Conexoes`
- ✅ `contatos` em vez de `SAAS_Contatos`
- etc.

Isso deixa o banco mais profissional e fácil de trabalhar! 🚀
