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

    <title>Ajout stocks</title>
    <meta name="description" content="Site de l'association Dionysos Party">
    <link rel="stylesheet" href="styles.css">
    
</head>

<body>
    <h1>Modifier un objet</h1>

    <?php
    $filename = 'stocks.txt';
    $nameToEdit = urldecode($_GET['name']);
    $currentStock = null;

    if (file_exists($filename)) {
        $stocks = file($filename, FILE_IGNORE_NEW_LINES);
        foreach ($stocks as $stock) {
            list($name, $price, $quantity) = explode(',', $stock, 3);
            if ($name === $nameToEdit) {
                $currentStock = ['name' => $name, 'price' => $price, 'quantity' => $quantity];
                break;
            }
        }
    }

    if ($currentStock):
    ?>

    <form method="post" action="modifier_obj.php">
        <input type="hidden" name="original_name" value="<?php echo $currentStock['name']; ?>">
        <label for="name">Nom de l'objet:</label>
        <input type="text" id="name" name="name" value="<?php echo $currentStock['name']; ?>" required>
        <br>
        <label for="price">Prix de l'objet:</label>
        <input type="text" id="price" name="price" value="<?php echo $currentStock['price']; ?>" required>
        <br>
        <label for="quantity">Quantité de l'objet:</label>
        <input type="number" id="quantity" name="quantity" value="<?php echo $currentStock['quantity']; ?>" required>
        <br>
        <button type="submit">Mettre à jour</button>
    </form>

    <?php endif; ?>

</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $originalName = $_POST['original_name'];
    $newName = $_POST['name'];
    $newPrice = $_POST['price'];
    $newQuantity = $_POST['quantity'];

    if (file_exists($filename)) {
        $stocks = file($filename, FILE_IGNORE_NEW_LINES);
        $newStocks = [];
        
        foreach ($stocks as $stock) {
            list($name, $price, $quantity) = explode(',', $stock, 3);
            if ($name === $originalName) {
                $newStocks[] = "$newName,$newPrice,$newQuantity";
            } else {
                $newStocks[] = $stock;
            }
        }

        file_put_contents($filename, implode("\n", $newStocks) . "\n");
    }

    header("Location: admin.php?updated=true");
    exit;
}
?>
