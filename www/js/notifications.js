class NotificationManager {
    constructor() {
        this.notificationContainer = document.createElement('div');
        this.notificationContainer.className = 'notification-container';
        document.body.appendChild(this.notificationContainer);
    }

    showNotification(message, duration = 3000) {
        const notification = document.createElement('div');
        notification.className = 'notification';
        
        const content = document.createElement('div');
        content.className = 'notification-content';
        
        const messageElement = document.createElement('p');
        messageElement.textContent = message;
        
        const progressBar = document.createElement('div');
        progressBar.className = 'progress-bar';
        
        content.appendChild(messageElement);
        content.appendChild(progressBar);
        notification.appendChild(content);
        
        this.notificationContainer.appendChild(notification);
        
        // Animation de la barre de progression
        setTimeout(() => {
            progressBar.style.width = '100%';
            progressBar.style.transition = `width ${duration}ms linear`;
        }, 10);
        
        // Suppression de la notification après la durée spécifiée
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.3s ease-out';
            setTimeout(() => {
                notification.remove();
            }, 300);
        }, duration);
    }
}

// Création d'une instance globale du gestionnaire de notifications
const notificationManager = new NotificationManager(); 