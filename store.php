<?php
include 'emostore_admin_sqlsetting.php';
$keys = ["id","name","iconurl","postedon","introduction","creator","creatorurl","server","serverurl","dataformat","installurl","codeurl"];
@mysql_connect($db_host,$db_user,$db_password)
or die("ERROR=数据库连接失败");
@mysql_select_db($db_name)
or die("ERROR=选择数据库失败");
$sql = "select * from `emoticonstore`.`emostore`";
$query = @mysql_query($sql)
or die("ERROR=SQL语句执行失败，查询数据失败。");
while ($row=mysql_fetch_array($query)) {
	$arr[] = $row;
}
toXml($arr,$keys);

function toXml($arr,$keys)
{
	$data = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	for ($i =  0; $i < count($arr); $i++) {
		$arri = $arr[$i];
		$data = $data."<source id=".$arri["id"].">";
		for ($j = 1; $j < count($keys); $j++)
		{
			$nowkey = $keys[$j];
			$nowvalue = $arri[$nowkey];
			$data = $data."<".$keys[$j].">".$nowvalue."</".$keys[$j].">";
		}
		$data = $data."</source>";
		echo $data;
	}
}
?>