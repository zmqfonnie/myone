<?php

namespace app\api\controller;

use app\common\controller\Api;
use fast\Rsa;
use function Sodium\crypto_aead_aes256gcm_encrypt;

/**
 * 示例接口
 */
class Demo extends Api
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
    protected $encode = ['test'];


    /**
     * 发送端
     */
    public function send()
    {
        $data = [
            'name' => 'zmq',
            'pwd' => 1998,
            'time' => time(),
            'cs' => "a2131zmq怎邹敏强"
        ];
        $data = json_encode($data);

        //加密前数据
        echo '加密前数据：' . $data . "<br/>";

        //获取随机密码
        $key = substr(md5(time()) . 'fonnie', 0, 16);
        echo '加密前密码：' . $key . "<br/>";


        //AES加密后数据
        $data = openssl_encrypt($data, 'AES-128-ECB', $key);

        //加密后数据
        echo 'AES加密,加密后数据：' . $data . "<br/>";


        //使用客户端私钥加密随机密码  RSA加密
        openssl_private_encrypt($key, $encrypted, file_get_contents('private.pem'));

        //加密后的内容通常含有特殊字符，需要base64编码转换下
        $encrypted = base64_encode($encrypted);
        $key = $encrypted;
        echo '客户端私钥加密随机密码(RSA一般用于加密密码),加密后密码：' . $key . "<br/>";

        //发送数据
        $data = [
            'key' => $key,
            'data' => $data
        ];

        //调用服务器接口
        $a = request_post('http://myone.com/api/demo/get', $data);
        dump($a);

    }


    /**
     * 接收端
     */
    public function get()
    {

        $post = $this->request->post();

        //使用用户公钥解密密码 RSA解密
        openssl_public_decrypt(base64_decode($post['key']), $decrypted, file_get_contents('public.pem'));

        //获取真密码
        $post['key'] = $decrypted;
        //数据解密 AES解密
        $post['data'] = json_decode(openssl_decrypt($post['data'], 'AES-128-ECB', $post['key']));


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
        file_put_contents('./public.pem', $public_key);
        file_put_contents('./private.pem', $private_key);

        echo $public_key;
        echo "<br/>";
        echo $private_key;
    }


    /**
     * 公钥加密
     */
    public function public_encode()
    {
        $data = $_POST['data'];
        openssl_public_encrypt($data, $encrypted, config('publicKey'));
        //加密后的内容通常含有特殊字符，需要base64编码转换下
        $encrypted = base64_encode($encrypted);
        $this->success('使用公钥加密成功！', $encrypted);
    }


    /**
     * 私钥解密
     */
    public function private_decode()
    {

        $data = $_POST['data'];
        openssl_private_decrypt(base64_decode($data), $decrypted, config('privateKey'));
        $this->success('解密公钥加密文件成功！', $decrypted);
    }

    /**
     * 私钥加密
     */
    public function private_encode()
    {
        $data = $_POST['data'];
        openssl_private_encrypt($data, $encrypted, config('privateKey'));
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
        openssl_public_decrypt(base64_decode($data), $decrypted, config('publicKey'));
        $this->success('解密私钥加密文件成功！', $decrypted);
    }


    /**
     * AES 加密
     * @by fonnie 2019/12/19 9:07
     */
    public function aes_encode()
    {
        $post = $this->request->post();
        //获取随机密码
        $key = substr(md5(time()) . 'fonnie', 0, 16);
        $data['key'] = $key;


        $data['data'] = openssl_encrypt(json_encode($post['data']), 'AES-128-ECB', $key);

        $this->success('AES加密成功！', $data);
    }


    /**
     * AES 解密
     * @by fonnie 2019/12/19 9:08
     */
    public function aes_decode()
    {
        $post = $this->request->post();
        $post['data'] = json_decode(openssl_decrypt($post['data'], 'AES-128-ECB', $post['key']));
        return $this->success('AES解密成功！', $post);
    }

}
