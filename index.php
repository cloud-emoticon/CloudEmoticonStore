<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：管理控制台</title></head><body>
<center>云颜文字·源商店<h1>管理控制台</h1></center>
<hr>
<?php
session_start();
$url = "";
if (isset($_SESSION['username'])) {
	if ($_SESSION['userflag'] == 1) {
		$url = "emostore_admin_alldata.php";
	}
	if ($_SESSION['userflag'] == 0) {
		$url = "emostore_admin_login_ui.php?backurl=emostore_admin_alldata.php";
	}
}else{
	$url = "emostore_admin_login_ui.php?backurl=emostore_admin_alldata.php";
}
echo "<meta http-equiv=\"Refresh\" content=\"1;URL=".$url."\">";
echo "<center><i><a href='".$url."'>正在加载</a></i></center>";
include 'emostore_admin_sqlsetting.php';
echo $footer;
?></body></html>