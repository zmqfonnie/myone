<?php

namespace app\index\controller;


use app\common\controller\Frontend;

/**
 * 及时通讯
 */
class Im extends Frontend
{
//    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';


    public function _initialize()
    {
        parent::_initialize();
    }

    public function  index(){

       return $this->view->fetch();
    }
}
