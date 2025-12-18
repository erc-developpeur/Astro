var upload = document.getElementById("upload");
var preview = document.getElementById("preview");
var avatar = document.getElementById("avatar");
var avatar_name = document.getElementById("name");
var avatar_name_change_box = document.getElementById("change-name-box");

var avatars = {
  srcList: [
    {
      name: "Cosmos",
      src: encodeURIComponent("https://source.unsplash.com/rTZW4f02zY8/150x150")
    },
    {
      name: "Walrus",
      src: encodeURIComponent("https://source.unsplash.com/h13Y8vyIXNU/150x150")
    },
    {
      name: "Flowers",
      src: encodeURIComponent("https://source.unsplash.com/PwWkzeJeJZE/150x150")
    },
    {
      name: "Dog",
      src: encodeURIComponent("https://source.unsplash.com/oCJuJQqvCzc/150x150")
    }
  ],
  activeKey: 1,
  add: function(_name, _src) {
    this.activeKey = this.srcList.length;
    return (
      this.srcList.push({ name: _name, src: encodeURIComponent(_src) }) - 1
    );
  },
  changeName: function(key, _name) {
    if (!Number.isInteger(key)) {
      return false;
    }
    this.srcList[key].name = _name;
    if (avatar_name.dataset.key == key) {
      avatar_name.textContent = _name;
    }
    return _name;
  },
  showNext: function() {
    var _next = this.activeKey + 1;
    if (_next >= this.srcList.length) {
      _next = 0;
    }
    this.showByKey(_next);
  },
  showLast: function() {
    var _next = this.activeKey - 1;
    if (_next < 0) {
      _next = this.srcList.length - 1;
    }
    this.showByKey(_next);
  },
  showByKey: function(_next) {
    var _on = this.srcList[_next];
    if (!_on.name) return;

    while (preview.firstChild) {
      preview.removeChild(preview.firstChild);
    }

    var img = document.createElement("img");
    img.src = decodeURIComponent(_on.src);
    img.className = "avatar_img--loading";
    img.onload = function() {
      img.classList.add("avatar_img");
    };
    avatar_name.textContent = _on.name;
    avatar_name.setAttribute("data-key", _next);
    preview.appendChild(img);
    this.activeKey = _next;
  }
};

function showAvatar(key) {
  if (!key) {
    key = avatars.activeKey;
  }
}

// Vérification de l'existence des éléments avant de les utiliser
if (upload) {
    upload.addEventListener("change", handleFiles, false);
}

function handleFiles() {
    var files = this.files;
    for (var i = 0; i < files.length; i++) {
        var file = files[i];
        var imageType = /^image\//;

        if (!imageType.test(file.type)) {
            if (avatar) {
                avatar.classList.add("avatar--upload-error");
                setTimeout(function() {
                    avatar.classList.remove("avatar--upload-error");
                }, 1200);
            }
            continue;
        }

        if (avatar) {
            avatar.classList.remove("avatar--upload-error");
        }

        // Créer un FormData pour l'upload
        const formData = new FormData();
        formData.append('action', 'updateProfilePhoto');
        formData.append('photo', file);

        // Envoyer la photo au serveur
        fetch('/controle/ajax_handler.php', {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Mettre à jour l'aperçu
                if (preview) {
                    while (preview.firstChild) {
                        preview.removeChild(preview.firstChild);
                    }

                    var img = document.createElement("img");
                    img.file = file;
                    img.src = window.URL.createObjectURL(file);
                    img.onload = function() {
                        window.URL.revokeObjectURL(this.src);
                    };
                    img.className = "avatar_img";
                    preview.appendChild(img);
                }

                // Mettre à jour le nom
                if (avatar_name) {
                    avatar_name.textContent = file.name;
                }

                alert(data.message);
            } else {
                alert(data.message);
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors de l\'upload');
        });
    }
}

/** Inline functions */
window.changeAvatarName = function(event, key, name) {
  if (event.keyCode != 13 && event != "blur") return;
  key = parseInt(key);
  if (!name) return;
  var change = avatars.changeName(key, name);
  document.activeElement.blur();
  // remove selection abilities
  window.getSelection().removeAllRanges();
};

window.changeAvatar = function(dir) {
  if (dir === "next") {
    avatars.showNext();
  } else {
    avatars.showLast();
  }
};
window.handleAriaUpload = function(e, obj) {
  if (e.keyCode == 13) {
    obj.click();
  }
};

// Sidebar navigation
var sidenav = document.getElementById("mySidenav");
var openBtn = document.getElementById("openBtn");
var closeBtn = document.getElementById("closeBtn");

if (openBtn && closeBtn && sidenav) {
    openBtn.onclick = openNav;
    closeBtn.onclick = closeNav;

    function openNav() {
        sidenav.classList.add("active");
    }

    function closeNav() {
        sidenav.classList.remove("active");
    }
}

// Navigation menu
const button = document.getElementById('avatar-navbar');
const closeButton = document.querySelector('.close-button');
const navigationMenu = document.querySelector('.navigation__menu');

if (button && closeButton && navigationMenu) {
    button.addEventListener('click', () => {
        navigationMenu.classList.remove('none');
        navigationMenu.classList.remove('hide');
    });

    closeButton.addEventListener('click', () => {
        navigationMenu.classList.add('hide');
    });
}

// Main items
const mainItems = document.querySelectorAll('.main-item');
if (mainItems.length > 0) {
    mainItems.forEach((mainItem) => {
        mainItem.addEventListener('click', () => {
            mainItem.classList.toggle('main-item--open');
        });
    });
}

// Events handling
const events = document.getElementById("events");
const scrollLeftButton = document.getElementById("action-button--previous");
const scrollRightButton = document.getElementById("action-button--next");

if (events) {
    let isDown = false;
    let startX;
    let startY;
    let scrollLeft;
    let scrollTop;

    events.addEventListener("mousedown", (e) => {
        isDown = true;
        startX = e.pageX - events.offsetLeft;
        startY = e.pageY - events.offsetTop;
        scrollLeft = events.scrollLeft;
        scrollTop = events.scrollTop;
        events.style.cursor = "grabbing";
    });

    events.addEventListener("mouseleave", () => {
        isDown = false;
        events.style.cursor = "grab";
    });

    events.addEventListener("mouseup", () => {
        isDown = false;
        events.style.cursor = "grab";
    });

    events.addEventListener("scroll", (e) => {
        const position = events.scrollLeft;
        if (scrollLeftButton) {
            scrollLeftButton.disabled = position === 0;
        }
        if (scrollRightButton) {
            scrollRightButton.disabled = Math.round(position) === events.scrollWidth - events.clientWidth;
        }
    });

    document.addEventListener("mousemove", (e) => {
        if (!isDown) return;
        e.preventDefault();
        const x = e.pageX - events.offsetLeft;
        const y = e.pageY - events.offsetTop;
        const walkX = (x - startX) * 1;
        const walkY = (y - startY) * 1;
        events.scrollLeft = scrollLeft - walkX;
        events.scrollTop = scrollTop - walkY;
    });
}

if (scrollLeftButton) {
    scrollLeftButton.addEventListener("click", () => {
        if (events) {
            events.scrollBy({
                top: 0,
                left: -200,
                behavior: "smooth",
            });
        }
    });
}

if (scrollRightButton) {
    scrollRightButton.addEventListener("click", () => {
        if (events) {
            events.scrollBy({
                top: 0,
                left: 200,
                behavior: "smooth",
            });
        }
    });
}

function editUsername() {
    const currentUsername = document.getElementById('username')?.textContent;
    const newUsername = prompt('Entrez votre nouveau nom d\'utilisateur:', currentUsername);
    
    if (!newUsername || newUsername === currentUsername) return;
    
    fetch('/controle/ajax_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=updateUsername&newUsername=${encodeURIComponent(newUsername)}`
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            const usernameElement = document.getElementById('username');
            if (usernameElement) {
                usernameElement.textContent = newUsername;
            }
            alert(data.message);
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue lors de la mise à jour');
    });
}

function editPassword() {
    const currentPassword = prompt('Entrez votre mot de passe actuel:');
    if (!currentPassword) return;
    
    const newPassword = prompt('Entrez votre nouveau mot de passe:');
    if (!newPassword) return;
    
    const confirmPassword = prompt('Confirmez votre nouveau mot de passe:');
    if (newPassword !== confirmPassword) {
        alert('Les mots de passe ne correspondent pas');
        return;
    }
    
    fetch('/controle/ajax_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `action=updatePassword&currentPassword=${encodeURIComponent(currentPassword)}&newPassword=${encodeURIComponent(newPassword)}`
    })
    .then(response => response.json())
    .then(data => {
        alert(data.message);
    })
    .catch(error => {
        console.error('Erreur:', error);
        alert('Une erreur est survenue lors de la mise à jour');
    });
}

// Fonction pour initialiser le graphique de visionnage
function initViewingGraph() {
    console.log('Initialisation du graphique...');
    
    // Vérifier si les éléments du graphique existent
    const bars = document.querySelectorAll('.bar');
    if (bars.length === 0) {
        console.error('Aucune barre trouvée dans le graphique');
        return;
    }

    // Récupérer les données réelles depuis le serveur
    fetch('/controle/ajax_handler.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: 'action=getWeeklyViewingStats'
    })
    .then(response => {
        console.log('Réponse reçue:', response.status);
        if (!response.ok) {
            throw new Error(`Erreur HTTP: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Données reçues:', data);
        if (data.success) {
            const viewingData = data.data;
            console.log('Données de visionnage:', viewingData);
            
            // Mettre à jour les barres avec animation
            bars.forEach((bar, index) => {
                if (viewingData[index]) {
                    const hours = viewingData[index].hours;
                    const maxHeight = 10; // Hauteur maximale en heures
                    const heightPercentage = (hours / maxHeight) * 100;
                    
                    console.log(`Barre ${index}: ${hours}h, ${heightPercentage}%`);
                    
                    // Animation de la hauteur
                    setTimeout(() => {
                        bar.style.height = `${heightPercentage}%`;
                        const valueElement = bar.querySelector('.bar-value');
                        if (valueElement) {
                            valueElement.textContent = `${hours}h`;
                        }
                    }, index * 100);
                } else {
                    console.warn(`Pas de données pour l'index ${index}`);
                }
            });
        } else {
            console.error('Erreur dans la réponse:', data.message);
            // Afficher des valeurs par défaut
            bars.forEach((bar, index) => {
                bar.style.height = '0%';
                const valueElement = bar.querySelector('.bar-value');
                if (valueElement) {
                    valueElement.textContent = '0h';
                }
            });
        }
    })
    .catch(error => {
        console.error('Erreur lors de la récupération des données:', error);
        // Afficher des valeurs par défaut en cas d'erreur
        bars.forEach((bar, index) => {
            bar.style.height = '0%';
            const valueElement = bar.querySelector('.bar-value');
            if (valueElement) {
                valueElement.textContent = '0h';
            }
        });
    });
}

// Attendre que le DOM soit chargé
document.addEventListener('DOMContentLoaded', function() {
    console.log('DOM chargé, userId:', window.userId);
    
    const photoUploadInput = document.getElementById('photo-upload');
    if (photoUploadInput) {
        photoUploadInput.addEventListener('change', function(e) {
            console.log('Fichier sélectionné:', e.target.files[0]);
            const file = e.target.files[0];
            if (!file) return;

            // Vérifier le type de fichier
            if (!file.type.startsWith('image/')) {
                alert('Veuillez sélectionner une image');
                return;
            }

            console.log('Type de fichier:', file.type);
            console.log('Taille du fichier:', file.size, 'octets');

            // Créer un FormData
            const formData = new FormData();
            formData.append('action', 'updateProfilePhoto');
            formData.append('photo', file);

            // Envoyer la photo au serveur
            fetch('/controle/ajax_handler.php', {
                method: 'POST',
                body: formData
            })
            .then(response => {
                console.log('Statut de la réponse:', response.status);
                return response.json();
            })
            .then(data => {
                console.log('Réponse du serveur:', data);
                if (data.success) {
                    // Mettre à jour l'aperçu de la photo
                    const profilePhoto = document.querySelector('.photo-container img');
                    if (profilePhoto) {
                        // Vérifier que nous avons un ID utilisateur valide
                        const userId = window.userId;
                        if (!userId) {
                            console.error('ID utilisateur non défini');
                            alert('Erreur: ID utilisateur non défini');
                            return;
                        }
                        console.log('Mise à jour de l\'image avec userId:', userId);
                        
                        // Construire l'URL de l'image
                        const timestamp = new Date().getTime();
                        const imageUrl = `/controle/get_profile_photo.php?user_id=${userId}&t=${timestamp}`;
                        console.log('URL de l\'image:', imageUrl);
                        
                        // Créer une nouvelle image pour vérifier le chargement
                        const newImage = new Image();
                        newImage.onload = function() {
                            console.log('Nouvelle image chargée avec succès');
                            profilePhoto.src = this.src;
                        };
                        newImage.onerror = function(e) {
                            console.error('Erreur lors du chargement de l\'image:', e);
                            // Essayer de charger la réponse pour voir s'il y a un message d'erreur
                            fetch(imageUrl)
                                .then(response => response.json())
                                .then(data => {
                                    console.error('Message d\'erreur du serveur:', data);
                                    alert('Erreur lors du chargement de l\'image: ' + (data.message || 'Erreur inconnue'));
                                })
                                .catch(error => {
                                    console.error('Erreur lors de la récupération du message d\'erreur:', error);
                                    alert('Erreur lors du chargement de l\'image');
                                });
                        };
                        newImage.src = imageUrl;
                    } else {
                        console.error('Élément photo-container img non trouvé');
                    }
                    alert(data.message);
                } else {
                    console.error('Erreur:', data.message);
                    alert(data.message);
                }
            })
            .catch(error => {
                console.error('Erreur:', error);
                alert('Une erreur est survenue lors de l\'upload de la photo');
            });
        });
    } else {
        console.error('Élément photo-upload non trouvé');
    }

    // Initialiser le graphique
    initViewingGraph();
});






