<?php
namespace Kezhi\Model;
/**
 * CREATE TABLE photo (
 * id INT(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 * uid INT(8) NOT NULL DEFAULT 0 COMMENT '用户id',
 * name VARCHAR(45) NOT NULL,
 * extension VARCHAR(45) NOT NULL,
 * mime VARCHAR(45) NOT NULL,
 * size INT(8) NOT NULL,
 * md5 VARCHAR(32) NOT NULL,
 * dir VARCHAR(45) NOT NULL,
 * FOREIGN KEY(uid) REFERENCES user(id) ON UPDATE CASCADE ON DELETE CASCADE
 *)DEFAULT CHARSET=utf8;
*/
class Photo extends Model{
    public function query($uid){
        if($uid == 0){
            throw new \Exception('数据库查询失败', 500);
        }
        $stmt = $this->db->prepare("SELECT * FROM photo WHERE uid = :uid LIMIT 1");
        $stmt->bindParam(':uid', $uid);
        if($stmt->execute()){
            $result = $stmt->fetch();
            if($result !== false){
                return $result;
            }else{
                throw new \Exception('数据库查询成功但获取数据失败', 500);
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    /**
     * @return array 取得的所有数据
     * @throws \Exception
     */
    public function getAll()
    {
        $stmt = $this->db->prepare("SELECT a.*, b.student_number, b.name AS username 
                                FROM photo a , user_info b
                                GROUP BY a.uid");
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            if($result !== false){
                return $result;
            }else{
                throw new \Exception('数据库查询成功但获取数据失败', 500);
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    public function add($data, $uid = 0){
        $stmt = $this->db->prepare("INSERT INTO photo (uid, name, extension, mime, size, md5, dir) VALUES (:uid, :name, :extension, :mime, :size, :md5, :dir)");
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':extension', $extension);
        $stmt->bindParam(':mime', $mime);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':md5', $md5);
        $stmt->bindParam(':dir', $dir);
        $name = $data['name'];
        $extension = $data['extension'];
        $mime = $data['mime'];
        $size = $data['size'];
        $md5 = $data['md5'];
        $dir = $data['dir'];
        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('数据库操作失败', 500);
        }
    }

    public function update($uid, $data){
        $stmt = $this->db->prepare("UPDATE photo SET name = :name, extension = :extension, mime = :mime, size = :size, md5 = :md5, dir = :dir WHERE uid = :uid LIMIT 1");
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':extension', $extension);
        $stmt->bindParam(':mime', $mime);
        $stmt->bindParam(':size', $size);
        $stmt->bindParam(':md5', $md5);
        $stmt->bindParam(':dir', $dir);
        $name = $data['name'];
        $extension = $data['extension'];
        $mime = $data['mime'];
        $size = $data['size'];
        $md5 = $data['md5'];
        $dir = $data['dir'];
        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    public function setUser($id, $uid){
        $stmt = $this->db->prepare("UPDATE photo SET uid = :uid WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':uid', $uid);
        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    public function checkHas($uid){
        $stmt = $this->db->prepare("SELECT COUNT(*) FROM photo WHERE uid = :uid LIMIT 1");
        $stmt->bindParam(':uid', $uid);
        if($stmt->execute()){
            $result = $stmt->fetch();
            if($result !== false){
                if($result[0] > 0){
                    return true;
                }else{
                    return false;
                }
            }else{
                throw new \Exception('数据库查询成功但获取数据失败', 500);
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }
}
