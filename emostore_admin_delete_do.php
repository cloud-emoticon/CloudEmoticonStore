<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：删除数据</title></head><body>
<center>云颜文字·源商店<h1>删除数据</h1></center>
<?php
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['userflag'] == 1) {
		echo "管理员：".$_SESSION['username']."。<a href='emostore_admin_logout.php?backurl=".$_SERVER['PHP_SELF']."'>注销</a>。";
	}
	if ($_SESSION['userflag'] == 0) {
		echo "标准用户：".$_SESSION['username']."。<a href='emostore_admin_logout.php?backurl=".$_SERVER['PHP_SELF']."'>注销</a>。";
		die("<hr><p><b>访问受限：</b>必须使用管理员账户登录才可以继续哦。</p>");
	}
}else{
	echo "没有登录任何用户，请先<a href='emostore_admin_login_ui.php?backurl=".$_SERVER['PHP_SELF']."'>登录</a>。";
	die("<hr><p><b>访问受限：</b>必须使用管理员账户登录才可以继续哦。</p>");
}
include 'emostore_admin_sqlsetting.php';
$linkID = db_connect();
$id = "0";
if (isset($_GET["id"])) {
	$id = mysqli_real_escape_string($linkID,$_GET["id"]);
} else if (isset($_POST["id"])) {
	$id = mysqli_real_escape_string($linkID,$_POST["id"]);
} else {
	die("<hr><p><b>请求参数错误。</p>");
}
$sql = "delete from `emostore` where `id`=".$id.";";
$query = mysqli_query($linkID,$sql)
or die("<p><b>SQL语句执行失败。</b></p>");
mysqli_close($linkID);
echo "<p><b>条目删除成功。</b></p>";
?><p><a href="emostore_admin_alldata.php">返回源列表</a>
<meta http-equiv="Refresh" content="3;URL=emostore_admin_alldata.php">
</p><?php echo $footer; ?></body></html>