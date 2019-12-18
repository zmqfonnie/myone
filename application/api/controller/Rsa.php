<?php

namespace app\api\controller;

use app\common\controller\Api;

/**
 * 示例接口
 */
class Rsa extends Api
{

    //如果$noNeedLogin为空表示所有接口都需要登录才能请求
    //如果$noNeedRight为空表示所有接口都需要验证权限才能请求
    //如果接口已经设置无需登录,那也就无需鉴权了
    //
    // 无需登录的接口,*表示全部
    protected $noNeedLogin = ['*'];
    // 无需鉴权的接口,*表示全部
    protected $noNeedRight = ['test2'];

    //需要解密的方法
    protected $encode = ['get'];


    /**
     * 发送端
     */
    public function send()
    {
        $param = $this->request->post();

        $password = md5(time());
        dump($password);
        $this->success('返回成功', $this->request->param());

    }


    /**
     * 接收端
     */
    public function get()
    {

        $post = $this->request->post();


        $this->success('返回成功！', $post);
    }


    /**
     * 创建Rsa公钥和私钥
     */
    public function create_rsa()
    {
        //证书密码 可以是任意字符串
        $password = $this->request->post('password');
        $config = array(
            "password" => $password,
            "digest_alg" => "sha512",            //加密方式
            "private_key_bits" => 1024,           //字节数  512 1024 2048  4096 等 ,不能加引号，此处长度与加密的字符串长度有关系，可以自己测试一下
            "private_key_type" => OPENSSL_KEYTYPE_RSA,   //加密类型
        );
        $res = openssl_pkey_new($config);

        //提取私钥
        openssl_pkey_export($res, $private_key);

        //生成公钥
        $public_key = openssl_pkey_get_details($res);
        $public_key = $public_key["key"];

        //文件创建
        //file_put_contents('./public.pem',$public_key);
        //file_put_contents('./private.pem',$private_key);

        echo $public_key;
        echo "\n\n";
        echo $private_key;
    }


    /**
     * 公钥加密
     */
    public function public_encode()
    {
        $data = $_POST['data'];
        if (empty($data)) {
            $this->error('数据出错！');
        }
        openssl_public_encrypt($data, $encrypted, config('publicKey'));
        //加密后的内容通常含有特殊字符，需要base64编码转换下
        $encrypted = base64_encode($encrypted);
        $this->success('使用公钥加密成功！', $encrypted);
    }

    /**
     * 私钥加密
     */
    public function private_encode()
    {
        $data = $_POST['data'];
        if (empty($data)) {
            $this->error('数据出错！');
        }
        openssl_public_encrypt($data, $encrypted, config('publicKey'));
        //加密后的内容通常含有特殊字符，需要base64编码转换下
        $encrypted = base64_encode($encrypted);
        $this->success('使用私钥加密成功！', $encrypted);
    }

    /**
     * 公钥解密
     */
    public function public_decode()
    {
        $data = $_POST['data'];
        if (empty($data)) {
            $this->error('数据出错！');
        }
        openssl_private_decrypt(base64_decode($data), $decrypted, config('privateKey'));
        $this->success('解密私钥加密文件成功！', $decrypted);
    }


    /**
     * 私钥解密
     */
    public function private_decode()
    {
        $data = $_POST['data'];
        if (empty($data)) {
            $this->error('数据出错！');
        }
        openssl_private_decrypt(base64_decode($data), $decrypted, config('privateKey'));
        $this->success('解密公钥加密文件成功！', $decrypted);
    }


}
