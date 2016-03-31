<?php
/** API */
namespace Kezhi\Api;
use Kezhi\Model as Model;
/**
 * User apis
 * 用户操作相关的API
*/
class User extends Api {
    /**
     * 新增用户API
     *
     * @api
     * @param string username POST方式提交的用户名
     * @param string password POST方式提交的密码
    */
    public function add(){
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        if(is_null($username) || is_null($password)){
            $this->invalid_request();
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

    /**
     * 更新用户API
     *
     * @api
     * @param integer id POST方式提交的Id
     * @param string username POST方式提交的用户名
     * @param string password POST方式提交的密码
    */
    public function update(){
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        $username = isset($_POST['username']) ? $_POST['username'] : null;
        $password = isset($_POST['password']) ? $_POST['password'] : null;
        if(is_null($id) || $id<=0 || is_null($username) || is_null($password)){
            $this->invalid_request();
        }
        $user = new Model\User();
        try{
            if($user->update($id, $username, $password)){
                $this->result['status'] = parent::CREATED;
                $this->result['data'] = '修改用户成功';
            }else{
                $this->result['status'] = parent::INTERNAL_SERVER_ERROR;
                $this->result['data'] = '由未知原因导致的服务器错误';
            }
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }

    /**
     * 删除用户API
     * 如果提交的id值数据库不存在且大于等于1,则返回删除成功字样
     * @api
     * @param integer id POST方式提交的id
    */
    public function delete(){
        $id = isset($_POST['id']) ? $_POST['id'] : null;
        if(is_null($id) || $id <= 0){
            $this->invalid_request();
        }
        $user = new Model\User();
        try{
            if($user->delete($id)){
                $this->result['status'] = parent::NO_CONTENT;
                $this->result['data'] = '删除用户成功';
            }else{
                $this->result['status'] = parent::INTERNAL_SERVER_ERROR;
                $this->result['data'] = '由未知原因导致的服务器错误';
            }
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }
}
?>
