<?php
/** API */
namespace Kezhi\Api;
use Kezhi\Model as Model;
/**
 * User apis
 * 用户操作相关的API
*/
class User extends Api {
    public function add(){
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        if(is_null($username) || is_null($password)){
            $this->result['status'] = parent::INVALID_REQUEST;
            $this->result['data'] = '无效的参数';
            $this->sendJson();
        }
        $user = new Model\User();
        try{
            if($user->add($username, $password)){
                $this->result['status'] = parent::CREATED;
                $this->result['data'] = [
                    'desc'  =>  '新建用户成功',
                    'url'   =>  '/index.php/auth'
                ];
            }else{
                $this->result['status'] = parent::INTERNAL_SERVER_ERROR;
                $this->result['data'] = '新建用户过程中遇到不可知错误';
            }
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }
}
?>
