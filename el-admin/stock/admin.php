<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: ../connexion.php');
    exit;
}

// Mise à jour de la quantité
if (isset($_GET['update']) && isset($_GET['name']) && isset($_GET['action'])) {
    $filename = 'stocks.txt';
    if (file_exists($filename)) {
        $stocks = file($filename, FILE_IGNORE_NEW_LINES);
        $updatedStocks = [];
        foreach ($stocks as $stock) {
            if (!empty(trim($stock))) {
                list($name, $price, $quantity) = explode(',', $stock);
                if ($name === $_GET['name']) {
                    if ($_GET['action'] === 'increment') {
                        $quantity++;
                    } elseif ($_GET['action'] === 'decrement' && $quantity >= 1) {
                        $quantity--;
                    }
                }
                $updatedStocks[] = "$name,$price,$quantity";
            }
        }
        file_put_contents($filename, implode("\n", $updatedStocks));
        header('Location: admin.php?updated=true');
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

    <title>Admin stocks</title>
    <meta name="description" content="Site de l'association Dionysos Party">
    <link rel="stylesheet" href="styles.css">
    
</head>

<body>
    <h1>Administration des stocks</h1>
    <a href="ajouter_obj.php">Ajouter un objet</a>
    <h1>Liste des stocks :</h1>

    <?php
    if (isset($_GET['deleted']) && $_GET['deleted'] === 'true') {
        echo "<p style='color: green;'>L'objet a été supprimé avec succès.</p>";
    }
    if (isset($_GET['updated']) && $_GET['updated'] === 'true') {
        echo "<p style='color: green;'>L'objet a été mis à jour avec succès.</p>";
    }
    ?>

    <ul>
        <?php
        $filename = 'stocks.txt';
        if (file_exists($filename)) {
            $stocks = file($filename, FILE_IGNORE_NEW_LINES);
            foreach ($stocks as $stock) {
                if (!empty(trim($stock))) { 
                    list($name, $price, $quantity) = explode(',', $stock, 3);
                    if (!empty($name) && !empty($price)) { 
                        echo "<li>$name | $price € | Quantité: $quantity
                            <br><a href=\"?update=true&name=" . urlencode($name) . "&action=increment\">+1</a> 
                            <a href=\"?update=true&name=" . urlencode($name) . "&action=decrement\">-1</a>
                            <a href=\"modifier_obj.php?name=" . urlencode($name) . "\">Modifier</a> 
                            <a href=\"supprimer_obj.php?name=" . urlencode($name) . "\">Supprimer</a></li>";
                    }
                }
            }
        }
        ?>
    </ul>

    <button type="button" onclick="window.location.href='../index.php';">Retour</button>
</body>
</html>