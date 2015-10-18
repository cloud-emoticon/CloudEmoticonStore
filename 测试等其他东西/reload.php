<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：内容分发</title></head><body>
<center>云颜文字·源商店<h1>内容分发</h1></center>
<hr>
<?php
$starturl = "https://yoooooooooo.com/emoticon/store/";
$localdir = getcwd()."/";
$files = ["emostore.xml","emostore.json","emostore.ylt","updatetime.txt","phparray.txt","index.html"];
echo "<hr><p>开始下载资料到".$localdir."...</p>";
for ($i = 0; $i < count($files); $i++) {
	$nowfilename = $files[$i];
	$url = $starturl.$nowfilename;
	$local = $localdir.$nowfilename;
	file_put_contents($local,file_get_contents($url))
	or die("<hr><p><b>接收分发缓存 <a href=\"".$nowfilename."\" target=\"_blank\">".$nowfilename."</a> 失败。</b></p>");
	echo "<hr><p><b>接收分发缓存 <a href=\"".$nowfilename."\" target=\"_blank\">".$nowfilename."</a> 成功。</b></p>";
}
echo "<hr>操作结束。";
?></body></html>