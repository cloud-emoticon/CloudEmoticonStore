<?php
	$pagenumber = 2;//一页内有多少条数据

	$pageAll = mysqli_query("select count(*) from `emoticonstore`.`emostore`")
	or die("SQL语句执行失败");
	// mysqli_close($linkID);
	$page = $pageAll / $pagenumber;
	if ($pageAll % $pagenumber != 0) {
		$page++;
	}
	$pageNUM = array();
	$nowPageNumber = 1;
	if (isset($_GET["pagenumber"])) {
		$nowPageNumber = $_GET["pagenumber"];
	}
	if ($nowPageNumber <= 1) {
		echo "《上一页";
	} else {
		echo "<a href='emostore_admin_alldata.php?pagenumber=".($nowPageNumber-1)."'>《上一页</a>";
	}
	for ($i=0; $i < $page; $i++) { 
		$pageNUM[$i] = $i+1;

		if ($nowPageNumber != $i+1) {
			echo "<a href='emostore_admin_alldata.php?pagenumber=".$pageNUM[$i]."'>$pageNUM[$i]</a>";
		}else{
			echo "$pageNUM[$i]";
		}
		
		if ($i != $page-1) {
			echo " ";
		}
	}
	if ($nowPageNumber >= $page) {
		echo "下一页》";
	} else {
		echo "<a href='emostore_admin_alldata.php?pagenumber=".($nowPageNumber-1)."'>下一页》</a>";
	}
	printf($pageNUM);
?>