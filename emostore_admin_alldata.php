<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：数据库内容管理</title></head><body>
<center>云颜文字·源商店<h1>数据库内容管理</h1></center>
<center>当前登录的用户：
<?php
$pagenumber = 10;//一页内有多少条数据
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
or die("<hr><p><b>数据库连接失败</b></p>");
@mysql_select_db($db_name)
or die("<hr><p><b>选择数据库失败</b></p>");
$query = @mysql_query("select count(*) from `emoticonstore`.`emostore`")
or die("<hr><p><b>SQL语句执行失败，数据量检测失败。</b></p>");
$datacount = 0;
if($arr = mysql_fetch_array($query)) {
	echo "<hr>SQL数据库中共存储有 ".$arr[0]." 个颜文字源。</br></center>";
	$datacount = $arr[0];
}
$nowPageNumber = 1;
$maxpage = floor($datacount / $pagenumber);
$yu = $pagenumber;
if ($datacount % $pagenumber != 0) {
	$maxpage++;
	$yu = $datacount % $pagenumber;
}
if ($maxpage < 1) {
	$maxpage = 1;
}
if (isset($_GET["pagenumber"])) {
	$nowPageNumber = mysql_real_escape_string($_GET["pagenumber"]);
	if ($nowPageNumber < 1) {
		$nowPageNumber = 1;
	} else if ($nowPageNumber > $maxpage) {
		$nowPageNumber = $maxpage;
	}
}
//（当前页页码-1）*每页条数+1
$formid = ($nowPageNumber-1)*$pagenumber;
if ($yu > $datacount) {
	$yu = $datacount;
}
$sql2 = "select * from `emoticonstore`.`emostore` order by id desc limit ".$formid.",".$pagenumber.";";
if ($nowPageNumber >= $maxpage) {
	$sql2 = "select * from `emoticonstore`.`emostore` order by id desc limit ".$formid.",".$yu.";";
}
// echo "<hr>".$sql2;
$query = @mysql_query($sql2)
or die("<hr><p><b>SQL语句执行失败，查询数据失败。</b></p>");
$arr = array();
while ($row=mysql_fetch_array($query)) {
	$arr[] = $row;
}
echo "<hr>";
$keys = ["id","name","iconurl","postedon","introduction","creator","creatorurl","server","serverurl","dataformat","installurl","codeurl"];
$keynames = ["内部ID(只读)","颜文字源名称","图标网址","登记日期","简介","维护者","维护者网站","服务器","服务器提供网址","云颜文字数据格式","软件调用网址","源代码网址"];
	for ($i =  0; $i < count($arr); $i++) {
		$arri = $arr[$i];
		echo "<form name=\"edit".$arri["id"]."\" method=\"post\" action=\"emostore_admin_edit_do.php\">";
		echo "<table border=0 align=\"center\" width=800><tbody><tr><td><img src=\"".$arri["iconurl"]."\" /></td><td></td><tr>";
		for ($j = 0; $j < count($keys); $j++) {
			$nowkey = $keys[$j];
			echo "<tr><td>".$keynames[$j]."</td>";
			$nowvalue = $arri[$nowkey];
			echo "<td><input type=\"text\" name=\"".$nowkey."\" value=\"".$nowvalue."\" size=100";
			if ($j == 0) {
				echo " readonly=\"readonly\"";
			}
			echo " /></td></tr>";
		}
		echo "<tr><td></td><td><input type=\"submit\" name=\"Submit\" value=\"修改这个源条目\" /></form>";
		echo "　<a href=\"emostore_admin_delete_do.php?id=".$arri["id"]."\">删除这个源条目</a></td></tr>";
		echo "</tbody></table>";
	}
?>
<hr><center>
<?php
// echo "<上一页　为分页代码预留的位置。　下一页>";

$maxpageNUM = array();
if ($nowPageNumber <= 1) {
		echo "《上一页　";
	} else {
		echo "<a href='emostore_admin_alldata.php?pagenumber=".($nowPageNumber-1)."'>《上一页</a>　";
	}
	for ($i=0; $i < $maxpage; $i++) { 
		$maxpageNUM[$i] = $i+1;

		if ($nowPageNumber != $i+1) {
			echo "<a href='emostore_admin_alldata.php?pagenumber=".$maxpageNUM[$i]."'>$maxpageNUM[$i]</a>";
		}else{
			echo "<b>$maxpageNUM[$i]</b>";
		}
		
		if ($i != $maxpage-1) {
			echo " ";
		}
	}
	if ($nowPageNumber >= $maxpage) {
		echo "　下一页》";
	} else {
		echo "　<a href='emostore_admin_alldata.php?pagenumber=".($nowPageNumber+1)."'>下一页》</a>";
	}
?>
</center><hr>
<form name="addnew" method="post" action="emostore_admin_add_do.php">
<table border=0 align="center" width=800><tbody>
<?php
$defvals = ["新增源条目","新建颜文字源","http://",date("Y-m-d",time()),"新增源","匿名","http://","www.","http://","XML1","cloudemoticon://","http://"];
		for ($j = 0; $j < count($keys); $j++) {
			echo "<tr><td>".$keynames[$j]."</td>";
			echo "<td><input type=\"text\" name=\"".$keys[$j]."\" value=\"".$defvals[$j]."\"";
			if ($j == 0) {
				echo " disabled=\"disabled\"";
			}
			echo " size=100 /></td></tr>";
		}
?>
<tr><td></td><td><input type="submit" name="Submit" value="新增一个源条目" />　<input type="reset" name="Reset" value="重新输入" /></td></tr>
</form></tbody></table>
<hr><center>
<b>应用源列表到API接口：</b>
<form name="addnew" method="get" action="emostore_admin_cache.php">
<input type="submit" name="Submit" value="刷新缓存" />
</form>
</center></body></html>