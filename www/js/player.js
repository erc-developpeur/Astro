document.addEventListener('DOMContentLoaded', function() {
    const video = document.getElementById('videoPlayer');
    const playPauseBtn = document.getElementById('playPauseBtn');
    const muteBtn = document.getElementById('muteBtn');
    const volumeSlider = document.getElementById('volumeSlider');
    const progressBar = document.getElementById('progressBar');

    // Gestion du bouton Lecture/Pause
    playPauseBtn.addEventListener('click', function() {
        if (video.paused) {
            video.play();
            playPauseBtn.textContent = 'Pause';
        } else {
            video.pause();
            playPauseBtn.textContent = 'Lecture';
        }
    });

    // Gestion du bouton Mute
    muteBtn.addEventListener('click', function() {
        if (video.muted) {
            video.muted = false;
            muteBtn.textContent = 'Son';
            volumeSlider.value = video.volume;
        } else {
            video.muted = true;
            muteBtn.textContent = 'Muet';
            volumeSlider.value = 0;
        }
    });

    // Gestion du volume
    volumeSlider.addEventListener('input', function() {
        video.volume = volumeSlider.value;
        if (video.volume === 0) {
            video.muted = true;
            muteBtn.textContent = 'Muet';
        } else {
            video.muted = false;
            muteBtn.textContent = 'Son';
        }
    });

    // Mise à jour de la barre de progression
    video.addEventListener('timeupdate', function() {
        const progress = (video.currentTime / video.duration) * 100;
        progressBar.value = progress;
    });

    // Navigation dans la vidéo
    progressBar.addEventListener('input', function() {
        const time = (progressBar.value / 100) * video.duration;
        video.currentTime = time;
    });

    // Gestion des raccourcis clavier
    document.addEventListener('keydown', function(e) {
        switch(e.key) {
            case ' ':
            case 'k':
                e.preventDefault();
                if (video.paused) {
                    video.play();
                    playPauseBtn.textContent = 'Pause';
                } else {
                    video.pause();
                    playPauseBtn.textContent = 'Lecture';
                }
                break;
            case 'm':
                e.preventDefault();
                video.muted = !video.muted;
                muteBtn.textContent = video.muted ? 'Muet' : 'Son';
                break;
            case 'ArrowLeft':
                e.preventDefault();
                video.currentTime = Math.max(0, video.currentTime - 5);
                break;
            case 'ArrowRight':
                e.preventDefault();
                video.currentTime = Math.min(video.duration, video.currentTime + 5);
                break;
        }
    });
}); 

let currentSeason = 1;
    let currentEpisode = 1;

    // Fonction pour basculer l'affichage d'un menu déroulant
    function toggleDropdown(dropdownId) {
        const dropdown = document.getElementById(dropdownId);
        const content = dropdown.querySelector('.dropdown-content');
        content.classList.toggle('show');
    }

    function selectSeason(seasonNumber) {
        currentSeason = seasonNumber;
        document.getElementById('currentSeason').textContent = seasonNumber;
        // Fermer tous les menus déroulants
        closeAllDropdowns();
        // Mettre à jour la vidéo si nécessaire
        updateVideo();
    }

    function selectEpisode(episodeNumber) {
        currentEpisode = episodeNumber;
        document.getElementById('currentEpisode').textContent = episodeNumber;
        // Fermer tous les menus déroulants
        closeAllDropdowns();
        // Mettre à jour la vidéo si nécessaire
        updateVideo();
    }

    function closeAllDropdowns() {
        const dropdowns = document.querySelectorAll('.dropdown-content');
        dropdowns.forEach(dropdown => {
            dropdown.classList.remove('show');
        });
    }

    function updateVideo() {
        // Implémenter la logique pour charger la vidéo correspondante
        console.log('Chargement de la vidéo - Saison:', currentSeason, 'Épisode:', currentEpisode);
    }

    // Fermer les menus déroulants quand on clique ailleurs
    document.addEventListener('click', function(event) {
        if (!event.target.closest('.dropdown')) {
            closeAllDropdowns();
        }
    });

    function openListPopup(mediaId, type) {
        const popup = document.getElementById('listPopup');
        if (popup) {
            popup.classList.add('active');
            loadUserLists(mediaId);
        }
    }

    function closeListPopup() {
        const popup = document.getElementById('listPopup');
        if (popup) {
            popup.classList.remove('active');
        }
    }

    function createNewList() {
        const listName = document.getElementById('newListName').value;
        if (listName.trim() === '') {
            alert('Veuillez entrer un nom pour la liste');
            return;
        }
        
        // Créer un nouvel élément de liste
        const listsContainer = document.querySelector('.user-lists');
        const newListId = Date.now(); // ID temporaire
        const listItem = document.createElement('div');
        listItem.className = 'user-list-item';
        listItem.innerHTML = `
            <input type="checkbox" id="list_${newListId}">
            <div class="list-name-container">
                <span class="list-name">${listName}</span>
                <input type="text" class="list-name-edit" value="${listName}" style="display: none;">
            </div>
            <div class="list-actions">
                <button class="edit-list-btn" onclick="editListName(${newListId})">
                    <i class="fas fa-edit"></i>
                </button>
                <button class="save-list-btn" onclick="saveListName(${newListId})" style="display: none;">
                    <i class="fas fa-save"></i>
                </button>
                <button class="delete-list-btn" onclick="confirmDeleteList(${newListId})">
                    <i class="fas fa-trash"></i>
                </button>
            </div>
        `;
        
        // Ajouter la nouvelle liste en dessous
        listsContainer.appendChild(listItem);
        
        // Vider le champ de saisie
        document.getElementById('newListName').value = '';
    }

    function loadUserLists(mediaId) {
        const listsContainer = document.querySelector('.user-lists');
        // Ici, vous devrez ajouter le code pour charger les listes via AJAX
        // Exemple:
        /*
        fetch('get_user_lists.php')
            .then(response => response.json())
            .then(data => {
                listsContainer.innerHTML = '';
                data.lists.forEach(list => {
                    const listItem = document.createElement('div');
                    listItem.className = 'user-list-item';
                    listItem.innerHTML = `
                        <input type="checkbox" id="list_${list.id}" 
                               onchange="toggleMediaInList(${list.id}, ${mediaId})"
                               ${list.hasMedia ? 'checked' : ''}>
                        <div class="list-name-container">
                            <span class="list-name">${list.name}</span>
                            <input type="text" class="list-name-edit" value="${list.name}" style="display: none;">
                        </div>
                        <div class="list-actions">
                            <button class="edit-list-btn" onclick="editListName(${list.id})">
                                <i class="fas fa-edit"></i>
                            </button>
                            <button class="save-list-btn" onclick="saveListName(${list.id})" style="display: none;">
                                <i class="fas fa-save"></i>
                            </button>
                            <button class="delete-list-btn" onclick="confirmDeleteList(${list.id})">
                                <i class="fas fa-trash"></i>
                            </button>
                        </div>
                    `;
                    listsContainer.appendChild(listItem);
                });
            });
        */
    }

    function editListName(listId) {
        const listItem = document.querySelector(`#list_${listId}`).closest('.user-list-item');
        const nameSpan = listItem.querySelector('.list-name');
        const nameInput = listItem.querySelector('.list-name-edit');
        const editBtn = listItem.querySelector('.edit-list-btn');
        const saveBtn = listItem.querySelector('.save-list-btn');

        nameSpan.style.display = 'none';
        nameInput.style.display = 'block';
        editBtn.style.display = 'none';
        saveBtn.style.display = 'block';
        nameInput.focus();
        nameInput.select();

        // Ajouter l'écouteur d'événement pour la touche Entrée
        nameInput.onkeydown = function(event) {
            if (event.key === 'Enter') {
                event.preventDefault(); // Empêcher le comportement par défaut
                saveListName(listId);
            }
        };
    }

    function saveListName(listId) {
        const listItem = document.querySelector(`#list_${listId}`).closest('.user-list-item');
        const nameSpan = listItem.querySelector('.list-name');
        const nameInput = listItem.querySelector('.list-name-edit');
        const editBtn = listItem.querySelector('.edit-list-btn');
        const saveBtn = listItem.querySelector('.save-list-btn');
        const newName = nameInput.value.trim();

        if (newName === '') {
            alert('Le nom de la liste ne peut pas être vide');
            return;
        }

        // Mettre à jour le nom visuellement immédiatement
        nameSpan.textContent = newName;
        nameSpan.style.display = 'block';
        nameInput.style.display = 'none';
        editBtn.style.display = 'block';
        saveBtn.style.display = 'none';

        // Supprimer l'écouteur d'événement
        nameInput.onkeydown = null;

        // Envoyer la requête de mise à jour au serveur
        fetch('update_list.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                listId: listId,
                newName: newName
            })
        });
    }

    function confirmDeleteList(listId) {
        if (confirm('Êtes-vous sûr de vouloir supprimer cette liste ?')) {
            // Supprimer visuellement immédiatement
            const listItem = document.querySelector(`#list_${listId}`).closest('.user-list-item');
            listItem.style.opacity = '0';
            listItem.style.transform = 'translateX(-100%)';
            listItem.style.transition = 'all 0.3s ease';
            
            setTimeout(() => {
                listItem.remove();
            }, 300);

            // Envoyer la requête de suppression au serveur
            fetch('delete_list.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({
                    listId: listId
                })
            });
        }
    }

    // Fermer le popup quand on clique en dehors
    window.onclick = function(event) {
        const popup = document.getElementById('listPopup');
        if (event.target === popup) {
            closeListPopup();
        }
    }

    function toggleLike(mediaId) {
        const likeBtn = document.querySelector(`.like-btn[onclick="toggleLike(${mediaId})"]`);
        const heartIcon = document.getElementById(`heartIcon_${mediaId}`);
        
        // Toggle la classe active
        likeBtn.classList.toggle('active');
        
        // Changer l'icône
        if (likeBtn.classList.contains('active')) {
            heartIcon.classList.remove('far');
            heartIcon.classList.add('fas');
        } else {
            heartIcon.classList.remove('fas');
            heartIcon.classList.add('far');
        }

        // Envoyer la requête au serveur
        fetch('toggle_favorite.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
            },
            body: JSON.stringify({
                mediaId: mediaId,
                isFavorite: likeBtn.classList.contains('active')
            })
        });
    }