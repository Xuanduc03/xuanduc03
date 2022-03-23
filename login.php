<?php
    session_start();
    //connect to database
    $db = mysqli_connect("localhost", "root", "", "authentic");

    if(isset($_POST["login-btn"])){
        $username = mysqli_real_escape_string($db, $_POST['username']);
        $password = mysqli_real_escape_string($db, $_POST['password']);

        $password = md5($password);
        $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
        $result = mysqli_query($db, $sql);

        if(mysqli_num_rows($result) == 1){
            $_SESSION['message'] ='You are now loged in';
            $_SESSION['username'] = $username;
            header("location: home.php");
        }else{
            $_SESSION['message'] ='Username/password combination incorrect';
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Register login</title>
</head>
<body>
    <div class="header">
        <h1>Form đăng ký - đăng nhập by php/Mysql</h1>
    </div>
<?php
    if(isset($_SESSION['message'])){
        echo "<div id='error-msg'>". $_SESSION['message']. "</div>";
        unset($_SESSION['message']);
    }
?>
    <form action="" method="post">
        <table>
            <tr>
                <td>Username : </td>
                <td><input type="text" name="username" class="textinput"></td>
            </tr>
            <tr>
                <td>Password : </td>
                <td><input type="password" name="password" class="textinput"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="login-btn" value="Login" class="button"></td>
            </tr>
        </table>
    </form>
</body>
</html>