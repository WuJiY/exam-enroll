<?php
/** API */
namespace Kezhi\Api;
use Kezhi\Model as Model;
/**
 * AUTH 认证
 *
*/
class Auth extends Api{
    /**
     * 认证用户身份的方法
    */
    public function auth(){
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        if(is_null($username) || is_null($password)){
            $this->result['status'] = parent::INVALID_REQUEST;
            $this->result['data'] = '无效的参数';
            $this->sendJson();
        }
        $user = new Model\User();
        try{
            if($user->auth($username, $password)){
                session_id(md5($username));
                $_SESSION['username'] = $username;
                $this->result['status'] = parent::CREATED;
                $this->result['data'] = [
                    'desc'  =>  '认证成功',
                    'url'   =>  '/index.php/user'
                ];
            }else{
                $this->result['status'] = parent::NOT_FOUND;
                $this->result['data'] = '用户名或密码错误';
            }
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }
}

?>
