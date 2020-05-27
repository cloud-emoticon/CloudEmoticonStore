[Deprecated]

# 云颜文字·源商店

云颜文字源商店的后台管理脚本，适用于 PHP7 。

## 功能说明

- emostore_admin_add_do.php：添加数据
- emostore_admin_alldata.php：数据库内容管理
- emostore_admin_cache.php：创建APP接口缓存
- emostore_admin_delete_do.php：删除数据
- emostore_admin_edit_do.php：修改数据
- emostore_admin_login_do.php：用户登录信息
- emostore_admin_login_ui.php：用户登录页面
- emostore_admin_loginstatus.php：检查登录状态
- emostore_admin_logout.php：登出用户
- emostore_admin_md5test.php：（测试用）MD5测试
- emostore_admin_sqlsetting.php：数据库连接设定
- emostore_user_regcheck.php：注册新用户
- index.php：自动登录和跳转
- login.html：登录页
- pagenumber.php：页码分割
- signup.html：注册新用户
- sqlnote.sql：数据库命令笔记
- validate_code.class.php、validate_image.php：验证码库

## 操作步骤

- 前往后台管理服务器中的 admin.php 页。
- 登录并在各模块中进行源条目的 增、删、改、查 。
- 点击刷新缓存，emostore.xml、emostore.json、emostore.ylt、updatetime.txt、phparray.txt、index.html 将被创建。
- 点击分发，这些内容将被复制到生产服务器。

备注：后台管理页面目前没有头像上传功能，目前请用FTP手动传图代替。
