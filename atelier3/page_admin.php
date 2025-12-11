<?php
session_start();

// Vérifier que l'utilisateur est connecté en tant qu'admin
if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'admin') {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page Admin</title>
</head>
<body>
    <h1>Page Administrateur</h1>
    <p>Vous êtes connecté en tant qu'<strong>admin</strong>.</p>

    <p><a href="logout.php">Se déconnecter</a></p>
    <p><a href="index.php">Retour à l'accueil de l'atelier 3</a></p>
</body>
</html>
