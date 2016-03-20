<?php
namespace Kezhi\Controller;
use Kezhi\Lib as Lib;
use Kezhi\Common;
/**
 * 通过excel表格导入数据到系统中
 * 通过读取分析用户上传的excel文件，将用户信息导入到系统数据库中。
*/
class Import extends Controller{
    public function student_account(){
        $this->smarty->display('student_account.tpl');
    }

    public function student_account_handle(){
        $upload = new \Kezhi\Common\Upload();
        if(isset($_FILES['student_account_file'])){
            try{
                $file = $upload->excel('student_account_file');
                $config = $this->getConfig('import_user_account');
                $excel_importer = new Lib\ExcelImport($config['rules'], $config['exts']);
                $excel = $excel_importer->import($file['dir'] . $file['name']);
                $result = $excel
                ->worksheet(0)
                ->area(0,3)
                ->getValue();
                var_dump($result);
            }catch(\Exception $e){
                echo $e->getMessage();
                exit;
            }
        }else{

        }
    }

    /**
     * 获取配置
     * 导入全局配置并根据关键字获取配置
     * @param $key 要获取的配置的键，可以为空，返回表格导入配置，可以为exts，返回扩展名，为对应业务定义key，则返回对应rule
     * @return Array 对应的配置
    */
    private function getConfig($key = null){
        global $conf;
        $conf->load(__CONF__.'/'.$conf['rules']['import_excel_config_file']);
        if(is_null($key)){
            return $conf['import_excel'];
        }elseif($key == 'exts'){
            return $conf['import_excel'][$key];
        }else{
            $result = $conf['import_excel']['rules'][$key];
            $exts = array_merge($conf['import_excel']['exts'], isset($result['exts']) ? $result['exts'] : []);
            $result['exts'] = $exts;
            return $result;
        }
    }
}
