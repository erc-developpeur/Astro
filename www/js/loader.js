class PageLoader {
    constructor() {
        this.loaderContainer = document.createElement('div');
        this.loaderContainer.className = 'loader-container';
        this.loaderContainer.innerHTML = '<div class="loader"></div>';
        document.body.appendChild(this.loaderContainer);

        // Intercepter les clics sur les liens
        document.addEventListener('click', (e) => {
            const link = e.target.closest('a');
            if (link && !link.hasAttribute('data-no-loader')) {
                e.preventDefault();
                const href = link.getAttribute('href');
                if (href && !href.startsWith('#')) {
                    this.show();
                    setTimeout(() => {
                        window.location.href = href;
                    }, 300);
                }
            }
        });

        // Gérer le chargement de la page
        window.addEventListener('load', () => {
            this.hide();
        });
    }

    show() {
        this.loaderContainer.classList.add('active');
    }

    hide() {
        this.loaderContainer.classList.remove('active');
    }
}

// Initialiser le loader
document.addEventListener('DOMContentLoaded', () => {
    window.pageLoader = new PageLoader();
}); 