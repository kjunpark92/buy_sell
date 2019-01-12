<?php session_start(); ?>

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
    $isIndexPage=true;
        include('./html/db.php');
        $imagesrc= "./img/logo_top.png";
        include('./html/header.php'); 
        ?>
        <div class="item_wrap_index">
            <?php
            $counter = 0;
            $req = $db->prepare('SELECT * FROM posts ORDER BY datePosted DESC limit 0,6 ');
            $req->execute();
            while ($result = $req -> fetch()){
                $id = $result['id'];
                $img = $result['img'];
                $title = $result['title'];
                $price = $result['price'];
                $district = $result['district'];
                $town = $result['town'];
                $category = $result['category'];
                include('./html/item_box.php');
            } 
            ?>
        </div>
        <?php
        include('./html/aside.php');
        ?>
        <div id="footer_wrapper">
        <?php
        include('./html/footer.php');?>
        </div>
    <script src="./js/script.js"></script>
</body>
</html>

