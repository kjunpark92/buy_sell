<?php session_start(); 
 print_r($_SESSION);?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="./style/style.css">
    <title>Buy and Sell</title>
</head>
<body>
    <?php
        include('./html/db.php');
        include('./html/header.php');
        include('./html/aside.php');
        include('./html/footer.php');
    ?>

    <script src="./js/script.js">
        </script>
</body>
</html>