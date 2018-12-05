<link rel="stylesheet" href="../style/style.css">

<?php
    include('./header.php');
    include('./db.php');
    
$login_form = "
<br/><br/><br/>
<div>
    <form action='./log_in.php' method='POST'>
        <label for='username'> Username : </label> <input type='text' name='username' id='username'> <br/><br/>
        <label for='password'> Password : </label> <input type='password' name='password' id='password'> <br/><br/>
        <label> Remember me : <input type= 'checkbox' name='remember' id='remember' checked ><br/><br/>
        <input type='submit' value='Log In'>
    </form>
</div>";


    echo $login_form;

    $username = $_POST['username'];

    $req = $db -> prepare("SELECT id, password FROM users WHERE username= :username");
    $req -> execute(array(
        'username' => $username
    ));
    $result = $req->fetch();
    
    $isPasswordCorrect = password_verify($_POST['password'], $result['password']);
        
        if ($_POST['password']){
            if ($isPasswordCorrect) {
                $_SESSION['id'] = $result['id'];
                $_SESSION['username'] = $username;
                if (isset($_POST['remember'])){
                    setcookie("username",$username, time()+3600);
                    setcookie("id", $result['id'], time()+3600);
                }
                header("Location:../index.php");
                
            } 
            else {
                echo '<br/> Wrong ID or password !';
            }
        }
    
    


?>
