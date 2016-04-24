<?php
namespace Kezhi\Api;

use Kezhi\Model as Model;
use Kezhi\Lib as Lib;

class Export extends Api{
    use \Kezhi\Traits\ExportExcel;

    public function export(){
        $exams = isset($_POST['exams']) ? $_POST['exams'] : null;
        $type = isset($_POST['type']) ? $_POST['type'] : 'xls';
        switch($type){
            case 'xls':
            case 'xlsx':
                $this->excel($exams);
                break;
            default:
                $this->excel($exams);
                break;
        }
    }

    public function excel(Array $exams){
        try{
            $enroll = new Model\Enroll();
            $data = $enroll->getExportData($exams);
            $excel = new Lib\ExcelExport();
            $rules = $this->getConfig('export_student');
            $excel->setRules($rules['rules']);
            $excel->setDatas($data);
            $excel->export();
            $file = $excel->save();
            $this->result['status'] = parent::OK;
            $this->result['data'] = [
                'desc'  =>  '导出成功',
                'uri'   =>  '/index.php/download/' . $file
            ];
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }
}
?>
