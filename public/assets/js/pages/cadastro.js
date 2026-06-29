// ==================== CADASTRO PÚBLICO ====================

function appUrl(path) {
    if (typeof window.glchatUrl === 'function') return window.glchatUrl(path);
    if (typeof window.hublabelUrl === 'function') return window.hublabelUrl(path);
    return path;
}

document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('cadastroForm');
    const btn = document.getElementById('cadastroBtn');
    const btnText = document.getElementById('btnText');
    const senhaInput = document.getElementById('senha');
    const confirmarSenhaInput = document.getElementById('confirmarSenha');
    const toggleSenha = document.getElementById('toggleSenha');
    const toggleConfirmarSenha = document.getElementById('toggleConfirmarSenha');
    
    // Toggle mostrar/ocultar senha
    if (toggleSenha) {
        toggleSenha.addEventListener('click', function() {
            const type = senhaInput.type === 'password' ? 'text' : 'password';
            senhaInput.type = type;
        });
    }
    
    if (toggleConfirmarSenha) {
        toggleConfirmarSenha.addEventListener('click', function() {
            const type = confirmarSenhaInput.type === 'password' ? 'text' : 'password';
            confirmarSenhaInput.type = type;
        });
    }
    
    // Validação de força da senha
    if (senhaInput) {
        senhaInput.addEventListener('input', function() {
            const senha = this.value;
            const strengthText = document.getElementById('passwordStrength');
            const strengthFill = document.getElementById('strengthFill');
            
            if (!senha) {
                strengthText.textContent = '';
                strengthFill.className = 'strength-fill';
                return;
            }
            
            let strength = 0;
            if (senha.length >= 8) strength++;
            if (senha.match(/[a-z]/) && senha.match(/[A-Z]/)) strength++;
            if (senha.match(/[0-9]/)) strength++;
            if (senha.match(/[^a-zA-Z0-9]/)) strength++;
            
            strengthFill.className = 'strength-fill';
            
            if (strength === 1) {
                strengthText.textContent = 'Fraca';
                strengthFill.classList.add('strength-weak');
            } else if (strength === 2) {
                strengthText.textContent = 'Média';
                strengthFill.classList.add('strength-medium');
            } else if (strength === 3) {
                strengthText.textContent = 'Forte';
                strengthFill.classList.add('strength-strong');
            } else if (strength === 4) {
                strengthText.textContent = 'Muito Forte';
                strengthFill.classList.add('strength-very-strong');
            }
        });
    }
    
    // Máscara de telefone
    const telefoneInput = document.getElementById('telefone');
    if (telefoneInput) {
        telefoneInput.addEventListener('input', function(e) {
            let value = e.target.value.replace(/\D/g, '');
            if (value.length > 11) value = value.slice(0, 11);
            
            if (value.length > 6) {
                value = value.replace(/^(\d{2})(\d{5})(\d{0,4}).*/, '($1) $2-$3');
            } else if (value.length > 2) {
                value = value.replace(/^(\d{2})(\d{0,5})/, '($1) $2');
            } else if (value.length > 0) {
                value = value.replace(/^(\d*)/, '($1');
            }
            
            e.target.value = value;
        });
    }
    
    // Submit do formulário
    if (form) {
        form.addEventListener('submit', async function(e) {
            e.preventDefault();
            
            const nome = document.getElementById('nome').value.trim();
            const email = document.getElementById('email').value.trim();
            const telefone = document.getElementById('telefone').value.replace(/\D/g, '');
            const senha = document.getElementById('senha').value;
            const confirmarSenha = document.getElementById('confirmarSenha').value;
            
            // Validações
            if (!nome || !email || !telefone || !senha || !confirmarSenha) {
                showToast('Preencha todos os campos obrigatórios', 'error');
                return;
            }
            
            if (senha.length < 8) {
                showToast('A senha deve ter no mínimo 8 caracteres', 'error');
                return;
            }
            
            if (senha !== confirmarSenha) {
                showToast('As senhas não coincidem', 'error');
                return;
            }
            
            if (!email.match(/^[^\s@]+@[^\s@]+\.[^\s@]+$/)) {
                showToast('E-mail inválido', 'error');
                return;
            }
            
            if (telefone.length < 10) {
                showToast('Telefone inválido', 'error');
                return;
            }
            
            // Desabilitar botão e mostrar loading
            btn.disabled = true;
            btn.classList.add('loading');
            btnText.innerHTML = '<i class="fa-solid fa-spinner fa-spin"></i> Criando conta...';
            
            try {
                const response = await fetch(appUrl('/api/cadastro/criar'), {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json'
                    },
                    body: JSON.stringify({
                        nome,
                        email,
                        telefone,
                        senha
                    })
                });
                
                console.log('Response status:', response.status);
                console.log('Response headers:', response.headers.get('content-type'));
                
                const text = await response.text();
                console.log('Response text:', text);
                
                const result = JSON.parse(text);
                
                if (result.success) {
                    showToast('Conta criada com sucesso! Redirecionando...', 'success');
                    
                    // Redirecionar para login após 2 segundos
                    setTimeout(() => {
                        window.location.href = appUrl('/login');
                    }, 2000);
                } else {
                    showToast(result.error || 'Erro ao criar conta', 'error');
                    btn.disabled = false;
                    btn.classList.remove('loading');
                    btnText.innerHTML = '<i class="fa-regular fa-user"></i> Criar Conta Gratuita';
                }
            } catch (error) {
                console.error('Erro ao criar conta:', error);
                showToast('Erro ao criar conta. Tente novamente.', 'error');
                btn.disabled = false;
                btn.classList.remove('loading');
                btnText.innerHTML = '<i class="fa-regular fa-user"></i> Criar Conta Gratuita';
            }
        });
    }
});

// Sistema de Toast
function showToast(message, type = 'info') {
    const container = document.getElementById('toastContainer') || createToastContainer();
    
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type}`;
    
    const messageDiv = document.createElement('div');
    messageDiv.className = 'toast-message';
    messageDiv.textContent = message;
    
    toast.appendChild(messageDiv);
    container.appendChild(toast);
    
    setTimeout(() => toast.classList.add('show'), 10);
    
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 400);
    }, 4000);
}

function createToastContainer() {
    const container = document.createElement('div');
    container.id = 'toastContainer';
    container.className = 'toast-container';
    document.body.appendChild(container);
    return container;
}
