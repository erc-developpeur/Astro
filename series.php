<?php
require_once __DIR__ . '/models/Serie.php';
$config = require_once 'config/app.php';

// Initialisation de la classe Serie
$serieModel = new Serie();

// Récupération des séries
$featuredSeries = $serieModel->getFeaturedSeries();
$trendingSeries = $serieModel->getTrendingSeries();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Séries - <?php echo $config['app_name']; ?></title>
    <link
      rel="shortcut icon"
      type="image/png"
      href="www/img/logo-mini.png"
    />
    <link rel="stylesheet" href="www/css/style.css">
    <link rel="stylesheet" href="www/css/home.css">
    <link rel="stylesheet" href="www/css/button-like.css">
    <link rel="stylesheet" href="www/css/serie.css">
    <link rel="stylesheet" href="www/css/popup.css">
    <script src="www/js/button-like.js"></script>
    <script src="www/js/index.js"></script>
    <script src="www/js/home.js"></script>
    <script src="www/js/commentaire.js"></script>
    <script src="www/js/sorting.js"></script>
    <script src="www/js/similar-series.js"></script>
    <script src="www/js/like.js"></script>
    <link rel="stylesheet" href="css/loader.css">
    <script src="js/loader.js" defer></script>
    <script src="/V_7/www/js/popup.js"></script>
</head>
<body>
<?php include 'components/header.php'; ?>

<?php include 'components/popup.php'; ?>

    <div class="films-hero">
        <div class="hero-content-serie-films">
            <h1>Toutes nos series</h1>
            <p>Découvrez notre collection de séries de tous genres</p>
        </div>
    </div>

    <div class="filter-container">
        <div class="search-box">
            <input type="text" id="search-input" placeholder="Rechercher une série...">
            <button id="search-btn"><i class="fas fa-search"></i></button>
        </div>
        <div class="filter-options">
            <div class="filter-group">
                <label for="genre-filter">Genre:</label>
                <select id="genre-filter">
                    <option value="">Tous les genres</option>
                    <option value="action">Action</option>
                    <option value="aventure">Aventure</option>
                    <option value="comedie">Comédie</option>
                    <option value="drame">Drame</option>
                    <option value="horreur">Horreur</option>
                    <option value="sci-fi">Science-Fiction</option>
                    <option value="fantastique">Fantastique</option>
                    <option value="romance">Romance</option>
                    <option value="thriller">Thriller</option>
                    <option value="animation">Animation</option>
                </select>
            </div>
            <div class="filter-group">
                <label for="sort-filter">Trier par:</label>
                <select id="sort-filter">
                    <option value="popular">Popularité</option>
                    <option value="recent">Date de sortie</option>
                    <option value="rating">Note</option>
                    <option value="title">Titre</option>
                </select>
            </div>
        </div>
    </div>

    <main class="films-container">
        <div class="movie-grid">
            <?php
            require_once 'models/Serie.php';
            $serieManager = new Serie();
            $series = $serieManager->getAllSeries();
            
            foreach ($series as $serie) {
                echo '<div class="movie-card" 
                     data-genres=' . json_encode($serie['genre']) . '
                     data-rating="' . $serie['rating'] . '">';
                echo '<div class="movie-poster">';
                echo '<img src="' . $serie['image'] . '" alt="' . $serie['title'] . '">';
                echo '<div class="overlay">';
                
                echo '<a href="player.php?id=' . $serie['id'] . '&type=serie" class="play-btn">Regarder</a>';
                echo '<button class="info-btn" onclick="showMoviesDetails(' . $serie['id'] . ')">Détails</button>';
                echo '<h3>' . $serie['title'] . '</h3>';
                
                if (isset($_SESSION['user_id'])) {
                    echo '<div class="actions">';
                    echo '<button class="like-btn-overlay" onclick="toggleLike(' . $serie['id'] . ', \'serie\')"><i class="far fa-heart"></i></button>';
                    echo '<button class="add-list-btn-overlay" onclick="openListPopup(' . $serie['id'] . ', \'serie\')"><i class="fas fa-plus"></i></button>';
                    echo '</div>';
                }
                
                echo '</div>';
                echo '</div>';
                echo '</div>';
                
                // Stocker les données de la série pour l'utilisation dans le popup
                echo '<script>';
                echo 'window.serieData = window.serieData || {};';
                echo 'window.serieData[' . $serie['id'] . '] = {';
                echo 'id: ' . $serie['id'] . ',';
                echo 'type: "serie",';
                echo 'title: "' . addslashes($serie['title']) . '",';
                echo 'description: "' . addslashes($serie['description']) . '",';
                echo 'image: "' . addslashes($serie['image']) . '",';
                echo 'imagefond: "' . addslashes($serie['imagefond']) . '",';
                echo 'affiche: "' . addslashes($serie['affiche']) . '",';
                echo 'date: "' . addslashes($serie['date']) . '",';
                echo 'genre: ' . json_encode($serie['genre']) . ',';
                echo 'rating: ' . $serie['rating'] . ',';
                echo 'actors: "' . addslashes($serie['actors']) . '",';
                echo 'trailer_id: "' . addslashes($serie['trailer_id'] ?? '') . '",';
                echo 'seasons: ' . $serie['seasons'] . ',';
                echo 'episodes: ' . $serie['episodes'];
                echo '};';
                echo '</script>';
            }
            ?>
        </div>
        
        <div class="pagination">
            <button class="pagination-btn prev-page" disabled><i class="fas fa-chevron-left"></i></button>
            <div class="page-numbers">
                <span class="page-number active">1</span>
                <span class="page-number">2</span>
                <span class="page-number">3</span>
                <span class="page-number">4</span>
                <span class="page-number">5</span>
            </div>
            <button class="pagination-btn next-page"><i class="fas fa-chevron-right"></i></button>
        </div>
    </main>
    <div id="like-notification" class="like-notification">
        <div class="partie-text">
            <span id="like-notification-message">Ajouté aux favoris !</span>
        </div>
        <div id="like-progress-bar" style="height: 4px; width: 100%; background: #eee; border-radius: 2px; margin-top: 10px; overflow: hidden;">
            <div id="like-progress-bar-inner" style="height: 100%; width: 100%; background: linear-gradient(90deg, #222, #888); transition: width 2s linear;"></div>
        </div>
    </div>

    <?php include 'footer.php'; ?>

    <script src="/V_7/www/js/button-like.js"></script>
    <script src="www/js/index.js"></script>
    <script src="www/js/home.js"></script>
    <script src="www/js/commentaire.js"></script>
    <script src="www/js/similar-series.js"></script>
    <script src="www/js/like.js"></script>
    <script src="www/js/sorting.js"></script>
    <script src="www/js/script.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html> 