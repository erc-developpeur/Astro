// Fonction pour afficher une notification
function showLikeNotification(message) {
    const notification = document.createElement('div');
    notification.className = 'notification';
    notification.innerHTML = `
        <div class="notification-content">
            <p>${message}</p>
            <div class="progress-bar"></div>
        </div>
    `;
    document.body.appendChild(notification);

    // Animation de la barre de progression
    const progressBar = notification.querySelector('.progress-bar');
    progressBar.style.width = '100%';
    progressBar.style.transition = 'width 3s linear';

    // Supprimer la notification après 3 secondes
    setTimeout(() => {
        notification.remove();
    }, 3000);
}

// Fonction pour gérer les likes
function toggleLike(mediaId, mediaType) {
    if (!mediaId || !mediaType) {
        console.error('ID et type du média requis');
        return;
    }

    const button = event.currentTarget;
    const icon = button.querySelector('i');
    const isLiked = icon.classList.contains('fas');

    fetch('api/toggle_like.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `media_id=${mediaId}&media_type=${mediaType}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Mettre à jour l'icône
            icon.classList.toggle('far');
            icon.classList.toggle('fas');

            // Afficher la notification
            const action = isLiked ? 'retiré des' : 'ajouté aux';
            const mediaTitle = button.closest('.serie-card').querySelector('h3').textContent;
            showLikeNotification(`${mediaTitle} a été ${action} favoris`);
        } else {
            console.error('Erreur:', data.message);
            showLikeNotification('Une erreur est survenue');
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        showLikeNotification('Une erreur est survenue');
    });
} 