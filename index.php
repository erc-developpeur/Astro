<?php
session_start();
// if (!isset($_SESSION['user_id'])) {
//     header('Location: login.php');
//     exit;
// }

require_once 'models/Movie.php';
require_once 'models/Serie.php';


// Initialisation des modèles
$movieModel = new Movie();
$serieModel = new Serie();

// Récupération des films et séries
$featuredMovies = $movieModel->getLatestMovies(10);
$featuredSeries = $serieModel->getLatestSeries(10);
$trendingMovies = array_slice($movieModel->getAllMovies(), 0, 5);
$trendingSeries = array_slice($serieModel->getAllSeries(), 0, 5);

// Récupération du film vedette
$featuredMovie = $movieModel->getAllMovies()[0];

// Configuration
$config = require_once 'config/app.php';

// Statistiques
$totalMovies = count($movieModel->getAllMovies());
$totalSeries = count($serieModel->getAllSeries());

// Préparation des données pour le héros
$allMovies = $movieModel->getAllMovies();
$allSeries = $serieModel->getAllSeries();

// Trier par date (du plus récent au plus ancien)
usort($allMovies, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});
usort($allSeries, function($a, $b) {
    return strtotime($b['date']) - strtotime($a['date']);
});

// Prendre les 7 derniers films et séries pour le héros
$heroMovies = array_slice($allMovies, 0, 7);
$heroSeries = array_slice($allSeries, 0, 7);
$myList = array_merge($heroMovies, $heroSeries);

// Utiliser les mêmes films et séries que la section hero pour le carrousel
$movieManager = new Movie();
$serieManager = new Serie();
$allMovies = $movieManager->getAllMovies();
$allSeries = $serieManager->getAllSeries();
shuffle($allMovies); // Mélanger tous les films
shuffle($allSeries); // Mélanger toutes les séries
$movies = array_slice($allMovies, 0, 7); // Prendre 7 films aléatoires
$series = array_slice($allSeries, 0, 7); // Prendre 7 séries aléatoires
$myList = array_merge($movies, $series);
shuffle($myList); // Mélanger encore une fois la liste finale
$featuredMovies = $myList; // Utiliser la même liste mélangée pour le hero

// Générer des listes aléatoires de films et séries
$allMovies = $movieModel->getAllMovies();
$allSeries = $serieModel->getAllSeries();

// Mélanger les tableaux
shuffle($allMovies);
shuffle($allSeries);

// Prendre les 5 premiers éléments de chaque
$randomMovies = array_slice($allMovies, 0, 4);
$randomSeries = array_slice($allSeries, 0, 3);
// Prendre les 14 premiers éléments de chaque
$randomMoviesAlaUne = array_slice($allMovies, 0, 7);
$randomSeriesAlaUne = array_slice($allSeries, 0, 7);

// Suppression de la redéfinition de $featuredMovies
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $config['app_name'] . " - " . $config['app_description']; ?></title>
    <link
      rel="shortcut icon"
      type="image/png"
      href="www/img/logo-mini.png"
    />
    <link rel="stylesheet" href="www/css/style.css">
    <link rel="stylesheet" href="www/css/home.css">
    <link rel="stylesheet" href="www/css/button-like.css">
    <link rel="stylesheet" href="www/css/popup.css">
    <script src="www/js/button-like.js"></script>
    <script src="www/js/index.js"></script>
    <script src="www/js/home.js"></script>
    <script src="www/js/commentaire.js"></script>
    <script src="www/js/popup.js"></script>
    <script src="www/js/similar-series.js"></script>
    <script src="www/js/similar-movies.js"></script>
    <script src="www/js/carousel.js"></script>
    <link rel="stylesheet" href="css/loader.css">
    <script src="js/loader.js" defer></script>
</head>
<body>
    <?php include 'components/popup.php'; ?>
    <?php include 'components/header.php'; ?>
    <section class="hero">
        <div class="hero-content">
            <img id="main-fond-img" class="hero-fond-img hero-fade show" src="<?php echo htmlspecialchars($featuredMovie['imagefond']); ?>" alt="<?php echo htmlspecialchars($featuredMovie['title']); ?>">
            <img class="img-degrade" src="www/img/DEGRADE.png" style="z-index: -1;">
            <div class="hero-main-content">
                <div class="hero-content-left" style="text-align: left;">
                    <h1 id="main-title" class="hero-title hero-fade show">
                        <?php echo htmlspecialchars($featuredMovie['title']); ?>
                    </h1>
                    <div id="main-meta" class="hero-meta">
                        <span id="main-genre" class="hero-fade show"><?php echo htmlspecialchars(implode(', ', $featuredMovie['genre'])); ?></span>
                        &nbsp;|&nbsp;
                        <span id="main-rating" class="hero-rating hero-fade show">
                            <?php echo number_format($featuredMovie['rating'], 1); ?> ★
                        </span>
                        &nbsp;|&nbsp;
                        <span id="main-year" class="hero-fade show"><?php echo date('Y', strtotime($featuredMovie['date'])); ?></span>
                    </div>
                    <p id="main-description" class="hero-description hero-fade show">
                        <?php echo htmlspecialchars($featuredMovie['description']); ?>
                    </p>
                    <div class="hero-events">
                        <a href="player.php?id=<?php echo $featuredMovie['id']; ?>&type=movie" id="dynamic-play-button" class="hero-play-button">PLAY</a>
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <button class="hero-add-button" onclick="openListPopup(<?php echo $featuredMovie['id']; ?>, 'movie')">
                                <span>+</span>
                            </button>
                            <button class="hero-like-button">
                                <span>❤</span>
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <div class="hero-bottom">
                <div class="degarde-right">
                    <div class="event">
                        <?php
                        $movieManager = new Movie();
                        $serieManager = new Serie();
                        $allMovies = $movieManager->getAllMovies();
                        $allSeries = $serieManager->getAllSeries();
                        shuffle($allMovies); // Mélanger tous les films
                        shuffle($allSeries); // Mélanger toutes les séries
                        $movies = array_slice($allMovies, 0, 6); // Prendre 7 films aléatoires
                        $series = array_slice($allSeries, 0, 5); // Prendre 7 séries aléatoires
                        $myList = array_merge($movies, $series);
                        shuffle($myList); // Mélanger encore une fois la liste finale
                        $featuredMovies = $myList; // Utiliser la même liste mélangée pour le hero
                        foreach ($myList as $item) {
                            $activeClass = ($item['id'] == $featuredMovie['id'] && $item['type'] == 'movie') ? 'active' : '';
                            echo '<div class="mylist-card ' . $activeClass . '" data-id="' . $item['id'] . '" data-type="' . $item['type'] . '">';
                            echo '<img src="' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['title']) . '" class="mylist-img">';
                            echo '</div>';
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="featured-section">
        <div class="section-header" style="display: flex;">
            <h2 class="section-title">À la une</h2>
            <a href="films.php" class="btn-more-featured">Voir plus</a>
        </div>
        <div class="movie-grid">
            <?php
            require_once 'models/Movie.php';
            $movieManager = new Movie();
            $movies = $movieManager->getAllMovies();
            $limitedMovies = array_slice($movies, 0, 14); // Limite à 14 films
            foreach ($limitedMovies as $movie) {
                if ($movie['type'] === 'movie') { // Vérifier que c'est bien un film
                    echo '<div class="movie-card" 
                         data-genres=' . json_encode($movie['genre']) . '
                         data-rating="' . $movie['rating'] . '">';
                    echo '<div class="movie-poster">';
                    echo '<img src="' . $movie['image'] . '" alt="' . $movie['title'] . '">';
                    echo '<div class="overlay">';
                    echo '<a href="player.php?id=' . $movie['id'] . '&type=movie" class="play-btn">Regarder</a>';
                    echo '<button class="info-btn" onclick="showMoviesDetails(' . $movie['id'] . ')">Détails</button>';
                    echo '<h3>' . $movie['title'] . '</h3>';
                    
                    if (isset($_SESSION['user_id'])) {
                        echo '<div class="actions">';
                        echo '<button class="like-btn-overlay" onclick="toggleLike(' . $movie['id'] . ')"><i class="far fa-heart"></i></button>';
                        echo '<button class="add-list-btn-overlay" onclick="openListPopup(' . $movie['id'] . ', \'movie\')"><i class="fas fa-plus"></i></button>';
                        echo '</div>';
                    }
                    
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                    
                    // Stocker les données du film pour l'utilisation dans le popup
                    echo '<script>';
                    echo 'window.serieData = window.serieData || {};';
                    echo 'window.serieData[' . $movie['id'] . '] = {';
                    echo 'id: ' . $movie['id'] . ',';
                        echo 'type: "movie",';
                    echo 'title: "' . addslashes($movie['title']) . '",';
                    echo 'description: "' . addslashes($movie['description']) . '",';
                    echo 'image: "' . addslashes($movie['image']) . '",';
                    echo 'imagefond: "' . addslashes($movie['imagefond']) . '",';
                    echo 'affiche: "' . addslashes($movie['affiche']) . '",';
                    echo 'date: "' . addslashes($movie['date']) . '",';
                    echo 'genre: ' . json_encode($movie['genre']) . ',';
                    echo 'rating: ' . $movie['rating'] . ',';
                    echo 'actors: "' . addslashes($movie['actors']) . '",';
                    echo 'trailer_id: "' . addslashes($movie['trailer_id'] ?? '') . '",';
                    echo 'duration: "' . $movie['duration'] . '",';
                        echo '};';
                        echo '</script>';
                    }
                }
            ?>
        </div>
    </section>

    <section class="apple-tv-section">
        <div class="section-header" style="display: flex;margin-top: 1.5rem;">
            <h2 class="section-title">Top Séries</h2>
            <a href="series.php" class="btn-more-featured">Voir plus</a>
        </div>
        <div class="apple-grid">
            <?php 
            require_once 'models/Serie.php';
            $serieManager = new Serie();
            $series = $serieManager->getAllSeries();
            
            // Filtrer uniquement les séries
            $series = array_filter($series, function($serie) {
                return $serie['type'] === 'serie';
            });
            
            // Convertir en tableau indexé pour usort
            $series = array_values($series);
            
            // Trier les séries par rating (du plus haut au plus bas)
            usort($series, function($a, $b) {
                $ratingA = floatval($a['rating']);
                $ratingB = floatval($b['rating']);
                if ($ratingA == $ratingB) return 0;
                return ($ratingA > $ratingB) ? -1 : 1;
            });
            
            // Prendre les 6 meilleures séries
            $topSeries = array_slice($series, 0, 6);
            
            // Afficher les ratings pour debug
            echo '<!-- Debug Ratings: ';
            foreach ($topSeries as $index => $serie) {
                echo $serie['title'] . ': ' . $serie['rating'] . ' | ';
            }
            echo ' -->';
            
            foreach ($topSeries as $index => $serie) {
                echo '<div class="movie-card" 
                     data-genres=' . json_encode($serie['genre']) . '
                     data-rating="' . $serie['rating'] . '">';
                echo '<div class="movie-poster">';
                echo '<span class="number-badge">' . ($index + 1) . '</span>';
                echo '<img src="' . $serie['image'] . '" alt="' . $serie['title'] . '">';
                echo '<div class="overlay">';
                echo '<a href="player.php?id=' . $serie['id'] . '&type=serie" class="play-btn">Regarder</a>';
                echo '<button class="info-btn" onclick="showMoviesDetails(' . $serie['id'] . ')">Détails</button>';
                echo '<h3>' . $serie['title'] . '</h3>';
                echo '<div class="rating">Note: ' . number_format($serie['rating'], 1) . '/10</div>';
                
                if (isset($_SESSION['user_id'])) {
                    echo '<div class="actions">';
                    echo '<button class="like-btn-overlay" onclick="toggleLike(' . $serie['id'] . ')"><i class="far fa-heart"></i></button>';
                    echo '<button class="add-list-btn-overlay" onclick="openListPopup(' . $serie['id'] . ', \'movie\')"><i class="fas fa-plus"></i></button>';
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
                echo 'type: "movie",';
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
                echo 'episodes: ' . $serie['episodes'] . ',';
                echo '};';
                echo '</script>';
            }
            ?>
        </div>
    </section>

    <section class="stats">
        <?php
        $movieManager = new Movie();
        $serieManager = new Serie();
        $allMovies = $movieManager->getAllMovies();
        $allSeries = $serieManager->getAllSeries();
        $totalMovies = count($allMovies);
        $totalSeries = count($allSeries);
        $totalAll = $totalMovies + $totalSeries;
        // Genres uniques
        $allGenres = [];
        foreach ($allMovies as $m) $allGenres = array_merge($allGenres, $m['genre']);
        foreach ($allSeries as $s) $allGenres = array_merge($allGenres, $s['genre']);
        $uniqueGenres = array_unique($allGenres);
        // Années
        $years = [];
        foreach ($allMovies as $m) $years[] = date('Y', strtotime($m['date']));
        foreach ($allSeries as $s) $years[] = date('Y', strtotime($s['date']));
        $minYear = min($years);
        $maxYear = max($years);
        ?>
<div class="stats-cards-container">
    <div class="stat-card">
        <i style="font-size: 30px;margin-bottom: 18px;" class="fas fa-film"></i>
        <div class="stat-label">Films</div>
        <div class="stat-value"><?php echo $totalMovies; ?>+</div>
    </div>
    <div class="stat-card">
        <i style="font-size: 30px;margin-bottom: 18px;" class="fas fa-tv"></i>
        <div class="stat-label">Séries</div>
        <div class="stat-value"><?php echo $totalSeries; ?>+</div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><span class="font-size: 30px;"><svg xmlns='http://www.w3.org/2000/svg' width='44' height='44' viewBox='0 0 24 24'><title>ticket_fill</title><g id="ticket_fill" fill='none' fill-rule='evenodd'><path d='M24 0v24H0V0zM12.594 23.258l-.012.002-.071.035-.02.004-.014-.004-.071-.036c-.01-.003-.019 0-.024.006l-.004.01-.017.428.005.02.01.013.104.074.015.004.012-.004.104-.074.012-.016.004-.017-.017-.427c-.002-.01-.009-.017-.016-.018m.264-.113-.014.002-.184.093-.01.01-.003.011.018.43.005.012.008.008.201.092c.012.004.023 0 .029-.008l.004-.014-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014-.034.614c0 .012.007.02.017.024l.015-.002.201-.093.01-.008.003-.011.018-.43-.003-.012-.01-.01z'/><path fill='#FFFFFFFF' d='M13 4a1 1 0 0 1 .993.883L14 5a1 1 0 0 0 1.993.117L16 5a1 1 0 0 1 1-1h2a3 3 0 0 1 3 3v10a3 3 0 0 1-3 3h-2a1 1 0 0 1-.993-.883L16 19a1 1 0 0 0-1.993-.117L14 19a1 1 0 0 1-1 1H5a3 3 0 0 1-3-3V7a3 3 0 0 1 3-3zm2 9a1 1 0 0 0-1 1v1a1 1 0 1 0 2 0v-1a1 1 0 0 0-1-1m0-5a1 1 0 0 0-.993.883L14 9v1a1 1 0 0 0 1.993.117L16 10V9a1 1 0 0 0-1-1'/></g></svg></span></div>
        <div class="stat-label">Genres</div>
        <div class="stat-value"><?php echo count($uniqueGenres); ?></div>
    </div>
    <div class="stat-card">
        <div class="stat-icon"><span class="font-size: 30px;"><svg xmlns='http://www.w3.org/2000/svg' width='44' height='44' viewBox='0 0 24 24'><title>calendar_3_line</title><g id="calendar_3_line" fill='none'><path d='M24 0v24H0V0zM12.594 23.258l-.012.002-.071.035-.02.004-.014-.004-.071-.036c-.01-.003-.019 0-.024.006l-.004.01-.017.428.005.02.01.013.104.074.015.004.012-.004.104-.074.012-.016.004-.017-.017-.427c-.002-.01-.009-.017-.016-.018m.264-.113-.014.002-.184.093-.01.01-.003.011.018.43.005.012.008.008.201.092c.012.004.023 0 .029-.008l.004-.014-.034-.614c-.003-.012-.01-.02-.02-.022m-.715.002a.023.023 0 0 0-.027.006l-.006.014-.034.614c0 .012.007.02.017.024l.015-.002.201-.093.01-.008.003-.011.018-.43-.003-.012-.01-.01z'/><path fill='#FFFFFFFF' d='M18 3a2 2 0 0 1 2 2v2h.191a1.5 1.5 0 0 1 1.342 2.17L20 12.237V19a2 2 0 0 1-2 2H6a2 2 0 0 1-2-2v-6.764L2.467 9.171A1.5 1.5 0 0 1 3.81 7H4V5a2 2 0 0 1 2-2zm1.382 6H4.618l1.276 2.553c.076.15.11.31.106.467V19h12v-6.98a.997.997 0 0 1 .106-.467zM14.5 11a2 2 0 0 1 1.995 1.85l.005.15v2a2 2 0 0 1-1.85 1.995L14.5 17h-1a2 2 0 0 1-1.995-1.85L11.5 15v-2a2 2 0 0 1 1.85-1.995L13.5 11zm-4.006.9.006.116V16a1 1 0 0 1-1.993.117L8.5 16v-2.5a1 1 0 0 1-.548-1.836l.1-.058.986-.493c.601-.3 1.297.059 1.437.675zM14.5 13h-1v2h1zM18 5H6v2h12z'/></g></svg></span></div>
        <div class="stat-label">Années</div>
        <div class="stat-value"><?php echo $minYear . ' - ' . $maxYear; ?></div>
    </div>
</div>
</section>

    <section class="random-suggestions-section">
        <div class="section-header" style="display: flex;">
            <h2 class="section-title">Suggestions aléatoires</h2>
            <a href="suggestions.php" class="btn-more-featured">Voir plus</a>
        </div>
        <div class="movie-grid">
            <?php foreach ($randomMovies as $movie): ?>
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
                                    <button class="like-btn-overlay" onclick="toggleLike(<?php echo $movie['id']; ?>)"><i class="far fa-heart"></i></button>
                                    <button class="add-list-btn-overlay" onclick="addToList(<?php echo $movie['id']; ?>)"><i class="fas fa-plus"></i></button>
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
            <?php foreach ($randomSeries as $serie): ?>
                <div class="movie-card" 
                    data-genres='<?php echo json_encode($serie['genre']); ?>'
                    data-rating="<?php echo $serie['rating']; ?>">
                    <div class="movie-poster">
                        <img src="<?php echo $serie['image']; ?>" alt="<?php echo $serie['title']; ?>">
                        <div class="overlay">
                            <a href="player.php?id=<?php echo $serie['id']; ?>&type=serie" class="play-btn">Regarder</a>
                            <button class="info-btn" onclick="showMoviesDetails(<?php echo $serie['id']; ?>)">Détails</button>
                            <h3><?php echo $serie['title']; ?></h3>
                            <?php if (isset($_SESSION['user_id'])): ?>
                                <div class="actions">
                                    <button class="like-btn-overlay" onclick="toggleLike(<?php echo $serie['id']; ?>)"><i class="far fa-heart"></i></button>
                                    <button class="add-list-btn-overlay" onclick="openListPopup(' . $serie['id'] . ', \'movie\')"><i class="fas fa-plus"></i></button>';
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
                <script>
                window.serieData = window.serieData || {};
                window.serieData[<?php echo $serie['id']; ?>] = {
                    id: <?php echo $serie['id']; ?>,
                    type: "movie",
                    title: "<?php echo addslashes($serie['title']); ?>",
                    description: "<?php echo addslashes($serie['description']); ?>",
                    image: "<?php echo addslashes($serie['image']); ?>",
                    imagefond: "<?php echo addslashes($serie['imagefond']); ?>",
                    affiche: "<?php echo addslashes($serie['affiche']); ?>",
                    date: "<?php echo addslashes($serie['date']); ?>",
                    genre: <?php echo json_encode($serie['genre']); ?>,
                    rating: <?php echo $serie['rating']; ?>,
                    actors: "<?php echo addslashes($serie['actors']); ?>",
                    trailer_id: "<?php echo addslashes($serie['trailer_id'] ?? ''); ?>",
                    seasons: <?php echo $serie['seasons']; ?>,
                    episodes: <?php echo $serie['episodes']; ?>,
                    actor_link_1: "<?php echo addslashes($serie['actor_link_1'] ?? ''); ?>",
                    actor_link_2: "<?php echo addslashes($serie['actor_link_2'] ?? ''); ?>",
                    actor_link_3: "<?php echo addslashes($serie['actor_link_3'] ?? ''); ?>",
                    actor_link_4: "<?php echo addslashes($serie['actor_link_4'] ?? ''); ?>",
                    actor_link_5: "<?php echo addslashes($serie['actor_link_5'] ?? ''); ?>"
                };
                </script>
            <?php endforeach; ?>
        </div>
    </section>

    <?php include 'footer.php'; ?>

    <script src="js/popup.js"></script>
    <?php include 'components/popup.php'; ?>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="js/script.js"></script>

    <div id="like-notification" class="like-notification">
        <div class="partie-text">
            <span id="like-notification-message">Ajouté aux favoris !</span>
        </div>
        <div id="like-progress-bar" style="height: 4px; width: 100%; background: #eee; border-radius: 2px; margin-top: 10px; overflow: hidden;">
            <div id="like-progress-bar-inner" style="height: 100%; width: 100%; background: linear-gradient(90deg, #222, #888); transition: width 2s linear;"></div>
        </div>
    </div>
</body>
</html> 