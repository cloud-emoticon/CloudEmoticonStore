<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：创建APP接口缓存</title></head><body>
<center>云颜文字·源商店<h1>创建APP接口缓存</h1></center>
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
$keys = ["id","name","iconurl","postedon","introduction","creator","creatorurl","server","serverurl","dataformat","installurl","codeurl"];
@mysql_connect($db_host,$db_user,$db_password)
or die("<hr><p><b>数据库连接失败</b></p>");
@mysql_select_db($db_name)
or die("<hr><p><b>选择数据库失败</b></p>");
$sql = "select * from `emoticonstore`.`emostore`";
$query = @mysql_query($sql)
or die("<hr><p><b>SQL语句执行失败，查询数据失败。</b></p>");
while ($row=mysql_fetch_array($query)) {
	$arr[] = $row;
}
$datetime = date("y-m-d h:i:s",time());
$xmldata = toXml($arr,$keys,$datetime);
savefile($xmldata,"emostore.xml");
$jsondata = toJson($arr,$keys);
savefile($jsondata,"emostore.json");
$yltdata = toYlt($arr,$keys);
savefile($yltdata,"emostore.ylt");
savefile($datetime,"updatetime.txt");
echo "<hr><a href=\"emostore_admin_alldata.php\">返回源管理</a>";

function savefile($data,$filename)
{
	$myfile = fopen($filename, "w")
	or die("<hr><p><b>创建缓存 <a href=\"".$filename."\" target=\"_blank\">".$filename."</a> 失败。</b></p>");
	fwrite($myfile, $data);
	fclose($myfile);
	echo "<hr><p>创建缓存 <a href=\"".$filename."\" target=\"_blank\">".$filename."</a> 成功。</p>";
}

//Extensible Markup Language
function toXml($arr,$keys,$datetime)
{
	$xml = "<?xml version=\"1.0\" encoding=\"UTF-8\"?><cloudemoticonstore updatetime=\"".$datetime."\">";
	for ($i =  0; $i < count($arr); $i++) {
		$arri = $arr[$i];
		$xml = $xml."<source id=\"".$arri["id"]."\">";
		for ($j = 1; $j < count($keys); $j++)
		{
			$nowkey = $keys[$j];
			$nowvalue = $arri[$nowkey];
			$xml = $xml."<".$keys[$j].">".$nowvalue."</".$keys[$j].">";
		}
		$xml = $xml."</source>";
	}
	$xml = $xml."</cloudemoticonstore>";
	return $xml;
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
?></body></html>