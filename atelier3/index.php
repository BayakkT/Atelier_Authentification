<?php
session_start();

// Compteur de visites sur la page d'accueil de l'atelier 3
if (!isset($_SESSION['visits'])) {
    $_SESSION['visits'] = 1;
} else {
    $_SESSION['visits']++;
}

// Si déjà connecté, on redirige selon le rôle
if (isset($_SESSION['username'])) {
    if ($_SESSION['username'] === 'admin') {
        header('Location: page_admin.php');
        exit();
    } elseif ($_SESSION['username'] === 'user') {
        header('Location: page_user.php');
        exit();
    }
}

// Traitement du formulaire de connexion
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $login = $_POST['login'] ?? '';
    $password = $_POST['password'] ?? '';

    $valid = false;
    $role = null;

    if ($login === 'admin' && $password === 'secret') {
        $valid = true;
        $role = 'admin';
    } elseif ($login === 'user' && $password === 'utilisateur') {
        $valid = true;
        $role = 'user';
    }

    if ($valid) {
        // On stocke le type d'utilisateur dans la session
        $_SESSION['username'] = $role;

        if ($role === 'admin') {
            header('Location: page_admin.php');
        } else {
            header('Location: page_user.php');
        }
        exit();
    } else {
        $error = "Identifiants incorrects.";
    }
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Atelier 3 - Authentification par Session</title>
</head>
<body>
    <h1>Atelier 3 : Authentification par Session</h1>

    <p>
        <?php
        echo "Vous avez visité cette page d'accueil <strong>" . $_SESSION['visits'] . "</strong> fois.";
        ?>
    </p>

    <?php if (!empty($error)): ?>
        <p style="color:red;"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="">
        <label for="login">Nom d'utilisateur :</label>
        <input type="text" id="login" name="login" required>
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

    <a href="../index.html">Retour à l'accueil général</a>
</body>
</html>
