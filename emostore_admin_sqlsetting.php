<?php
	$user_table="emostoreadmin";
	$data_table="emostore";
	$query="set names 'utf-8'";
	$keys = ["id","name","iconurl","postedon","introduction","creator","creatorurl","server","serverurl","dataformat","installurl","codeurl","usergroup"];
	$keynames = ["内部ID(只读)","颜文字源名称","图标网址","登记日期","简介","维护者","维护者网站","服务器","服务器提供网址","云颜文字数据格式","软件调用网址","源代码网址","呈现给用户组"];
	//<?php echo $footer; ? >
	$footer="<hr><center>源商店管理员后台 © 云颜文字团队 2015.<br>源商店 by 神楽坂雅詩,0wew0,神楽坂紫,KT</center>";

	function db_connect() {
		$db_host="_____";
		$db_port=3000;
		$db_user="_____";
		$db_password="_____";
		$db_name="_____";

		/* $con=mysql_connect($db_host,$db_user,$db_password,$db_name,$db_port);
		$sqlerrno = mysqli_connect_errno($con);
		if ($sqlerrno) {
			die('数据库操作失败。');
		}
		return $con; */
		
		/* $con = mysqli_init();
		mysqli_real_connect($con,$db_host,$db_user,$db_password,false,$db_port);
		mysqli_errno($con)!=0 && die('数据库连接失败。'.$mysqli->error);
		if (!$con) {
			die('数据库操作失败。'.$mysqli->error);
		}
		if (!@mysqli_select_db($con,$db_name)) {
			die('无法使用数据库。'.$mysqli->error);
		}
		return $con; */

		$con = mysqli_connect($db_host.":".$db_port,$db_user,$db_password,$db_name);
		if (mysqli_connect_errno($con)) 
		{
			echo "连接数据库失败: ".mysqli_connect_error(); 
		}
		return $con;
	}
?>