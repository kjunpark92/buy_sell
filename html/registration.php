<link rel="stylesheet" href="../style/style.css">

<?php
    include('./header.php');
    include('./db.php');
?>
    <div>
        <form action="registration.php" method="POST" id="registration">
            <label for="username">Username : </label> 
            <input type="text" name="username" id="username"><br>
            <label for="password"> Password : </label>
            <input type="password" name="password" id="password"> <br>
            <label for="male"> Gender :
            <input type="radio" name="gender" id="male" value="m">Male </label>
            <label for="female"> <input type="radio" name="gender" id="female" value="f">Female </label><br>
            <label for="phone"> Phone : </label> 
            <input type="phone" name="phone" id="phone" maxlength="11"> <br>
            <label for="email"> Email : </label>
            <input type="email" name="email" id="email"> <br>
            <label for="address"> Address : </label>
            <input type="text" name="address" id="address"><br>
            <label for="district"> District : <?php include("./district_list.php")?> </label><br>
            <label for="town"> Town : <?php include("./town_list.php")?></label> <br>
            
            <input type="submit" value="Register"><button id="save">Save</button>
        </form>
    </div>

<script src="../js/script.js"> </script>
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
        $req = $db -> prepare("INSERT INTO users(username, gender, phone, email, address, password) VALUES (:Username, :Gender, :Phone, :Email, :Address, :Password)");
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