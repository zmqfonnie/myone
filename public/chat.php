<?php

require_once 'workerman/Autoloader.php';

$weServer = new \Workerman\Worker('webscoket://127.0.0.1:3000');  //监听本机3000端口

$weServer->onConnect = function (){

};