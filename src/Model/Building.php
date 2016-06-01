<?php
namespace Kezhi\Model;
/**
 * 教学楼表
 *
 * CREATE TABLE building(
 * id INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 * name VARCHAR(45) NOT NULL COMMENT '教学楼名称',
 * code INT(8) NOT NULL COMMENT '编码,需要在程序中自动补全为2位',
 * title VARCHAR(45) NOT NULL COMMENT '备注',
 * status TINYINT default 0 COMMENT '考场状态信息'
 * )DEFAULT CHARSET=utf8 COMMENT='教学楼表';
*/
class Building extends Model{
    const INUSE = 0;
    const DELETED = 1;

    public function add($name, $code, $title, $status = self::INUSE){
        $this->validateCode($code);
        $stmt = $this->db->prepare("INSERT INTO building (name, code, title, status) VALUES (:name, :code, :title, :status)");
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':title', $title);
        $stmt->bindValue(':status', $status, \PDO::PARAM_INT);

        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的服务器错误', 500);
        }
    }

    public function update($id, $name, $code, $title, $status = self::INUSE){
        $this->validateCode($code);
        $stmt = $this->db->prepare("UPDATE building SET name=:name, code=:code, title=:title, status=:status WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':title', $title);
        $stmt->bindValue(':status', $status, \PDO::PARAM_INT);
        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的服务器错误', 500);
        }
    }

    public function query($id = 0){
        if($id == 0){
            throw new \Exception('请求的教学楼信息不存在', 404);
        }
        $stmt = $this->db->prepare("SELECT * FROM building WHERE id = :id AND status = :status");
        $stmt->bindParam(':id', $id);
        $stmt->bindValue(':status', self::INUSE);
        if($stmt->execute()){
            $result = $stmt->fetch();
            if($result != false){
                if(!empty($result)){
                    return $result;
                }else{
                    throw new \Exception('请求的教学楼信息不存在', 404);
                }
            }else{
                throw new \Exception('数据库查询失败', 500);
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    public function queryAllName(){
        $stmt = $this->db->prepare("SELECT id, name FROM building WHERE status = :status");
        $stmt->bindValue(':status', self::INUSE, \PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            if($result != false){
                if(!empty($result)){
                    return $result;
                }else{
                    throw new \Exception('请求的教学楼信息不存在', 404);
                }
            }else{
                throw new \Exception('数据库查询失败', 500);
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }

    }

    public function delete($id){
        $stmt = $this->db->prepare("UPDATE building SET status = :status WHERE id = :id");
        $stmt->bindValue(':status', self::DELETED, \PDO::PARAM_INT);
        $stmt->bindParam(':id', $id);
        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的服务器错误', 500);
        }
    }

    public function getCount(){
        $result = $this
        ->db
        ->query("SELECT COUNT(*) FROM building WHERE status = " . self::INUSE);
        if($result === false){
            throw new \Exception('数据库查询失败', 500);
        }
        $result = $result->fetch();
        if($result === false){
            throw new \Exception('数据库查询失败', 500);
        }else{
            return intval($result[0]);
        }
    }

    public function queryAllLimit($start, $num){
        $stmt = $this->db->prepare("SELECT * FROM building WHERE status = :status LIMIT :start,:num");
        $stmt->bindValue(':status', self::INUSE, \PDO::PARAM_INT);
        $stmt->bindValue(':start', $start, \PDO::PARAM_INT);
        $stmt->bindValue(':num', $num, \PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            if($result !== false){
                return $result;
            }else{
                return [];
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }


    private function validateCode(&$code){
        $code = intval($code);
        if($code > 99 || $code < 1){
            throw new \Exception('教学楼编号必须在1~99之间', 400);
        }
    }
}
?>
