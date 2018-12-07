<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registration</title>
    <link rel="stylesheet" href="../style/style.css">
</head>
<body>

    <?php 
    include('db.php');
    include('header.php');
    $username_edit = '';
    $gender_edit = '';
    $phone_edit = '';
    $email_edit = '';
    $address_edit = '';
    $submitValue = 'Register';
    if(isset($_GET['id'])){
        $user_id = $_GET['id'];
        $req = $db->prepare('SELECT * FROM users WHERE id = :user_id');
        $req -> execute(array( 'user_id' => $user_id ));
        $data = $req -> fetch();
        $username_edit= $data['username'];
        $gender_edit = $data['gender'];
        $phone_edit = $data['phone'];
        $email_edit = $data['email'];
        $address_edit = $data['address'];
        $submitValue = 'Save';
        $query = "UPDATE users(username, gender, phone, email, address, district, town, dateJoined, password, authority) VALUES (:Username, :Gender, :Phone, :Email, :Address, :District, :Town, :DateJoined, :Password, :Authority)";
    }
    ?>
    <div>
        <form action="registration.php" method="POST">
            <span class="red_star">*</span><label for="username">Username : </label>
            <input type="text" name="username" id="username" value="<?php echo $username_edit?>"><br>
            <span class="red_star">*</span><label for="male"> Gender :
            <input type="radio" name="gender" id="male" value="m">Male </label>
            <label for="female"> <input type="radio" name="gender" id="female" value="f">Female </label><br>
            <span class="red_star">*</span><label for="phone"> Phone : </label> 
            <input type="text" name="phone" id="phone" maxlength="11" value="<?php echo $phone_edit?>"><br>
            <span class="red_star">*</span><label for="email"> Email : </label>
            <input type="text" name="email" id="email" value="<?php echo $email_edit?>"><br>
            <span class="red_star">*</span><label for="address"> Address : </label>
            <input type="text" name="address" id="address" value="<?php echo $address_edit?>"><br>
            <span class="red_star">*</span><label for="district_town"> District/Town : </label>
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
            <span class="red_star">*</span><label for="password"> Password : </label>
            <input type="password" name="password" id="password"><br>
            <input id="save" type="submit" value="<?php echo $submitValue; ?>">
        </form>
        <div id="error_message"></div>
    </div>
<?php include('footer.php');?>

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
        if(empty($query)){
            $query = "INSERT INTO users(username, gender, phone, email, address, district, town, dateJoined, password, authority) VALUES (:Username, :Gender, :Phone, :Email, :Address, :District, :Town, :DateJoined, :Password, :Authority)";
        }


        $req = $db -> prepare($query);
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
?>
<script>
    var submit = document.querySelector('input[type="submit"]');
    var error_message = document.querySelector('#error_message');
    submit.addEventListener('click',function(e){
        error_message.innerHTML = "";
        var username = document.querySelector('#username');
        var password = document.querySelector('#password');
        if(username.value == "" && password.value == ""){
            error_message.innerHTML = "Enter a user name and password";
            e.preventDefault();
        }
        else 
            if(username.value == "" || password.value == ""){
            error_message.innerHTML = "Please fill out all the fields with * next to it";
            e.preventDefault();
            
        }
    });
</script>
</body>
</html>