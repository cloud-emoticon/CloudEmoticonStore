<?php
include 'emostore_admin_sqlsetting.php';
@mysql_connect($db_host,$db_user,$db_password)
or die("数据库连接失败");
@mysql_select_db($db_name)
or die("选择数据库失败");
//获取输入的信息
$username = $_POST['username'];
$passcode = $_POST['passcode'];
//获取session的值
$passwd = md5(md5($passcode));
$query = @mysql_query("select username,userflag from $user_table where username = '$username' and passcode = '$passwd'")
or die("SQL语句执行失败");
//判断用户以及密码
if($row = mysql_fetch_array($query))
{
    session_start();
    //判断权限
    if($row['userflag'] == 1 or $row['userflag'] == 0){
        $_SESSION['username'] = $row['username'];
        $_SESSION['userflag'] = $row['userflag'];
        echo "<a href='emostore_admin_loginstatus.php'>登录成功</a>";
    }else{
        echo "用户组不正确";
    }
}else{
    echo "用户名或密码不正确";
}
?>