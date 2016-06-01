<?php
namespace Kezhi\Api;

use Kezhi\Model as Model;
use Kezhi\Lib as Lib;
use Alchemy\Zippy as Zippy;

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

    public function photos(){
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        if(is_null($name)){
            $this->invalid_request();
        }
        @mkdir(__DOWNLOAD__ . 'photos');
        $zip = Zippy\Zippy::load();
        $archive = $zip->create('photos.zip', [
            'folder'    =>  __DOWNLOAD__ . 'photos'
        ], true);
        $photo = new Model\Photo();
        foreach ($photo->getAll() as $photo){
            try{
                $archive->addMembers([
                    'photos/' . $photo[$name]   =>  $photo['dir'] . $photo['name']
                ]);
            }catch (\Exception $e){
                // TODO 记录到日志中
            }
        }
        $this->result['status'] = '导出成功';
        $this->result['data'] = '/index.php/download/' . 'photos.zip';
        $this->sendJson();
    }


}
?>
