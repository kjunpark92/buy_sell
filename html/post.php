<link rel="stylesheet" href="../style/style.css">

<?php 
    include('./header.php');
    include('./db.php');
?>

<div id='post_edit_form_wrapper'>
    <form action="" method="POST" id="post_edit_form">
        <div class="post_edit">
            <span> Title </span><br/>
            <input type="text" name="post_title" placeholder="Title">
        </div>
        <div class="post_edit">
            <span> Upload a picture </span><br/>
            <input type="file" name="post_pic" accept="image/*"/>
        </div>
        <div class="post_edit">
            <span> Item Description </span><br/>
            <textarea name="item_description" rows="20" cols="70" form="post_edit_form"> 
            </textarea>
        </div>
        <div class="post_edit">
            <span> Price </span>
            <input type="text" name="post_price" style="width: 50px;"/>
        </div>
        <div class="post_edit">
            <span> Date </span>
            <input type="text" name="post_date"/>
        </div>
        <div class="post_edit">
            <span> Your Location </span>
            <input type="location" name="post_location" placeholder="$_POST "/>
            <br/><br/>
        </div>
        <div class="post_edit">
            <input type="submit" name="post_submit" value ="Post/Edit">
        </div>
    </form>
</div>
