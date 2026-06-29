<?php
/**
 * Redefinir Senha - HTML/CSS limpo do n8n
 * JavaScript será adicionado separadamente
 */
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <!-- Versão limpa: HTML + CSS apenas. JavaScript removido. -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#ffffff">
    <title>Redefinir Senha - IA Chatconversa</title>

    <link rel="icon" type="image/png" href="/hublabel/public/hublabel/public/assets/images/favicon">
    <link rel="shortcut icon" type="image/png" href="/hublabel/public/hublabel/public/assets/images/favicon">
    <link rel="apple-touch-icon" href="/hublabel/public/hublabel/public/assets/images/favicon">

    
<!-- scripts removidos para manter somente HTML + CSS -->

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    
<!-- scripts removidos para manter somente HTML + CSS -->

    <style>
        body { background-color: #ffffff; }
        .success-message, .error-message { display: none; }
        .success-message.show, .error-message.show { display: block; }
        .loading-spinner {
            width: 20px;
            height: 20px;
            border: 2px solid rgba(255, 255, 255, 0.35);
            border-top: 2px solid white;
            border-radius: 50%;
            animation: spin-reset 1s linear infinite;
            display: none;
        }
        .reset-btn.loading .loading-spinner { display: block; }
        @keyframes spin-reset {
            to { transform: rotate(360deg); }
        }
        .bg-pattern {
            background-image: radial-gradient(rgba(255, 255, 255, 0.1) 1px, transparent 1px);
            background-size: 24px 24px;
        }
        .strength-fill {
            height: 100%;
            width: 0%;
            transition: all 0.3s ease;
            border-radius: 2px;
        }
        .strength-weak { background: #ef4444; }
        .strength-medium { background: #f59e0b; }
        .strength-strong { background: #22c55e; }
        .strength-very-strong { background: #6C63FF; }

        /* === Dropdowns <select>: fundo branco e texto preto (light e dark) === */
        body.light-mode select,
        body.dark-mode select,
        body:not(.light-mode) select {
            background-color: #ffffff !important;
            color: #000000 !important;
            -webkit-text-fill-color: #000000 !important;
        }
        body.light-mode select option,
        body.dark-mode select option,
        body:not(.light-mode) select option,
        body.light-mode select optgroup,
        body.dark-mode select optgroup,
        body:not(.light-mode) select optgroup {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
        body.light-mode select[class],
        body.dark-mode select[class],
        body:not(.light-mode) select[class] {
            background-color: #ffffff !important;
            color: #000000 !important;
            -webkit-text-fill-color: #000000 !important;
        }
        body.light-mode select[class] option,
        body.dark-mode select[class] option,
        body:not(.light-mode) select[class] option {
            background-color: #ffffff !important;
            color: #000000 !important;
        }
    </style>
    <link rel="stylesheet" href="dropdowns-global.css">
</head>
<body class="font-sans antialiased min-h-screen flex selection:bg-brand-500 selection:text-white text-slate-900">

    <div class="flex flex-1 w-full min-h-screen">
        <div class="w-full lg:w-1/2 flex flex-col items-center justify-center p-8 sm:p-12 relative">
            <div class="w-full max-w-md mx-auto flex flex-col justify-center min-h-full py-8 lg:py-12">

                <a href="https://app.chatconversa.app.br/login" class="inline-flex items-center gap-2 text-sm font-bold text-brand-600 hover:text-brand-700 transition-colors mb-8 -mt-2">
                    <i class="fa-solid fa-arrow-left text-xs"></i>
                    Voltar para login
                </a>

                <div class="mb-10 text-center">
                    <img src="/hublabel/public/assets/images/logo" alt="IA Chatconversa" class="h-12 sm:h-14 w-auto max-w-[min(100%,320px)] object-contain object-center mx-auto" width="320" height="112">
                    <div class="flex items-center justify-center gap-3" style="display: none;">
                        <div class="w-10 h-10 rounded-xl bg-brand-500 text-white flex items-center justify-center text-xl font-bold shadow-[0_4px_14px_rgba(37,211,102,0.35)] shrink-0">D</div>
                        <span class="font-extrabold text-2xl tracking-tight text-slate-900">IA Chatconversa</span>
                    </div>
                </div>

                <h1 class="text-3xl font-extrabold text-slate-900 mb-2 tracking-tight text-center">Redefinir senha</h1>
                <p class="text-slate-500 font-medium mb-8 text-center">Digite e confirme sua nova senha para voltar a acessar a conta.</p>

                <form id="resetForm" class="space-y-5 w-full">
                    <div class="success-message rounded-xl border border-success-200 bg-success-50 text-success-800 text-sm font-semibold text-center py-3 px-4" id="successMessage"></div>
                    <div class="error-message rounded-xl border border-red-200 bg-red-50 text-red-800 text-sm font-semibold text-center py-3 px-4" id="errorMessage"></div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2" for="newPassword">Nova senha <span class="text-brand-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="fa-solid fa-lock text-slate-400 text-sm"></i>
                            </div>
                            <input type="password" id="newPassword" name="newPassword" placeholder="Digite sua nova senha" required autocomplete="new-password"
                                class="w-full bg-white border border-slate-200 rounded-xl pl-11 pr-12 py-3.5 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all shadow-sm">
                            <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600 transition-colors bg-transparent border-0 cursor-pointer" id="toggleNewPassword" aria-label="Mostrar ou ocultar senha">
                                <span class="eye-icon-new flex items-center justify-center">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </span>
                            </button>
                        </div>
                        <div class="password-strength text-xs font-semibold text-slate-500 mt-2 min-h-[1.25rem]" id="passwordStrength"></div>
                        <div class="h-1 bg-slate-200 rounded-full mt-2 overflow-hidden">
                            <div class="strength-fill" id="strengthFill"></div>
                        </div>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2" for="confirmPassword">Confirmar nova senha <span class="text-brand-500">*</span></label>
                        <div class="relative">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-4 pointer-events-none">
                                <i class="fa-solid fa-lock text-slate-400 text-sm"></i>
                            </div>
                            <input type="password" id="confirmPassword" name="confirmPassword" placeholder="Confirme sua nova senha" required autocomplete="new-password"
                                class="w-full bg-white border border-slate-200 rounded-xl pl-11 pr-12 py-3.5 text-sm font-semibold text-slate-900 placeholder:text-slate-400 focus:outline-none focus:border-brand-500 focus:ring-4 focus:ring-brand-500/10 transition-all shadow-sm">
                            <button type="button" class="absolute inset-y-0 right-0 flex items-center pr-4 text-slate-400 hover:text-slate-600 transition-colors bg-transparent border-0 cursor-pointer" id="toggleConfirmPassword" aria-label="Mostrar ou ocultar confirmação">
                                <span class="eye-icon-confirm flex items-center justify-center">
                                    <svg width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                        <circle cx="12" cy="12" r="3"></circle>
                                    </svg>
                                </span>
                            </button>
                        </div>
                    </div>

                    <button type="submit" class="reset-btn w-full bg-brand-500 hover:bg-brand-600 disabled:hover:bg-brand-500 text-white font-extrabold py-4 rounded-xl shadow-[0_4px_20px_rgba(37,211,102,0.35)] transition-all hover:-translate-y-0.5 disabled:transform-none mt-2 flex items-center justify-center gap-2 disabled:opacity-70" id="resetBtn">
                        <div class="loading-spinner"></div>
                        <span id="btnText" class="inline-flex items-center justify-center gap-2">
                            <i class="fa-solid fa-key"></i>
                            Redefinir senha
                        </span>
                    </button>

                    <div class="flex items-start gap-2 bg-brand-50 border border-brand-100 rounded-lg p-3">
                        <i class="fa-solid fa-shield-halved text-brand-500 text-sm mt-0.5 shrink-0"></i>
                        <span class="text-xs font-bold text-brand-800 leading-snug">Os seus dados estão protegidos com criptografia de ponta a ponta.</span>
                    </div>
                </form>
            </div>

            <div class="w-full text-center mt-auto pt-8 pb-4">
                <p class="text-[11px] font-bold text-slate-400 uppercase tracking-widest">© 2026 • Plataforma segura e confiável</p>
            </div>
        </div>

        <div class="hidden lg:flex w-1/2 bg-slate-900 relative overflow-hidden items-center justify-center p-12">
            <div class="absolute inset-0 bg-pattern opacity-10"></div>
            <div class="absolute -top-40 -right-40 w-[600px] h-[600px] bg-brand-500 rounded-full blur-[120px] opacity-20 animate-pulse"></div>
            <div class="absolute -bottom-40 -left-40 w-[600px] h-[600px] bg-blue-600 rounded-full blur-[120px] opacity-20"></div>

            <div class="relative z-10 w-full max-w-lg text-left">
                <div class="flex gap-4 mb-8">
                    <div class="w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center text-white border border-white/20 shadow-xl">
                        <i class="fa-brands fa-whatsapp text-2xl"></i>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-brand-500 flex items-center justify-center text-white border border-brand-400 shadow-[0_0_20px_rgba(37,211,102,0.4)] transform -translate-y-2">
                        <i class="fa-solid fa-robot text-xl"></i>
                    </div>
                    <div class="w-12 h-12 rounded-xl bg-white/10 backdrop-blur-md flex items-center justify-center text-white border border-white/20 shadow-xl">
                        <i class="fa-solid fa-chart-line text-xl"></i>
                    </div>
                </div>

                <h2 class="text-4xl font-black text-white leading-tight mb-6">
                    Automatize o seu WhatsApp e <span class="text-brand-400">escale as suas vendas.</span>
                </h2>
                <p class="text-lg text-slate-300 font-medium leading-relaxed">
                    Transforme mensagens em receitas com a plataforma completa de CRM, Disparos e Agentes IA. Tudo o que precisa para vender mais e melhor.
                </p>
            </div>
        </div>
    </div>

    
<!-- scripts removidos para manter somente HTML + CSS -->


<!-- JavaScript de inicialização -->
<script src="/hublabel/public/assets/js/pages/redefinir_senha.js"></script>
</body>
</html>
