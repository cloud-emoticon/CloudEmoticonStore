<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：添加数据</title></head><body>
<center>云颜文字·源商店<h1>添加数据</h1></center>
<?php
include 'emostore_admin_sqlsetting.php';
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
@mysql_connect($db_host,$db_user,$db_password)
or die("<hr><p><b>数据库连接失败</p>");
@mysql_select_db($db_name)
or die("<hr><p><b>选择数据库失败</p>");
$isok = true;
echo "<hr><table border=0 align=\"center\" width=800><tbody>";
$sqlkey = "`";
$sqlval = "'";
for ($i = 1; $i < count($keys); $i++) {
	$nowkey = mysql_real_escape_string($keys[$i]);
    if (isset($_POST[$nowkey])) {
    	$nowval = mysql_real_escape_string($_POST[$nowkey]);
    	echo "<tr><td>".$nowkey."</td><td>".$nowval."</td></tr>";
    	$sqlkey = $sqlkey.$nowkey."`,`";
    	$sqlval = $sqlval.$nowval."','";
    } else {
    	echo "找不到参数：".$nowkey."。</br>";
    	$isok = false;
    }
}
$sqlkey = substr($sqlkey, 0,strlen($sqlkey)-2);
$sqlval = substr($sqlval, 0,strlen($sqlval)-2);
$sql = "insert `emostore`(".$sqlkey.") values(".$sqlval.");";
echo "</tbody></table><hr>";
if ($isok == false) {
    die("<hr><p><b>参数不正确，提交添加中止。</b></p>");
}
// echo $sql."<hr>";
$query = @mysql_query($sql)
or die("<p><b>SQL语句执行失败。</b></p>");
echo "<p><b>条目添加成功。</b></p>";
?><p><a href="emostore_admin_alldata.php">返回源列表</a>
<meta http-equiv="Refresh" content="3;URL=emostore_admin_alldata.php">
</p><?php echo $footer; ?></body></html>