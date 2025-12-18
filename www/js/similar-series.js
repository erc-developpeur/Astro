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
            .filter(s => !limitedSimilarSeries.includes(s) && s.id != serieId)
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