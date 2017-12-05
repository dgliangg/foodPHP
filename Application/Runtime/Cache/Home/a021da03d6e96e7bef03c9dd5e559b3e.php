<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>thinkphp测试</title>
</head>
<body>
<div>
    <div>
        <h1>登录</h1>
        <h3>欢迎使用在线music</h3>
        <form id="form" name="form" method="post" action="<?php echo U('te2');?>"  autocomplete="off">
            <div>
                <input name="username" type="text" placeholder="用户名" >
            </div>
            <div>
                <input name="password" type="password" placeholder="密码">
            </div>

            <button type="submit">登 录</button>
        </form>
        <div>
            <a href="te2.html">
                <button type="button">跳转</button>
            </a>
        </div>
    </div>
</div>
</body>
</html>