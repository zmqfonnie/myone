<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:82:"F:\WorkProgram\laragon\www\myone\public/../application/index\view\layim\index.html";i:1577496958;}*/ ?>
<!doctype html>
<html>
<head>
    <meta charset="utf-8">
    <title>LayIM测试</title>
    <link rel="stylesheet" href="/static/layim/dist/css/layui.css" media="all">
</head>
<body style="background-color: #00e765">
<script src="/static/layim/dist/layui.js"></script>
<script>
    layui.use('layim', function(layim){
        //先来个客服模式压压精
        layim.config({
            brief: true //是否简约模式（如果true则不显示主面板）
        }).chat({
            name: '客服姐姐'
            ,type: 'friend'
            ,avatar: 'http://tp1.sinaimg.cn/5619439268/180/40030060651/1'
            ,id: -2
        });
    });
</script>
</body>
</html>