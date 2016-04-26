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
            $exam = new Model\Exam();
            $data = $enroll->getExportDatas($exams);
            foreach($data as $k=>&$v){
                if($v['sex'] == 0){
                    $v['sex'] = '男';
                }else if($v['sex'] == 1){
                    $v['sex'] = '女';
                }else{
                    $v['sex'] = '未知';
                }
                $v['type_name'] = $exam->getExamTypeName($v['type']);
                $arr = explode(',', $v['enrolled']);
                if(array_search('0', $arr)!==false){
                    $v['writing_brush'] = '已选择';
                }
                if(array_search('1', $arr)!==false){
                    $v['pen'] = '已选择';
                }
                if(array_search('2', $arr)!==false){
                    $v['chalk'] = '已选择';
                }
                if(array_search('3', $arr)!==false){
                    $v['putonghua'] = '已选择';
                }
            }
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
