<?php
session_start();

$config = require_once 'config/app.php';

// Suppression de la vérification de connexion
// if (!isset($_SESSION['user_id'])) {
//     $_SESSION['redirect_after_login'] = $_SERVER['REQUEST_URI'];
//     header('Location: login.php');
//     exit;
// }

require_once 'models/Movie.php';
require_once 'models/Serie.php';

$movieModel = new Movie();
$serieModel = new Serie();

// Récupération des données utilisateur
$userId = $_SESSION['user_id'] ?? null;
$username = $_SESSION['username'] ?? 'Visiteur';
$email = $_SESSION['email'] ?? '';
$joinDate = $_SESSION['created_at'] ?? date('Y-m-d');
$avatar = $_SESSION['avatar'] ?? 'www/img/default-avatar.png';
$isVisitor = isset($_SESSION['visitor']) && $_SESSION['visitor'] === true;

// Récupération des données si l'utilisateur est connecté et n'est pas un visiteur
if ($userId && !$isVisitor) {
    $watchlist = $movieModel->getWatchlist($userId);
    $likedMovies = $movieModel->getLikedMovies($userId);
    $likedSeries = $serieModel->getLikedSeries($userId);
    $watchHistory = $movieModel->getWatchHistory($userId);
    $stats = $movieModel->getUserStats($userId);
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mon Profil - <?php echo $username; ?></title>
    <link rel="stylesheet" href="www/css/style.css">
    <link rel="stylesheet" href="www/css/profile.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link
      rel="shortcut icon"
      type="image/png"
      href="www/img/logo-mini.png"
    />
    <link rel="stylesheet" href="css/loader.css">
    <script src="js/loader.js" defer></script>
</head>
<body>
<?php include 'components/header.php'; ?>

    <main class="profile-container">
        <!-- Section Profil -->
        <section class="profile-section">
            <div class="profile-header">
                <div class="profile-avatar">
                    <?php if (!$isVisitor): ?>
                    <form id="avatar-form" action="upload_avatar.php" method="post" enctype="multipart/form-data">
                        <label for="avatar-upload" class="avatar-upload-label">
                            <img src="<?php echo $avatar; ?>" alt="Avatar" class="avatar-image">
                            <div class="avatar-overlay">
                                <i class="fas fa-camera"></i>
                                <span>Changer la photo</span>
                            </div>
                        </label>
                        <input type="file" id="avatar-upload" name="avatar" accept="image/*">
                    </form>
                    <?php else: ?>
                    <div class="avatar-container">
                        <img src="<?php echo $avatar; ?>" alt="Avatar" class="avatar-image">
                    </div>
                    <?php endif; ?>
                </div>
                <div class="profile-info">
                    <h1><?php echo $username; ?></h1>
                    <?php if (!$isVisitor): ?>
                    <p class="profile-email"><?php echo $email; ?></p>
                    <p class="profile-date">Membre depuis: <?php echo date('d/m/Y', strtotime($joinDate)); ?></p>
                    <?php endif; ?>
                    <div class="profile-stats">
                        <div class="stat-item">
                            <i class="fas fa-film"></i>
                            <span><?php echo $stats['total_watched'] ?? 0; ?> films regardés</span>
                        </div>
                        <div class="stat-item">
                            <i class="fas fa-clock"></i>
                            <span><?php echo $stats['total_time'] ?? 0; ?> heures de visionnage</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Onglets de Navigation -->
        <div class="profile-tabs-wrapper">
            <div class="tabs-scroll-left" onclick="scrollTabs(-100)">&lt;</div>
            <div class="profile-tabs" id="profileTabs">
                <button class="tab-btn active" data-tab="watchlist">Ma Liste</button>
                <button class="tab-btn" data-tab="liked">Favoris</button>
                <button class="tab-btn" data-tab="history">Historique</button>
                <button class="tab-btn" data-tab="stats">Statistiques</button>
                <?php if (!$isVisitor): ?>
                <button class="tab-btn" data-tab="settings">Paramètres</button>
                <?php endif; ?>
            </div>
            <div class="tabs-scroll-right" onclick="scrollTabs(100)">&gt;</div>
        </div>

        <!-- Contenu des Onglets -->
        <div class="tab-content">
            <!-- Liste de Visionnage -->
            <div class="tab-pane active" id="watchlist">
                <h2>Ma Liste de Visionnage</h2>
                <div class="media-grid">
                    <?php if (!$isVisitor && !empty($watchlist)): ?>
                        <?php foreach ($watchlist as $item): ?>
                            <div class="media-card">
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                                <div class="media-info">
                                    <h3><?php echo $item['title']; ?></h3>
                                    <p class="media-year"><?php echo $item['year']; ?></p>
                                    <div class="media-actions">
                                        <a href="player.php?id=<?php echo $item['id']; ?>" class="watch-btn">Regarder</a>
                                        <button class="remove-btn" onclick="removeFromWatchlist(<?php echo $item['id']; ?>)">Retirer</button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-message"><?php echo $isVisitor ? 'Connectez-vous pour gérer votre liste de visionnage' : 'Votre liste de visionnage est vide'; ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Favoris -->
            <div class="tab-pane" id="liked">
                <h2>Mes Favoris</h2>
                <div class="media-grid">
                    <?php if (!$isVisitor && (!empty($likedMovies) || !empty($likedSeries))): ?>
                        <?php foreach ($likedMovies as $movie): ?>
                            <div class="media-card">
                                <img src="<?php echo $movie['image']; ?>" alt="<?php echo $movie['title']; ?>">
                                <div class="media-info">
                                    <h3><?php echo $movie['title']; ?></h3>
                                    <p class="media-year"><?php echo $movie['year']; ?></p>
                                    <div class="media-actions">
                                        <a href="player.php?id=<?php echo $movie['id']; ?>" class="watch-btn">Regarder</a>
                                        <button class="unlike-btn" onclick="toggleLike(<?php echo $movie['id']; ?>)">
                                            <i class="fas fa-heart"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-message"><?php echo $isVisitor ? 'Connectez-vous pour gérer vos favoris' : 'Vous n\'avez pas encore de favoris'; ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Historique -->
            <div class="tab-pane" id="history">
                <h2>Historique de Visionnage</h2>
                <div class="media-grid">
                    <?php if (!$isVisitor && !empty($watchHistory)): ?>
                        <?php foreach ($watchHistory as $item): ?>
                            <div class="media-card">
                                <img src="<?php echo $item['image']; ?>" alt="<?php echo $item['title']; ?>">
                                <div class="media-info">
                                    <h3><?php echo $item['title']; ?></h3>
                                    <p class="media-date">Regardé le: <?php echo date('d/m/Y', strtotime($item['watched_at'])); ?></p>
                                    <div class="media-actions">
                                        <a href="player.php?id=<?php echo $item['id']; ?>" class="watch-btn">Reprendre</a>
                                    </div>
                                </div>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="empty-message"><?php echo $isVisitor ? 'Connectez-vous pour voir votre historique' : 'Aucun historique de visionnage'; ?></p>
                    <?php endif; ?>
                </div>
            </div>

            <!-- Statistiques -->
            <div class="tab-pane" id="stats">
                <h2>Mes Statistiques</h2>
                <div class="stats-grid">
                    <div class="stat-card">
                        <i class="fas fa-film"></i>
                        <h3>Films Regardés</h3>
                        <p><?php echo $stats['movies_watched'] ?? 0; ?></p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-tv"></i>
                        <h3>Séries Regardées</h3>
                        <p><?php echo $stats['series_watched'] ?? 0; ?></p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-clock"></i>
                        <h3>Temps Total</h3>
                        <p><?php echo $stats['total_time'] ?? 0; ?> heures</p>
                    </div>
                    <div class="stat-card">
                        <i class="fas fa-star"></i>
                        <h3>Favoris</h3>
                        <p><?php echo $stats['total_likes'] ?? 0; ?></p>
                    </div>
                </div>
                <div class="stats-chart">
                    <h3>Genres Préférés</h3>
                    <canvas id="genreChart"></canvas>
                </div>
            </div>

            <?php if (!$isVisitor): ?>
            <!-- Paramètres -->
            <div class="tab-pane" id="settings">
                <h2>Paramètres du Compte</h2>
                <div class="settings-grid">
                    <div class="settings-card">
                        <h3>Informations Personnelles</h3>
                        <form id="profile-form" action="update_profile.php" method="post">
                            <div class="form-group">
                                <label for="username">Nom d'utilisateur</label>
                                <input type="text" id="username" name="username" value="<?php echo $username; ?>">
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" id="email" name="email" value="<?php echo $email; ?>">
                            </div>
                            <button type="submit" class="save-btn">Enregistrer</button>
                        </form>
                    </div>
                    <div class="settings-card">
                        <h3>Sécurité</h3>
                        <form id="password-form" action="update_password.php" method="post">
                            <div class="form-group">
                                <label for="current-password">Mot de passe actuel</label>
                                <input type="password" id="current-password" name="current_password">
                            </div>
                            <div class="form-group">
                                <label for="new-password">Nouveau mot de passe</label>
                                <input type="password" id="new-password" name="new_password">
                            </div>
                            <button type="submit" class="save-btn">Changer le mot de passe</button>
                        </form>
                    </div>
                </div>
            </div>
            <?php endif; ?>
        </div>
    </main>

    <?php include 'footer.php'; ?>

    <div id="movie-popup" class="popup">
        <div class="popup-content">
            <span class="close-popup">&times;</span>
            <div id="movie-details-content">
                <!-- Contenu dynamique chargé par JavaScript -->
            </div>
        </div>
    </div>

    <div id="serie-popup" class="popup">
        <div class="popup-content">
            <span class="close-popup">&times;</span>
            <div id="serie-details-content">
                <!-- Contenu dynamique chargé par JavaScript -->
            </div>
        </div>
    </div>

    <div id="edit-profile-popup" class="popup">
        <div class="popup-content">
            <span class="close-popup">&times;</span>
            <h2>Modifier le profil</h2>
            <form id="edit-profile-form" action="update_profile.php" method="post" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="popup-username">Nom d'utilisateur</label>
                    <input type="text" id="popup-username" name="username" value="<?php echo htmlspecialchars($_SESSION['username']); ?>" required>
                </div>
                <div class="form-group">
                    <label for="popup-bio">Biographie</label>
                    <textarea id="popup-bio" name="bio" rows="4"><?php echo htmlspecialchars($_SESSION['bio'] ?? ''); ?></textarea>
                </div>
                <div class="form-group">
                    <label for="popup-avatar">Avatar</label>
                    <input type="file" id="popup-avatar" name="avatar" accept="image/*">
                </div>
                <div class="form-buttons">
                    <button type="submit" class="btn-primary">Enregistrer</button>
                    <button type="button" class="btn-secondary close-popup-btn">Annuler</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>
    <script src="js/profile.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const avatarUpload = document.getElementById('avatar-upload');
        const avatarForm = document.getElementById('avatar-form');
        const avatarImage = document.querySelector('.avatar-image');
        const defaultAvatar = document.querySelector('.default-avatar');

        avatarUpload.addEventListener('change', function() {
            if (this.files && this.files[0]) {
                const reader = new FileReader();
                
                reader.onload = function(e) {
                    // Créer l'image si elle n'existe pas
                    if (!avatarImage) {
                        const img = document.createElement('img');
                        img.className = 'avatar-image';
                        img.alt = 'Avatar';
                        defaultAvatar.parentNode.replaceChild(img, defaultAvatar);
                        img.src = e.target.result;
                    } else {
                        avatarImage.src = e.target.result;
                    }
                }
                
                reader.readAsDataURL(this.files[0]);
                
                // Soumettre le formulaire
                avatarForm.submit();
            }
        });

        // Afficher les messages d'erreur ou de succès
        <?php if (isset($_SESSION['error'])): ?>
            alert('<?php echo $_SESSION['error']; ?>');
            <?php unset($_SESSION['error']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['success'])): ?>
            alert('<?php echo $_SESSION['success']; ?>');
            <?php unset($_SESSION['success']); ?>
        <?php endif; ?>
    });

    // Fonctions pour gérer les interactions
    function removeFromWatchlist(id) {
        if (confirm('Voulez-vous vraiment retirer ce média de votre liste ?')) {
            fetch('api/remove_from_watchlist.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ id: id, type: 'movie' })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    location.reload();
                } else {
                    alert('Erreur lors de la suppression');
                }
            });
        }
    }

    function toggleLike(id) {
        fetch('api/toggle_like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({ id: id, type: 'movie' })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                alert('Erreur lors de la modification');
            }
        });
    }

    function scrollTabs(amount) {
        const tabs = document.getElementById('profileTabs');
        if (tabs) {
            tabs.scrollLeft += amount;
        }
    }
    </script>
</body>
</html> 