<?php
$config = require_once 'config/app.php';
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription - <?php echo $config['app_name']; ?></title>
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
            <h2>Créer un compte</h2>
        </div>
        <div class="auth-form">
            <?php
            session_start();
            
            // Vérifier si l'utilisateur est déjà connecté
            if (isset($_SESSION['user_id'])) {
                header("Location: index.php");
                exit();
            }
            
            // Initialiser les variables
            $username = $email = "";
            $errors = [];
            
            // Traitement du formulaire d'inscription
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                // Configuration de la base de données
                $servername = "localhost";
                $db_username = "root";
                $db_password = "";
                $dbname = "streamflix";
                
                // Connexion à la base de données
                $conn = new mysqli($servername, $db_username, $db_password, $dbname);
                
                // Vérifier la connexion
                if ($conn->connect_error) {
                    die("Connexion échouée: " . $conn->connect_error);
                }
                
                // Récupération et validation des données du formulaire
                $username = trim($_POST['username']);
                $email = trim($_POST['email']);
                $password = $_POST['password'];
                $confirm_password = $_POST['confirm_password'];
                
                // Validation du nom d'utilisateur
                if (empty($username)) {
                    $errors[] = "Le nom d'utilisateur est requis";
                } elseif (strlen($username) < 3 || strlen($username) > 50) {
                    $errors[] = "Le nom d'utilisateur doit contenir entre 3 et 50 caractères";
                }
                
                // Validation de l'email
                if (empty($email)) {
                    $errors[] = "L'email est requis";
                } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $errors[] = "Format d'email invalide";
                } else {
                    // Vérifier si l'email existe déjà
                    $sql = "SELECT id FROM users WHERE email = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("s", $email);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    
                    if ($result->num_rows > 0) {
                        $errors[] = "Cet email est déjà utilisé";
                    }
                    
                    $stmt->close();
                }
                
                // Validation du mot de passe
                if (empty($password)) {
                    $errors[] = "Le mot de passe est requis";
                } elseif (strlen($password) < 8) {
                    $errors[] = "Le mot de passe doit contenir au moins 8 caractères";
                }
                
                // Vérification de la correspondance des mots de passe
                if ($password !== $confirm_password) {
                    $errors[] = "Les mots de passe ne correspondent pas";
                }
                
                // Si aucune erreur, enregistrer l'utilisateur
                if (empty($errors)) {
                    // Hachage du mot de passe
                    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
                    
                    // Insérer le nouvel utilisateur dans la base de données
                    $sql = "INSERT INTO users (username, email, password, created_at) VALUES (?, ?, ?, NOW())";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("sss", $username, $email, $hashed_password);
                    
                    if ($stmt->execute()) {
                        // Récupérer l'ID de l'utilisateur créé
                        $user_id = $stmt->insert_id;
                        
                        // Créer la session
                        $_SESSION['user_id'] = $user_id;
                        $_SESSION['username'] = $username;
                        $_SESSION['email'] = $email;
                        
                        // Redirection vers la page d'accueil
                        header("Location: index.php");
                        exit();
                    } else {
                        $errors[] = "Erreur lors de l'inscription: " . $stmt->error;
                    }
                    
                    $stmt->close();
                }
                
                $conn->close();
            }
            ?>
            
            <?php if (!empty($errors)): ?>
                <div class="error-message">
                    <ul>
                        <?php foreach ($errors as $error): ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                    </ul>
                </div>
            <?php endif; ?>
            
            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <div class="form-group">
                    <label for="username">Nom d'utilisateur</label>
                    <input type="text" id="username" name="username" value="<?php echo htmlspecialchars($username); ?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="form-group">
                    <label for="confirm_password">Confirmer le mot de passe</label>
                    <input type="password" id="confirm_password" name="confirm_password" required>
                </div>
                <div class="form-group terms">
                    <label class="container">
                        <input checked="checked" type="checkbox" id="terms" name="terms">
                        <div class="checkmark"></div>
                    </label>
                    <label class="terms" for="terms">J'accepte les <a href="terms.php">conditions d'utilisation</a> et la <a href="privacy.php">politique de confidentialité</a></label>
                </div>
                <div class="form-group">
                    <button type="submit" class="auth-button">S'inscrire</button>
                </div>
            </form>
            <div class="auth-separator">
                <span>ou</span>
            </div>
            <div class="sso-login">
                <a href="index.php">
                    <button type="button">
                        <i class="fas fa-key"></i>
                        <span>Authentification unique (SSO)</span>
                    </button>
                </a>
            </div>
            <div class="auth-links">
                <p>Déjà inscrit? <a href="login.php">Connectez-vous</a></p>
            </div>
        </div>
        <div class="auth-footer">
            <a href="index.html">Retour à l'accueil</a>
        </div>
    </div>

    <script src="https://kit.fontawesome.com/a076d05399.js" crossorigin="anonymous"></script>
</body>
</html> 