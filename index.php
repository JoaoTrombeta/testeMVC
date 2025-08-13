<?php
    include_once("./router.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tanca - PCP</title>
    <link rel="stylesheet" href="./assets/css/defaults.css">
    <link rel="stylesheet" href="./assets/css/main.css">
    <link rel="stylesheet" href="./assets/css/onprint.css">
</head>
<body class="to-print">
    <?php
        if($modalInclude != ""){
            include_once("./view/defaults/modal.php");
        }
    ?>
    <header>
        <?php
            include_once("./view/defaults/header.php");
        ?>
    </header>
    <main class="to-print">
        <?php
        if($page != ""){
            include_once("./view/pages/$page.php");
        }elseif($orientation != ""){
            include_once("./view/orientation/$orientation.php");
        }else{
            include_once("./view/orientation/home.php");
        }
        ?>
    </main>
    <footer>

    </footer>
</body>
</html>