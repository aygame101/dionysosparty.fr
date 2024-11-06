<!doctype html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Dionysos Party</title>
    <meta name="description" content="Site de l'association Dionysos Party">
    <link rel="stylesheet" href="styles.css">
    
</head>

<body>

    <div class="container">

        <section class="one">
            <img class="img_top_index" src="img/logo.png" alt="image1">
            <div class="first_page">
                <h1>Dionysos Party</h1>

                <?php
                $filename = 'el-admin/boutons/buttons.txt';
                if (file_exists($filename)) {
                    $buttons = file($filename, FILE_IGNORE_NEW_LINES);
                    foreach ($buttons as $button) {
                        if (!empty(trim($button))) {
                            list($name, $link) = explode(',', $button, 2);
                            if (!empty($name) && !empty($link)) { 
                                echo "<a target=\"_blank\" href=\"$link\"><h2 class=buttons>$name</h2></a>";
                            }
                        }
                    }
                }
                ?>

                <div class="scroll"></div>

            </div>
        </section>

    </div>

</html>