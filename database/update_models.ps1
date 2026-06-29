# Script PowerShell para atualizar referências de tabelas nos Models

$modelsPath = "C:\xampp\htdocs\hublabel\app\Models"

# Mapeamento de tabelas antigas para novas
$replacements = @{
    'SAAS_AgentesIA' = 'agentes_ia'
    'SAAS_Conexões' = 'conexoes'
    'SAAS_Contatos' = 'contatos'
    'SAAS_Conversas_Agentes' = 'conversas_agentes'
    'SAAS_Mensagens' = 'mensagens'
    'SAAS_Disparos' = 'disparos'
    'SAAS_Detalhes_Disparos' = 'detalhes_disparos'
    'SAAS_Quadros' = 'quadros'
    'SAAS_Etapas_Quadros' = 'etapas_quadros'
    'SAAS_Cards_Quadros' = 'cards_quadros'
    'SAAS_Etiquetas' = 'etiquetas'
    'SAAS_Contatos_Etiquetas' = 'contatos_etiquetas'
}

# Processar cada arquivo PHP no diretório Models
Get-ChildItem -Path $modelsPath -Filter *.php | ForEach-Object {
    $file = $_.FullName
    $content = Get-Content $file -Raw
    
    $modified = $false
    foreach ($old in $replacements.Keys) {
        $new = $replacements[$old]
        if ($content -match [regex]::Escape($old)) {
            $content = $content -replace [regex]::Escape($old), $new
            $modified = $true
        }
    }
    
    if ($modified) {
        Set-Content -Path $file -Value $content -NoNewline
        Write-Host "✅ Atualizado: $($_.Name)"
    }
}

Write-Host "`n🎉 Atualização concluída!"
