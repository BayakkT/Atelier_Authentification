<?php
// Atelier 4 : Authentification simple via le header HTTP (Basic Auth)

// 1) Vérifier si des identifiants ont été envoyés
if (!isset($_SERVER['PHP_AUTH_USER'], $_SERVER['PHP_AUTH_PW'])) {
    demander_authentification();
    exit;
}

// 2) Récupérer les identifiants
$username = $_SERVER['PHP_AUTH_USER'];
$password = $_SERVER['PHP_AUTH_PW'];

// 3) Vérifier les 2 profils autorisés
$isAdmin = ($username === 'admin' && $password === 'secret');
$isUser  = ($username === 'user'  && $password === 'utilisateur');

if (!$isAdmin && !$isUser) {
    // Mauvais identifiants → on redemande l'authentification
    demander_authentification("Identifiants incorrects.");
    exit;
}

// À partir d'ici l'utilisateur est authentifié (admin ou user)

function demander_authentification($message = "Vous devez vous identifier pour accéder à cette page.") {
    header('WWW-Authenticate: Basic realm="Zone protégée Atelier 4"');
    header('HTTP/1.0 401 Unauthorized');
    echo "<h1>Authentification requise</h1>";
    echo "<p>$message</p>";
}
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Atelier 4 - Authentification HTTP</title>
</head>
<body>
    <h1>Atelier 4 : Authentification via les headers HTTP</h1>

    <p>
        Bonjour <strong><?= htmlspecialchars($username) ?></strong>,
        vous êtes connecté avec le profil 
        <strong><?= $isAdmin ? 'admin' : 'user' ?></strong>.
    </p>

    <hr>

    <h2>Section visible par tous les utilisateurs authentifiés</h2>
    <p>
        Cette partie de la page est accessible aussi bien au profil 
        <em>admin</em> qu'au profil <em>user</em>.
    </p>

    <?php if ($isAdmin): ?>
        <hr>
        <h2>Section réservée à l'administrateur</h2>
        <p>
            Cette section est uniquement visible par <strong>admin</strong> (login : admin / mot de passe : secret).<br>
            Le profil <em>user</em> ne voit pas cette partie.
        </p>
    <?php endif; ?>

    <hr>
    <p>
        Pour tester avec un autre utilisateur, fermez l’onglet ou la fenêtre de navigation privée,
        puis rouvrez la page pour que le navigateur redemande les identifiants.
    </p>

    <p><a href="../index.html">Retour à l'accueil général</a></p>
</body>
</html>
