document.addEventListener('DOMContentLoaded', function() {
    // Gestion des onglets
    const tabButtons = document.querySelectorAll('.tab-btn');
    const tabPanes = document.querySelectorAll('.tab-pane');

    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            // Retirer la classe active de tous les boutons et panneaux
            tabButtons.forEach(btn => btn.classList.remove('active'));
            tabPanes.forEach(pane => pane.classList.remove('active'));

            // Ajouter la classe active au bouton cliqué
            button.classList.add('active');

            // Afficher le panneau correspondant
            const tabId = button.getAttribute('data-tab');
            document.getElementById(tabId).classList.add('active');
        });
    });

    // Gestion des popups
    const moviePopup = document.getElementById('movie-popup');
    const seriePopup = document.getElementById('serie-popup');
    const closeButtons = document.querySelectorAll('.close-popup');

    closeButtons.forEach(button => {
        button.addEventListener('click', () => {
            moviePopup.style.display = 'none';
            seriePopup.style.display = 'none';
        });
    });

    // Fermer les popups en cliquant en dehors
    window.addEventListener('click', (event) => {
        if (event.target === moviePopup) {
            moviePopup.style.display = 'none';
        }
        if (event.target === seriePopup) {
            seriePopup.style.display = 'none';
        }
    });

    // Fonction pour afficher les détails d'un film
    window.showMovieDetails = function(movieId) {
        fetch(`api/movie_details.php?id=${movieId}`)
            .then(response => response.json())
            .then(data => {
                const content = document.getElementById('movie-details-content');
                content.innerHTML = `
                    <h2>${data.title}</h2>
                    <div class="movie-meta">
                        <span>${data.genre.join(', ')}</span>
                        <span>${data.rating} ★</span>
                        <span>${new Date(data.date).getFullYear()}</span>
                    </div>
                    <p>${data.description}</p>
                    <div class="movie-actions">
                        <a href="player.php?id=${data.id}&type=movie" class="play-btn">Regarder</a>
                        <button class="like-btn" onclick="toggleLike(${data.id}, 'movie')">
                            <i class="fas fa-heart"></i>
                        </button>
                        <button class="add-list-btn" onclick="addToList(${data.id}, 'movie')">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                `;
                moviePopup.style.display = 'block';
            })
            .catch(error => console.error('Error:', error));
    };

    // Fonction pour afficher les détails d'une série
    window.showSerieDetails = function(serieId) {
        fetch(`api/serie_details.php?id=${serieId}`)
            .then(response => response.json())
            .then(data => {
                const content = document.getElementById('serie-details-content');
                content.innerHTML = `
                    <h2>${data.title}</h2>
                    <div class="serie-meta">
                        <span>${data.genre.join(', ')}</span>
                        <span>${data.rating} ★</span>
                        <span>${new Date(data.date).getFullYear()}</span>
                        <span>${data.seasons} saisons</span>
                    </div>
                    <p>${data.description}</p>
                    <div class="serie-actions">
                        <a href="player.php?id=${data.id}&type=serie" class="play-btn">Regarder</a>
                        <button class="like-btn" onclick="toggleLike(${data.id}, 'serie')">
                            <i class="fas fa-heart"></i>
                        </button>
                        <button class="add-list-btn" onclick="addToList(${data.id}, 'serie')">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>
                `;
                seriePopup.style.display = 'block';
            })
            .catch(error => console.error('Error:', error));
    };

    // Fonction pour aimer/ne plus aimer
    window.toggleLike = function(id, type) {
        fetch('api/toggle_like.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: id,
                type: type
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mettre à jour l'interface utilisateur
                const button = event.target.closest('.like-btn, .unlike-btn');
                if (button.classList.contains('like-btn')) {
                    button.classList.remove('like-btn');
                    button.classList.add('unlike-btn');
                    button.innerHTML = '<i class="fas fa-heart"></i>';
                } else {
                    button.classList.remove('unlike-btn');
                    button.classList.add('like-btn');
                    button.innerHTML = '<i class="far fa-heart"></i>';
                }
            }
        })
        .catch(error => console.error('Error:', error));
    };

    // Fonction pour ajouter/supprimer de la liste
    window.addToList = function(id, type) {
        if (!isLoggedIn()) {
            showNotification('Vous devez être connecté pour ajouter des médias à votre liste', 'error');
            return;
        }

        fetch('api/toggle_watchlist.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `media_id=${id}&media_type=${type}`
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                showNotification(data.message, 'success');
                // Mettre à jour l'interface utilisateur
                const button = document.querySelector(`[data-media-id="${id}"][data-media-type="${type}"]`);
                if (button) {
                    button.classList.toggle('active');
                }
            } else {
                showNotification(data.message, 'error');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            showNotification('Une erreur est survenue', 'error');
        });
    };

    // Fonction pour supprimer de la liste
    window.removeFromList = function(id, type) {
        fetch('api/remove_from_watchlist.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                id: id,
                type: type
            })
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Supprimer la carte de l'interface
                const card = event.target.closest('.movie-card');
                card.remove();
            }
        })
        .catch(error => console.error('Error:', error));
    };
}); 