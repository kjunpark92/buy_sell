<?php
session_start();
if(isset($_SESSION['username'])){
$username = $_SESSION['username'];
$req = $db->prepare('SELECT id, username FROM users WHERE username = :username');
        $req->execute(array(
        'username' => $username));
        $result = $req->fetch();
        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $username;
}
?>
<link rel="stylesheet" href="../style/style.css">
<header>
    <div id="navbar">
        <div id="top_logo">
            <a href="../index.php"> logo <img src="" alt="" ></a>
        </div>
        <div class="category">
            <span>Electronics</span>
        </div>
        <div class="category">
            <span>Vehicles</span>
        </div>
        <div class="category">
            <span>Cosmetics</span>
        </div>
        <div class="category">
            <span>Clothing</span>
        </div>
        <div class="category">
            <span>Misc</span>
        </div>
        <div id="top_login">
            <span><?php echo (isset($_SESSION['id'])) ? "<a href='./html/profile.php'>".$username."</a>" : "<a href='./html/log_in.php'>Log In</a>"; ?></span>
        </div>
        <div id="top_register">
            <span><?php echo (isset($_SESSION['id'])) ? "<a href='./html/log_out.php'>Log Out</a>" : "<a href='./html/registration.php'>New? Register Now</a>";?></span>
        </div>

</header>