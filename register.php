<?php
    session_start();
    //connect to database
    $db = mysqli_connect("localhost", "root", "", "authentic");

    if(isset($_POST["resigter-btn"])){
        $username = mysqli_real_escape_string($db ,$_POST['username']);
        $email = mysqli_real_escape_string($db ,$_POST['email']);
        $password = mysqli_real_escape_string($db, $_POST['password']);
        $password2 = mysqli_real_escape_string($db, $_POST['password2']);

        if($password == $password2){
            //create user
            $password = md5($password); //ma hoa mat khau
            $sql = "INSERT INTO users(username, email, password) VALUES ('$username', '$email', '$password')";
            mysqli_query($db, $sql);
            $_SESSION['message'] = "You are now logged in";
            $_SESSION['username'] = $username;
            header("location: home.php"); // chuyen huong ve trang chu
        }else{
            //false
            $_SESSION['message'] = "The two password do not match";
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
                <td>Email : </td>
                <td><input type="email" name="email" class="textinput"></td>
            </tr>
            <tr>
                <td>Password : </td>
                <td><input type="password" name="password" class="textinput"></td>
            </tr>
            <tr>
                <td>Password submit : </td>
                <td><input type="password" name="password2" class="textinput"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="resigter-btn" value="Register" class="button"></td>
            </tr>
        </table>
    </form>
</body>
</html>