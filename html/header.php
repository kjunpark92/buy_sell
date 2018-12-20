<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
include('db.php');
if(isset($_SESSION['username'])){
    $username = $_SESSION['username'];
    $req = $db->prepare('SELECT id, username FROM users WHERE username = :username');
        $req->execute(array(
        'username' => $username));
        $result = $req->fetch();
        $_SESSION['id'] = $result['id'];
        $_SESSION['username'] = $username;
}
$url = "";
$profile = '';
$login = "";
$logout = "";
$registration = "";
$logo = "<div>
    <a href="'<?php ./index.php; ?>'"><img src="../img/logo_top.png" alt=""></a>
<div>"
if(isset($isIndexPage) AND $isIndexPage) {
    $url = "./html/in_category.php?cat=";
    $index = "index.php";
    $profile = "./html/profile.php";
    $login = "./html/log_in.php";
    $logout = "./html/log_out.php";
    $registration = "./html/registration.php";
}
else {
    $url = "in_category.php?cat=";
    $index = "../index.php";
    $profile = "profile.php";
    $login = "log_in.php";
    $logout = "log_out.php";
    $registration = "registration.php";
}
?>
<link rel="stylesheet" href="../style/style.css">
<header>
    <div id="navbar">
        <div id="top_logo">
        <?php echo $logo;?>
            <!-- <p><script> vertical-align = "middle</"script></p>HOME</a> -->
        </div>
        <div class="category">
            <span><a href="<?php echo $url;?>electronics">Electronics</a></span>
        </div>
        <div class="category">
            <span><a href="<?php echo $url;?>vehicles">Vehicles</a></span>
        </div>
        <div class="category">
            <span><a href="<?php echo $url;?>cosmetics">Cosmetics</a></span>
        </div>
        <div class="category">
            <span><a href="<?php echo $url;?>clothing">Clothing</a></span>
        </div>
        <div class="category">
            <span><a href="<?php echo $url;?>misc">Misc</a></span>
        </div>
        <div id="top_login">
            <span><?php echo (isset($_SESSION['id'])) ? "<a href='".$profile."'>".$username."</a>" : "<a href='".$login."'>Log In</a>"; ?></span>
        </div>
        <div id="top_register">
            <span><?php echo (isset($_SESSION['id'])) ? "<a href='".$logout."'>Log Out</a>" : "<a href='".$registration."'>New? Register Now</a>";?></span>
        </div>

</header>