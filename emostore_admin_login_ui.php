<!DOCTYPE html>
<html><head><meta charset="utf-8"><title>云颜文字·源商店：用户登录页面</title></head><body>
<center>云颜文字·源商店<h1>用户登录</h1></center>
<form name="yashilogin" method="post" action="emostore_admin_login_do.php">
    <div style="width:353">
        <dl>
            <dt></dt>
            <dd>
                <div align="center">
                    用户名：
                    <input type="text" name="username"/>
                </div>
            </dd>
            <dd>
                <div align="center">
                    密　码：
                    <input type="password" name="passcode"/>
                </div>
            </dd>
            <dd>
                <p align="center">
                <input type="text" name="backurl" hidden=true value=<?php
                if (isset($_GET['backurl'])) {
                    $backurl = $_GET['backurl'];
                    echo "\"".$backurl."\"";
                } else if (isset($_POST['backurl'])) {
                    $backurl = $_POST['backurl'];
                    echo "\"".$backurl."\"";
                }
                ?> />
                    <input type="submit" name="Submit" value="登录用户" />
                    <input type="reset" name="Reset" value="清除输入" />
                    <?php
                    if (isset($backurl)) {
                    echo "<a href='".$backurl."'>取消</a>";
                    }
                    ?>
                </p>
            </dd>
        </dl>
    </div>
</form>
</body></html>