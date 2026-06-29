// HUBLABEL - Main JavaScript

// API Helper
const API = {
    async request(url, options = {}) {
        const defaultOptions = {
            headers: {
                'Content-Type': 'application/json',
            },
        };

        const response = await fetch(url, { ...defaultOptions, ...options });
        const data = await response.json();

        if (!data.success) {
            throw new Error(data.error || 'Erro desconhecido');
        }

        return data.data;
    },

    get(url) {
        return this.request(url, { method: 'GET' });
    },

    post(url, body) {
        return this.request(url, {
            method: 'POST',
            body: JSON.stringify(body),
        });
    },

    put(url, body) {
        return this.request(url, {
            method: 'PUT',
            body: JSON.stringify(body),
        });
    },

    delete(url) {
        return this.request(url, { method: 'DELETE' });
    },
};

// Toast Notifications
const Toast = {
    show(message, type = 'info') {
        const toast = document.createElement('div');
        toast.className = `toast toast-${type}`;
        toast.innerHTML = `
            <span class="material-symbols-rounded">${this.getIcon(type)}</span>
            <span>${message}</span>
        `;

        document.body.appendChild(toast);

        setTimeout(() => toast.classList.add('show'), 100);
        setTimeout(() => {
            toast.classList.remove('show');
            setTimeout(() => toast.remove(), 300);
        }, 3000);
    },

    getIcon(type) {
        const icons = {
            success: 'check_circle',
            error: 'error',
            warning: 'warning',
            info: 'info',
        };
        return icons[type] || 'info';
    },

    success(message) {
        this.show(message, 'success');
    },

    error(message) {
        this.show(message, 'error');
    },

    warning(message) {
        this.show(message, 'warning');
    },

    info(message) {
        this.show(message, 'info');
    },
};

// Modal Helper
const Modal = {
    open(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.add('active');
            document.body.style.overflow = 'hidden';
        }
    },

    close(modalId) {
        const modal = document.getElementById(modalId);
        if (modal) {
            modal.classList.remove('active');
            document.body.style.overflow = '';
        }
    },

    closeAll() {
        document.querySelectorAll('.modal.active').forEach(modal => {
            modal.classList.remove('active');
        });
        document.body.style.overflow = '';
    },
};

// Form Validation
const Validator = {
    required(value) {
        return value && value.trim() !== '';
    },

    email(value) {
        const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return regex.test(value);
    },

    phone(value) {
        const cleaned = value.replace(/\D/g, '');
        return cleaned.length >= 10 && cleaned.length <= 11;
    },

    minLength(value, min) {
        return value && value.length >= min;
    },

    maxLength(value, max) {
        return value && value.length <= max;
    },

    validateForm(formId, rules) {
        const form = document.getElementById(formId);
        if (!form) return false;

        let isValid = true;
        const errors = {};

        Object.keys(rules).forEach(fieldName => {
            const field = form.querySelector(`[name="${fieldName}"]`);
            if (!field) return;

            const value = field.value;
            const fieldRules = rules[fieldName];

            fieldRules.forEach(rule => {
                if (typeof rule === 'function') {
                    if (!rule(value)) {
                        isValid = false;
                        errors[fieldName] = errors[fieldName] || [];
                        errors[fieldName].push('Campo inválido');
                    }
                } else if (rule.type === 'required' && !this.required(value)) {
                    isValid = false;
                    errors[fieldName] = errors[fieldName] || [];
                    errors[fieldName].push(rule.message || 'Campo obrigatório');
                } else if (rule.type === 'email' && !this.email(value)) {
                    isValid = false;
                    errors[fieldName] = errors[fieldName] || [];
                    errors[fieldName].push(rule.message || 'Email inválido');
                }
            });
        });

        return { isValid, errors };
    },
};

// Format Helpers
const Format = {
    phone(value) {
        const cleaned = value.replace(/\D/g, '');
        if (cleaned.length === 11) {
            return cleaned.replace(/(\d{2})(\d{5})(\d{4})/, '($1) $2-$3');
        } else if (cleaned.length === 10) {
            return cleaned.replace(/(\d{2})(\d{4})(\d{4})/, '($1) $2-$3');
        }
        return value;
    },

    currency(value) {
        return new Intl.NumberFormat('pt-BR', {
            style: 'currency',
            currency: 'BRL',
        }).format(value);
    },

    date(value) {
        const date = new Date(value);
        return new Intl.DateTimeFormat('pt-BR').format(date);
    },

    datetime(value) {
        const date = new Date(value);
        return new Intl.DateTimeFormat('pt-BR', {
            dateStyle: 'short',
            timeStyle: 'short',
        }).format(date);
    },

    number(value) {
        return new Intl.NumberFormat('pt-BR').format(value);
    },
};

// Loading State
const Loading = {
    show(elementId) {
        const element = document.getElementById(elementId);
        if (element) {
            element.disabled = true;
            element.dataset.originalText = element.innerHTML;
            element.innerHTML = '<span class="loading"></span> Carregando...';
        }
    },

    hide(elementId) {
        const element = document.getElementById(elementId);
        if (element && element.dataset.originalText) {
            element.disabled = false;
            element.innerHTML = element.dataset.originalText;
        }
    },
};

// Debounce
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Copy to Clipboard
async function copyToClipboard(text) {
    try {
        await navigator.clipboard.writeText(text);
        Toast.success('Copiado para a área de transferência');
    } catch (err) {
        Toast.error('Erro ao copiar');
    }
}

// Initialize
document.addEventListener('DOMContentLoaded', function() {
    // Close modals on ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            Modal.closeAll();
        }
    });

    // Auto-hide alerts
    document.querySelectorAll('.alert').forEach(alert => {
        setTimeout(() => {
            alert.style.opacity = '0';
            setTimeout(() => alert.remove(), 300);
        }, 5000);
    });

    // Phone mask
    document.querySelectorAll('input[type="tel"]').forEach(input => {
        input.addEventListener('input', function(e) {
            e.target.value = Format.phone(e.target.value);
        });
    });
});

// Export to global
window.API = API;
window.Toast = Toast;
window.Modal = Modal;
window.Validator = Validator;
window.Format = Format;
window.Loading = Loading;
window.debounce = debounce;
window.copyToClipboard = copyToClipboard;
