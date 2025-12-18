// Fonction pour trier les films/séries
function sortItems(items, sortBy) {
    switch(sortBy) {
        case 'popular':
            // Trier par popularité (rating)
            return items.sort((a, b) => b.rating - a.rating);
        case 'recent':
            // Trier par date de sortie
            return items.sort((a, b) => new Date(b.date) - new Date(a.date));
        case 'rating':
            // Trier par note
            return items.sort((a, b) => b.rating - a.rating);
        case 'title':
            // Trier par titre
            return items.sort((a, b) => a.title.localeCompare(b.title));
        default:
            return items;
    }
}

// Fonction pour filtrer par genre
function filterByGenre(items, genre) {
    if (!genre) return items;
    return items.filter(item => item.genre.includes(genre));
}

// Fonction pour mettre à jour l'affichage
function updateDisplay(items) {
    const container = document.querySelector('.movie-grid');
    if (!container) return;

    // Vider le conteneur
    container.innerHTML = '';

    // Recréer les cartes
    items.forEach(item => {
        const card = document.createElement('div');
        card.className = 'movie-card';
        card.setAttribute('data-genres', JSON.stringify(item.genre));
        card.setAttribute('data-rating', item.rating);

        card.innerHTML = `
            <div class="movie-poster">
                <img src="${item.image}" alt="${item.title}">
                <div class="overlay">
                    <button class="play-btn" onclick="watch${item.type === 'movie' ? 'Movie' : 'Serie'}(${item.id})">Regarder</button>
                    <button class="info-btn" onclick="show${item.type === 'movie' ? 'Movie' : 'Serie'}Details(${item.id})">Détails</button>
                    <h3>${item.title}</h3>
                    ${window.userId ? `
                        <div class="actions">
                            <button class="like-btn-overlay" onclick="toggleLike(${item.id}, '${item.type}')">
                                <i class="far fa-heart"></i>
                            </button>
                            <button class="add-list-btn-overlay" onclick="openListPopup(${item.id}, '${item.type}')">
                                <i class="fas fa-plus"></i>
                            </button>
                        </div>
                    ` : ''}
                </div>
            </div>
        `;

        container.appendChild(card);
    });
}

// Écouteurs d'événements pour les filtres
document.addEventListener('DOMContentLoaded', function() {
    const sortFilter = document.getElementById('sort-filter');
    const genreFilter = document.getElementById('genre-filter');
    const searchInput = document.getElementById('search-input');
    const searchBtn = document.getElementById('search-btn');

    // Fonction pour appliquer tous les filtres
    function applyFilters() {
        let items = window.serieData ? Object.values(window.serieData) : [];
        
        // Filtrer par genre
        const selectedGenre = genreFilter.value;
        items = filterByGenre(items, selectedGenre);
        
        // Recherche
        const searchTerm = searchInput.value.toLowerCase();
        if (searchTerm) {
            items = items.filter(item => 
                item.title.toLowerCase().includes(searchTerm)
            );
        }
        
        // Trier
        const sortBy = sortFilter.value;
        items = sortItems(items, sortBy);
        
        // Mettre à jour l'affichage
        updateDisplay(items);
    }

    // Écouteurs d'événements
    sortFilter.addEventListener('change', applyFilters);
    genreFilter.addEventListener('change', applyFilters);

    // Recherche en temps réel
    searchInput.addEventListener('input', function() {
        applyFilters();
    });

    // Recherche au clic sur le bouton
    searchBtn.addEventListener('click', function() {
        applyFilters();
    });

    // Recherche avec la touche Entrée
    searchInput.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            applyFilters();
        }
    });
}); 