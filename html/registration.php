<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
</head>
<body>
    <div>
        <form action="registration.php" method="POST">
            Username : <input type="text" name="username" id="username"><br>
            Gender : <input type="radio" name="gender" id="male" value="m">Male<input type="radio" name="gender" id="female" value="f">Female<br>
            Phone : <input type="text" name="phone" id="phone" maxlength="11"><br>
            Email : <input type="text" name="email" id="email"><br>
            Address : <input type="text" name="address" id="address"><br>
            District : <br>
            Town :<br>
            Password : <input type="password" name="password" id="password"><br>
            <input type="submit" value="Register"><button id="save">Save</button>
        </form>
    </div>
<?php 
    try
{
    $db = new PDO("mysql:host=localhost;dbname=buy_sell;charset=utf8",'root','root');
}
    catch (Exception $e)
{
    die('Error: '. $e->getMessage());
}
?>
<?php


if(isset($_POST['username']) AND isset($_POST['gender']) AND isset($_POST['phone']) AND isset($_POST['email']) AND isset($_POST['address']) AND isset($_POST['password'])){
    echo "test";
    $username = $_POST['username'];
    $gender = $_POST['gender'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $address = $_POST['address'];
    $password = $_POST['password'];
    if(!empty($username) AND !empty($gender) AND !empty($phone) AND !empty($email) AND !empty($address) AND !empty($password)){
        echo "test1";
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $req = $db -> prepare("INSERT INTO test1(Username, Gender, Phone, Email, Address, Password) VALUES (:Username, :Gender, :Phone, :Email, :Address, :Password)");
        $req -> execute(array(
            'Username' => $username,
            'Gender' => $gender,
            'Phone' => $phone,
            'Email' => $email,
            'Address' => $address,
            'Password' => $pass_hache
            // 'Authority' => 2
        ));
        header ('location: log_in.php');
    }
    else {
        echo "Please fill out all the fields with * next to it";
    }
}


?>
<!-- <script src="../js/script.js"></script> -->
</body>
</html>

<!-- 
    District, Town, DateJoined, Authority
:District, :Town, :DateJoined, :Authority
-->