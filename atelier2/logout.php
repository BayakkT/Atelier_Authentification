<?php
session_start();

// Supprimer toutes les variables de session
$_SESSION = [];

// Détruire la session côté serveur
session_destroy();

// Supprimer le cookie d'authentification
setcookie('authToken', '', time() - 3600, '/', '', false, true);

// Rediriger vers la page de connexion
header('Location: index.php');
exit();
?>
