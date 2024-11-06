<?php
if (isset($_GET['name'])) {
    $nameToDelete = urldecode($_GET['name']);
    $filename = 'stocks.txt';
    if (file_exists($filename)) {
        $stocks = file($filename, FILE_IGNORE_NEW_LINES);
        $newStocks = [];
        
        foreach ($stocks as $stock) {
            list($name, $price, $quantity) = explode(',', $stock, 3);
            if ($name !== $nameToDelete) {
                $newStocks[] = $stock;
            }
        }
        
        file_put_contents($filename, implode("\n", $newStocks) . "\n");
    }
    header("Location: admin.php?deleted=true");
    exit;
}
?>
