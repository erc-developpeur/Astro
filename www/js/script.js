function closeSeriePopup() {
    const seriePopup = document.getElementById('serie-popup');
    seriePopup.style.display = 'none';
    document.body.style.overflow = '';
}

// Fermer le popup en cliquant en dehors
document.getElementById('serie-popup').addEventListener('click', function(e) {
    if (e.target === this) {
        closeSeriePopup();
    }
});

// Menu Burger
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM chargé');
    const navBurger = document.querySelector('.nav-burger');
    const navCenter = document.querySelector('.nav-center');
    console.log('Éléments trouvés:', { navBurger, navCenter });

    if (navBurger && navCenter) {
        navBurger.addEventListener('click', () => {
            console.log('Clic sur le menu burger');
            navBurger.classList.toggle('active');
            navCenter.classList.toggle('active');
        });

        // Fermer le menu quand on clique sur un lien
        document.querySelectorAll('.nav-center a').forEach(link => {
            link.addEventListener('click', () => {
                navBurger.classList.remove('active');
                navCenter.classList.remove('active');
            });
        });
    }
}); 