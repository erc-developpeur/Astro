// Fonction pour afficher les détails d'une série
function showSerieDetails(serieId) {
    const seriePopup = document.getElementById('serie-popup');
    const serie = window.serieData && window.serieData[serieId];
    
    if (!serie) {
        console.error('Données de la série non trouvées');
        return;
    }
    
    const serieDetailsContent = document.getElementById('serie-details-content');
    
    if (!seriePopup || !serieDetailsContent) return;
    
    let content = `
        <a class="lien-button-video" href="player.php?id=${serie.id}&type=serie">
            <div class="fond-image">
                <img src="${serie.imagefond}" alt="${serie.title}">
                <div class="container-play">
                    <div class="play-icon"></div>
                </div>
                <img class="img-degrade" src="../www/img/DEGRADE.png">
            </div>
        </a>
        <div class="serie-details">
            <div class="movie-details-header">
                <div class="serie-poster-large">
                    <img src="${serie.affiche}" alt="${serie.title}">
                </div>
                <div class="serie-details-info">
                    <h2>${serie.title}</h2>
                    <div class="movie-meta">
                        <span class="year">${serie.date}</span>
                        <span class="seasons">${serie.seasons} saisons</span>
                        <span class="episodes">${serie.episodes} épisodes</span>
                        <span class="genres">${serie.genre.join(', ')}</span>
                    </div>
                    <div class="rating">
                        <span class="rating-value">${serie.rating}</span>
                        <span class="stars">`;
    
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
                        <a class="play-btn large" href="player.php?id=${serie.id}&type=serie">
                            <i class="fas fa-play"></i> Regarder maintenant
                        </a>
                        <button class="like-btn large" onclick="toggleLike(${serie.id}, 'serie')">
                            <i class="far fa-heart"></i> Ajouter aux favoris
                        </button>
                        <button class="add-list-btn large" onclick="openListPopup(${serie.id}, 'serie')">
                            <i class="fas fa-plus"></i> Ajouter à ma liste
                        </button>
                    </div>
                </div>
            </div>
        </div>
    `;
    
    serieDetailsContent.innerHTML = content;
    seriePopup.classList.add('active');
    document.body.style.overflow = 'hidden';
}

// Fonction pour regarder une série
function watchSerie(serieId) {
    window.location.href = `player.php?id=${serieId}&type=serie`;
} 