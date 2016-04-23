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
        $stmp = $this->db->prepare("INSERT INTO room (location, code, title, volume, status) VALUES (:location, :code, :title, :volume, :status)");
        $stmp->bindParam(':location', $location);
        $stmp->bindParam(':code', $code);
        $stmp->bindParam(':title', $title);
        $stmp->bindParam(':volume', $volume);
        $stmp->bindValue(':status', $status);
        if($stmp->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的服务器错误', 500);
        }
    }

    public function update($id, $location, $code, $title, $volume, $status = self::INUSE){
        $this->validateCode($code);
        $stmp = $this->db->prepare("UPDATE room SET location=:location, code=:code, title=:title, volume=:volume, status=:status WHERE id = :id LIMIT 1");
        $stmp->bindParam(':id', $id);
        $stmp->bindParam(':location', $location);
        $stmp->bindParam(':code', $code);
        $stmp->bindParam(':title', $title);
        $stmp->bindParam(':volume', $volume);
        $stmp->bindValue(':status', $status);
        if($stmp->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的服务器错误', 500);
        }
    }

    public function delete($id){
        $stmp = $this->db->prepare("UPDATE room SET status = :status WHERE id = :id");
        $stmp->bindValue(':status', self::DELETED, \PDO::PARAM_INT);
        $stmp->bindParam(':id', $id);
        if($stmp->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的服务器错误', 500);
        }
    }

    public function queryAllLimit($start, $num){
        $stmp = $this->db->prepare("SELECT a.id, a.code, a.title, a.volume, b.name FROM room a LEFT JOIN building b ON a.location = b.id WHERE a.status = :status LIMIT :start,:num");
        $stmp->bindValue(':status', self::INUSE, \PDO::PARAM_INT);
        $stmp->bindValue(':start', $start, \PDO::PARAM_INT);
        $stmp->bindValue(':num', $num, \PDO::PARAM_INT);
        if($stmp->execute()){
            $result = $stmp->fetchAll();
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
