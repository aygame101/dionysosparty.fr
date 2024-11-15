<?php
session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: el_admin.php');
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
    <h1>Ajouter un objet</h1>
    <form method="post" action="ajouter_obj.php">
        <label for="name">Nom de l'objet:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="price">Prix de l'objet:</label>
        <input type="text" id="price" name="price" required>
        <br>
        <label for="quantity">Quantité de l'objet:</label>
        <input type="number" id="quantity" name="quantity" required>
        <br>
        <button type="button" onclick="window.location.href='index.php';">Retour</button>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    
    $item = "$name,$price,$quantity\n";
    $filename = 'stocks.txt';
    file_put_contents($filename, $item, FILE_APPEND);
    header("Location: admin.php");
    exit;
}
?>
