<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>云颜文字·源商店：内容测试</title>
</head>
<body>
当前登录的用户：
<?php
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['userflag'] == 1) {
		echo "管理员：".$_SESSION['username']."。<a href='emostore_admin_logout.php'>注销</a>";
	}
	if ($_SESSION['userflag'] == 0) {
		echo "标准用户：".$_SESSION['username']."。<a href='emostore_admin_logout.php'>注销</a>";
	}
}else{
	echo "没有登录任何用户，<a href='login.html'>请先登录</a>。";
}
echo "<h1>源商店内容测试</h1>";
include 'emostore_admin_sqlsetting.php';
@mysql_connect($db_host,$db_user,$db_password)
or die("数据库连接失败");
@mysql_select_db($db_name)
or die("选择数据库失败");
$query = @mysql_query("select count(*) from `emoticonstore`.`emostore`")
or die("SQL语句执行失败1");
$datacount = 0;
if($arr = mysql_fetch_array($query)) {
	echo "SQL数据库中共存储有 ".$arr[0]." 个颜文字源。</br>";
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
		for ($j = 0; $j < count($keys); $j++) {
			$nowkey = $keys[$j];
			echo "</br>".$keynames[$j]."：";
			print_r($arri[$nowkey]);
		}
		echo "</br><a href=\"emostore_admin_delete.php?id=".$arri["id"]."\">删除数据</a>";
		echo "<hr>";
	}
// }
?>
<p><a href="emostore_admin_add.php">新增数据</a></p>
</body>
</html>