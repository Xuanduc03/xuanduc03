<?php
    session_start();
    $_SESSION['message'] ='You are now loged in';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title>Document</title>
    <style>
    
        .home{
            color : blueviolet;
            margin-top: 30px;
        }
        .welcome{
            color :brown;
            font-family:'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
    </style>
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
/*
tnd : ten nguoi dung
stg : so tien gui
lai : lai suat(%/ nam)
sng : so ngay thuc gui / 360
so_lai : so tien lai gui ko ky han
*/
$tnd = $stg = $lai = $sng = $so_lai = "";
if(isset($_POST['tenkhach'])){
    $tnd = trim($_POST['tenkhach']);
}else{
    $tnd = "";
}
if(isset($_POST['sotiengui'])){
    $stg = trim($_POST['sotiengui']);
}else{
    $stg = 0;
}
if(isset($_POST['laisuat'])){
    $lai = trim($_POST['laisuat']);
}else{
    $lai = 0;
}
if(isset($_POST['songaygui'])){
    $sng = trim($_POST['songaygui']);
}else{
    $sng = 0;
}
if(isset($_POST['tinh'])){
    if(is_numeric($stg) && is_numeric($lai) && ($sng < 365)){
        $so_lai = $stg * ($lai/100) * ($sng/360);
    }else{
        echo "<font color='red'>Giá trị không hợp lệ vui lòng nhập lại! </font>"; 
         $so_lai = "";
    }
}else{
    $so_lai = 0;
}
?>
<h1 class="home" align='center'>Home</h1>

    <div class="welcome">
        <h4 align='center' >Welcome <?php echo $_SESSION['username'] ?> This is home</h4>
        <h4 align='center'>Chương trình tính số tiền gửi lãi ngân hàng với ko kỳ hạn bạn có thể thử!!! </h4>
    </div>

    <form action="" method="POST" align="center">
    <table style="border: 1px solid black; background-color: pink;" align='center' >

    <tr bgcolor="orange">
        <th colspan="3" align="center">
            <h3><font color="brown">Tính lãi suất gửi tiết kiệm không kỳ hạn</font></h3>
        </th>
    </tr>

    <tr>
        <td>Tên người gửi : </td>
        <td><input type="text" name="tenkhach" value="<?php echo $tnd; ?>"/></td>
    </tr>
    <tr>
        <td>Số tiền gửi tiết kiệm : </td>
        <td><input type="text" name="sotiengui" value="<?php echo $stg; ?>"/></td>
        <td>(VNĐ)</td>
    </tr>
    <tr>
        <td>Lãi suất(%/năm) : </td>
        <td><input type="text" name="laisuat" value="<?php echo $lai; ?>"/></td>
        <td>(%)</td>
    </tr>
    <tr>
        <td>Số ngày gửi thực : </td>
        <td><input type="text" name="songaygui" value="<?php echo $sng; ?>"/></td>
        <td>(Ngày)</td>
    </tr>
    <tr>
        <td>Số tiền lãi : </td>
        <td><input type="text" name="sotien" disabled="disabled" value="<?php echo $so_lai; ?>"/></td>
        <td>(VNĐ)</td>
    </tr>
    <tr>
        <td colspan="3" style="text-align: center;"><input type="submit" name="tinh" value="Tính lãi suất"/></td>
    </tr>
    </table>
    </form>
<div align='center'><a href="logout.php">Logout</a></div>
<div align='center'><a href="register.php">New accout</a></div>
</body>
</html>