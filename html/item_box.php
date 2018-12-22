<?php
include('db.php');
$req = $db->prepare('SELECT * FROM posts);
$req->execute(array());
$result = $req -> fetch()){
            
echo "<div class = "item_wrapper">
    <div class="item_img"><img src="'.$img.'".<span>'.$category.'</span><br>  </div>
    <span class="title">'.$title.'<span class-"price"'>$price.'</span><br>
    <span class="district_town">'.$district.'-'.$town.'</span>
</div>" 
?>