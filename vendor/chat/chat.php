<?php

require_once 'workerman/Autoloader.php';

$weServer = new \Workerman\Worker('websocket://192.168.1.254:3000');  //监听本机3000端口

//当有客户端连接事件时
$weServer->onConnect = function ($conn){
    echo '连接成功';
};

//直接设置所有连接的onMessage回调
$weServer->onMessage = function ($conn,$data)  {
    echo '信息回调';
};

$weServer->onError = function (){

};

$weServer->onClose = function (){

};

//运行服务器
$weServer->runAll();