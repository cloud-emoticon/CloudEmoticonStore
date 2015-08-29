<?php
unset($_SESSION['username']);
unset($_SESSION['passcode']);
unset($_SESSION['userflag']);
echo "已注销"."<a href='login.html'>返回登录</a>";
?>