// Fonction pour vérifier si c'est un desktop
function isDesktop() {
    return window.innerWidth > 968;
}

document.addEventListener('DOMContentLoaded', function() {
    // Ne s'exécute que sur desktop
    if (!isDesktop()) return;

    const event = document.querySelector('.event');
    if (!event) return;

    const cards = document.querySelectorAll('.mylist-card');
    let currentIndex = 0;

    // Fonction pour mettre à jour le héros
    function updateHeroContent(card) {
        const id = card.dataset.id;
        const type = card.dataset.type;
        
        // Utiliser les données stockées dans window.myListFondData
        const fondData = window.myListFondData[type + '_' + id];
        if (!fondData) return;

        // Mettre à jour le contenu avec animation de fondu
        document.getElementById('main-fond-img').classList.remove('show');
        document.getElementById('main-title').classList.remove('show');
        document.getElementById('main-description').classList.remove('show');
        document.getElementById('main-genre').classList.remove('show');
        document.getElementById('main-rating').classList.remove('show');
        document.getElementById('main-year').classList.remove('show');

        setTimeout(() => {
            document.getElementById('main-fond-img').src = fondData.imagefond;
            document.getElementById('main-fond-img').alt = fondData.title;
            document.getElementById('main-title').textContent = fondData.title;
            document.getElementById('main-description').textContent = fondData.description;
            document.getElementById('main-genre').textContent = fondData.genre;
            document.getElementById('main-rating').textContent = fondData.rating + ' ★';
            document.getElementById('main-year').textContent = fondData.year;

            // Mettre à jour le bouton PLAY
            updatePlayButton(id, type);

            document.getElementById('main-fond-img').classList.add('show');
            document.getElementById('main-title').classList.add('show');
            document.getElementById('main-description').classList.add('show');
            document.getElementById('main-genre').classList.add('show');
            document.getElementById('main-rating').classList.add('show');
            document.getElementById('main-year').classList.add('show');
        }, 350);
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

    // Ajouter les événements de survol pour chaque carte
    cards.forEach(card => {
        card.addEventListener('mouseenter', () => {
            if (!isDesktop()) return;
            updateHeroContent(card);
        });
    });

    // Autoplay plus lent pour desktop
    let autoplayInterval = setInterval(() => {
        if (!isDesktop()) {
            clearInterval(autoplayInterval);
            return;
        }
        currentIndex = (currentIndex + 1) % cards.length;
        updateHeroContent(cards[currentIndex]);
    }, 8000); // 8 secondes pour desktop

    // Arrêter l'autoplay quand la souris est sur une carte
    event.addEventListener('mouseenter', () => {
        if (!isDesktop()) return;
        clearInterval(autoplayInterval);
    });

    // Reprendre l'autoplay quand la souris quitte la zone
    event.addEventListener('mouseleave', () => {
        if (!isDesktop()) return;
        autoplayInterval = setInterval(() => {
            currentIndex = (currentIndex + 1) % cards.length;
            updateHeroContent(cards[currentIndex]);
        }, 8000);
    });

    // Gestion du redimensionnement
    window.addEventListener('resize', () => {
        if (!isDesktop()) {
            clearInterval(autoplayInterval);
        }
    });

    // Mettre à jour le bouton PLAY initial avec le film vedette
    const featuredMovie = window.featuredMovie;
    if (featuredMovie) {
        updatePlayButton(featuredMovie.id, 'movie');
    }
}); 