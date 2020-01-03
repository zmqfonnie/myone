<?php
/**
 * This file is part of workerman.
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the MIT-LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @author walkor<walkor@workerman.net>
 * @copyright walkor<walkor@workerman.net>
 * @link http://www.workerman.net/
 * @license http://www.opensource.org/licenses/mit-license.php MIT License
 */

/**
 * 用于检测业务代码死循环或者长时间阻塞等问题
 * 如果发现业务卡死，可以将下面declare打开（去掉//注释），并执行php start.php reload
 * 然后观察一段时间workerman.log看是否有process_timeout异常
 */
//declare(ticks=1);

use \GatewayWorker\Lib\Gateway;

/**
 * 主逻辑
 * 主要是处理 onConnect onMessage onClose 三个方法
 * onConnect 和 onClose 如果不需要可以不用实现并删除
 */
class Events
{
    public static $user = [];
    public static $uuid = [];
    public static function onWorkerStart($businessWorker)
    {   //服务准备就绪
        echo "Worker_socket_ready\n";
    }

    public static function onConnect($client_id)
    {
        //当客户端链接上时触发，这里可以做 session  域名来源排除 ，安全过滤等
        echo "$client_id\n";

    }


    public static function onMessage($client_id, $message)
    {

        /*监听事件，需要把客户端发来的json转为数组*/
        $data = json_decode($message, true);
        dump($message);

    }
    /**
     * 当用户断开连接时触发
     * @param int $client_id 连接id
     */
    public static function onClose($client_id)
    {

        //有用户离线时触发 并推送给全部用户
        $data['type'] = "out";
        $data['id'] = array_search($client_id, self::$user);
        unset(self::$user[$data['id']]);
        unset(self::$uuid[$data['id']]);
        $data['num'] = count(self::$user);
        Gateway::sendToAll(json_encode($data));

    }
}
