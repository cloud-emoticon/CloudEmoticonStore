<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>源商店内容测试</title>
</head>
<body>
<?php
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
// print_r($arr);
echo "<hr>";
// if($arr = mysql_fetch_array($query)) {
// 	echo count($arr)."行<br/>";
// 	// foreach ($arr as $key => $value) { 
// 	// 	echo $key.": ".$value."<br />";
// 	// }
$keys = ["id","name","iconurl","postedon","introduction","creator","creatorurl","server","serverurl","dataformat","installurl","codeurl"];
$keynames = ["序号","颜文字源名称","图标网址","登记日期","简介","维护者","维护者网站","服务器","服务器提供网址","云颜文字数据格式","软件调用网址","源代码网址"];
	for ($i = count($arr) - 1; $i >= 0; $i--) {
		$arri = $arr[$i];
		for ($j = 0; $j < count($keys); $j++) {
			$nowkey = $keys[$j];
			echo "</br>".$keynames[$j]."：";
			print_r($arri[$nowkey]);
		}
		// echo $arri[name];
		// print_r($arri);
		// print_r($arri['name']);
		echo "<hr>";
		// echo "<p></p>";
	}
// }
?>
</body>
</html>