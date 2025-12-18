<?php
session_start();
// Suppression de la vérification de connexion obligatoire
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
//     exit;
// }

$config = require_once 'config/app.php';
require_once 'models/Movie.php';
require_once 'models/Serie.php';

$movieModel = new Movie();
$serieModel = new Serie();

// Récupérer l'ID et le type depuis l'URL
$id = isset($_GET['id']) ? (int)$_GET['id'] : null;
$type = isset($_GET['type']) ? $_GET['type'] : null;

if ($id && $type) {
    if ($type === 'movie') {
        $media = $movieModel->getMovieById($id);
        $videoUrl = $movieModel->getVideoUrl($id);
    } elseif ($type === 'serie') {
        $media = $serieModel->getSerieById($id);
        $videoUrl = $serieModel->getVideoUrl($id);
    }

    if ($media && $videoUrl) {
        $title = $media['title'];
        $description = $media['description'];
        $date = $media['date'];
        $genres = $media['genre'];
        $rating = $media['rating'];
        $actors = $media['actors'];
        $imagefond = $media['imagefond'];
        $affiche = $media['affiche'];
    } else {
        // Rediriger vers la page d'accueil si le média n'existe pas
        header('Location: index.php');
        exit;
    }
} else {
    // Rediriger vers la page d'accueil si aucun ID ou type n'est fourni
    header('Location: index.php');
    exit;
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link
      rel="shortcut icon"
      type="image/png"
      href="www/img/logo-mini.png"
    />
    <title><?php echo $title; ?> - <?php echo $config['app_name']; ?></title>
    <link rel="stylesheet" href="www/css/style.css">
    <link rel="stylesheet" href="www/css/player.css">
    <link rel="stylesheet" href="www/css/popup.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <script src="www/js/player.js"></script>
</head>
<body>
<?php include 'components/header.php'; ?>
    <main class="player-container">
        <?php if ($type === 'serie'): ?>
            <div class="series-controls">
                <div class="dropdown" id="seasonDropdown">
                    <button class="dropdown-btn" onclick="toggleDropdown('seasonDropdown')">
                        <i class="fas fa-list"></i> Saison <span id="currentSeason">1</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <?php for ($i = 1; $i <= $media['seasons']; $i++): ?>
                            <a href="#" onclick="selectSeason(<?php echo $i; ?>)">Saison <?php echo $i; ?></a>
                        <?php endfor; ?>
                    </div>
                </div>

                <div class="dropdown" id="episodeDropdown">
                    <button class="dropdown-btn" onclick="toggleDropdown('episodeDropdown')">
                        <i class="fas fa-film"></i> Épisode <span id="currentEpisode">1</span>
                        <i class="fas fa-chevron-down"></i>
                    </button>
                    <div class="dropdown-content">
                        <?php for ($i = 1; $i <= $media['episodes']; $i++): ?>
                            <a href="#" onclick="selectEpisode(<?php echo $i; ?>)">Épisode <?php echo $i; ?></a>
                        <?php endfor; ?>
                    </div>
                </div>
            </div>
        <?php endif; ?>
        <div class="video-wrapper">
            <?php if (isset($_SESSION['user_id']) || isset($_SESSION['visitor'])): ?>
                <div class="video-notice">
                    <i class="fas fa-info-circle"></i>
                    <p>Pour des raisons de droits d'auteur, nous ne pouvons pas diffuser le film directement. Nous vous proposons la bande-annonce à la place.</p>
                </div>
                <div class="video-container">
                    <iframe 
                        src="https://www.youtube.com/embed/<?php echo $media['trailer_id']; ?>?autoplay=1" 
                        frameborder="0" 
                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                        allowfullscreen>
                    </iframe>
                </div>
            <?php else: ?>
                <div class="login-required">
                    <div class="login-message">
                        <i class="fas fa-lock"></i>
                        <h3>Contenu réservé aux membres</h3>
                        <p>Connectez-vous pour accéder à cette vidéo</p>
                        <a href="login.php" class="login-btn">Se connecter</a>
                    </div>
                </div>
            <?php endif; ?>
        </div>

        <div class="movie-details">
            <div class="movie-details-header">
                <div class="movie-poster-large">
                    <img src="<?php echo $affiche; ?>" alt="<?php echo $title; ?>">
                </div>
                <div class="movie-details-info">
                    <h2><?php echo $title; ?></h2>
                    <div class="movie-meta">
                        <span class="year"><?php echo date('Y', strtotime($date)); ?></span>
                        <span class="genres"><?php echo implode(', ', $genres); ?></span>
                    </div>
                    <div class="rating">
                        <span class="rating-value"><?php echo number_format($rating, 1); ?></span>
                        <span class="stars">
                            <?php
                            $fullStars = floor($rating);
                            $halfStar = $rating - $fullStars >= 0.5;
                            for ($i = 1; $i <= 5; $i++) {
                                if ($i <= $fullStars) {
                                    echo '<i class="fas fa-star"></i>';
                                } else if ($halfStar && $i === $fullStars + 1) {
                                    echo '<i class="fas fa-star-half-alt"></i>';
                                } else {
                                    echo '<i class="far fa-star"></i>';
                                }
                            }
                            ?>
                        </span>
                    </div>
                    <p class="description"><?php echo $description; ?></p>
                    <div class="action-buttons">
                        <button class="like-btn large" onclick="toggleLike(<?php echo $id; ?>)">
                            <i class="far fa-heart" id="heartIcon_<?php echo $id; ?>"></i> Ajouter aux favoris
                        </button>
                        <button class="add-list-btn large" onclick="openListPopup(<?php echo $id; ?>, '<?php echo $type; ?>')">
                            <i class="fas fa-plus"></i> Ajouter à ma liste
                        </button>
                    </div>
                </div>
            </div>

            <div class="movie-content-grid">
                <div class="movie-description-section">
                    <h3>Synopsis</h3>
                    <p class="description"><?php echo $description; ?></p>
                </div>

                <div class="movie-cast-section">
                    <h3>Casting</h3>
                    <div class="actor-links">
                        <?php
                        $actorsArray = explode(',', $actors);
                        foreach ($actorsArray as $actor) {
                            $actor = trim($actor);
                            $wikipediaUrl = "https://fr.wikipedia.org/wiki/" . str_replace(' ', '_', $actor);
                            echo '<a href="' . $wikipediaUrl . '" target="_blank" class="actor-link">' . $actor . '</a>';
                        }
                        ?>
                    </div>
                </div>

                <div class="comments-section">
                    <h3>Commentaires</h3>
                    <?php if (isset($_SESSION['user_id'])): ?>
                        <form class="comment-form" method="POST" action="add_comment.php">
                            <input type="hidden" name="media_id" value="<?php echo $id; ?>">
                            <input type="hidden" name="media_type" value="<?php echo $type; ?>">
                            <textarea name="comment" placeholder="Ajouter un commentaire..." required></textarea>
                            <button type="submit" class="submit-comment">Publier</button>
                        </form>
                    <?php else: ?>
                        <p class="login-message">Connectez-vous pour ajouter un commentaire</p>
                    <?php endif; ?>
                    
                    <div class="comments-list">
                        <?php
                        // Vérifier si un commentaire vient d'être publié
                        if (isset($_GET['success']) && $_GET['success'] == 1): ?>
                            <div class="comment-success-message">
                                <i class="fas fa-check-circle"></i>
                                <p>Votre commentaire a été publié avec succès !</p>
                            </div>
                        <?php endif;

                        // Récupérer les commentaires depuis la base de données
                        try {
                            $dbConfig = require_once 'config/dbconfig.php';
                            $pdo = new PDO(
                                "mysql:host=" . $dbConfig['host'] . ";dbname=" . $dbConfig['database'] . ";charset=" . $dbConfig['charset'],
                                $dbConfig['username'],
                                $dbConfig['password']
                            );
                            $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

                            $stmt = $pdo->prepare("
                                SELECT c.*, u.username 
                                FROM comments c 
                                JOIN users u ON c.user_id = u.id 
                                WHERE c.media_id = ? AND c.media_type = ? 
                                ORDER BY c.created_at DESC
                            ");
                            $stmt->execute([$id, $type]);
                            $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);

                            foreach ($comments as $comment): ?>
                                <div class="comment">
                                    <div class="comment-header">
                                        <span class="comment-author"><?php echo htmlspecialchars($comment['username']); ?></span>
                                        <span class="comment-date"><?php echo date('d/m/Y H:i', strtotime($comment['created_at'])); ?></span>
                                    </div>
                                    <p class="comment-content"><?php echo htmlspecialchars($comment['content']); ?></p>
                                </div>
                            <?php endforeach;
                        } catch (PDOException $e) {
                            error_log("Erreur lors de la récupération des commentaires: " . $e->getMessage());
                            echo "<p>Une erreur est survenue lors du chargement des commentaires.</p>";
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>

        <section class="random-suggestions-section">
            <div class="section-header" style="display: flex;">
                <h2 class="section-title">Vous pourriez aussi aimer</h2>
            </div>
            <div class="movie-grid" style="padding: 1.5rem;">
                <?php 
                $randomMovies = $movieModel->getRandomMovies(8);
                foreach ($randomMovies as $movie): ?>
                    <div class="movie-card" 
                        data-genres='<?php echo json_encode($movie['genre']); ?>'
                        data-rating="<?php echo $movie['rating']; ?>">
                        <div class="movie-poster">
                            <img src="<?php echo $movie['image']; ?>" alt="<?php echo $movie['title']; ?>">
                            <div class="overlay">
                                <a href="player.php?id=<?php echo $movie['id']; ?>&type=movie" class="play-btn">Regarder</a>
                                <button class="info-btn" onclick="showMoviesDetails(<?php echo $movie['id']; ?>)">Détails</button>
                                <h3><?php echo $movie['title']; ?></h3>
                                <?php if (isset($_SESSION['user_id'])): ?>
                                    <div class="actions">
                                        <button class="like-btn" onclick="toggleLike(<?php echo $movie['id']; ?>)">
                                            <i class="far fa-heart" id="heartIcon_<?php echo $movie['id']; ?>"></i>
                                        </button>
                                        <button class="add-list-btn" onclick="openListPopup(<?php echo $movie['id']; ?>, 'movie')">
                                            <i class="fas fa-plus"></i>
                                        </button>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <script>
                    window.movieData = window.movieData || {};
                    window.movieData[<?php echo $movie['id']; ?>] = {
                        id: <?php echo $movie['id']; ?>,
                        type: "movie",
                        title: "<?php echo addslashes($movie['title']); ?>",
                        description: "<?php echo addslashes($movie['description']); ?>",
                        image: "<?php echo addslashes($movie['image']); ?>",
                        imagefond: "<?php echo addslashes($movie['imagefond']); ?>",
                        affiche: "<?php echo addslashes($movie['affiche']); ?>",
                        date: "<?php echo addslashes($movie['date']); ?>",
                        genre: <?php echo json_encode($movie['genre']); ?>,
                        rating: <?php echo $movie['rating']; ?>,
                        actors: "<?php echo addslashes($movie['actors']); ?>",
                        trailer_id: "<?php echo addslashes($movie['trailer_id'] ?? ''); ?>",
                        actor_link_1: "<?php echo addslashes($movie['actor_link_1'] ?? ''); ?>",
                        actor_link_2: "<?php echo addslashes($movie['actor_link_2'] ?? ''); ?>",
                        actor_link_3: "<?php echo addslashes($movie['actor_link_3'] ?? ''); ?>",
                        actor_link_4: "<?php echo addslashes($movie['actor_link_4'] ?? ''); ?>",
                        actor_link_5: "<?php echo addslashes($movie['actor_link_5'] ?? ''); ?>"
                    };
                    </script>
                <?php endforeach; ?>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>

    <?php include 'components/popup.php'; ?>
</body>
</html> 