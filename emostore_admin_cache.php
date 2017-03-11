<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：创建APP接口缓存</title></head><body>
<center>云颜文字·源商店<h1>创建APP接口缓存</h1></center>
<?php
//
$relativepath = "userimg/"; //设置为"/"=当前层级文件夹。
$absolutepath = "http://emoticon.moe/store/"; //设为null可以使用相对路径。
//
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
$sql = "select * from `emoticonstore`.`emostore`";
$query = mysqli_query($linkID,$sql)
or die("<hr><p><b>SQL语句执行失败，查询数据失败。</b></p>");
while ($row=mysqli_fetch_array($query)) {
	$arr[] = $row;
}
/*

			if ($nowkey == "iconurl") {
				$nowvalue = $relativepath.$nowvalue;
				if ($isabsolutepath) {
					$nowvalue = $absolutepath.$nowvalue;
				}
			}
*/
mysqli_close($linkID);
// $keyerr = count($arr[0]) - count($keys);
// if ($keyerr != 0) {
// 	die("<hr><p><b>配置键值对不匹配，差异".$keyerr."。</b></p>");
// }
$datetime = date("y-m-d h:i:s",time());
$arr = addpath($arr,$relativepath,$absolutepath);
$xmldata = toXml($arr,$keys,$datetime,$furi);
savefile($xmldata,"emostore.xml");
$jsondata = toJson($arr,$keys,$furi);
savefile($jsondata,"emostore.json");
$yltdata = toYlt($arr,$keys);
savefile($yltdata,"emostore.ylt");
savefile($datetime,"updatetime.txt");
$padata = toPhparray($arr,$keys);
savefile($padata,"phparray.txt");
$padata = toHtml($arr,$keys,$datetime);
savefile($padata,"index.html");

echo "<hr><a href=\"emostore_admin_alldata.php\">返回源管理</a>　<b><a href=\"http://emoticon.moe/store/reload.php\">下一步:将内容分发到emoticon.moe</a></b>";

function addpath($arr,$relativepath,$absolutepath) {
	$newarr = [];
	for ($i =  0; $i < count($arr); $i++) {
		$arri = $arr[$i];
		$arri["iconurl"] = $relativepath.$arri["iconurl"];
		if ($absolutepath) {
			$arri["iconurl"] = $absolutepath.$arri["iconurl"];
		}
		$newarr[$i] = $arri;
	}
	return $newarr;
}

function savefile($data,$filename)
{
	$myfile = fopen($filename, "w")
	or die("<hr><p><b>创建缓存 <a href=\"".$filename."\" target=\"_blank\">".$filename."</a> 失败。</b></p>");
	fwrite($myfile, $data);
	fclose($myfile);
	echo "<hr><p>创建缓存 <a href=\"".$filename."\" target=\"_blank\">".$filename."</a> 成功。</p>";
}

//Extensible Markup Language
function toXml($arr,$keys,$datetime,$isabsolutepath)
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
function toJson($arr,$keys,$absolutepath)
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
	for ($h = 0; $h < count($keys); $h++) {
		$nowkey = $keys[$h];
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

//PHPArray
function toPhparray($arr,$keys) {
	$pa = "arr = ".serialize($arr).";;   keys = ".serialize($keys).";;   ";
	return $pa;
}

//HTML
function toHtml($arr,$keys,$datetime) {
	$htmla = "<!DOCTYPE HTML PUBLIC \"-//W3C//DTD HTML 4.01 Transitional//EN\" \"http://www.w3.org/TR/html4/loose.dtd\"><html><head><meta name=\"viewport\" http-equiv=\"Content-Type\" content=\"text/html; charset=UTF-8; initial-scale=1.0, maximum-scale=1.0, user-scalable=no, width=device-width\"><title>Cloud Emoticon Library</title><style type=\"text/css\">body{background-repeat:no-repeat;background-image:url()}</style></head><body bgcolor=\"#133518\" text=\"#CFCFCF\" link=\"#CFCFCF\" vlink=\"#CFCFCF\" alink=\"#FFFFFF\" leftmargin=\"0\" topmargin=\"0\" marginwidth=\"0\" marginheight=\"0\"><div id=\"web_bg\" style=\"position:absolute;width:100%;height:100%;z-index:-1\"><img style=\"position:fixed\" src=\"Background.jpg\" height=\"100%\" width=\"100%\"></div><table width=\"100%\" border=\"0\"><tbody><tr><td height=\"51\" colspan=\"3\" align=\"center\"><p><img src=\"logo.png\" width=\"300\" height=\"79\" alt=\"\"></p></td></tr>";
	$htmlc = "<tr><td colspan=\"3\" align=\"center\">(C) 云颜文字社区 2015 / 神楽坂雅詩<br>上次更新日期：".$datetime."<br><a href=\"https://yoooooooooo.com/emoticon/store/admin.php\" target=\"_blank\">后台管理</a>｜<a href=\"http://emoticon.moe/\" target=\"_blank\">项目主页</a></td></tr>";
	$htmlb = "";
	for ($i =  0; $i < count($arr); $i++) {
		$arri = $arr[$i];
		$htmlb = $htmlb."<tr><td width=\"120\"><img src=\"".$arri["iconurl"]."\" width=\"120\" height=\"120\" alt=\"\"/></td><td><h3>".$arri["name"]."</h3><p>".$arri["postedon"]." ".$arri["creator"]."<br>".$arri["dataformat"]." ".$arri["server"]."<br>".$arri["introduction"]."</p></td><td align=\"center\"><h3><a href=\"".$arri["installurl"]."\"><img src=\"plus.png\" width=\"28\" height=\"28\" alt=\"\"/></a></h3><p><a href=\"".$arri["codeurl"]."\"><img src=\"code.png\" width=\"36\" height=\"28\" alt=\"\"/></a></p></td></tr>";
	}
	return $htmla.$htmlb.$htmlc;
}
echo $footer;
?></body></html>