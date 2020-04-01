<?php
/**
 * Created by zouminqiang
 * Date: 2020/4/1 8:50
 */
namespace  app\api\controller;

use addons\database\library\Backup;
use app\common\controller\Api;
use think\Exception;

/**
 * 定时任务方法
 * Class Crontab
 * @package app\api\controller
 */
class Crontab extends Api{


    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';


    /**
     * 备份数据库
     * Created by zouminqiang
     * Date: 2020/4/1 8:51
     */
    public function  backup(){

        $config = get_addon_config('database');
        $backupDir = ROOT_PATH . 'public' . DS . $config['backupDir'];
        if ($this->request->isPost()) {
            $database = config('database');
            try {

                //删除文件
                $files = scandir($backupDir);  //文件夹下文件与文件夹数组
                count($files)>=4 && unlink($backupDir.$files[2]);
                $backup = new Backup($database['hostname'], $database['username'], $database['database'], $database['password'], $database['hostport']);
                $backup->setIgnoreTable($config['backupIgnoreTables'])->backup($backupDir);
            } catch (Exception $e) {
                $this->error($e->getMessage());
            }
            $this->success(__('Backup successful'));
        }
        return;

    }

}