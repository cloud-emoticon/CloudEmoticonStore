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
$xmldata = toXml($arr,$keys);
$jsondata = toJson($arr,$keys);
$yltdata = toYlt($arr,$keys);

//Extensible Markup Language
function toXml($arr,$keys)
{
	$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?>";
	for ($i =  0; $i < count($arr); $i++) {
		$arri = $arr[$i];
		$xml = $xml."<source id=".$arri["id"].">";
		for ($j = 1; $j < count($keys); $j++)
		{
			$nowkey = $keys[$j];
			$nowvalue = $arri[$nowkey];
			$xml = $xml."<".$keys[$j].">".$nowvalue."</".$keys[$j].">";
		}
		$xml = $xml."</source>";
		return $xml;
	}
}

//JavaScript Object Notation
function toJson($arr,$keys)
{
	$json = "[";
	for ($i =  0; $i < count($arr); $i++) {
		$arri = $arr[$i];
		$json = $json."{";
		for ($j = 0; $j < count($keys); $j++)
		{
			$nowkey = $keys[$j];
			$nowvalue = $arri[$nowkey];
			$json = $json."\"".$keys[$j]."\":\"".$nowvalue."\",";
		}
		$json = substr($json, 0, -1);
		$json = $json."},";
	}
	$json = substr($json, 0, -1);
	$json = $json."]";
	return $json;
}

//Yashi Lightweight Table
function toYlt($arr,$keys) {
	$ylt = "|#t|main|#c";
	for ($j = 1; $j < count($keys); $j++) {
		$nowkey = $keys[$j];
		$ylt = $ylt."|".$nowkey;
	}
	for ($i =  0; $i < count($arr); $i++) {
		$arri = $arr[$i];
		$ylt = $ylt."|#r";
		for ($j = 0; $j < count($keys); $j++)
		{
			$nowkey = $keys[$j];
			$nowvalue = $arri[$nowkey];
			$ylt = $ylt."|".$nowvalue;
		}
	}
	return $ylt;
}
?>