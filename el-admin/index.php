<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: connexion.php');
    exit;
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
        <h1>Page Admin</h1>
        <a href="stock/admin.php"><h2 class=buttons>Stocks</h2></a>
        <a href="boutons/admin.php"><h2 class=buttons>Boutons</h2></a>
        <a href="logout.php"><h2 class=buttons>Déconnexion</h2></a>
        <a href="../index.php"><h2 class=buttons>Accueil</h2></a>

    </div>
</body>
</html>
