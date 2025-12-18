// Fonction pour afficher les détails d'une série dans le popup
function showMoviesDetails(serieId) {
    document.getElementById('movie-popup').style.display = 'block';
    // Récupérer les données de la série depuis l'objet serieData défini dans la page
    const serie = window.serieData && window.serieData[serieId];
    
    if (!serie) {
        console.error('Données de la série non trouvées');
        return;
    }
    
    const moviePopup = document.getElementById('movie-popup');
    const movieDetailsContent = document.getElementById('movie-details-content');
    
    if (!moviePopup || !movieDetailsContent) return;
    
    // Générer le contenu HTML du popup
    let content = `
        <a class="lien-button-video" href="player.php?id=${serie.id}&type=movie">
            <div class="fond-image">
                <img src="${serie.imagefond}" alt="${serie.title}">
                <div class="container-play">
                    <div class="play-icon"></div>
                </div>
                <img class="img-degrade" src="www/img/DEGRADE.png">
            </div>
        </a>
        <div class="movie-details">
            <div class="movie-details-header">
                <div class="movie-poster-large">
                    <img src="${serie.affiche}" alt="${serie.title}">
                </div>
                <div class="movie-details-info">
                    <h2>${serie.title}</h2>
                    <div class="movie-meta">
                        <span class="year">${serie.date}</span>
                        <span class="genres">${serie.genre.join(', ')}</span>
                        <span class="rating-value">${serie.rating}</span>
                        <span class="stars">`;
    
    // Générer les étoiles de notation
    const fullStars = Math.floor(serie.rating);
    const halfStar = serie.rating - fullStars >= 0.5;
    
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
                    <p class="description">${serie.description}</p>
                    <div class="action-buttons">
                        <a class="play-btn large" href="player.php?id=${serie.id}&type=movie">
                            <i class="fas fa-play"></i> Regarder maintenant
                        </a>
                        <button class="play-btn large" onclick="toggleLike(${serie.id})">
                            <i class="far fa-heart"></i> Ajouter aux favoris
                        </button>
                        <button class="play-btn large" onclick="addToList(${serie.id})">
                            <i class="fas fa-plus"></i> Ajouter à ma liste
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="movie-content-grid">
                <div class="movie-description-section">
                    <h3>Synopsis</h3>
                    <p class="description">${serie.description}</p>
                </div>
                
                <div class="movie-trailer-section">
                    <h3>Bande-annonce</h3>
                    <div class="video-container">
                        <iframe 
                                src="https://www.youtube.com/embed/${serie.trailer_id}" 
                                frameborder="0" 
                                allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" 
                                allowfullscreen>
                        </iframe>
                    </div>
                    <div class="trailer-links">
                        <a href="https://www.youtube.com/watch?v=${serie.trailer_id}" target="_blank" class="play-btn large">
                            <i class="fab fa-youtube"></i> Voir sur YouTube
                        </a>
                    </div>
                </div>
                
                <div class="movie-cast-section">
                    <h3>Casting</h3>
                    <div class="actor-links">
                        ${serie.actors.split(',').map((actor, index) => {
                            const actorName = actor.trim();
                            const wikipediaUrl = `https://fr.wikipedia.org/wiki/${actorName.replace(/\s+/g, '_')}`;
                            return `<a href="${wikipediaUrl}" target="_blank" class="actor-link">${actorName}</a>`;
                        }).join('')}
                    </div>
                </div>
            </div>
            
            <div class="similar-series-section">
                <h3>Séries similaires</h3>
                <div class="similar-series-container" id="similar-series-container">
                    <!-- Les séries similaires seront chargées dynamiquement -->
                </div>
            </div>
        </div>
    `;
    
    // Injecter le contenu dans le popup
    movieDetailsContent.innerHTML = content;
    
    // Charger les séries similaires
    afficherSeriesSimilaires(serieId);
}

// Fonction pour regarder une série (simulation)
function watchSerie(serieId) {
    // Dans une application réelle, cette fonction redirigerait vers la page de lecture de la série
    alert(`Lecture de la série ID: ${serieId} - Cette fonctionnalité est en cours de développement.`);
}

function showLikeNotification(message = "Ajouté aux favoris !", mediaId = null) {
    const notif = document.getElementById('like-notification');
    const notifMsg = document.getElementById('like-notification-message');
    const progressBar = document.getElementById('like-progress-bar-inner');
    notif.style.display = 'block';
    let finalMessage = message;
    if (mediaId && window.serieData && window.serieData[mediaId]) {
        finalMessage = `${window.serieData[mediaId].title} : ${message}`;
    }
    if (notifMsg) notifMsg.textContent = finalMessage;
    if (progressBar) {
        progressBar.style.transition = 'none';
        progressBar.style.width = '100%';
        void progressBar.offsetWidth;
        progressBar.style.transition = 'width 2s linear';
        setTimeout(() => {
            progressBar.style.width = '0%';
        }, 10);
    }
    setTimeout(() => {
        notif.style.display = 'none';
        if (progressBar) {
            progressBar.style.transition = 'none';
            progressBar.style.width = '100%';
        }
    }, 2000);
}

// Fonction pour ajouter/retirer des favoris (simulation)
function toggleLike(serieId) {
    const button = event.currentTarget;
    const icon = button.querySelector('i');
    if (icon.classList.contains('far')) {
        icon.classList.remove('far');
        icon.classList.add('fas');
        showLikeNotification("Ajouté aux favoris !", serieId);
    } else {
        icon.classList.remove('fas');
        icon.classList.add('far');
        showLikeNotification("Retiré des favoris", serieId);
    }
}


// Fonction pour afficher les séries similaires
function afficherSeriesSimilaires(serieId) {
    const serie = window.serieData && window.serieData[serieId];
    if (!serie) return;
    
    const container = document.getElementById('similar-series-container');
    if (!container) return;
    
    // Trouver des séries similaires basées sur le genre
    const similarSeries = [];
    const currentGenres = serie.genre || [];
    
    // Parcourir toutes les séries pour trouver des correspondances
    for (const id in window.serieData) {
        if (id == serieId) continue; // Exclure la série actuelle
        
        const otherSerie = window.serieData[id];
        // Vérifier si c'est bien une série
        if (otherSerie.type !== serie.type) continue;
        
        const otherGenres = otherSerie.genre || [];
        
        // Vérifier si les séries partagent au moins un genre
        const hasCommonGenre = currentGenres.some(genre => otherGenres.includes(genre));
        
        if (hasCommonGenre) {
            similarSeries.push(otherSerie);
        }
    }
    
    // Limiter à 4 séries similaires
    const limitedSimilarSeries = similarSeries.slice(0, 4);
    
    // Si pas assez de séries similaires, ajouter des séries populaires
    if (limitedSimilarSeries.length < 4) {
        const remainingCount = 4 - limitedSimilarSeries.length;
        const popularSeries = Object.values(window.serieData)
            .filter(s => s.type === serie.type && !limitedSimilarSeries.includes(s) && s.id != serieId)
            .sort((a, b) => b.rating - a.rating)
            .slice(0, remainingCount);
        
        limitedSimilarSeries.push(...popularSeries);
    }
    
    // Générer le HTML pour les séries similaires
    let html = '';
    limitedSimilarSeries.forEach(similarSerie => {
        html += `
            <div class="similar-serie-card" onclick="showSerieDetails(${similarSerie.id})">
                <div class="similar-serie-poster">
                    <img src="${similarSerie.image}" alt="${similarSerie.title}">
                </div>
                <div class="similar-serie-info">
                    <h4>${similarSerie.title}</h4>
                    <div class="similar-serie-rating">
                        <span class="rating-value">${similarSerie.rating}</span>
                        <span class="stars">`;
        
        // Générer les étoiles de notation
        const fullStars = Math.floor(similarSerie.rating);
        const halfStar = similarSerie.rating - fullStars >= 0.5;
        
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

document.addEventListener('DOMContentLoaded', function() {
    const heroLikeBtn = document.querySelector('.hero-like-button');
    if (heroLikeBtn) {
        heroLikeBtn.addEventListener('click', function() {
            showLikeNotification("Ajouté aux favoris !");
            // Ici tu peux aussi ajouter la logique d'ajout/retrait des favoris si besoin
        });
    }
}); 