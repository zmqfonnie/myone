<?php
/**
 * Created by zouminqiang
 * Date: 2020/4/1 8:50
 */

namespace app\api\controller;

use addons\database\library\Backup;
use app\common\controller\Api;
use think\Exception;

/**
 * 定时任务方法
 * Class Crontab
 * @package app\api\controller
 */
class Crontab extends Api
{


    protected $noNeedLogin = '*';
    protected $noNeedRight = '*';


    /**
     * 备份数据库
     * Created by zouminqiang
     * Date: 2020/4/1 8:51
     */
    public function backup()
    {

        $config = get_addon_config('database');
        $backupDir = ROOT_PATH . 'public' . DS . $config['backupDir'];
        if ($this->request->isPost()) {
            $database = config('database');
            try {

                //删除文件
                $files = scandir($backupDir);  //文件夹下文件与文件夹数组
                count($files) >= 4 && unlink($backupDir . $files[2]);
                $backup = new Backup($database['hostname'], $database['username'], $database['database'], $database['password'], $database['hostport']);
                $backup->setIgnoreTable($config['backupIgnoreTables'])->backup($backupDir);
            } catch (Exception $e) {
                $this->error($e->getMessage());
            }
            $this->success(__('Backup successful'));
        }
        return;

    }


//    /**
//     * 循环遍历文件
//     * @param $path
//     * @param $zip
//     * Created by zouminqiang
//     * Date: 2020/4/2 8:47
//     */
//    private function addFileToZip($path, $zip)
//    {
//        $handler = opendir($path); //打开当前文件夹由$path指定。
//        while (($filename = readdir($handler)) !== false) {
//            if ($filename != "." && $filename != "..") {//文件夹文件名字为'.'和‘..’，不要对他们进行操作
//                if (is_dir($path . "/" . $filename)) {// 如果读取的某个对象是文件夹，则递归
//                    $this->addFileToZip($path . "/" . $filename, $zip);
//                } else { //将文件加入zip对象
//                    $zip->addFile($path . "/" . $filename);
//                }
//            }
//        }
//        @closedir($path);
//    }
//
//    /**
//     * 压缩文件
//     * Created by zouminqiang
//     * Date: 2020/4/2 9:03
//     */
//    public function backupCode()
//    {
//
//        $zip = new \ZipArchive();
//        //myone.zip必须存在
//        if ($zip->open(ROOT_PATH.'myone.zip', \ZipArchive::OVERWRITE) === TRUE) {
//
//            $path = ROOT_PATH.'public/uploads/';
//            if (is_dir($path)) {  //给出文件夹，打包文件夹
//                $this->addFileToZip($path, $zip);
//            } else if (is_array($path)) {  //以数组形式给出文件路径
//                foreach ($path as $file) {
//                    $zip->addFile($file);
//                }
//            } else {      //只给出一个文件
//                $zip->addFile($path);
//            }
//
//            $zip->close(); //关闭处理的zip文件
//        }
//    }

}