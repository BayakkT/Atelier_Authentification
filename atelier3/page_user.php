<?php
session_start();

if (!isset($_SESSION['username']) || $_SESSION['username'] !== 'user') {
    header('Location: index.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Page Utilisateur</title>
</head>
<body>
    <h1>Espace Utilisateur</h1>
    <p>Vous êtes connecté en tant que <strong>user</strong>.</p>

    <a href="logout.php">Se déconnecter</a>
</body>
</html>
