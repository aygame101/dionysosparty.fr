<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../connexion.php');
    exit;
}

if (isset($_GET['toggle']) && isset($_GET['name'])) {
    $filename = 'buttons.txt';
    if (file_exists($filename)) {
        $buttons = file($filename, FILE_IGNORE_NEW_LINES);
        $updatedButtons = [];
        foreach ($buttons as $button) {
            if (!empty(trim($button))) {
                list($name, $link, $status) = explode(',', $button);
                if ($name === $_GET['name']) {
                    
                    $status = $status === '1' ? '0' : '1';
                }
                $updatedButtons[] = "$name,$link,$status";
            }
        }

        file_put_contents($filename, implode("\n", $updatedButtons));
        header('Location: admin.php');
        exit;
    }
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

    $filename = 'buttons.txt';
    if (file_exists($filename)) {
        $buttons = file($filename, FILE_IGNORE_NEW_LINES);
        echo "<ul>";
        foreach ($buttons as $button) {
            if (!empty(trim($button))) {
                list($name, $link, $status) = explode(',', $button);
                if (!empty($name) && !empty($link)) {
                    echo "<li>$name - <a href=\"$link\">$link</a> ";
                    echo $status === '1' 
                        ? "<a href=\"?toggle=true&name=" . urlencode($name) . "\">Désactiver</a> " 
                        : "<a href=\"?toggle=true&name=" . urlencode($name) . "\">Activer</a> ";
                    echo "<a href=\"delete_button.php?name=" . urlencode($name) . "\">Supprimer</a>";
                    echo "</li>";
                }
            }
        }
        echo "</ul>";
    } else {
        echo "<p>Le fichier des boutons est introuvable.</p>";
    }
    ?>

    <button type="button" onclick="window.location.href='../index.php';">Retour</button>
</body>
</html>
