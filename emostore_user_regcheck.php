<?php
include 'emostore_admin_sqlsetting.php';
	if (isset($_POST["Submit"]) && $_POST["Submit"] == "注册") {
		if ($_POST["username"] == "" || $_POST["password"] == "" || $_POST["confirm"] == "") {
			echo "<script>alert('请确认信息完整性！'); history.go(-1);</script>";
		}else{  
            if($_POST["password"] == $_POST["confirm"]){  
@mysql_connect($db_host,$db_user,$db_password)
or die("数据库连接失败");
@mysql_select_db($db_name)
or die("选择数据库失败");
                // mysql_query($query); //设定字符集  
                $sql = "select username from user where username = '$_POST[username]'"; //SQL语句  
                $result = mysql_query($sql);    //执行SQL语句  
                $num = mysql_num_rows($result); //统计执行结果影响的行数  
                if($num)    //如果已经存在该用户  
                {  
                    echo "<script>alert('用户名已存在'); history.go(-1);</script>";  
                }  
                else    //不存在当前注册用户名称  
                {  
                    $pw = md5(md5($_POST[password]));
                    $sql_insert = "insert into emostoreadmin (username,passcode,userflag) values('$_POST[username]','$pw','0')";
                    $res_insert = mysql_query($sql_insert);  
                    //$num_insert = mysql_num_rows($res_insert);  
                    if($res_insert)  
                    {  
                        echo "<script>alert('注册成功！'); history.go(-1);</script>";  
                    }  
                    else  
                    {  
                        echo "<script>alert('系统繁忙，请稍候！'); history.go(-1);</script>";  
                    }  
                }  
            }  
            else  
            {  
                echo "<script>alert('密码不一致！'); history.go(-1);</script>";  
            }  
        }  
	}
?>