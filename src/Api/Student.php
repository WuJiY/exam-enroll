<?php
namespace Kezhi\Api;

use Kezhi\Model as Model;

class Student extends Api{
    public function get_info(){
        $user_id = isset($_POST['id']) ? intval($_POST['id']) : (isset($_GET['id']) ? intval($_GET['id']) : 0);
        try{
            $userinfo = new Model\UserInfo();
            $result = $userinfo->query($user_id);
            $this->result['status'] = parent::OK;
            $this->result['data'] = $result;
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }

    public function del(){
        $user_id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        try{
            $userinfo = new Model\UserInfo();
            if($userinfo->delete($user_id)){
                $this->result['status'] = parent::NO_CONTENT;
                $this->result['data'] = '成功删除该用户';
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
