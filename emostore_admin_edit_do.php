<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：修改数据</title></head><body>
<center>云颜文字·源商店<h1>修改数据</h1></center>
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
$isok = true;
echo "<hr><table border=0 align=\"center\" width=800><tbody>";
$sql = "update `emostore` set ";
for ($i = 0; $i < count($keys); $i++) {
	$nowkey = mysqli_real_escape_string($linkID,$keys[$i]);
    if (isset($_POST[$nowkey])) {
    	$nowval = mysqli_real_escape_string($linkID,$_POST[$nowkey]);
    	echo "<tr><td>".$nowkey."</td><td>".$nowval."</td></tr>";
    	$sql = $sql."`".$nowkey."`='".$nowval."',";
    } else {
    	echo "找不到参数：".$nowkey."。</br>";
    	$isok = false;
    }
}
$sql = substr($sql, 0,strlen($sql)-1);
echo "</tbody></table><hr>";
$sql = $sql." where `id`=".mysqli_real_escape_string($linkID,$_POST["id"]).";";
if ($isok == false) {
    die("<hr><p><b>参数不正确，提交修改中止。</b></p>");
}
//echo $sql."<hr>";
$query = mysqli_query($linkID,$sql)
or die("<p><b>SQL语句执行失败。</b></p>");
mysqli_close($linkID);
echo "<p><b>条目修改成功。</b></p>";
// $query = @mysql_query("select count(*) from `emoticonstore`.`emostore`")
// or die("<hr><p><b>SQL语句执行失败1</p>");
?><p><a href="emostore_admin_alldata.php">返回源列表</a>
<meta http-equiv="Refresh" content="3;URL=emostore_admin_alldata.php">
</p><?php echo $footer; ?></body></html>