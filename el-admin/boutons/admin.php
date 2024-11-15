<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../connexion.php');
    exit;
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Admin bouton</title>
    <meta name="description" content="Site de l'association Dionysos Party">
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <h1>Administration des boutons</h1>
    <a href="add_button.php">Ajouter un bouton</a>
    <h1>Liste des boutons</h1>

    <?php
    if (isset($_GET['deleted']) && $_GET['deleted'] === 'true') {
        echo "<p style='color: green;'>Le bouton a été supprimé avec succès.</p>";
    }
    ?>

    <ul>
        <?php
        $filename = 'buttons.txt';
        if (file_exists($filename)) {
            $buttons = file($filename, FILE_IGNORE_NEW_LINES);
            foreach ($buttons as $button) {
                if (!empty(trim($button))) {
                    list($name, $link) = explode(',', $button, 2);
                    if (!empty($name) && !empty($link)) {
                        echo "<li>$name - <a href=\"$link\">$link</a><br><a href=\"delete_button.php?name=" . urlencode($name) . "\">Supprimer</a></li>";
                    }
                }
            }
        }
        ?>
    </ul>

    <button type="button" onclick="window.location.href='../index.php';">Retour</button>
</body>
</html>
