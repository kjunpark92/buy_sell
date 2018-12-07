<link rel='stylesheet' href='../style/style.css'>

<?php 
    include('./header.php');
    include('./db.php');

$title_edit = "";
$img_edit = "";
$desc_edit = "";
$price_edit= "";
$submit_value = "Post";


// checking if this is editing existing post
if (isset($_GET['post_id'])){ 
    $post_id = $_GET['post_id'];
    $query_select =  "SELECT * FROM posts WHERE id=".$post_id;
    $req = $db->query($query_select)->fetch();
    $title_edit = $req['title'];
    $img_edit = $req['img'];
    $desc_edit = $req['description'];
    $price_edit= $req['price'];
    $loc_edit = implode('-', array($req['district'],$req['town']));
    $submit_value = "Edit";
   
} else {
    $user_id = ""; // fill with the value in session of the logged user
    $query_select =  "SELECT * FROM users WHERE id=".$user_id;
    $req = $db -> query($query_select);

    $loc_edit = implode('-', array($req['district'],$req['town'])) ;
}
?>
<div id='post_edit_form_wrapper'>
    <form action='' method='POST' id='post_edit_form'>
        <div class='post_edit'>
            <span> Title </span><br/>
            <input type='text' name='post_title' placeholder="Title" value="<?php echo $title_edit;?>">
        </div>
        <div class='post_edit'>
            <span> Upload a picture </span><br/>
            <input type='file' name='post_pic' accept='image/*' src="<?php echo $img_edit;?>">
        </div>
        <div class='post_edit'>
            <span> Item Description </span><br/>
            <textarea name='item_description' rows='20' cols='70' form='post_edit_form' placeholder="Description"><?php echo $desc_edit;?></textarea>
        </div>
        <div class='post_edit'>
            <span> Price </span>
            <input type='text' name='post_price' style='width: 100px;' placeholder="Number only" value="<?php echo $price_edit;?>"/>
        </div>
        <div class='post_edit'>
            <span> Your Location </span>
            <select name="district_town" id="district_town">    
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
            <br/><br/>
        </div>
        <div class='post_edit'>
            <input type='submit' name='post_submit' value ="<?php echo $submit_value;?>">
        </div>
    </form>
</div>

<!-- script to put selected within the informations from the database -->
