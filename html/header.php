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
         <a href="<?php echo $index;?>" id="logo"><img src=" <?php echo isset($imagesrc) ? $imagesrc : '../img/logo_top.png' ?>" alt="logo"  width="75px" height="60px"></a>
        </div>
        <div class="category">
            <a href="<?php echo $url;?>electronics"><span>Electronics</span></a>
        </div>
        <div class="category">
            <a href="<?php echo $url;?>vehicles"><span>Vehicles</span></a>
        </div>
        <div class="category">
            <a href="<?php echo $url;?>cosmetics"><span>Cosmetics</span></a>
        </div>
        <div class="category">
            <a href="<?php echo $url;?>clothing"><span>Clothing</span></a>
        </div>
        <div class="category">
            <a href="<?php echo $url;?>misc"><span>Misc</span></a>
        </div>
        <div id="top_login">
            <?php echo (isset($_SESSION['id'])) ? "<a href='".$profile."'><span>".$username."</span></a>" : "<a href='".$login."'><span>Log In</span></a>"; ?>
        </div>
        <div id="top_register">
            <?php echo (isset($_SESSION['id'])) ? "<a href='".$logout."'><span>Log Out</span></a>" : "<a href='".$registration."'><span>Register</span></a>";?>
        </div>
</header>