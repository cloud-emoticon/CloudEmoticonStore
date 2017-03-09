<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：内容分发</title></head><body>
<center>云颜文字·源商店<h1>内容分发</h1></center>
<hr>
<?php
ini_set('display_errors', true);
error_reporting(E_ALL);
$starturl = "https://yoooooooooo.com/emoticon/store/";
$localdir = getcwd()."/";
$files = ["emostore.xml","emostore.json","emostore.ylt","updatetime.txt","phparray.txt","index.html"];
echo "<hr><p>开始下载资料到".$localdir."...</p>";
$debug = false;
if (isset($_GET["debug"])) {
	$debug = true;
}
for ($i = 0; $i < count($files); $i++) {
	$nowfilename = $files[$i];
	$url = $starturl.$nowfilename;
	$local = $localdir.$nowfilename;
	if (!$debug) {
		file_put_contents($local,file_get_contents($url))
		or die("<hr><p><b>接收分发缓存 <a href=\"".$nowfilename."\" target=\"_blank\">".$nowfilename."</a> 失败。</b></p>");
		echo "<hr><p><b>接收分发缓存 <a href=\"".$nowfilename."\" target=\"_blank\">".$nowfilename."</a> 成功。</b></p>";
	} else {
		echo "<hr><p><b>显示读取缓存 <a href=\"".$nowfilename."\" target=\"_blank\">".$nowfilename."</a> ：</b></p>";
		echo "<p>需要复制文件 ".$url." 到 ".$local." ：</p><p>";
		echo file_get_contents($url)."</p>";
	}
}
//兼容性: 1.0 商店路径
$cdir = getcwd()."/../";
$files = ["emostore.xml","emostore.json"];
$tfiles = ["store.xml","store.json"];
for ($i = 0; $i < count($files); $i++) {
	$nowfile = $localdir.$files[$i];
	$tofile = $cdir.$tfiles[$i];
	if (!$debug) {
		copy($nowfile,$tofile)
		or die("<hr><p><b>兼容分发缓存 ".$tfiles[$i]." 失败。</b></p>");
		echo "<hr><p><b>兼容分发缓存 ".$tfiles[$i]." 成功。</b></p>";
	} else {
		echo "<hr><p><b>需要兼容分发缓存 ".$nowfile." 到 ".$tofile." 。</b></p>";
	}
}
//兼容性 结束
?></body></html>