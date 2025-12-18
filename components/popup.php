<?php
// Vérifier si l'utilisateur est connecté

$isLoggedIn = isset($_SESSION['user_id']);
?>

    <link rel="stylesheet" href="www/css/popup.css">
    <link rel="stylesheet" href="www/css/add-to-list.css">

<div class="list-popup" id="listPopup">
    <div class="list-popup-content">
        <div class="list-popup-header">
            <h3>Ajouter à une liste</h3>
            <button style="padding: 1.2rem; font-size: 2rem; color: white; cursor: pointer; transition: transform 0.3s ease;" class="close-popup-liste" onclick="closeListPopup()">&times;</button>
        </div>
        
        <?php if ($isLoggedIn): ?>
            <div class="create-list-section">
                <input type="text" id="newListName" placeholder="Nom de la nouvelle liste">
                <button class="create-list-btn" onclick="createNewList()">
                    <div class="sign">+</div>
                    <div class="text">Create</div>
                </button>
            </div>
            <div class="user-lists" id="userLists">
                <!-- Les listes de l'utilisateur seront chargées ici dynamiquement -->
            </div>
        <?php else: ?>
            <div class="login-require-maliste">
                <p>Veuillez vous connecter pour gérer vos listes.</p>
                <a href="login.php" class="login-btn">Se connecter</a>
            </div>
        <?php endif; ?>
    </div>
</div>

<!-- Popup pour les films -->
<div id="movie-popup" class="popup">
    <div class="popup-content">
        <span class="close-popup">
            <button class="button85" onclick="closeMoviePopup()">
                <span class="text">Fermer</span>
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
                    </svg>
                </span>
            </button>
        </span>
        <div id="movie-details-content">
            <!-- Contenu dynamique chargé par JavaScript -->
        </div>
    </div>
</div>

<!-- Popup pour les séries -->
<div id="serie-popup" class="popup">
    <div class="popup-content">
        <span class="close-popup">
            <button class="button85" onclick="closeSeriePopup()">
                <span class="text">Fermer</span>
                <span class="icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M24 20.188l-8.315-8.209 8.2-8.282-3.697-3.697-8.212 8.318-8.31-8.203-3.666 3.666 8.321 8.24-8.206 8.313 3.666 3.666 8.237-8.318 8.285 8.203z"></path>
                    </svg>
                </span>
            </button>
        </span>
        <div id="serie-details-content">
            <!-- Contenu dynamique chargé par JavaScript -->
        </div>
    </div>
</div>

<!-- Overlay pour le fond flouté -->
<div class="menu-overlay"></div>

<script src="www/js/add-to-list.js"></script>

<style>
    :root{
    --one-coloc: #0D0D0D;
    --two-coloc:#262626;
    --tree-coloc:#595959;
    --bar-coloc:#d4d4d4;
    --four-coloc:#8C8C8C;
    --five-color:#F2F2F2;
    --box-shadows:#f2f2f24d;
    --border-raduis: 15px;
  
  
  
  
    --popup-fond:#000000;
    --popup-shadow:#0000004d;
  }
/* Correction de l'en-tête du popup */
.login-require-maliste {
    width: 100%;
    background: none;
    border-radius: 0;
    margin: 0;
    padding: 40px 0 30px 0;
    box-shadow: none;
    display: flex
;
    flex-direction: column;
    position: relative;
    align-items: center;
    justify-content: center;
    transform: translateY(0px);
}
.list-popup-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
    padding: 0 20px 10px 20px;
}

.list-popup-header h3 {
    margin: 0;
    color: var(--five-coloc);
    font-size: 1.5em;
    font-weight: 700;
    letter-spacing: 0.01em;
}

.close-popup-liste {
    margin-left: 10px;
    margin-right: -10px;
    background: #222;
    color: #fff;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    cursor: pointer;
    font-size: 2rem;
    display: flex;
    align-items: center;
    justify-content: center;
    transition: background 0.2s;
}
.close-popup-liste:hover {
    background: #e50914;
    color: #fff;
}

.create-list-section {
    display: flex;
    gap: 10px;
    margin-bottom: 20px;
    padding: 0 20px;
}

#newListName {
    flex: 1;
    padding: 10px;
    border: 1px solid #333;
    border-radius: 5px;
    background: #2a2a2a;
    color: white;
}

.create-list-btn {
    display: flex;
    align-items: center;
    justify-content: flex-start;
    width: 45px;
    height: 55px;
    border: none;
    border-radius: 5px;
    cursor: pointer;
    position: relative;
    overflow: hidden;
    transition-duration: .3s;
    box-shadow: 2px 2px 10px rgba(0, 0, 0, 0.199);
    background-color: black;
}

.sign {
    width: 100%;
    font-size: 2em;
    margin-bottom: 5px;
    color: white;
    transition-duration: .3s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.text {
    position: absolute;
    right: 0%;
    width: 0%;
    opacity: 0;
    color: white;
    font-size: 1.2em;
    font-weight: 500;
    transition-duration: .3s;
}
.create-list-btn:hover {
    width: 125px;
    border-radius: 0px;
    transition-duration: .3s;
}
.create-list-btn:hover .sign {
    width: 30%;
    transition-duration: .3s;
    transform: translate(-10px, 0px);
}
.create-list-btn:hover .text {
    opacity: 1;
    width: 70%;
    transition-duration: .3s;
    padding-right: 20px;
}
.create-list-btn:active {
    transform: translate(2px ,2px);
}

.user-lists {
    display: flex;
    flex-direction: column;
    gap: 10px;
    padding: 0 20px 20px 20px;
}

.list-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 10px;
    background: #2a2a2a;
    border-radius: 5px;
}

.list-info {
    display: flex;
    align-items: flex-start;
    gap: 4px;
    flex: 1;
    min-width: 0;
}

.list-info h4 {
    margin: 0;
    color: #fff;
    font-size: 1.15em;
    font-weight: 700;
    letter-spacing: 0.01em;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    max-width: 180px;
    transition: color 0.2s;
}
.list-info h4:hover {
    color: #e50914;
}
.list-info .edit-list-input {
    width: 170px;
    font-size: 1.08em;
    padding: 7px 12px;
    border-radius: 6px;
    border: 1.5px solid #e50914;
    background: #181818;
    color: #fff;
    outline: none;
    transition: border 0.2s, box-shadow 0.2s;
    box-shadow: 0 2px 8px rgba(229,9,20,0.07);
}
.list-info .edit-list-input:focus {
    border: 1.5px solid #ffc107;
    box-shadow: 0 0 0 2px #ffc10733;
}
.list-count {
    background: #232323;
    color: #bdbdbd;
    font-size: 0.93em;
    border-radius: 12px;
    padding: 2px 10px;
    margin-top: 2px;
    font-weight: 500;
    letter-spacing: 0.01em;
    box-shadow: 0 1px 4px rgba(0,0,0,0.08);
    user-select: none;
}

.list-actions {
    display: flex;
    gap: 8px;
    align-items: center;
}

.add-to-list-btn,
.close-popup-liste {
    background: #333;
    color: white;
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    box-shadow: 0 2px 8px rgba(0,0,0,0.12);
}
.add-to-list-btn:hover {
    background: #444;
}
.add-to-list-btn.added {
    background: #e50914;
    color: #fff;
}
.delete-list-btn {
    background: transparent;
    border: none;
    color: #e50914;
    font-size: 22px;
    cursor: pointer;
    border-radius: 50%;
    padding: 6px;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.delete-list-btn:hover {
    background: #3a1a1a;
}
.material-symbols-outlined {
    font-family: 'Material Symbols Outlined', sans-serif;
    font-variation-settings: 'FILL' 1, 'wght' 400, 'GRAD' 0, 'opsz' 24;
    font-size: 22px;
    line-height: 1;
}
.edit-list-btn {
    background: transparent;
    border: none;
    color: #ffc107;
    font-size: 22px;
    cursor: pointer;
    border-radius: 50%;
    padding: 6px;
    transition: background 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
}
.edit-list-btn:hover {
    background: #3a2a00;
}
.edit-list-input {
    padding: 6px 10px;
    border-radius: 5px;
    border: 1.5px solid #888;
    background: #222;
    color: #fff;
    margin-right: 8px;
    font-size: 1em;
    width: 120px;
}
.validate-edit-btn, .cancel-edit-btn {
    margin-top: 5px;
    background: #333;
    color:rgb(31, 189, 0);
    border: none;
    width: 36px;
    height: 36px;
    border-radius: 50%;
    cursor: pointer;
    transition: all 0.3s;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 22px;
    box-shadow: 0 2px 8px rgba(0, 0, 0, 0.12);
}
.cancel-edit-btn {
    color: #e50914;
}
.validate-edit-btn:hover {
    background: #1b3a1b;
}
.cancel-edit-btn:hover {
    background: #3a1a1a;
}

.login-required p {
    color: #fff;
    font-size: 1.15em;
    margin-bottom: 18px;
    text-align: center;
}
.login-required .login-btn,
.login-require-maliste .login-btn {
    background: none;
    color: #fff;
    border: 1.5px solid var(--four-coloc);
    border-radius: 8px;
    padding: 12px 28px;
    font-size: 1.1em;
    cursor: pointer;
    transition: background 0.2s, color 0.2s, border 0.2s;
    margin-top: 8px;
}
.login-required .login-btn:hover {
    background: var(--four-coloc);
    color: #232323;
    border: 1.5px solid var(--four-coloc);
}
</style>

<button class="add-list-btn" 
        data-media-id="ID_DU_MEDIA" 
        data-media-type="movie|serie" 
        onclick="openListPopup('ID_DU_MEDIA', 'movie|serie')">
    <i class="fas fa-plus"></i>
</button>
</body>
</html> 