<?php

namespace app\index\controller;

use app\common\controller\Fonnie;

class Article extends Fonnie
{

    public function index($id)
    {

        $data = $id;
        $this->assign('data', $data);
        return $this->view->fetch();
    }


}
