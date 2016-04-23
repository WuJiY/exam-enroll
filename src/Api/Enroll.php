<?php
namespace Kezhi\Api;

use Kezhi\Model as Model;

class Enroll extends Api{
    public function enroll(){
        $exam_id = isset($_POST['exam_id']) ? intval($_POST['exam_id']) : null;
        $uid = isset($_POST['uid']) ? intval($_POST['uid']) : $_SESSION['uid'];
        $status = isset($_POST['status']) ? intval($_POST['status']) : null;
        if(is_null($exam_id) || is_null($uid) || is_null($status)){
            $this->invalid_request();
        }
        if($uid == $_SESSION['uid'] && $_SESSION['role'] != 'student'){
            $this->forbidden_request();
        }
        try{
            $enroll = new Model\Enroll();
            $enroll_id = $enroll->checkHave($exam_id, $uid);
            if($enroll_id == false){
                $enroll->add($exam_id, $uid, Model\Enroll::ENROLLED);
                $this->result['data'] = '报名信息新增成功';
            }else{
                $enroll->setEnrollStatus($enroll_id, $status);
                $this->result['data'] = '报名信息修改成功';
            }
            $this->result['status'] = parent::CREATED;
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }
}
