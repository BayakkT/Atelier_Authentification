<?php
// Démarrer une session utilisateur
session_start();

// Si l'utilisateur a déjà un cookie + une session valides, on le redirige
if (isset($_COOKIE['authToken'], $_SESSION['authToken'], $_SESSION['username'])
    && $_COOKIE['authToken'] === $_SESSION['authToken']) {

    if ($_SESSION['username'] === 'admin') {
        header('Location: page_admin.php');
        exit();
    } elseif ($_SESSION['username'] === 'user') {
        header('Location: page_user.php');
        exit();
    }
}

// Gérer la soumission du formulaire
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    $valid = false;

    // Vérification des identifiants
    if ($username === 'admin' && $password === 'secret') {
        $valid = true;
        $role = 'admin';
    } elseif ($username === 'user' && $password === 'utilisateur') {
        $valid = true;
        $role = 'user';
    }

    if ($valid) {
        // Générer un token aléatoire unique
        $token = bin2hex(random_bytes(16));

        // Stocker le token + l'utilisateur dans la session
        $_SESSION['authToken'] = $token;
        $_SESSION['username'] = $role;

        // Cookie valable 1 minute (60 secondes)
        setcookie(
            'authToken',
            $token,
            time() + 60,
            '/',      // Chemin
            '',       // Domaine
            false,    // Secure (mettre true si HTTPS obligatoire)
            true      // HttpOnly
        );

        // Rediriger selon le type d'utilisateur
        if ($role === 'admin') {
            header('Location: page_admin.php');
        } else { // user
            header('Location: page_user.php');
        }
        exit();
    } else {
        $error = "Nom d'utilisateur ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
</head>
<body>
    <h1>Atelier authentification par Cookie</h1>
    <h3>
        La page <a href="page_admin.php">page_admin.php</a> 
        et la page <a href="page_user.php">page_user.php</a> 
        sont inaccessibles tant que vous ne vous êtes pas connecté.
    </h3>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="username">Nom d'utilisateur :</label>
        <input type="text" id="username" name="username" required>
        <br><br>
        <label for="password">Mot de passe :</label>
        <input type="password" id="password" name="password" required>
        <br><br>
        <button type="submit">Se connecter</button>
    </form>
    <br>
    <p>
        Identifiants possibles :<br>
        - admin / secret<br>
        - user / utilisateur
    </p>
    <a href="../index.html">Retour à l'accueil</a>
</body>
</html>
