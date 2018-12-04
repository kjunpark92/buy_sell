<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Log In</title>
</head>
<body>
<?php
include('header.php');
?>
    <div>
        <form action="log_in.php" method="POST">
            Username : <input type="text" name="username" id="username"><br>
            Password : <input type="password" name="password" id="password"><br>
            <input type="submit" value="Log In">
        </form>
        <div id="error_message"></div>
    </div>
<?php
include('footer.php');
?>
<?php
include('db.php');
if(!empty($_POST['username']) AND !empty($_POST['password'])){
    $username = $_POST['username'];
    $password = $_POST['password'];
    $req = $db->prepare('SELECT Username, Password FROM users WHERE Username = :Username');
    $req->execute(array(
    'Username' => $username));
    $result = $req->fetch();
    $isPasswordCorrect = password_verify($password, $result['Password']);
    if($isPasswordCorrect){
        header ('location: ../index.php');
    }
    else {
        echo "Your user name or password is wrong!";
    }
}
?>
<script>
    var submit = document.querySelector('input[type="submit"]');
    var error_message = document.querySelector('#error_message');
    console.log(submit);
    submit.addEventListener('click',function(e){
        error_message.innerHTML = "";
        var username = document.querySelector('#username');
        var password = document.querySelector('#password');
        console.log(submit);
        console.log(username);
        if(username.value == "" || password.value == ""){
            console.log("test");
            error_message.innerHTML = "Enter a user name and password";
            e.preventDefault();
        }
    });
</script>
</body>
</html>