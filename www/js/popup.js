// Fonction pour fermer le popup de film
function closeMoviePopup() {
    const moviePopup = document.getElementById('movie-popup');
    if (moviePopup) {
        moviePopup.classList.remove('active');
        moviePopup.style.display = 'none';
        document.body.style.overflow = '';
        document.querySelector('.menu-overlay')?.classList.remove('active');
    }
}

// Fonction pour fermer le popup de série
function closeSeriePopup() {
    const seriePopup = document.getElementById('serie-popup');
    if (seriePopup) {
        seriePopup.classList.remove('active');
        seriePopup.style.display = 'none';
        document.body.style.overflow = '';
        document.querySelector('.menu-overlay')?.classList.remove('active');
    }
}

// Fermer les popups en cliquant en dehors
document.addEventListener('DOMContentLoaded', function() {
    const moviePopup = document.getElementById('movie-popup');
    const seriePopup = document.getElementById('serie-popup');

    if (moviePopup) {
        moviePopup.addEventListener('click', function(e) {
            if (e.target === this) {
                closeMoviePopup();
            }
        });
    }

    if (seriePopup) {
        seriePopup.addEventListener('click', function(e) {
            if (e.target === this) {
                closeSeriePopup();
            }
        });
    }

    // Fermer avec la touche ESC
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') {
            closeMoviePopup();
            closeSeriePopup();
        }
    });
});

