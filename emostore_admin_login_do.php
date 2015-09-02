<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：用户登录信息</title></head><body>
<center>云颜文字·源商店<h1>用户登录信息</h1>
<?php
include 'emostore_admin_sqlsetting.php';
@mysql_connect($db_host,$db_user,$db_password)
or die("数据库连接失败");
@mysql_select_db($db_name)
or die("选择数据库失败");
//获取输入的信息
$username = $_POST['username'];
$passcode = $_POST['passcode'];
$backurl = "";
//获取session的值
$passwd = md5(md5($passcode));
$query = @mysql_query("select username,userflag from $user_table where username = '$username' and passcode = '$passwd'")
or die("SQL语句执行失败");
//判断用户以及密码
if($row = mysql_fetch_array($query))
{
    session_start();
    //判断权限
    echo "登录成功~!";
    $_SESSION['username'] = $row['username'];
    $_SESSION['userflag'] = $row['userflag'];
    if($row['userflag'] == 1 or $row['userflag'] == 0){
        echo "<p>欢迎您，管理员 ".$row['username']."。</p>";
    }else{
        echo "<p>欢迎您，用户 ".$row['username']."。</p>";
    }
}else{
    echo "用户名或密码不正确";
}
    if (isset($_POST['backurl'])) {
        echo "<p><a href='".$_POST['backurl']."'>返回登录前页面</a></p>";
        echo "<meta http-equiv=\"Refresh\" content=\"3;URL=".$_POST['backurl']."\">";
    }
?></center><?php echo $footer; ?></body></html>