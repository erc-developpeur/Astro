<?php
// Inclure les fichiers nécessaires
require_once 'config/database.php';
require_once 'models/Movie.php';
require_once 'models/Serie.php';

// Récupérer le film vedette
$movieManager = new Movie();
$featuredMovie = $movieManager->getFeaturedMovie();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="assets/css/hero.css">
</head>
<body>
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
                        shuffle($allMovies);
                        shuffle($allSeries);
                        $movies = array_slice($allMovies, 0, 6);
                        $series = array_slice($allSeries, 0, 5);
                        $myList = array_merge($movies, $series);
                        shuffle($myList);
                        $featuredMovies = $myList;
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

    <script src="assets/js/hero.js"></script>
</body>
</html> 