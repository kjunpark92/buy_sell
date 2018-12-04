<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="../style/registration.css">
</head>
<body>
<?php
include('header.php');
?>
    <div>
        <form action="registration.php" method="POST">
            <span class="red_star">*</span>Username : <input type="text" name="username" id="username"><br>
            <span class="red_star">*</span>Gender : <input type="radio" name="gender" id="male" value="m">Male<input type="radio" name="gender" id="female" value="f">Female<br>
            <span class="red_star">*</span>Phone : <input type="text" name="phone" id="phone" maxlength="11"><br>
            <span class="red_star">*</span>Email : <input type="text" name="email" id="email"><br>
            <span class="red_star">*</span>Address : <input type="text" name="address" id="address"><br>
            <span class="red_star">*</span>District/Town : 
                <select name="district_town" id="district_town">
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
                </select><br>
            <span class="red_star">*</span>Password : <input type="password" name="password" id="password"><br>
            <input type="submit" value="Register"><button id="save">Save</button>
        </form>
    </div>
<?php
include('footer.php');
?>
<?php 
include('db.php');
?>
<?php
    if(!empty($_POST['username']) AND !empty($_POST['gender']) AND !empty($_POST['phone']) AND !empty($_POST['email']) AND !empty($_POST['address']) AND !empty($_POST['district_town']) AND !empty($_POST['password'])){
        $username = $_POST['username'];
        $gender = $_POST['gender'];
        $phone = $_POST['phone'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];
        $district_town = $_POST['district_town'];
        $explode_dt = explode('-',$district_town);
        $district = $explode_dt[0];
        $town = $explode_dt[1];
        $date_joined = date('Y/m/d');
        $pass_hache = password_hash($_POST['password'], PASSWORD_DEFAULT);
        $req = $db -> prepare("INSERT INTO users(Username, Gender, Phone, Email, Address, District, Town, DateJoined, Password, Authority) VALUES (:Username, :Gender, :Phone, :Email, :Address, :District, :Town, :DateJoined, :Password, :Authority)");
        $req -> execute(array(
            'Username' => $username,
            'Gender' => $gender,
            'Phone' => $phone,
            'Email' => $email,
            'Address' => $address,
            'District' => $district,
            'Town' => $town,
            'DateJoined' => $date_joined,
            'Password' => $pass_hache,
            'Authority' => 2
        ));
        header ('location: log_in.php');
    }
    else {
        echo "Please fill out all the fields with * next to it";
    }
?>
<!-- <script src="../js/script.js"></script> -->
</body>
</html>