<?php
$config = require_once 'config/app.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="www/img/logo-mini.png" />
    <title>Politique des Cookies - <?php echo $config['app_name']; ?></title>
    <link rel="stylesheet" href="www/css/style.css">
    <link rel="stylesheet" href="www/css/legal.css">
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>

    <main class="legal-container">
        <div class="legal-content">
            <h1>Politique des Cookies</h1>
            <p class="last-updated">Dernière mise à jour : <?php echo date('d/m/Y'); ?></p>

            <section>
                <h2>1. Qu'est-ce qu'un Cookie ?</h2>
                <p>Un cookie est un petit fichier texte stocké sur votre appareil lorsque vous visitez notre site. Les cookies nous aident à améliorer votre expérience et à fournir des fonctionnalités personnalisées.</p>
            </section>

            <section>
                <h2>2. Types de Cookies Utilisés</h2>
                <p>Nous utilisons différents types de cookies :</p>
                <ul>
                    <li><strong>Cookies essentiels :</strong> Nécessaires au fonctionnement du site</li>
                    <li><strong>Cookies de performance :</strong> Pour analyser l'utilisation du site</li>
                    <li><strong>Cookies de fonctionnalité :</strong> Pour mémoriser vos préférences</li>
                    <li><strong>Cookies de ciblage :</strong> Pour personnaliser votre expérience</li>
                </ul>
            </section>

            <section>
                <h2>3. Comment Gérer les Cookies</h2>
                <p>Vous pouvez contrôler et/ou supprimer les cookies comme vous le souhaitez. Vous pouvez :</p>
                <ul>
                    <li>Supprimer tous les cookies déjà stockés</li>
                    <li>Configurer votre navigateur pour bloquer les cookies</li>
                    <li>Accepter ou refuser les cookies lors de votre visite</li>
                </ul>
            </section>

            <section>
                <h2>4. Cookies Tiers</h2>
                <p>Certains cookies sont placés par des services tiers qui apparaissent sur nos pages. Nous n'avons aucun contrôle sur ces cookies et vous devriez consulter les politiques de confidentialité des services concernés.</p>
            </section>

            <section>
                <h2>5. Mise à Jour de la Politique</h2>
                <p>Nous pouvons mettre à jour cette politique des cookies de temps à autre. Nous vous encourageons à consulter régulièrement cette page pour rester informé des changements.</p>
            </section>

            <section>
                <h2>6. Contact</h2>
                <p>Pour toute question concernant notre politique des cookies, veuillez nous contacter à :</p>
                <p>Email : privacy@<?php echo strtolower($config['app_name']); ?>.com</p>
            </section>
        </div>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html> 