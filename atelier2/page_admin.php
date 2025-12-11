<?php
// Démarrer la session
session_start();

// Vérifier que l'utilisateur est bien authentifié ET qu'il est admin
if (
    !isset($_COOKIE['authToken'], $_SESSION['authToken'], $_SESSION['username']) ||
    $_COOKIE['authToken'] !== $_SESSION['authToken'] ||
    $_SESSION['username'] !== 'admin'
) {
    // Pas authentifié ou pas admin → retour à la page de login
    header('Location: index.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil administrateur</title>
</head>
<body>
    <h1>Bienvenue sur la page Administrateur protégée par un Cookie</h1>
    <p>Vous êtes connecté en tant qu'<strong>admin</strong>.</p>
    <a href="logout.php">Se déconnecter</a>
</body>
</html>
