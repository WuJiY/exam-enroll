<?php
namespace Kezhi\Model;
/**
 * 教室表
 *
 * CREATE TABLE room(
 * id INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 * location INT(8) NOT NULL COMMENT '教学楼ID',
 * code INT(8) NOT NULL COMMENT UNIQUE '教室编号,自动补全为4位',
 * title VARCHAR(45) NOT NULL COMMENT '备注',
 * volume INT(8) NOT NULL DEFAULT 0 COMMENT '可容纳学生数量',
 * status TINYINT NOT NULL DEFAULT 0 COMMENT '状态',
 * FOREIGN KEY(location) REFERENCES building(id) ON UPDATE CASCADE ON DELETE CASCADE
 * )DEFAULT CHARSET=utf8 COMMENT='教室表';
*/
class Room extends Model{
    const INUSE = 0;
    const DELETED = 1;

    public function add($location, $code, $title, $volume, $status = self::INUSE){
        $this->validateCode($code);
        $stmt = $this->db->prepare("INSERT INTO room (location, code, title, volume, status) VALUES (:location, :code, :title, :volume, :status)");
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':volume', $volume);
        $stmt->bindValue(':status', $status);
        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的服务器错误', 500);
        }
    }

    public function update($id, $location, $code, $title, $volume, $status = self::INUSE){
        $this->validateCode($code);
        $stmt = $this->db->prepare("UPDATE room SET location=:location, code=:code, title=:title, volume=:volume, status=:status WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':location', $location);
        $stmt->bindParam(':code', $code);
        $stmt->bindParam(':title', $title);
        $stmt->bindParam(':volume', $volume);
        $stmt->bindValue(':status', $status);
        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的服务器错误', 500);
        }
    }

    public function delete($id){
        $stmt = $this->db->prepare("UPDATE room SET status = :status WHERE id = :id");
        $stmt->bindValue(':status', self::DELETED, \PDO::PARAM_INT);
        $stmt->bindParam(':id', $id);
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
        $stmt = $this->db->prepare("SELECT * FROM room WHERE id = :id AND status = :status");
        $stmt->bindParam(':id', $id);
        $stmt->bindValue(':status', self::INUSE);
        if($stmt->execute()){
            $result = $stmt->fetch();
            if($result != false){
                if(!empty($result)){
                    return $result;
                }else{
                    throw new \Exception('请求的教室信息不存在', 404);
                }
            }else{
                throw new \Exception('数据库查询失败', 500);
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    /**
     * 查询所有的教室信息
     */
    public function queryAll(){
        $stmt = $this->db->prepare("SELECT a.id, a.code, a.title, a.volume, b.name, b.code AS building_code, b.title AS building_title
            FROM room a
            LEFT JOIN building b ON a.location = b.id
            WHERE status = :status");
        $stmt->bindValue(':status', self::INUSE);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            if($result != false){
                return $result;
            }else{
                throw new \Exception('数据库查询失败', 500);
            }
        }else {
            throw new \Exception('数据库查询失败', 500);
        }

    }

    public function queryAllLimit($start, $num){
        $stmt = $this->db->prepare("SELECT a.id, a.code, a.title, a.volume, b.name FROM room a LEFT JOIN building b ON a.location = b.id WHERE a.status = :status LIMIT :start,:num");
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

    public function getCount(){
        $result = $this
        ->db
        ->query("SELECT COUNT(*) FROM room WHERE status = " . self::INUSE);
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

    private function validateCode(&$code){
        $code = intval($code);
        if($code > 9999 || $code < 1){
            throw new \Exception('教学楼编号必须在1~9999之间,前两位数表示楼层，后两位数表示教室流水号', 400);
        }
    }
}
?>
