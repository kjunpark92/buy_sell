<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?php echo $_GET['cat']; ?></title>
    <link rel='stylesheet' href='../style/style.css'>
</head>
<body>
<div id="category">
<?php 
include('db.php');
include('header.php');
$cat = $_GET['cat'];
$req = $db->prepare('SELECT id, img, title, price, district, townm category FROM posts WHERE category = :category');
        $req->execute(array(
        'category' => $cat));
        while ($result = $req -> fetch()){
            $id = $result['id'];
            $img = $result['img'];
            $title = $result['title'];
            $price = $result['price'];
            $district = $result['district'];
            $town = $result['town']
            $category = $result['category']];
            include('item_box.php');
        }
?>
</div>
<?php include('footer.php');?>
</body>
</html>