<?php
session_start();
?>
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
        include('./html/header.php');
            $counter = 0;
            $req = $db->prepare('SELECT * FROM posts ORDER BY datePosted DESC limit 0,5 ');
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
        include('./html/aside.php');
        include('./html/footer.php');
    ?>

    <script src="./js/script.js">
        </script>
</body>
</html>

