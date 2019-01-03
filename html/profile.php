<?php
    session_start();
?>
<link rel='stylesheet' href='../style/style.css'>

<?php 
    include('./header.php');
    include('./db.php');

    if (!empty($_SESSION['username'])){
        $username = $_SESSION['username'];
        $req = $db -> prepare("SELECT * , p.id AS post_id from users u, posts p WHERE u.username=:username AND p.user_id= u.id ORDER BY p.datePosted DESC");
        $array = array("username" => $username);
        $req->execute($array);
        $data = $req->fetchAll();
        $dateJoined = ($data) ? $data['dateJoined'] : "";
?>

<div> 
    Hello, <?php echo $username ?> <br/>
    You joined on <?php echo $dateJoined?> <br/>
</div>

<div id="editProfile">
    <a href="./registration.php"> edit profile </a>
</div>

<div id ="postlist_wrapper">
    <ul id="postlist">
    <?php 
        
        foreach ($data as $posted) {
            $post_id=$posted['post_id'];
            echo "<li>".$posted['title']."...".$posted['datePosted']."<a href='./post.php?post_id=".$post_id."'>....EDIT... </a></li>";
        }
    ?>
    </ul>
</div>

<?php
}
else {
    header("location:./log_in.php");
}
?>