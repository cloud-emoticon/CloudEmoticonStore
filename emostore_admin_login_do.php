<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：用户登录信息</title></head><body>
<center>云颜文字·源商店<h1>用户登录信息</h1>
<?php
session_start();
include 'emostore_admin_sqlsetting.php';
if(isset($_POST["validate"]) && isset($_POST["validate2"])){
    $validate=$_POST["validate"];
    $validate2=$_POST["validate2"];
    if(!isset($_SESSION["authnum_session"])) {
        die("<p>验证码校验失败</p>");
    }
    $va = strtoupper($validate);
    $vb = strtoupper($_SESSION["authnum_session"]);
    $va2 = strtoupper($validate2);
    $vb2 = "POI";
    if($va!=$vb || $va2!=$vb2){
        //echo "<br>validate = ".$validate;
        //echo "<br>_SESSION = ".$_SESSION["authnum_session"];
        die("<p>验证码不正确</p>");
    }
} else {
    die("<p>参数不正确</p>");
}

$con = db_connect();
//获取输入的信息
$username = $_POST['username'];
$passcode = $_POST['passcode'];
$backurl = "";
//获取session的值
$passwd = md5(md5($passcode));
$sql = "select username,userflag from $user_table where username = '$username' and passcode = '$passwd'";
// $query = mysqli_query($con,$sql);
$query = mysqli_query($con,$sql);
//判断用户以及密码
if($row = mysqli_fetch_array($query))
{
    //判断权限
    echo "<p>登录成功~!</p>";
    $_SESSION['username'] = $row['username'];
    $_SESSION['userflag'] = $row['userflag'];
    if($row['userflag'] == 1 or $row['userflag'] == 0){
        echo "<p>欢迎您，管理员 ".$row['username']."。</p>";
    }else{
        echo "<p>欢迎您，用户 ".$row['username']."。</p>";
    }
}else{
    echo "<p>用户名或密码不正确</p>";
}
    if (isset($_POST['backurl'])) {
        echo "<p><a href='".$_POST['backurl']."'>返回登录前页面</a></p>";
        // echo "<meta http-equiv=\"Refresh\" content=\"3;URL=".$_POST['backurl']."\">";
    }
    mysqli_close($con);
?></center><?php echo $footer; ?></body></html>