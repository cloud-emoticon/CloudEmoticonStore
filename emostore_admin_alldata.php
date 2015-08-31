<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：数据库内容管理</title></head><body>
<center>云颜文字·源商店<h1>数据库内容管理</h1></center>
<center>当前登录的用户：
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
@mysql_connect($db_host,$db_user,$db_password)
or die("数据库连接失败");
@mysql_select_db($db_name)
or die("选择数据库失败");
$query = @mysql_query("select count(*) from `emoticonstore`.`emostore`")
or die("SQL语句执行失败1");
$datacount = 0;
if($arr = mysql_fetch_array($query)) {
	echo "<hr>SQL数据库中共存储有 ".$arr[0]." 个颜文字源。</br></center>";
}
$query = @mysql_query("select * from emostore")
or die("SQL语句执行失败2");
$arr = array();
while ($row=mysql_fetch_array($query)) {
	$arr[] = $row;
}
echo "<hr>";
$keys = ["id","name","iconurl","postedon","introduction","creator","creatorurl","server","serverurl","dataformat","installurl","codeurl"];
$keynames = ["内部ID","颜文字源名称","图标网址","登记日期","简介","维护者","维护者网站","服务器","服务器提供网址","云颜文字数据格式","软件调用网址","源代码网址"];
	for ($i = count($arr) - 1; $i >= 0; $i--) {
		$arri = $arr[$i];
		echo "<form name=\"edit".$arri["id"]."\" method=\"get\" action=\"emostore_admin_edit_do.php\">";
		echo "<table border=0 align=\"center\" width=800><tbody><tr><td><img src=\"".$arri["iconurl"]."\" /></td><td></td><tr>";
		for ($j = 0; $j < count($keys); $j++) {
			$nowkey = $keys[$j];
			echo "<tr><td>".$keynames[$j]."</td>";
			$nowvalue = $arri[$nowkey];
			echo "<td><input type=\"text\" name=\"txt".$nowkey."\" value=\"".$nowvalue."\" size=100";
			if ($j == 0) {
				echo " disabled=\"disabled\"";
			}
			echo " /></td></tr>";
		}
		
		echo "<tr><td></td><td><input type=\"submit\" name=\"Submit\" value=\"修改这个源条目\" /></form>";
		echo "　<a href=\"emostore_admin_delete_do.php?id=".$arri["id"]."\">删除这个源条目</a></td></tr>";
		echo "</tbody></table><hr>";
	}
?>
<form name="fangbei" method="post" action="emostore_admin_add_do.php">
<table border=0 align="center" width=800><tbody>
<?php
		for ($j = 0; $j < count($keys); $j++) {
			echo "<tr><td>".$keynames[$j]."</td>";
			echo "<td><input type=\"text\" name=\"txtadd\"";
			if ($j == 0) {
				echo " disabled=\"disabled\" value=\"新增源条目\"";
			}
			echo " size=100 /></td></tr>";
		}
?>
<tr><td></td><td><input type="submit" name="Submit" value="新增一个源条目" />　<input type="reset" name="Reset" value="重新输入" /></td></tr>
</form></tbody></table>
<hr><center>© CloudEmoticonTeam 2015</center></body></html>