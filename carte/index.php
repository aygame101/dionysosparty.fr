<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Carte</title>
    <meta name="description" content="Site de l'association Dionysos Party">
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <h1>La carte</h1>
    <div>
        <?php
        $filename = '../el-admin/stock/stocks.txt';
        if (file_exists($filename)) {
            $stocks = file($filename, FILE_IGNORE_NEW_LINES);
            foreach ($stocks as $stock) {
                if (!empty(trim($stock))) {  // ligne pas vide
                    list($name, $price, $quantity) = explode(',', $stock, 3);
                    if (!empty($name) && !empty($price) && !empty($quantity) && $quantity > 0) {
                        echo "<h2 class=buttons>$name - " . $price . "€</h2>";
                    }
                }
            }
        }
        ?>

        <button type="button" onclick="window.location.href='../index.php';">Retour</button>
    </div>
</body>
</html>
