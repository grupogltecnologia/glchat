<footer class="page-footer">
    <div class="footer-content">
        <p>&copy; <?= date('Y') ?> HUBLABEL. Todos os direitos reservados.</p>
        <div class="footer-links">
            <a href="/ajuda">Ajuda</a>
            <a href="#">Termos de Uso</a>
            <a href="#">Privacidade</a>
        </div>
    </div>
</footer>

<style>
.page-footer {
    background: white;
    border-top: 1px solid #e5e7eb;
    padding: 20px 24px;
    margin-top: auto;
}

.footer-content {
    display: flex;
    align-items: center;
    justify-content: space-between;
    flex-wrap: wrap;
    gap: 16px;
}

.footer-content p {
    margin: 0;
    color: #64748b;
    font-size: 14px;
}

.footer-links {
    display: flex;
    gap: 24px;
}

.footer-links a {
    color: #64748b;
    text-decoration: none;
    font-size: 14px;
    transition: color 0.2s;
}

.footer-links a:hover {
    color: #6C63FF;
}

@media (max-width: 768px) {
    .footer-content {
        flex-direction: column;
        text-align: center;
    }
}
</style>
