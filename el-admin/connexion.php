<?php
session_start();

if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    header('Location: index.php');
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'];
    $password = hash('sha256', $_POST['password']);

    include 'titania.php';

    if ($username === $valid_username && $password === $hashed_password) {
        $_SESSION['loggedin'] = true;
        header('Location: index.php');
        exit;
    } else {
        $error = "Identifiants invalides";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dionysos Party Admin</title>
    <meta name="description" content="Site de l'association Dionysos Party">
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <div>
    <h1>Connexion Admin</h1>
    <form method="post" action="connexion.php">

        <input placeholder="Identifiant" type="text" id="username" name="username" required>
        <br>

        <input placeholder="Mot de passe"type="password" id="password" name="password" required>
        <br>
        <button type="submit">Se connecter</button>
    </form>
    <button type="button" onclick="window.location.href='../index.php';">Retour</button>
    <?php if (isset($error)): ?>
        <p style="color: red;"><?php echo $error; ?></p>
    <?php endif; ?>
    </div>
</body>
</html>
