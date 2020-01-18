<?php

namespace app\index\controller;

use app\common\controller\Fonnie;

class Index extends Fonnie
{

    public function index()
    {
        return $this->view->fetch();
    }

}
