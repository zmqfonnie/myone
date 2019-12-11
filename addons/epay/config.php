<?php

return array(
    array(
        'name'    => 'wechat',
        'title'   => '微信',
        'type'    => 'array',
        'content' =>
            array(),
        'value'   => [
            'appid'       => 'wxa967b1363abff9d9', // APP APPID c0a4e6b5308d75495a50a1a6e67bca69
            'app_id'      => 'wxfe7df3a3ec1951d7', // 公众号 APPID
            'app_secret'  => 'd7c6aacb449a79165e34c861f3360af1', // 公众号 APPSECRET
            'miniapp_id'  => '', // 小程序 APPID
            'mch_id'      => '1532358901', //支付商户ID
            'key'         => 'a2yfGuNKjCTQOjVXpmrk8Xv51J1j0JWV',
            'notify_url'  => '/addons/epay/api/notifyx/type/wechat', //请勿修改此配置
            'cert_client' => '/epay/certs/apiclient_cert.pem', // 可选, 退款，红包等情况时需要用到
            'cert_key'    => '/epay/certs/apiclient_key.pem',// 可选, 退款，红包等情况时需要用到
            'log'         => 1,
//            'mode'        => 'dev', // optional,设置此参数，将进入沙箱模式
        ],
        'rule'    => '',
        'msg'     => '',
        'tip'     => '微信参数配置',
        'ok'      => '',
        'extend'  => '',
    ),
    array(
        'name'    => 'alipay',
        'title'   => '支付宝',
        'type'    => 'array',
        'content' =>
            array(),
        'value'   => [
            'app_id'         => '',
            'notify_url'     => '/addons/epay/api/notifyx/type/alipay', //请勿修改此配置
            'return_url'     => '/addons/epay/api/returnx/type/alipay', //请勿修改此配置
            'ali_public_key' => '',
            'private_key'    => '',
            'log'            => 1,
            //'mode'           => 'dev', // optional,设置此参数，将进入沙箱模式
        ],
        'rule'    => 'required',
        'msg'     => '',
        'tip'     => '支付宝参数配置',
        'ok'      => '',
        'extend'  => '',
    ),
    array(

        'name'    => '__tips__',
        'title'   => '温馨提示',
        'type'    => 'array',
        'content' =>
            array(),
        'value'   => '请注意微信支付证书路径位于/addons/epay/certs目录下，请替换成你自己的证书<br>appid：APP的appid<br>app_id：公众号的appid<br>app_secret：公众号的secret<br>miniapp_id：小程序ID<br>mch_id：微信商户ID<br>key：微信商户支付的密钥',
        'rule'    => '',
        'msg'     => '',
        'tip'     => '微信参数配置',
        'ok'      => '',
        'extend'  => '',
    )
);