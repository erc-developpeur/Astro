<?php
require_once 'config/app.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="www/img/logo-mini.png" />
    <title>Politique de confidentialité - <?php echo $config['app_name']; ?></title>
    <link rel="stylesheet" href="www/css/style.css">
    <link rel="stylesheet" href="www/css/legal.css">
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>

    <main class="legal-container">
        <div class="legal-content">
            <h1>Politique de confidentialité</h1>
            <p class="last-updated">Dernière mise à jour : <?php echo date('d/m/Y'); ?></p>

            <section>
                <h2>Introduction</h2>
                <p>Bienvenue sur <?php echo $config['app_name']; ?>. Cette politique de confidentialité explique comment nous collectons, utilisons et protégeons vos informations personnelles.</p>
            </section>

            <section>
                <h2>Collecte des données</h2>
                <p>Nous collectons les informations suivantes :</p>
                <ul>
                    <li>Informations de compte (nom d'utilisateur, email)</li>
                    <li>Données de navigation</li>
                    <li>Préférences de contenu</li>
                </ul>
            </section>

            <section>
                <h2>Utilisation des données</h2>
                <p>Vos données sont utilisées pour :</p>
                <ul>
                    <li>Personnaliser votre expérience</li>
                    <li>Améliorer nos services</li>
                    <li>Communiquer avec vous</li>
                </ul>
            </section>

            <section>
                <h2>Protection des données</h2>
                <p>Nous mettons en œuvre des mesures de sécurité appropriées pour protéger vos informations personnelles.</p>
            </section>

            <section>
                <h2>Vos droits</h2>
                <p>Vous avez le droit de :</p>
                <ul>
                    <li>Accéder à vos données</li>
                    <li>Modifier vos informations</li>
                    <li>Supprimer votre compte</li>
                </ul>
            </section>

            <section>
                <h2>Contact</h2>
                <p>Pour toute question concernant cette politique, veuillez nous contacter à :</p>
                <p>Email : <?php echo $config['contact_email']; ?></p>
            </section>
        </div>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html> 