<?php

namespace app\index\controller;

use app\common\controller\Frontend;
use app\common\library\Auth;
use GatewayClient\Gateway;
use think\Session;


/**
 * 会员中心
 */
class Im extends Frontend
{

    protected $noNeedLogin = [''];
    protected $noNeedRight = ['*'];

    public function _initialize()
    {
        parent::_initialize();

    }


    /**
     * 会员中心
     */
    public function index()
    {
        return $this->view->fetch();
    }


    public function bind()
    {

        $client_id =  $this->request->param('client_id');


        // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值(ip不能是0.0.0.0)
        Gateway::$registerAddress = '192.168.1.254:1238';

        // 假设用户已经登录，用户uid和群组id在session中
        $uid = $this->auth->id;
        $group_id = $this->auth->group_id;
        // client_id与uid绑定
        Gateway::bindUid($client_id, $uid);

        $data = [
            'type'=>'say',
            'data'=>[
                'avatar'=>$this->auth->avatar,
                'name'=>$this->auth->username,
                'content'=>'进入了聊天室',
                'time'=>date('Y-m-d H:i:s')
            ]
        ];

        Gateway::sendToAll(json_encode($data));
    }

    public function send_message()
    {

        // 设置GatewayWorker服务的Register服务ip和端口，请根据实际情况改成实际值(ip不能是0.0.0.0)
        Gateway::$registerAddress = '127.0.0.1:3000';

        // 向任意uid的网站页面发送数据
        Gateway::sendToUid($uid, $message);
        // 向任意群组的网站页面发送数据
        Gateway::sendToGroup($group, $message);
    }
}
