<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：登出用户</title></head><body>
<center>云颜文字·源商店<h1>登出</h1>
<?php
session_start();
unset($_SESSION['username']);
unset($_SESSION['passcode']);
unset($_SESSION['userflag']);
echo "<p>已注销。</p>";
if (isset($_GET['backurl'])) {
    echo "<a href=\"".$_GET['backurl']."\">返回注销前页面</a>";
} else if (isset($_POST['backurl'])) {
    echo "<a href=\"".$_POST['backurl']."\">返回注销前页面</a>";
} else {
	echo "<a href='emostore_admin_login_ui.php'>重新登录</a>";
}
?></center></body></html>