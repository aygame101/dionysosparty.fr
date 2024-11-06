<?php

session_start();
if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true) {
    header('Location: el_admin.php');
    exit;
}

if (isset($_GET['name'])) {
    $nameToDelete = urldecode($_GET['name']);
    $filename = 'buttons.txt';
    if (file_exists($filename)) {
        
        $buttons = file($filename, FILE_IGNORE_NEW_LINES);
        $newButtons = [];
        
        
        foreach ($buttons as $button) {
            list($name, $link) = explode(',', $button, 2);
            if ($name !== $nameToDelete) {
                $newButtons[] = $button;
            }
        }
        
        
        file_put_contents($filename, implode("\n", $newButtons) . "\n");
    }
    
    header("Location: admin.php?deleted=true");
    exit;
}
?>
