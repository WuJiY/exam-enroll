<?php
/** 模型 */
namespace Kezhi\Model;
/**
 * User Model
 * 封装一些对用户表的操作
 * ```
 * CREATE TABLE user (
 * id INT(8) NOT NULL AUTO_INCREMENT COMMENT '用户id',
 * username VARCHAR(45) NOT NULL UNIQUE COMMENT '用户名',
 * password VARCHAR(255) NOT NULL COMMENT '密码',
 * role INT(8) NOT NULL DEFAULT 0 COMMENT '角色',
 * PRIMARY KEY(id)
 *)DEFAULT CHARSET=utf8 COMMENT='用户表';
 * ```
*/
class User extends Model{
    const ADMIN = 2;
    const STUDENT = 0;
    const TEACHER = 1;
    /**
     * 新增用户
     * 新增一条记录
     * @param $username String username
     * @param $password String password
     * @return bool
    */
    public function add($username, $password, $role = self::STUDENT){
        $this->validate_username($username);
        $this->validate_password($password);
        $this->encrypt($password);
        $stmp = $this->db->prepare("INSERT INTO user (username, password, role) VALUES (:username, :password, :role)");
        $stmp->bindParam(':username', $username);
        $stmp->bindParam(':password', $password);
        $stmp->bindParam(':role', $role);
        if($stmp->execute()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 更新用户
     * 更新一条记录
     * @param $id Integer $user_id
     * @param $username String $username
     * @param $password String $password
     * @return bool
    */
    public function update($id, $username, $password, $role = self::STUDENT){
        if(!is_numeric($id) || $id <= 0){
            return false;
        }
        $this->validate_username($username);
        $this->validate_password($password);
        $this->encrypt($password);
        $stmp = $this->db->prepare("UPDATE user SET username=:username , password=:password, role=:role WHERE id=:id");
        $stmp->bindParam(':username', $username);
        $stmp->bindParam(':password', $password);
        $stmp->bindParam(':role', $role);
        $stmp->bindParam(':id', $id);
        if($stmp->execute()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 删除用户
     * 删除一条记录，根据id或username,传入id为0表示根据username删除用户
     * @param $id Integer user_id
     * @param $username String username,default is ''
     * @return bool
    */
    public function delete($id, $username = ''){
        if(!is_numeric($id) || $id < 0){
            return false;
        }
        if($id == 0){
            // Delete row by $username
            $stmp = $this->db->prepare("DELETE FROM user WHERE username=:username");
            $stmp->bindParam(':username', $username);
        }else{
            // Delete row by $id
            $stmp = $this->db->prepare("DELETE FROM user WHERE id=:id");
            $stmp->bindParam(':id', $id);
        }
        if($stmp->execute()){
            return true;
        }else{
            return false;
        }
    }

    /**
     * 查询用户
     * 根据id/username查询用户，$id值为0表示根据username删除数据
     * @param $id Integer user_id
     * @param $username String username,default is ''
     * @return mixed 成功时返回查询结果，失败时返回false
    */
    public function query($id, $username = ''){
        if(!is_numeric($id) || $id < 0){
            return false;
        }
        if($id == 0){
            // Query row by $username
            $stmp = $this->db->prepare("SELECT * FROM user WHERE username=:username");
            $stmp->bindParam(':username', $username);
        }else{
            // Query row by $id
            $stmp = $this->db->prepare("SELECT * FROM user WHERE id=:id");
            $stmp->bindParam(':id', $id);
        }
        if($stmp->execute()){
            return $stmp->fetch();
        }else{
            return false;
        }
    }

    /**
     * 查询密码操作
     * 根据用户id或用户名查询用户密码
     * @param integer $id 用户id
     * @param string $username 用户名
     * @return mixed 成功时返回查询结果，失败时返回false
    */
    public function query_password($id, $username){
        if(!is_numeric($id) || $id < 0){
            return false;
        }
        $stmp = null;
        if($id == 0){
            $stmp = $this->db->prepare("SELECT password FROM user WHERE username=:username");
            $stmp->bindParam(':username', $username, \PDO::PARAM_STR);
        }else{
            $stmp = $this->db->prepare("SELECT password FROM user WHERE id=:id");
            $stmp->bindParam(':id', $id);
        }
        if($stmp->execute()){
            return $stmp->fetch();
        }else{
            return false;
        }
    }

    /**
     * 用户认证方法
     * 根据传入的username和password在数据库中检索是否有对应的用户
     * @param string $username 用户名
     * @param string $password 密码
     * @return mixed 成功时返回查询结果，失败时返回false
    */
    public function auth($username, $password){
        try{
            $this->validate_username($username);
            $this->validate_password($password);
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 400);
        }
        try{
            $info = $this->query_password(0, $username);
            if($info === false){
                throw new \Exception('数据库访问出错', 500);
            }
            if($this->check($password, $info['password'])){
                return $this->query(0, $username);
            }else{
                return false;
            }
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 500);
        }
    }

    /**
     * 验证用户名
     * 验证用户名是否合法
     * @param $username String username
    */
    private function validate_username(&$username){
        $username = trim($username);
        $preg = "/^([a-z]|[A-Z])(\d|\w){5,17}/";
        if(!preg_match($preg, $username)){
            throw new \Exception('用户名必须以字母开头，只能包含数字/字母/下划线，长度必须在6-17之间', 400);
        }
    }

    /**
     * 验证密码
     * 验证密码格式是否合法
     * @param $password String password
     * @throws Exception
    */
    private function validate_password(&$password){
        $password = trim($password);
        $preg = "/^(\d|\w)(\d|\w|@|!|#|\$|%|\^|&|\*|\(|\)){7,23}/";
        if(!preg_match($preg, $password)){
            throw new \Exception('密码必须是字母或数字开头，只能包含字母/数字/!@#$%^&*()，长度必须在8-24个字符', 400);
        }
    }

    /**
     * 加密密码
     * @param $password String 需要加密的密码明文，注意传入的是引用类型
     * @throws Exception
     * @see password_hash function
    */
    private function encrypt(&$password){
        if(PHP_VERSION < '5.5.0'){
            throw new \Exception('服务器PHP版本太低，至少需要5.5.0,请升级服务器后重新尝试', 500);
        }
        $hash = password_hash($password, PASSWORD_DEFAULT);
        if(!$hash){
            throw new \Exception('加密密码时遇到问题，请稍后再试！', 500);
        }
        $password = $hash;
    }

    /**
     * 检查用户输入的密码和数据库中存储的密码是否一致
     * @param string $password 密码
     * @param string $hash 数据库中存储着的加密后的密码
     * @return bool 验证成功返回true，否则返回false
    */
    private function check($password, $hash){
        if(PHP_VERSION < '5.5.0'){
            throw new \Exception('服务器PHP版本太低，至少需要5.5.0，请升级服务器后重新尝试', 500);
        }
        if(password_verify($password, $hash)){
            return true;
        }
        return false;
    }
}
?>
