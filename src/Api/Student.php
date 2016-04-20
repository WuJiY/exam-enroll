<?php
namespace Kezhi\Api;

use Kezhi\Model as Model;

class Student extends Api{
    public function get_info(){
        $user_id = isset($_POST['id']) ? intval($_POST['id']) : isset($_GET['id']) ? intval($_GET['id']) : 0;
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
}
?>
