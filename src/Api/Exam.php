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

    public function info(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        try{
            $exam = new Model\Exam();
            $result = $exam->query($id);
            $result['type_name'] = $exam->getExamTypeName($result['type']);
            $this->result['status'] = parent::OK;
            $this->result['data'] = $result;
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }

    public function edit(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : null;
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $type = isset($_POST['type']) ? $_POST['type'] : null;
        $exam_time = isset($_POST['exam_time']) ? $_POST['exam_time'] : null;
        if(is_null($name) || is_null($title) || is_null($type) || is_null($exam_time) || is_null($id)){
            $this->invalid_request();
        }
        try{
            $exam = new Model\Exam();
            $exam->update($id, $name, $type, $title, $exam_time);
            $this->result['status'] = parent::CREATED;
            $this->result['data'] = [
                'desc'  =>  '修改考试项目成功',
                'uri'   =>  '/index.php/exam'
            ];
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }

    public function del(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        try{
            $exam = new Model\Exam();
            if($exam->delete($id)){
                $this->result['status'] = parent::NO_CONTENT;
                $this->result['data'] = '成功删除该考试';
            }else{
                $this->result['status'] = parent::INTERNAL_SERVER_ERROR;
                $this->result['data'] = '未知原因导致的错误';
            }
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }
}
?>
