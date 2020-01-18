<?php

namespace app\common\controller;

use think\Controller;
use think\Db;

/**
 * 前台控制器基类
 */
class Fonnie extends Controller
{


    public function _initialize()
    {
        $this->view->engine->layout('layout/default');


        //网站配置
        $config = Db::name('Config')->where(['is_me' => 1])->field('name,value')->select();
        $site['version']=time();
        foreach ($config as $k=>$v) {
            $site[$v['name']] = $v['value'];
        }


        //菜单
        $menu = Db::name('menu')->field('id,name,url,class')->select();


        $this->assign('config', $site);
        $this->assign('menu', $menu);
    }


}
