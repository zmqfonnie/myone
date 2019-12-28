<?php if (!defined('THINK_PATH')) exit(); /*a:1:{s:79:"F:\WorkProgram\laragon\www\myone\public/../application/index\view\im\index.html";i:1577528147;}*/ ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Title</title>
    <link rel="stylesheet" href="/static/im/dist/css/layui.css">
</head>
<body>


<script src="/static/im/dist/layui.js"></script>
<script>

    //如果使用原生WebSocket，可以不用加载socket模块
    layui.use(['layim', 'layer', 'jquery'], function (layim) {
        var layer = layui.layer,
            $ = layui.jquery,
            socket = new WebSocket('ws://192.168.1.254:3000');


        socket.onmessage = function (e) {

            // json数据转换成js对象
            var data = eval("(" + e.data + ")");
            var type = data.type || '';
            switch (type) {
                // Events.php中返回的init类型的消息，将client_id发给后台进行uid绑定
                case 'init':
                    // 利用jquery发起ajax请求，将client_id发给后端进行uid绑定
                    $.post('bind', {client_id: data.client_id}, function (data) {
                    }, 'json');
                    break;
                case 'say':
                    console.log(e.data);
                    break;
                // 当mvc框架调用GatewayClient发消息时直接alert出来
                default :
                    alert(e.data);
            }
        };
    });


</script>
</body>
</html>