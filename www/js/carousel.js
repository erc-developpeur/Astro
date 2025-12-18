document.addEventListener('DOMContentLoaded', function() {
    const eventContainer = document.querySelector('.event');
    const cards = document.querySelectorAll('.mylist-card');
    let currentIndex = 0;
    const cardWidth = cards[0].offsetWidth;
    const gap = 20; // Espacement entre les cartes
    const cardsPerView = 5; // Nombre de cartes visibles à la fois
    let isAnimating = false;

    // Fonction pour déplacer les cartes
    function moveCards(direction) {
        if (isAnimating) return;
        isAnimating = true;

        const totalCards = cards.length;
        const moveDistance = cardWidth + gap;

        // Calculer le nouvel index
        if (direction === 'next') {
            currentIndex = (currentIndex + 1) % totalCards;
        } else {
            currentIndex = (currentIndex - 1 + totalCards) % totalCards;
        }

        // Animer le déplacement
        eventContainer.style.transition = 'transform 0.5s ease-in-out';
        eventContainer.style.transform = `translateX(-${currentIndex * moveDistance}px)`;

        // Réinitialiser la position après l'animation
        setTimeout(() => {
            if (currentIndex >= totalCards - cardsPerView) {
                currentIndex = 0;
                eventContainer.style.transition = 'none';
                eventContainer.style.transform = `translateX(0)`;
            } else if (currentIndex < 0) {
                currentIndex = totalCards - cardsPerView;
                eventContainer.style.transition = 'none';
                eventContainer.style.transform = `translateX(-${(totalCards - cardsPerView) * moveDistance}px)`;
            }
            isAnimating = false;
        }, 500);
    }

    // Ajouter les boutons de navigation
    const navigationContainer = document.createElement('div');
    navigationContainer.className = 'carousel-navigation';
    navigationContainer.innerHTML = `
        <button class="carousel-btn prev"><i class="fas fa-chevron-left"></i></button>
        <button class="carousel-btn next"><i class="fas fa-chevron-right"></i></button>
    `;
    eventContainer.parentNode.insertBefore(navigationContainer, eventContainer.nextSibling);

    // Gérer les clics sur les boutons
    document.querySelector('.carousel-btn.prev').addEventListener('click', () => moveCards('prev'));
    document.querySelector('.carousel-btn.next').addEventListener('click', () => moveCards('next'));

    // Ajouter le style CSS pour le carousel
    const style = document.createElement('style');
    style.textContent = `
        .event {
            display: flex;
            gap: ${gap}px;
            transition: transform 0.5s ease-in-out;
        }
        .carousel-btn {
            background: rgba(0, 0, 0, 0.5);
            border: none;
            color: white;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            cursor: pointer;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: background 0.3s ease;
        }
        .carousel-btn:hover {
            background: rgba(0, 0, 0, 0.8);
        }
        .mylist-card {
            flex: 0 0 ${cardWidth}px;
        }
    `;
    document.head.appendChild(style);

    // Défilement automatique
    let autoScrollInterval = setInterval(() => moveCards('next'), 8000);

    // Arrêter le défilement automatique au survol
    eventContainer.addEventListener('mouseenter', () => clearInterval(autoScrollInterval));
    eventContainer.addEventListener('mouseleave', () => {
        autoScrollInterval = setInterval(() => moveCards('next'), 8000);
    });

    // Sélectionne toutes les cartes
    eventContainer.addEventListener('click', function(e) {
        // Trouve la carte cliquée (même si on clique sur l'image à l'intérieur)
        const card = e.target.closest('.mylist-card');
        if (!card) return;

        const id = card.getAttribute('data-id');
        const type = card.getAttribute('data-type');
        const data = window.serieData && window.serieData[id];
        if (!data) return;

        // Met à jour l'image de fond
        const fondImg = document.getElementById('main-fond-img');
        if (fondImg) fondImg.src = data.imagefond || data.image;

        // Met à jour le titre
        const title = document.getElementById('main-title');
        if (title) title.textContent = data.title;

        // Met à jour le genre
        const genre = document.getElementById('main-genre');
        if (genre) genre.textContent = Array.isArray(data.genre) ? data.genre.join(', ') : data.genre;

        // Met à jour la note
        const rating = document.getElementById('main-rating');
        if (rating) rating.textContent = (data.rating ? Number(data.rating).toFixed(1) : '-') + ' ★';

        // Met à jour l'année
        const year = document.getElementById('main-year');
        if (year) year.textContent = data.date ? ('' + new Date(data.date).getFullYear()) : '';

        // Met à jour la description
        const desc = document.getElementById('main-description');
        if (desc) desc.textContent = data.description;

        // Met à jour le bouton play
        const playBtn = document.getElementById('dynamic-play-button');
        if (playBtn) {
            playBtn.href = `player.php?id=${data.id}&type=${data.type}`;
        }

        // Met à jour l'état actif sur la carte sélectionnée
        document.querySelectorAll('.mylist-card').forEach(c => c.classList.remove('active'));
        card.classList.add('active');
    });
}); 