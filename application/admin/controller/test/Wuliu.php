<?php

namespace app\admin\controller\test;

use app\common\controller\Backend;
use \app\admin\model\test\Wuliu as WuliuModel;

/**
 *
 *
 * @icon fa fa-circle-o
 */
class Wuliu extends Backend
{

    /**
     * Wuliu模型对象
     * @var \app\admin\model\test\Wuliu
     */
    protected $model = null;

    protected $multiFields = ['weigh', 'status'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = new WuliuModel();

        $statusList = WuliuModel::getStatusList();

        $this->assign('statusList', $statusList);

    }

    /**
     * 默认生成的控制器所继承的父类中有index/add/edit/del/multi五个基础方法、destroy/restore/recyclebin三个回收站方法
     * 因此在当前控制器中可不用编写增删改查的代码,除非需要自己控制这部分逻辑
     * 需要将application/admin/library/traits/Backend.php中对应的方法复制到当前控制器,然后进行修改
     */


    public function index()
    {
        //设置过滤方法
        $this->request->filter(['strip_tags']);
        if ($this->request->isAjax()) {
            //如果发送的来源是Selectpage，则转发到Selectpage
            if ($this->request->request('keyField')) {
                return $this->selectpage();
            }
            list($where, $sort, $order, $offset, $limit) = $this->buildparams();

            $list = $this->model
                ->field('id,name,image,images,code,createtime,status,weigh')
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();
            $total = count($list);
//            dump($total);die;
            $list = collection($list)->toArray();
            $result = array("total" => $total, "rows" => $list);

            return json($result);
        }
        return $this->view->fetch();
    }


    public function by($ids = '')
    {

        !empty($ids) && $this->success($ids);
        $this->error('审核失败');
    }

    public function refuse($ids = '')
    {

        !empty($ids) && $this->success($ids);
        $this->error('拒绝失败');
    }
}
