<?php
if (!isset($_SESSION)) {
    session_start();
}
?>
<link rel="stylesheet" href="www/css/header.css">
<header>
    <div class="logo">
        <a href="index.php">
            <img class="logo" alt="Astro I Tout voir, sans limites" src="www/img/1000006349-removebg-preview-modified">
        </a>
    </div>
    <div class="menu-burger">
        <span></span>
        <span></span>
        <span></span>
    </div>
    <nav>
        <ul>
            <li><a href="index.php">Accueil</a></li>
            <li><a href="films.php">Films</a></li>
            <li><a href="series.php">Séries</a></li>
        </ul>
        <ul>
            <div class="user-actions">
                    <?php
                    if (isset($_SESSION['user_id'])) {
                        echo '<div class="user-profile">';
                        echo '<img src="' . (isset($_SESSION['profile_picture']) ? $_SESSION['profile_picture'] : 'www/img/default-avatar.png') . '" alt="Photo de profil" class="profile-picture">';
                        echo '<span class="username">' . $_SESSION['username'] . '</span>';
                        echo '</div>';
                        echo '<a href="profile.php" class="profile-btn">Mon Profil</a>';
                        echo '<a href="logout.php" class="logout-btn">Déconnexion</a>';
                    } else {
                        echo '<a href="login.php" class="login-btn">Connexion</a>';
                        echo '<a href="register.php" class="register-btn">Inscription</a>';
                    }
                    ?>
            </div>
        </ul>
    </nav>

</header>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const menuBurger = document.querySelector('.menu-burger');
    const nav = document.querySelector('nav');
    const userActions = document.querySelector('.user-actions');

    menuBurger.addEventListener('click', function() {
        this.classList.toggle('active');
        nav.classList.toggle('active');
        userActions.classList.toggle('active');
    });
});
</script> 