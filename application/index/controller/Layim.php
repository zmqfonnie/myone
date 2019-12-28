<?php

namespace app\index\controller;


use app\common\controller\Frontend;

/**
 * 会员中心
 */
class Layim extends Frontend
{
    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';


    public function _initialize()
    {
        parent::_initialize();
    }

    public function  index(){

       return $this->view->fetch();
    }
}
