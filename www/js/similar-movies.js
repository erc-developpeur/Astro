// Fonction pour afficher les détails d'un film
function showMovieDetails(movieId) {
    console.log('Showing details for movie:', movieId); // Debug
    const popup = document.getElementById('movie-popup');
    const movie = window.movieData[movieId];
    
    if (movie) {
        console.log('Movie data:', movie); // Debug
        const content = document.getElementById('movie-details-content');
        content.innerHTML = `
            <div class="fond-image">
                <img src="${serie.imagefond}" alt="${serie.title}">
                <div class="container-play">
                    <div class="play-icon"></div>
                </div>
                <img class="img-degrade" src="../www/img/DEGRADE.png">
            </div>
            <div class="movie-details">
                <div class="movie-details-header">
                    <div class="movie-poster-large">
                        <img src="${movie.affiche || movie.image}" alt="${movie.title}">
                    </div>
                    <div class="movie-details-info">
                        <h2>${movie.title}</h2>
                        <div class="movie-meta">
                            <span class="year">${movie.date}</span>
                            <span class="genres">${movie.genre ? movie.genre.join(', ') : ''}</span>
                        </div>
                        <div class="rating">
                            <span class="rating-value">${movie.rating}</span>
                            <span class="stars">`;
        
        // Générer les étoiles de notation
        const fullStars = Math.floor(movie.rating);
        const halfStar = movie.rating - fullStars >= 0.5;
        
        for (let i = 1; i <= 5; i++) {
            if (i <= fullStars) {
                content += '<i class="fas fa-star"></i>';
            } else if (halfStar && i === fullStars + 1) {
                content += '<i class="fas fa-star-half-alt"></i>';
            } else {
                content += '<i class="far fa-star"></i>';
            }
        }
        
        content += `
                        </span>
                    </div>
                    <p class="description">${movie.description}</p>
                    <div class="action-buttons">
                        <button class="play-btn large" onclick="watchMovie(${movie.id})">
                            <i class="fas fa-play"></i> Regarder maintenant
                        </button>
                        <button class="like-btn large" onclick="toggleLike(${movie.id})">
                            <i class="far fa-heart"></i> Ajouter aux favoris
                        </button>
                        <button class="add-list-btn large" onclick="addToList(${movie.id})">
                            <i class="fas fa-plus"></i> Ajouter à ma liste
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="movie-content-grid">
                <div class="movie-description-section">
                    <h3>Synopsis</h3>
                    <p class="description">${movie.description}</p>
                </div>
                
                <div class="movie-trailer-section">
                    <h3>Bande-annonce</h3>
                    <div class="video-container">
                        ${movie.trailer_id ? `
                            <iframe 
                                src="https://www.youtube.com/embed/${movie.trailer_id}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                            </iframe>
                            <div class="trailer-links">
                                <a href="https://www.youtube.com/watch?v=${movie.trailer_id}" target="_blank" class="trailer-link">
                                    <i class="fab fa-youtube"></i> Voir sur YouTube
                                </a>
                            </div>
                        ` : '<p class="no-trailer">Bande-annonce non disponible</p>'}
                    </div>
                </div>
                
                <div class="movie-cast-section">
                    <h3>Casting</h3>
                    <div class="actor-links">
                        ${movie.actors ? movie.actors.split(',').map((actor, index) => {
                            const actorName = actor.trim();
                            const actorLink = movie[`actor_link_${index + 1}`] || `https://fr.wikipedia.org/wiki/${actorName.replace(/\s+/g, '_')}`;
                            return `<a href="${actorLink}" target="_blank" class="actor-link">${actorName}</a>`;
                        }).join('') : 'Information non disponible'}
                    </div>
                </div>
            </div>
            
            <div class="similar-series-section">
                <h3>Films similaires</h3>
                <div class="similar-series-container" id="similar-movies-container">
                    <!-- Les films similaires seront chargés dynamiquement -->
                </div>
            </div>
        `;
        
        // Afficher des films similaires
        afficherFilmsSimilaires(movieId);
        
        // Ouvrir le popup
        popup.classList.add('active');
        document.body.style.overflow = 'hidden';
    } else {
        console.error('Movie not found:', movieId); // Debug
    }
}

// Fonction pour afficher les films similaires
function afficherFilmsSimilaires(movieId) {
    const movie = window.movieData && window.movieData[movieId];
    if (!movie) return;
    
    const container = document.getElementById('similar-movies-container');
    if (!container) return;
    
    // Trouver des films similaires basés sur le genre
    const similarMovies = [];
    const currentGenres = movie.genre || [];
    
    // Parcourir tous les films pour trouver des correspondances
    for (const id in window.movieData) {
        if (id == movieId) continue; // Exclure le film actuel
        
        const otherMovie = window.movieData[id];
        const otherGenres = otherMovie.genre || [];
        
        // Vérifier si les films partagent au moins un genre
        const hasCommonGenre = currentGenres.some(genre => otherGenres.includes(genre));
        
        if (hasCommonGenre) {
            similarMovies.push(otherMovie);
        }
    }
    
    // Limiter à 4 films similaires
    const limitedSimilarMovies = similarMovies.slice(0, 4);
    
    // Si pas assez de films similaires, ajouter des films populaires
    if (limitedSimilarMovies.length < 4) {
        const remainingCount = 4 - limitedSimilarMovies.length;
        const popularMovies = Object.values(window.movieData)
            .filter(m => !limitedSimilarMovies.includes(m) && m.id != movieId)
            .sort((a, b) => b.rating - a.rating)
            .slice(0, remainingCount);
        
        limitedSimilarMovies.push(...popularMovies);
    }
    
    // Générer le HTML pour les films similaires
    let html = '';
    limitedSimilarMovies.forEach(similarMovie => {
        html += `
            <div class="similar-serie-card" onclick="showMovieDetails(${similarMovie.id})">
                <div class="similar-serie-poster">
                    <img src="${similarMovie.image}" alt="${similarMovie.title}">
                </div>
                <div class="similar-serie-info">
                    <h4>${similarMovie.title}</h4>
                    <div class="similar-serie-rating">
                        <span class="rating-value">${similarMovie.rating}</span>
                        <span class="stars">`;
        
        // Générer les étoiles de notation
        const fullStars = Math.floor(similarMovie.rating);
        const halfStar = similarMovie.rating - fullStars >= 0.5;
        
        for (let i = 1; i <= 5; i++) {
            if (i <= fullStars) {
                html += '<i class="fas fa-star"></i>';
            } else if (halfStar && i === fullStars + 1) {
                html += '<i class="fas fa-star-half-alt"></i>';
            } else {
                html += '<i class="far fa-star"></i>';
            }
        }
        
        html += `
                        </span>
                    </div>
                </div>
            </div>
        `;
    });
    
    container.innerHTML = html;
}

// Gestionnaire pour fermer le popup
document.addEventListener('DOMContentLoaded', function() {
    const popup = document.getElementById('movie-popup');
    const closeBtn = document.querySelector('.close-popup');
    
    if (closeBtn) {
        closeBtn.addEventListener('click', function() {
            popup.classList.remove('active');
            document.body.style.overflow = '';
        });
    }
    
    // Fermer le popup en cliquant en dehors
    popup.addEventListener('click', function(e) {
        if (e.target === popup) {
            popup.classList.remove('active');
            document.body.style.overflow = '';
        }
    });
}); 