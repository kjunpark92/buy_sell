<?php
session_start();
?>
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
    /*
    ******************************
    Edit management situation
    *****************************
    */

    // setting of the prefill form if the user is already logged in
    $username_edit = '';
    $gender_edit = '';
    $phone_edit = '';
    $email_edit = '';
    $address_edit = '';
    $edit = '';
    $submitValue = 'Register';
    $action = "registration.php";
    $confirmation = "Passsword Confirmation";

    if(isset($_SESSION['id'])) {
        $user_id = $_SESSION['id'];
        $req = $db->prepare('SELECT * FROM users WHERE id = :user_id');
        $req -> execute(array( 'user_id' => $user_id ));
        $data = $req -> fetch();
        $username_edit= $data['username'];
        $gender_edit = $data['gender'];
        $phone_edit = $data['phone'];
        $email_edit = $data['email'];
        $address_edit = $data['address'];
        $submitValue = 'Save';
        $district_town = implode('-', Array($data['district'], $data['town']));
        $action = "registration.php?id=".$user_id;
        $confirmation = "New Password Confirmation";
    }

    /*
    ******************************
    Add management situation
    *****************************
    */
    if(!empty($_POST['username']) AND !empty($_POST['gender']) AND !empty($_POST['phone']) AND !empty($_POST['email']) AND !empty($_POST['address']) AND !empty($_POST['district_town']) AND !empty($_POST['password']) AND !empty($_POST['user_id'])){
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
        if($user_id) { 
            // we are in the edit situation
            $query = "UPDATE users SET username = '$username', gender = '$gender', phone = '$phone', email = '$email', address = '$address' WHERE id = $user_id";
            $submitValue = 'Save';
            
        } else {
            // By default the query is an insert
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
        // change the value of the button depending of the situation
        if ($action == "registration.php") {
            header ('location: log_in.php');
        }
        else {
            header ('location: profile.php');
        }
    }
    ?>
    <div>
        <form action="<?php echo $action; ?>" method="POST">
            <input type="hidden" name = "user_id" value="<?php echo $user_id; ?>"/>
            <span class="red_star">*</span><label for="username">Username : </label>
            <input type="text" name="username" id="username" value="<?php echo $username_edit; ?>"><br>
            <span class="red_star">*</span> Gender :
            <label for="male"> <input type="radio" name="gender" id="male" value="m" <?php echo ($gender_edit == 'm') ? 'checked="checked"' : ''; ?> >Male </label>
            <label for="female"> <input type="radio" name="gender" id="female" value="f" <?php echo ($gender_edit == 'f') ? 'checked="checked"' : ''; ?> >Female </label><br>
            <span class="red_star">*</span><label for="phone"> Phone : </label> 
            <input type="text" name="phone" id="phone" maxlength="11" value="<?php echo $phone_edit; ?>"><br>
            <span class="red_star">*</span><label for="email"> Email : </label>
            <input type="text" name="email" id="email" value="<?php echo $email_edit; ?>"><br>
            <span class="red_star">*</span><label for="address"> Address : </label>
            <input type="text" name="address" id="address" value="<?php echo $address_edit; ?>"><br>
            <span class="red_star">*</span><label for="district_town"> District/Town : </label>
                <select name="district_town" id="district_town" myOptionToSelect = " <?php echo $district_town;?>">
                    <optgroup label="Gangnam">
                        <option value="gangnam-apgujeong" >Apgujeong</option>
                        <option value="gangnam-sinsa" >Sinsa</option>
                        <option value="gangnam-samseong" >Samseong</option>
                    </optgroup>
                    <optgroup label="Yongsan">
                        <option value="yongsan-itaewon" >Itaewon</option>
                        <option value="yongsan-yongmun" >Yongmun</option>
                        <option value="yongsan-seobinggo" >Seobinggo</option>
                    </optgroup>
                    <optgroup label="Mapo">
                        <option value="mapo-gongdeok" >Gongdeok</option>
                        <option value="mapo-hapjeong" >Hapjeong</option>
                        <option value="mapo-sinsu">Sinsu</option>
                    </optgroup>
                </select><br>
            <span class="red_star">*</span><label for="password"> Password : </label>
            <input type="password" name="password" id="password"><br>
            <span class="red_star">*</span><label for="confirmation"><?php echo $confirmation; ?> :</label>
            <input type="password" id="confirmation" name="confirmation"><br>
            <input id="save" type="submit" value="<?php echo $submitValue; ?>">
        </form>
        <div id="error_message"></div>
    </div>
<?php include('footer.php');?>
<script src="../js/script.js"></script>
<script>
    // Disiplay errors on the check of the form
    var submit = document.querySelector('input[type="submit"]');
    var error_message = document.querySelector('#error_message');
    submit.addEventListener('click',function(e){
        error_message.innerHTML = "";
        var username = document.querySelector('#username');
        var phone = document.querySelector('#phone');
        var email = document.querySelector('#email');
        var address = document.querySelector('#address');
        var password = document.querySelector('#password');
        var confirmation = document.querySelector("#confirmation");
        if(username.value == "" || password.value == "" || phone.value == "" || email.value == "" || address.value == ""){
            error_message.innerHTML = "Please fill out all the fields with * next to it";
            e.preventDefault();
            }
        if ((password.value || confirmation.value) && (password.value != confirmation.value)) {
            error_message.innerHTML = 'Has to be identical to the first password';
            e.preventDefault();
        }
    });

    // treatment of the selection of the district town selection for edition
    var select = document.getElementById("district_town");
    townSelection(select);

    //comfirm password
    var password = document.querySelector('#password');
    var confirmation = document.querySelector("#confirmation");
    checkPassword(password,confirmation);
</script>
</body>
</html>