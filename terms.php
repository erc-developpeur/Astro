<?php
require_once 'config/app.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="www/img/logo-mini.png" />
    <title>Conditions d'utilisation - <?php echo $config['app_name']; ?></title>
    <link rel="stylesheet" href="www/css/style.css">
    <link rel="stylesheet" href="www/css/legal.css">
</head>
<body>
    <?php include __DIR__ . '/header.php'; ?>

    <main class="legal-container">
        <div class="legal-content">
            <h1>Conditions d'utilisation</h1>
            <p class="last-updated">Dernière mise à jour : <?php echo date('d/m/Y'); ?></p>
            
            <section>
                <h2>Introduction</h2>
                <p>En utilisant <?php echo $config['app_name']; ?>, vous acceptez les conditions d'utilisation suivantes.</p>
            </section>

            <section>
                <h2>Utilisation du service</h2>
                <p>Vous vous engagez à :</p>
                <ul>
                    <li>Utiliser le service conformément à la loi</li>
                    <li>Ne pas perturber le fonctionnement du service</li>
                    <li>Respecter les droits d'auteur</li>
                </ul>
            </section>

            <section>
                <h2>Compte utilisateur</h2>
                <p>Vous êtes responsable de :</p>
                <ul>
                    <li>La sécurité de votre compte</li>
                    <li>L'exactitude des informations fournies</li>
                    <li>L'activité sur votre compte</li>
                </ul>
            </section>

            <section>
                <h2>Contenu</h2>
                <p>Le contenu disponible sur notre plateforme est protégé par des droits d'auteur et ne peut être utilisé sans autorisation.</p>
            </section>

            <section>
                <h2>Modifications</h2>
                <p>Nous nous réservons le droit de modifier ces conditions à tout moment. Les modifications prendront effet dès leur publication.</p>
            </section>

            <section>
                <h2>Contact</h2>
                <p>Pour toute question concernant ces conditions, veuillez nous contacter à :</p>
                <p>Email : <?php echo $config['contact_email']; ?></p>
            </section>
        </div>
    </main>

    <?php include __DIR__ . '/footer.php'; ?>
</body>
</html> 