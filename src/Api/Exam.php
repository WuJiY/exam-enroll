<?php
namespace Kezhi\Api;
use Kezhi\Model as Model;

class Exam extends Api{
    public function add(){
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $type = isset($_POST['type']) ? $_POST['type'] : null;
        $exam_time = isset($_POST['exam_time']) ? $_POST['exam_time'] : null;
        if(is_null($name) || is_null($title) || is_null($type) || is_null($exam_time)){
            $this->invalid_request();
        }
        try{
            $exam = new Model\Exam();
            $exam->add($name, $type, $title, $exam_time);
            $this->result['status'] = parent::CREATED;
            $this->result['data'] = [
                'desc'  =>  '新增考试项目成功',
                'uri'   =>  '/index.php/exam'
            ];
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }
}
?>
