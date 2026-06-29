<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= $pageTitle ?? 'HUBLABEL' ?></title>
    
    <link rel="icon" type="image/png" href="/assets/images/favicon.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Rounded:opsz,wght,FILL,GRAD@24,400,0,0&display=swap" rel="stylesheet">
    
    <link rel="stylesheet" href="/assets/css/main.css">
    <link rel="stylesheet" href="/assets/css/components.css">
    <?php if (isset($customCSS)): ?>
        <link rel="stylesheet" href="<?= $customCSS ?>">
    <?php endif; ?>
</head>
<body>
    <?php include __DIR__ . '/sidebar.php'; ?>
    
    <div class="main-wrapper">
        <?php include __DIR__ . '/header.php'; ?>
        
        <main class="main-content">
            <?= $content ?? '' ?>
        </main>
        
        <?php include __DIR__ . '/footer.php'; ?>
    </div>
    
    <script src="/assets/js/main.js"></script>
    <?php if (isset($customJS)): ?>
        <script src="<?= $customJS ?>"></script>
    <?php endif; ?>
</body>
</html>
