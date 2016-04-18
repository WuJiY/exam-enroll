<?php
/** API */
namespace Kezhi\Api;
use Kezhi\Common;
use Kezhi\Lib as Lib;
use Kezhi\Model as Model;
/**
 * ImportExcel Api
 * 导入excel表格的api，包括导入用户，导入缴费信息，导入成绩信息
*/
class Import extends Api{
    use \Kezhi\Traits\ImportExcel;
    /**
     * 导入学生账号
     * 上传excel文件，导入学生账号信息，将返回该excel解析后的数组
     * @api
    */
    public function student_account(){
        // var_dump($_FILES);exit;
        $upload = new \Kezhi\Common\Upload();
        if(isset($_FILES['student_account_file'])){
            try{
                $file = $upload->excel('student_account_file');
                $config = $this->getConfig('import_user_account');
                $excel_importer = new Lib\ExcelImport($config['rules'], $config['exts']);
                $excel = $excel_importer->import($file['dir'] . $file['name']);
                $result = $excel
                ->worksheet(0)
                ->area(1)
                ->getValue();
                $userinfo = new Model\UserInfo;
                $userinfo->import($result[0]);
                $this->result['status'] = 201;
                $this->result['data'] = $result;
            }catch(\Exception $e){
                $this->result['status'] = $e->getCode();
                $this->result['data'] = $e->getMessage();
                $this->sendJson();
            }
        }else{
            $this->result['status'] = 400;
            $this->result['data'] = '请以键student_account_file上传文件';
        }
        $this->sendJson();
    }
}
?>
