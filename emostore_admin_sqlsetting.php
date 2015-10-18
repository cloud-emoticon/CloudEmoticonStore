<?php
	$db_host="uuumoedb.mysql.rds.aliyuncs.com:3838";
	$db_user="emoticonuser";
	$db_password="t7_PBTWzTbnUG0pEHUFcmEbN8zPhM_TS";
	$db_name="emoticonstore";
	$user_table="emostoreadmin";
	$data_table="emostore";
	$query="set names 'utf-8'";
	$keys = ["id","name","iconurl","postedon","introduction","creator","creatorurl","server","serverurl","dataformat","installurl","codeurl","usergroup"];
	$keynames = ["内部ID(只读)","颜文字源名称","图标网址","登记日期","简介","维护者","维护者网站","服务器","服务器提供网址","云颜文字数据格式","软件调用网址","源代码网址","呈现给用户组"];
	//<?php echo $footer; ? >
	$footer="<hr><center>源商店管理员后台 © 云颜文字团队 2015.<br>源商店 by 神楽坂雅詩,0wew0,神楽坂紫,KT.<br><a href=\"http://www.miitbeian.gov.cn/\" target=\"_blank\" title=\"此处为域名拥有者资料，并非内容提供者信息，请勿使用这些信息干扰他的生活，谢谢理解。如有问题请联系cxchope@163.com。\">京ICP备15023313号</a></center>";
?>