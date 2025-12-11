<?php
// Démarrer la session (facultatif)
session_start();

// Vérifier si l'utilisateur possède bien un cookie d'authentification
// ⚠️ On ne vérifie plus la valeur (12345), seulement la présence du cookie
if (!isset($_COOKIE['authToken'])) {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Espace Administrateur</title>
</head>
<body>
    <h1>Bienvenue sur la page Administrateur protégée par un Cookie</h1>
    <p>Vous êtes connecté en tant qu'<strong>admin</strong>.</p>

    <a href="logout.php">Se déconnecter</a>
</body>
</html>
