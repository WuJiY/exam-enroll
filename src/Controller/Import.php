<?php
/** 控制器 */
namespace Kezhi\Controller;
use Kezhi\Lib as Lib;
use Kezhi\Common;
/**
 * 通过excel表格导入数据到系统中
 * 通过读取分析用户上传的excel文件，将用户信息导入到系统数据库中。
*/
class Import extends Controller{
    use \Kezhi\Traits\ImportExcel;
    /**
     * 学生账号导入页面
    */
    public function student_account(){
        $this->smarty->display('student_account.tpl');
    }

    /**
     * 学生账号导入操作
    */
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
                print_r($result);
            }catch(\Exception $e){
                echo $e->getMessage();
            }
        }else{
            echo 'ghj';
        }
    }
}
