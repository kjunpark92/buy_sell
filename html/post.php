<link rel='stylesheet' href='../style/style.css'>

<?php 
    include('./header.php');
    include('./db.php');

$title_edit = "";
$img_edit = "";
$desc_edit = "";
$price_edit= "";
$submit_value = "Post";
$newCat = '';
$action = "post.php";
if (isset($_GET['post_id'])){ 
    $post_id = $_GET['post_id'];
    $submit_value = "Edit";
    $action = "post.php?post_id=".$post_id;
} else {
    $user_id = "Jason Test"; // fill with the value in session of the logged user
}
// submit the values
if (isset($_POST['post_title']) AND isset($_POST['item_description']) AND isset($_POST['post_price']) AND isset($_POST['district_town'])) {
    
    $newTitle= $_POST['post_title'];
    $newDesc = $_POST['item_description'];
    $newImg = isset($_POST['post_pic']) ? $_POST['post_pic']:""; // to set when the image gonna be handled
    $newPrice = $_POST['post_price'];
    $district_town = $_POST['district_town'];
    $explode_dt = explode('-',$district_town);
    $district = $explode_dt[0];
    $town = $explode_dt[1];
    // $newCat = $_POST['post_category'];
    
    if($submit_value=="Edit"){
        $query_update =  "UPDATE posts SET title=:title, description=:description, price=:price, district=:district, town=:town, img=:img, category=:category WHERE id=".$post_id;

        $req = $db->prepare($query_update);
        $array_update = Array(
            "title" => $newTitle,
            "description" => $newDesc,
            "price" => $newPrice,
            "district" =>$district,
            "town" => $town,
            "img" => $newImg,
            "category" => $newCat
        );
        $req->execute($array_update);
    }
    else {
        $query_insert =  "INSERT INTO posts(title, description, price, district, town, img, category) VALUES(:title, :description, :price, :district, :town, :img, :category)";

        $req = $db->prepare($query_insert);
        $array = Array(
            "title" => $newTitle,
            "description" => $newDesc,
            "price" => $newPrice,
            "district" =>$district,
            "town" => $town,
            "img" => $newImg,
            "category" => $newCat
        );
        $req->execute($array);
        
    }
}
    // checking if this is editing existing post
if (isset($_GET['post_id'])){ 
    $query_select =  "SELECT * FROM posts WHERE id=".$post_id;
    $req = $db->query($query_select)->fetch();
    $title_edit = $req['title'];
    $img_edit = $req['img'];
    $desc_edit = $req['description'];
    $price_edit= $req['price'];
    $loc_edit = implode('-', array($req['district'],$req['town']));
   
} else {
    $query_select = "SELECT * FROM users WHERE username='$user_id'";
    $req = $db->query($query_select)->fetch();
    $loc_edit = implode('-', array($req['district'],$req['town']));
}
    //header('location:profile.php');

?>
<div id='post_edit_form_wrapper'>
    <form action='<?php echo $action;?>' method='POST' id='post_edit_form' enctype="multipart/form-data">
        <div class='post_edit required'>
            <span> Title </span> 
            <span class='error_msg'> * this field is required. </span><br/>
            <input type='text' name='post_title' class='requiredField'  placeholder="Title" value="<?php echo $title_edit;?>">
        </div>
        
        <div class='post_edit required'>
            <span> Select a Category </span>
            <span class='error_msg'> * this field is required.</span> <br/>
            <select name="post_category" id="post_category" class='requiredField'>
                <option selected disabled> Select a Category </option>
                <option value="cars"> - Cars - </option>
                <option value="electronics"> - Electronics - </option>
                <option value="clothing"> - Clothing - </option>
                <option value="cosmetics"> - Cosmetics - </option>
                <option value="misc"> - Miscellaneous - </option>
            </select>
            
        </div>
        <div class='post_edit required'>
            <span> Item Description </span>
            <span class='error_msg'> * this field is required.</span><br/>
            <textarea name='item_description' rows='20' cols='70' form='post_edit_form' class='requiredField' placeholder=" Description"><?php echo $desc_edit;?></textarea>
        </div>
        <div class='post_edit required'>
            <span> Price </span>
            <input type='text' name='post_price' id='post_price' class='requiredField' style='width: 100px;' placeholder=" number only" value="<?php echo $price_edit;?>"/>
            <span class='error_msg'>
            * this field is required.</span>
        </div>
        <div class='post_edit required'>
            <span> Your Location </span>
            <select name="district_town" id="district_town" class='requiredField' myOptionToSelect="<?php echo $loc_edit;?>">    
                <option selected disabled> Please select your location </option>
                <optgroup label="Gangnam">
                    <option value="gangnam-apgujeong">Apgujeong</option>
                    <option value="gangnam-sinsa">Sinsa</option>
                    <option value="gangnam-samseong">Samseong</option>
                </optgroup>
                <optgroup label="Yongsan">
                    <option value="yongsan-itaewon">Itaewon</option>
                    <option value="yongsan-yongmun">Yongmun</option>
                    <option value="yongsan-seobinggo">Seobinggo</option>
                </optgroup>
                <optgroup label="Mapo">
                    <option value="mapo-gongdeok">Gongdeok</option>
                    <option value="mapo-hapjeong">Hapjeong</option>
                    <option value="mapo-sinsu">Sinsu</option>
                </optgroup>
            </select>
            <span class='error_msg'>* this field is required.</span>
        </div>
        <div class='post_edit'>
            <span> Upload a picture </span><br/>
            <input type='file' name='post_pic' accept='image/*' src="<?php echo $img_edit;?>">
        </div>
        <br/><br/>
        <div class='post_edit'>
            <input type='submit' name='post_submit' 
            id='post_submit' value ="<?php echo $submit_value;?>">
        </div>
        <br/><br/>
    </form>
</div>

<script src="../js/script.js"> </script>
<script> var district_town = document.getElementById("district_town");
        townSelection(district_town);
</script>
<?php
    

?>

<!-- script to put selected within the informations from the database -->