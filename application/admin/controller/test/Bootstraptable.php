<?php


namespace app\admin\controller\test;
use app\common\controller\Backend;
use fast\Form;
use think\Db;
use think\Exception;
use think\exception\PDOException;
use think\exception\ValidateException;

class Bootstraptable extends Backend
{
    protected $model = null;
    protected $noNeedRight = ['start', 'pause', 'change', 'detail', 'cxselect', 'searchlist'];

    public function _initialize()
    {
        parent::_initialize();
        $this->model = model('AdminLog');
        $ipList = $this->model->whereTime('createtime', '-37 days')->group("ip")->column("ip,ip as aa");
        $this->view->assign("ipList", $ipList);
    }


    /**
     * 查看
     */
    public function index(){

        $this->relationSearch=true;
        if ($this->request->isAjax()) {
            list($where, $sort, $order, $offset, $limit) = $this->buildparams(NULL);
            $total = $this->model
                ->with("admin")
                ->where($where)
                ->order($sort, $order)
                ->count();
            $list = $this->model
                ->with("admin")
                ->where($where)
                ->order($sort, $order)
                ->limit($offset, $limit)
                ->select();
            foreach ($list as $row){
//                $row->validate();
//                $row->getRelation('merchants')->visible(['name','logo_image']);
            }

            $result = array("total" => $total, "rows" => $list, "extend" => ['money' => mt_rand(100000,999999), 'price' => $total]);

            return json($result);
        }
        return $this->view->fetch();
    }
    /**
     * 百度地图
     */
    public function map(){
        return $this->view->fetch();
    }
    /**
     * 搜索列表
     */
    public function selectpage()
    {
        $this->model = model('Area');
        return parent::selectpage();
    }
    /**
     * 详情
     * @param $ids
     * @return string
     * @throws \think\Exception
     */
    public function detail($ids){
        $row = $this->model->get(['id' => $ids]);
        if (!$row)
            $this->error(__('No Results were found'));
        if ($this->request->isAjax()) {
            $this->success("Ajax请求成功", null, ['row' => $row]);
        }
        $this->view->assign("row", $row->toArray());
        return $this->view->fetch();
    }
    /**
     * 启用
     */
    public function start($ids = '')
    {
        $this->success("模拟启动成功");
    }

    /**
     * 暂停
     */
    public function pause($ids = '')
    {
        $this->success("模拟暂停成功");
    }
    /**
     * 切换
     */
    public function change($ids = '')
    {
        $this->success("模拟切换成功");
    }
    /**
     * 联动搜索
     */
    public function cxselect()
    {
        $type = $this->request->get('type');
        $group_id = $this->request->get('group_id');
        $list = null;
        if ($group_id !== '') {
            if ($type == 'group') {
                $groupIds = $this->auth->getChildrenGroupIds(true);
                $list = \app\admin\model\AuthGroup::where('id', 'in', $groupIds)->field('id as value, name')->select();
            } else {
                $adminIds = \app\admin\model\AuthGroupAccess::where('group_id', 'in', $group_id)->column('uid');
                $list = \app\admin\model\Admin::where('id', 'in', $adminIds)->field('id as value, username AS name')->select();
            }
        }
        $this->success('', null, $list);

    }

    /**
     * 搜索下拉列表
     */
    public function searchlist()
    {
        $result = $this->model->limit(10)->select();
        $searchlist = [];
        foreach ($result as $key => $value) {
            $searchlist[] = ['id' => $value['url'], 'name' => $value['url']];
        }
        $data = ['searchlist' => $searchlist];
        $this->success('', null, $data);
    }




    public function edit($ids = null)
    {

        $row = $this->model->get($ids);
        if (!$row) {
            $this->error(__('No Results were found'));
        }
        $adminIds = $this->getDataLimitAdminIds();
        if (is_array($adminIds)) {
            if (!in_array($row[$this->dataLimitField], $adminIds)) {
                $this->error(__('You have no permission'));
            }
        }
        if ($this->request->isPost()) {
            $params = $this->request->post("row/a");
            if ($params) {
                $params = $this->preExcludeFields($params);
                $result = false;
                Db::startTrans();
                try {
                    //是否采用模型验证
                    if ($this->modelValidate) {
                        $name = str_replace("\\model\\", "\\validate\\", get_class($this->model));
                        $validate = is_bool($this->modelValidate) ? ($this->modelSceneValidate ? $name . '.edit' : $name) : $this->modelValidate;
                        $row->validateFailException(true)->validate($validate);
                    }
                    $result = $row->allowField(true)->save($params);
                    Db::commit();
                } catch (ValidateException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (PDOException $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                } catch (Exception $e) {
                    Db::rollback();
                    $this->error($e->getMessage());
                }
                if ($result !== false) {
                    $this->success();
                } else {
                    $this->error(__('No rows were updated'));
                }
            }
            $this->error(__('Parameter %s can not be empty', ''));
        }
        $this->view->assign("row", $row);
        return $this->view->fetch();
    }



}