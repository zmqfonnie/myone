<?php

namespace addons\layim;

use think\Addons;
use think\Request;

/**
 * 在线命令插件
 */
class Layim extends Addons
{

    /**
     * 插件安装方法
     * @return bool
     */
    public function install()
    {
        return true;
    }

    /**
     * 插件卸载方法
     * @return bool
     */
    public function uninstall()
    {
        return true;
    }

    /**
     * 插件启用方法
     * @return bool
     */
    public function enable()
    {

        return true;
    }

    /**
     * 插件禁用方法
     * @return bool
     */
    public function disable()
    {

        return true;
    }


    public function responseSend()
    {
        $request = Request::instance();
        if (($request->path() == "index/user/login" || $request->path() == "index/user/register") && !$request->isAjax() && !$request->isPost()) {
            echo '<div class="l2d_xb"><div class="waifu"><div class="waifu-tips"></div><canvas id="live2d" width="320px" height="320px" class="live2d"></canvas><div class="waifu-tool"><span class="fa fa-home"></span><span class="fa fa-comments"></span>
            <span class="fa fa-drivers-license-o"></span>
            <span class="fa fa-street-view"></span>
            <span class="fa fa-camera"></span>
            <span class="fa fa-info-circle"></span>
            <span class="fa fa-close"></span></div></div>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/jquery@2.1.4/dist/jquery.min.js"></script>
        <script type="text/javascript" src="https://cdn.jsdelivr.net/gh/xb2016/kratos-pjax@0.3.6/static/js/live2d.js"></script>
	</div>';


        }
    }

//    public function indexLoginInit(\think\Request &$request)
//    {
//        $config = $this->getConfig();
//        if ($config['mode'] == 'random' || $config['mode'] == 'daily') {
//            $index = $config['mode'] == 'random' ? mt_rand(1, 4000) : date("Ymd") % 4000;
//            $background = "http://img.infinitynewtab.com/wallpaper/" . $index . ".jpg";
//        } else {
//            $background = cdnurl($config['image']);
//        }
//        \think\View::instance()->assign('background', $background);
//    }

}
