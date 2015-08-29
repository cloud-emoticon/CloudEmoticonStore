<?php
session_start();
if (isset($_SESSION['username'])) {
	if ($_SESSION['userflag'] == 1) {
		echo "欢迎管理员".$_SESSION['username']."登录";
	}
	if ($_SESSION['userflag'] == 0) {
		echo "欢迎用户".$_SESSION['username']."登录";
	}
}else{
	echo "您没有权限访问";
}
?>