/**
 * Login - JavaScript funcional
 */

function appUrl(path) {
    if (typeof window.glchatUrl === 'function') return window.glchatUrl(path);
    if (typeof window.hublabelUrl === 'function') return window.hublabelUrl(path);
    return path;
}

document.addEventListener('DOMContentLoaded', function() {
    console.log('🔐 Login JS carregado');
    
    const loginForm = document.getElementById('loginForm');
    const loginBtn = document.querySelector('.login-btn, button[type="submit"]');
    
    if (!loginForm) {
        console.error('❌ Formulário de login não encontrado');
        return;
    }
    
    // Toggle senha
    const togglePassword = document.querySelector('.toggle-password, [data-toggle="password"]');
    if (togglePassword) {
        togglePassword.addEventListener('click', function() {
            const passwordInput = document.querySelector('input[type="password"], input[name="password"]');
            if (passwordInput) {
                const type = passwordInput.type === 'password' ? 'text' : 'password';
                passwordInput.type = type;
                
                const icon = this.querySelector('i');
                if (icon) {
                    icon.classList.toggle('fa-eye');
                    icon.classList.toggle('fa-eye-slash');
                }
            }
        });
    }
    
    // Submit do formulário
    loginForm.addEventListener('submit', async function(e) {
        e.preventDefault();
        console.log('📤 Enviando login...');
        
        const emailInput = document.querySelector('input[type="email"], input[name="email"]');
        const passwordInput = document.querySelector('input[type="password"], input[name="password"]');
        
        if (!emailInput || !passwordInput) {
            showToast('Campos não encontrados', 'error');
            return;
        }
        
        const email = emailInput.value.trim();
        const password = passwordInput.value;
        
        if (!email || !password) {
            showToast('Preencha todos os campos', 'error');
            return;
        }
        
        if (loginBtn) {
            loginBtn.disabled = true;
            loginBtn.innerHTML = 'Entrando...';
        }
        
        try {
            const response = await fetch(appUrl('/login'), {
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ email, password })
            });
            
            const data = await response.json();
            
            if (data.success) {
                showToast('Login realizado com sucesso!', 'success');
                setTimeout(() => {
                    window.location.href = appUrl('/dashboard');
                }, 500);
            } else {
                showToast(data.error || 'Erro ao fazer login', 'error');
                if (loginBtn) {
                    loginBtn.disabled = false;
                    loginBtn.innerHTML = '→ Entrar na Plataforma';
                }
            }
        } catch (error) {
            console.error('Erro:', error);
            showToast('Erro ao conectar com o servidor', 'error');
            if (loginBtn) {
                loginBtn.disabled = false;
                loginBtn.innerHTML = '→ Entrar na Plataforma';
            }
        }
    });
});

function showToast(message, type = 'info') {
    let container = document.getElementById('toastContainer');
    if (!container) {
        container = document.createElement('div');
        container.id = 'toastContainer';
        container.className = 'toast-container';
        document.body.appendChild(container);
    }
    
    const toast = document.createElement('div');
    toast.className = `toast-notification ${type}`;
    toast.innerHTML = `<span class="toast-message">${message}</span>`;
    
    container.appendChild(toast);
    setTimeout(() => toast.classList.add('show'), 10);
    
    setTimeout(() => {
        toast.classList.remove('show');
        setTimeout(() => toast.remove(), 400);
    }, 3000);
}
