<?php
namespace Kezhi\Api;
use Kezhi\Common;
use Kezhi\Lib as Lib;
class Import extends Api{
    use \Kezhi\Traits\ImportExcel;

    public function student_account(){
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
