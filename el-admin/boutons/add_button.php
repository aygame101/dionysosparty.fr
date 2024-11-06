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

    <title>Ajout bouton</title>
    <meta name="description" content="Site de l'association Dionysos Party">
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
    <h1>Ajouter un bouton</h1>
    <form method="post" action="add_button.php">
        <label for="name">Nom du bouton:</label>
        <input type="text" id="name" name="name" required>
        <br>
        <label for="link">Lien du bouton:</label>
        <input type="text" id="link" name="link" required>
        <br>
        <button type="submit">Ajouter</button>
    </form>
</body>
</html>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $link = $_POST['link'];
    
    $button = "$name,$link\n";
    $filename = 'buttons.txt';
    file_put_contents($filename, $button, FILE_APPEND);
    header("Location: admin.php");
    exit;
}
?>
