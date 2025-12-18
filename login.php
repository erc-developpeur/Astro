<?php
session_start();

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['user_id'])) {
    // Rediriger vers la page d'accueil si aucune page de redirection n'est définie
    $redirect = isset($_SESSION['redirect_after_login']) ? $_SESSION['redirect_after_login'] : 'index.php';
    unset($_SESSION['redirect_after_login']); // Nettoyer la variable de session
    header("Location: " . $redirect);
    exit();
}

$config = require_once 'config/app.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - <?php echo $config['app_name']; ?></title>
    <link rel="stylesheet" href="www/css/style.css">
    <link rel="stylesheet" href="www/css/css-login.css">
    <link
      rel="shortcut icon"
      type="image/png"
      href="www/img/logo-mini.png"
    />
    <style>
        @media screen and (max-width: 768px) {
            body.auth-page {
                min-height: 100vh;
                overflow-y: auto;
                position: relative;
            }
            .auth-container {
                margin-top: 22rem;
        min-height: 100vh;
        height: auto;
        padding: 20px;
        overflow-y: auto;
        position: relative;
            }
            .auth-form {
                max-height: none;
                overflow-y: visible;
                padding-bottom: 40px;
            }
            .auth-footer {
                position: relative;
                bottom: 0;
                width: 100%;
                padding: 20px 0;
            }
        }
    </style>
</head>
<body class="auth-page">
    <div class="auth-container">
        <div class="auth-header">
            <img style="width: 60px;" src="www/img/logo-mini.png">
            <h2>Connexion</h2>
        </div>
        <div class="auth-form">
            <?php
            // Traitement du formulaire de connexion
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Configuration de la base de données
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "streamflix";
                
                // Connexion à la base de données
                $conn = new mysqli($servername, $username, $password, $dbname);
                
                // Vérifier la connexion
                if ($conn->connect_error) {
                    die("Connexion échouée: " . $conn->connect_error);
                }
                
                // Récupération des données du formulaire
                $email = $_POST['email'];
                $password = $_POST['password'];
                
                // Requête pour vérifier les identifiants
                $sql = "SELECT id, email, password, username FROM users WHERE email = ?";
                $stmt = $conn->prepare($sql);
                $stmt->bind_param("s", $email);
                $stmt->execute();
                $result = $stmt->get_result();
                
                if ($result->num_rows == 1) {
                    $row = $result->fetch_assoc();
                    
                    // Vérifier le mot de passe
                    if (password_verify($password, $row['password'])) {
                        // Authentification réussie, créer la session
                        $_SESSION['user_id'] = $row['id'];
                        $_SESSION['username'] = $row['username'];
                        $_SESSION['email'] = $row['email'];
                        
                        // Redirection vers la page précédente ou l'accueil
                        $redirect = isset($_SESSION['redirect_after_login']) ? $_SESSION['redirect_after_login'] : 'index.php';
                        unset($_SESSION['redirect_after_login']); // Nettoyer la variable de session
                        header("Location: " . $redirect);
                        exit();
                    } else {
                        $error_message = "Mot de passe incorrect";
                    }
                } else {
                    $error_message = "Email non trouvé";
                }
                
                $stmt->close();
                $conn->close();
            }
            ?>
            
            <?php if (isset($error_message)): ?>
                <div class="error-message">
                    <?php echo $error_message; ?>
                </div>
            <?php endif; ?>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="email">Email</label>
                    <div class="input-with-icon">
                        <i class="fas fa-envelope"></i>
                        <input type="email" id="email" name="email" required>
                    </div>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <div class="input-with-icon">
                        <i class="fas fa-lock"></i>
                        <input type="password" id="password" name="password" required>
                    </div>
                </div>
                <div class="form-group remember-me" style="margin: 1rem;">
                    <label class="container">
                        <input checked="checked" type="checkbox" id="remember" name="remember">
                        <div class="checkmark"></div>
                    </label>
                    <label for="remember">Se souvenir de moi</label>
                </div>
                <div class="form-group">
                    <button type="submit" class="auth-button">Connexion</button>
                </div>
                <div class="auth-links">
                    <a href="forgot_password.php">Mot de passe oublié?</a>
                    <a href="register.php">Créer un compte</a>
                </div>
            </form>
            <div class="auth-separator" style="margin: 1rem;">
                <span>ou</span>
            </div>
            <div class="form-group">
                <button type="button" class="invite-button" onclick="loginAsVisitor()">Continuer en tant que visiteur</button>
            </div>
            <div class="auth-separator" style="margin: 1rem;">
                <span>ou</span>
            </div>
            <div class="sso-login">
                <button type="button" id="sso-btn">
                    <i class="fas fa-key"></i>
                    <span>Authentification unique (SSO)</span>
                </button>
            </div>
        </div>
        <div class="auth-footer" style="margin: 1rem;">
            <a href="index.html">Retour à l'accueil</a>
        </div>
    </div>

    <!-- Popup de connexion rapide -->
    <div id="sso-popup" class="sso-popup">
        <div class="sso-popup-content">
            <span class="close-sso-popup">&times;</span>
            <h3>Connexion rapide</h3>
            <div class="sso-options">
                <button class="sso-option google">
                    <img src="https://img.icons8.com/?size=100&id=17949&format=png&color=000000" alt="Google">
                    <span>Continuer avec Google</span>
                </button>
                <button class="sso-option facebook">
                    <img src="https://img.icons8.com/?size=100&id=uLWV5A9vXIPu&format=png&color=000000" alt="Facebook">
                    <span>Continuer avec Facebook</span>
                </button>
                <button class="sso-option apple">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0,0,256,256">
                <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M44.52734,34.75c-1.07812,2.39453 -1.59766,3.46484 -2.98437,5.57813c-1.94141,2.95313 -4.67969,6.64063 -8.0625,6.66406c-3.01172,0.02734 -3.78906,-1.96484 -7.87891,-1.92969c-4.08594,0.01953 -4.9375,1.96875 -7.95312,1.9375c-3.38672,-0.03125 -5.97656,-3.35156 -7.91797,-6.30078c-5.42969,-8.26953 -6.00391,-17.96484 -2.64844,-23.12109c2.375,-3.65625 6.12891,-5.80469 9.65625,-5.80469c3.59375,0 5.85156,1.97266 8.82031,1.97266c2.88281,0 4.63672,-1.97656 8.79297,-1.97656c3.14063,0 6.46094,1.71094 8.83594,4.66406c-7.76562,4.25781 -6.50391,15.34766 1.33984,18.31641zM31.19531,8.46875c1.51172,-1.94141 2.66016,-4.67969 2.24219,-7.46875c-2.46484,0.16797 -5.34766,1.74219 -7.03125,3.78125c-1.52734,1.85938 -2.79297,4.61719 -2.30078,7.28516c2.69141,0.08594 5.47656,-1.51953 7.08984,-3.59766z"></path></g></g>
                </svg>
                    <span style="margin-left: 10px;">Continuer avec Apple</span>
                </button>
                <button class="sso-option twitter">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0,0,256,256">
                <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(5.12,5.12)"><path d="M5.91992,6l14.66211,21.375l-14.35156,16.625h3.17969l12.57617,-14.57812l10,14.57813h12.01367l-15.31836,-22.33008l13.51758,-15.66992h-3.16992l-11.75391,13.61719l-9.3418,-13.61719zM9.7168,8h7.16406l23.32227,34h-7.16406z"></path></g></g>
                </svg>
                    <span style="margin-left: 10px;">Continuer avec Twitter</span>
                </button>
                <button class="sso-option github">
                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="25" height="25" viewBox="0,0,256,256">
                <g fill="#ffffff" fill-rule="nonzero" stroke="none" stroke-width="1" stroke-linecap="butt" stroke-linejoin="miter" stroke-miterlimit="10" stroke-dasharray="" stroke-dashoffset="0" font-family="none" font-weight="none" font-size="none" text-anchor="none" style="mix-blend-mode: normal"><g transform="scale(4,4)"><path d="M32,6c-14.359,0 -26,11.641 -26,26c0,12.277 8.512,22.56 19.955,25.286c-0.592,-0.141 -1.179,-0.299 -1.755,-0.479v-5.957c0,0 -0.975,0.325 -2.275,0.325c-3.637,0 -5.148,-3.245 -5.525,-4.875c-0.229,-0.993 -0.827,-1.934 -1.469,-2.509c-0.767,-0.684 -1.126,-0.686 -1.131,-0.92c-0.01,-0.491 0.658,-0.471 0.975,-0.471c1.625,0 2.857,1.729 3.429,2.623c1.417,2.207 2.938,2.577 3.721,2.577c0.975,0 1.817,-0.146 2.397,-0.426c0.268,-1.888 1.108,-3.57 2.478,-4.774c-6.097,-1.219 -10.4,-4.716 -10.4,-10.4c0,-2.928 1.175,-5.619 3.133,-7.792c-0.2,-0.567 -0.533,-1.714 -0.533,-3.583c0,-1.235 0.086,-2.751 0.65,-4.225c0,0 3.708,0.026 7.205,3.338c1.614,-0.47 3.341,-0.738 5.145,-0.738c1.804,0 3.531,0.268 5.145,0.738c3.497,-3.312 7.205,-3.338 7.205,-3.338c0.567,1.474 0.65,2.99 0.65,4.225c0,2.015 -0.268,3.19 -0.432,3.697c1.898,2.153 3.032,4.802 3.032,7.678c0,5.684 -4.303,9.181 -10.4,10.4c1.628,1.43 2.6,3.513 2.6,5.85v8.557c-0.576,0.181 -1.162,0.338 -1.755,0.479c11.443,-2.726 19.955,-13.009 19.955,-25.286c0,-14.359 -11.641,-26 -26,-26zM33.813,57.93c-0.599,0.042 -1.203,0.07 -1.813,0.07c0.61,0 1.213,-0.029 1.813,-0.07zM37.786,57.346c-1.164,0.265 -2.357,0.451 -3.575,0.554c1.218,-0.103 2.411,-0.29 3.575,-0.554zM32,58c-0.61,0 -1.214,-0.028 -1.813,-0.07c0.6,0.041 1.203,0.07 1.813,0.07zM29.788,57.9c-1.217,-0.103 -2.411,-0.289 -3.574,-0.554c1.164,0.264 2.357,0.451 3.574,0.554z"></path></g></g>
                </svg>
                    <span style="margin-left: 10px;">Continuer avec GitHub</span>
                </button>
            </div>
        </div>
    </div>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        const ssoBtn = document.getElementById('sso-btn');
        const ssoPopup = document.getElementById('sso-popup');
        const closeSsoPopup = document.querySelector('.close-sso-popup');

        ssoBtn.addEventListener('click', function() {
            ssoPopup.style.display = 'block';
            document.body.style.overflow = 'hidden';
        });

        closeSsoPopup.addEventListener('click', function() {
            ssoPopup.style.display = 'none';
            document.body.style.overflow = 'auto';
        });

        window.addEventListener('click', function(event) {
            if (event.target === ssoPopup) {
                ssoPopup.style.display = 'none';
                document.body.style.overflow = 'auto';
            }
        });

        // Animation des boutons de connexion rapide
        document.querySelectorAll('.sso-option').forEach(button => {
            button.addEventListener('click', function() {
                this.style.transform = 'scale(0.95)';
                setTimeout(() => {
                    this.style.transform = 'translateY(-2px)';
                }, 200);
                alert('Connexion avec ' + this.querySelector('span').textContent);
            });
        });
    });

    function loginAsVisitor() {
        fetch('visitor_login.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            }
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                // Rediriger vers la page d'accueil
                window.location.href = 'index.php';
            } else {
                alert('Une erreur est survenue lors de la connexion en tant que visiteur');
            }
        })
        .catch(error => {
            console.error('Erreur:', error);
            alert('Une erreur est survenue lors de la connexion en tant que visiteur');
        });
    }
    </script>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html> 