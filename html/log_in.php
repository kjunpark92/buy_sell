<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
    <link rel="stylesheet" href="../style/style.css">
    <link rel="stylesheet" href="../style/forms.css">
</head>
<body>
<?php
include('db.php');
include('header.php');
?>
<div class="wrapper_margin1">
    <div class="inner_wrapper">
    <h2>Log-In Information</h2><br>
        <form action="log_in.php" method="POST">
            <label for='username'> Username : </label> <input type='text' name='username' id='username' maxlength="11"> <br/>
            <label for='password'> Password : </label> <input type='password' name='password' id='password' maxlength="11"> <br/>
            <label> Remember me : <input type= 'checkbox' name='remember' id='remember' checked > <br/>
            <input type="submit" value="Log In">
        </form>
        <div id="error_message"></div>
    </div>
</div>
<?php
include('footer.php');
?>
<?php
    if(!empty($_POST['username']) AND !empty($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];
        $req = $db->prepare('SELECT id, username, password FROM users WHERE username = :username');
        $req->execute(array(
        'username' => $username));
        $result = $req->fetch();
        $isPasswordCorrect = password_verify($password, $result['password']);
        if($isPasswordCorrect){
            $_SESSION['user_id'] = $result['id'];
            $_SESSION['username'] = $username;
            
            if (isset($_POST['remember'])){
                setcookie("username",$username, time()+3600);
                setcookie("id", $result['id'], time()+3600);
            }
            
            // header ('location: ../index.php');
            header ('location: ./itempage.php?post_id=10');
        }
        else {
            echo "Your user name or password is wrong!";
        }
    }
?>
<script>
    var submit = document.querySelector('input[type="submit"]');
    var error_message = document.querySelector('#error_message');
    submit.addEventListener('click',function(e){
        error_message.innerHTML = "";
        var username = document.querySelector('#username');
        var password = document.querySelector('#password');
        if(username.value == "" || password.value == ""){
            error_message.innerHTML = "Enter a user name and password";
            e.preventDefault();
        }
    });
</script>
</body>
</html>
