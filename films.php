<?php
$config = require_once 'config/app.php';
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
    <title>Films - <?php echo $config['app_name']; ?></title>
    <link rel="stylesheet" href="www/css/style.css">
    <link rel="stylesheet" href="www/css/home.css">
    <link rel="stylesheet" href="www/css/button-like.css">
    <link rel="stylesheet" href="www/css/serie.css">
    <link rel="stylesheet" href="www/css/popup.css">
    <script src="www/js/button-like.js"></script>
    <script src="www/js/index.js"></script>
    <script src="www/js/home.js"></script>
    <script src="www/js/commentaire.js"></script>
    <script src="www/js/popup.js"></script>
    <script src="www/js/similar-series.js"></script>
    <script src="www/js/similar-movies.js"></script>
    <script src="www/js/sorting.js"></script>
    <link rel="stylesheet" href="css/loader.css">
    <script src="js/loader.js" defer></script>
</head>
<body>
<?php include 'components/header.php'; ?>

    <?php include 'components/popup.php'; ?>

    <div class="films-hero">
        <div class="hero-content-serie-films">
            <h1>Tous nos films</h1>
            <p>Découvrez notre collection de films de tous genres</p>
        </div>
    </div>

    <div class="filter-container">
        <div class="search-box">
            <input type="text" id="search-input" placeholder="Rechercher un film...">
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
            require_once 'models/Movie.php';
            $movieManager = new Movie();
            $movies = $movieManager->getAllMovies();
            
            foreach ($movies as $movie) {
                echo '<div class="movie-card" 
                     data-genres=' . json_encode($movie['genre']) . '
                     data-rating="' . $movie['rating'] . '">';
                echo '<div class="movie-poster">';
                echo '<img src="' . $movie['image'] . '" alt="' . $movie['title'] . '">';
                echo '<div class="overlay">';
                echo '<a href="player.php?id=' . $serie['id'] . '&type=serie" class="play-btn">Regarder</a>';
                echo '<button class="info-btn" onclick="showMoviesDetails(' . $serie['id'] . ')">Détails</button>';
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

    <?php include 'footer.php'; ?>

    <div id="movie-popup" class="popup">
        <div class="popup-content">
        
            <span class="close-popup">
            <button class="button85" onclick="closeMoviePopup()"><span class="text">Fermer</span><span class="icon"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"><path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path></svg></span></button>
            </span>
            <div id="movie-details-content">
                <!-- Contenu dynamique chargé par JavaScript -->
            </div>
        </div>
    </div>

    <div id="categories-dropdown" class="dropdown-menu">
        <div class="dropdown-content">
            <h3>Catégories</h3>
            <div class="category-grid">
                <a href="category.php?genre=action">Action</a>
                <a href="category.php?genre=aventure">Aventure</a>
                <a href="category.php?genre=animation">Animation</a>
                <a href="category.php?genre=comedie">Comédie</a>
                <a href="category.php?genre=crime">Crime</a>
                <a href="category.php?genre=documentaire">Documentaire</a>
                <a href="category.php?genre=drame">Drame</a>
                <a href="category.php?genre=famille">Famille</a>
                <a href="category.php?genre=fantastique">Fantastique</a>
                <a href="category.php?genre=guerre">Guerre</a>
                <a href="category.php?genre=histoire">Histoire</a>
                <a href="category.php?genre=horreur">Horreur</a>
                <a href="category.php?genre=musique">Musique</a>
                <a href="category.php?genre=mystere">Mystère</a>
                <a href="category.php?genre=romance">Romance</a>
                <a href="category.php?genre=science-fiction">Science-Fiction</a>
                <a href="category.php?genre=telefilm">Téléfilm</a>
                <a href="category.php?genre=thriller">Thriller</a>
                <a href="category.php?genre=western">Western</a>
            </div>
        </div>
    </div>

    <script src="js/todo-list.js"></script>
    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
    <script src="js/popup.js"></script>
    <script src="js/script.js"></script>

    <div id="like-notification" class="like-notification">
        <div class="partie-text">
            <span id="like-notification-message">Ajouté aux favoris !</span>
        </div>
        <div id="like-progress-bar" style="height: 4px; width: 100%; background: #eee; border-radius: 2px; margin-top: 10px; overflow: hidden;">
            <div id="like-progress-bar-inner" style="height: 100%; width: 100%; background: linear-gradient(90deg, #222, #888); transition: width 2s linear;"></div>
        </div>
    </div>

    <script>
    function closeMoviePopup() {
        const moviePopup = document.getElementById('movie-popup');
        moviePopup.style.display = 'none';
        document.body.style.overflow = '';
    }

    // Fermer le popup en cliquant en dehors
    document.getElementById('movie-popup').addEventListener('click', function(e) {
        if (e.target === this) {
            closeMoviePopup();
        }
    });
    // Générer les données pour chaque film/série de la liste
    window.myListFondData = {};
    <?php
    foreach ($myList as $item) {
        $fond = isset($item['imagefond']) ? $item['imagefond'] : $item['image'];
        $title = addslashes($item['title']);
        $desc = addslashes($item['description']);
        $match = isset($item['rating']) ? (int)($item['rating'] * 20 + rand(0, 5)) : 98; // Calcul simple pour l'exemple
        $year = isset($item['date']) ? date('Y', strtotime($item['date'])) : '';
        $genre = addslashes(implode(', ', $item['genre']));
        $rating = isset($item['rating']) ? number_format($item['rating'], 1) : '';
        echo "window.myListFondData['{$item['type']}_{$item['id']}'] = { imagefond: '" . addslashes($fond) . "', title: '" . $title . "', description: '" . $desc . "', match: '" . $match . "', year: '" . $year . "', genre: '" . $genre . "', rating: '" . $rating . "' };\n";
    }
    ?>

    function changeMainFond(id, type) {
        var fondData = window.myListFondData[type + '_' + id];
        if (fondData) {
            var fondImg = document.getElementById('main-fond-img');
            fondImg.src = fondData.imagefond;
            fondImg.alt = fondData.title;
            document.getElementById('main-title').textContent = fondData.title;
            document.getElementById('main-description').textContent = fondData.description;
            document.getElementById('main-genre').textContent = fondData.genre;
            document.getElementById('main-rating').textContent = fondData.rating + ' ★';
            document.getElementById('main-year').textContent = fondData.year;
            
            // Mettre à jour le bouton PLAY
            updatePlayButton(id, type);
        }
    }

    // Fonction pour mettre à jour le bouton PLAY
    function updatePlayButton(id, type) {
        const playButton = document.getElementById('dynamic-play-button');
        if (playButton) {
            playButton.href = `player.php?id=${id}&type=${type}`;
            playButton.setAttribute('data-id', id);
            playButton.setAttribute('data-type', type);
        }
    }

    // Ajouter l'écouteur d'événement sur chaque card
    window.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.mylist-card').forEach(function(card) {
            card.addEventListener('click', function() {
                var id = this.getAttribute('data-id');
                var type = this.getAttribute('data-type');
                changeMainFond(id, type);
            });
        });
    });

    // Mettre à jour le bouton PLAY initial avec le film vedette
    window.addEventListener('DOMContentLoaded', function() {
        const featuredMovie = <?php echo json_encode($featuredMovie); ?>;
        if (featuredMovie) {
            updatePlayButton(featuredMovie['id'], 'movie');
        }
    });

    window.heroSlides = <?php echo json_encode($featuredMovies); ?>;

    let currentSlide = 0;
    const slides = window.heroSlides;

    function updateHero(slide) {
        // Retire la classe show pour fade-out
        document.getElementById('main-fond-img').classList.remove('show');
        document.getElementById('main-title').classList.remove('show');
        document.getElementById('main-description').classList.remove('show');
        document.getElementById('main-genre').classList.remove('show');
        document.getElementById('main-rating').classList.remove('show');
        document.getElementById('main-year').classList.remove('show');

        // Retire la classe active de toutes les cartes
        document.querySelectorAll('.mylist-card').forEach(card => {
            card.classList.remove('active');
        });

        setTimeout(function() {
            document.getElementById('main-fond-img').src = slide.imagefond;
            document.getElementById('main-fond-img').alt = slide.title;
            document.getElementById('main-title').textContent = slide.title;
            document.getElementById('main-description').textContent = slide.description;
            document.getElementById('main-genre').textContent = (slide.genre || []).join(', ');
            document.getElementById('main-rating').textContent = (slide.rating ? Number(slide.rating).toFixed(1) : '') + ' ★';
            document.getElementById('main-year').textContent = slide.date ? new Date(slide.date).getFullYear() : '';

            // Ajoute la classe active à la carte correspondante
            const activeCard = document.querySelector(`.mylist-card[data-id="${slide.id}"][data-type="${slide.type}"]`);
            if (activeCard) {
                activeCard.classList.add('active');
            }

            // Mettre à jour le bouton PLAY
            updatePlayButton(slide.id, slide.type);

            // Ajoute la classe show pour fade-in
            document.getElementById('main-fond-img').classList.add('show');
            document.getElementById('main-title').classList.add('show');
            document.getElementById('main-description').classList.add('show');
            document.getElementById('main-genre').classList.add('show');
            document.getElementById('main-rating').classList.add('show');
            document.getElementById('main-year').classList.add('show');
        }, 350); // mi-temps de la transition
    }

    function nextHeroSlide() {
        currentSlide = (currentSlide + 1) % slides.length;
        updateHero(slides[currentSlide]);
    }

    window.addEventListener('DOMContentLoaded', function() {
        updateHero(slides[0]);
        setInterval(nextHeroSlide, 7000); // Change toutes les 7 secondes
    });

    document.getElementById('movie-popup').addEventListener('click', function(e) {
        if (e.target === this) {
            closeMoviePopup();
        }
    });
    document.getElementById('serie-popup').addEventListener('click', function(e) {
        if (e.target === this) {
            closeSeriePopup();
        }
    });
    </script>

    <script>
    function closeMoviePopup() {
        document.getElementById('movie-popup').style.display = 'none';
    }
    function closeSeriePopup() {
        document.getElementById('serie-popup').style.display = 'none';
    }
    </script>
</body>
</html> 