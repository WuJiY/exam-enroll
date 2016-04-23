<?php
namespace Kezhi\Model;

/**
 * 报名信息表
 *
 * CREATE TABLE enroll (
 * id INT(8) NOT NULL AUTO_INCREMENT PRIMARY KEY,
 * exam_id INT(8) NOT NULL COMMENT '报名哪个考试项目',
 * uid INT(8) NOT NULL COMMENT '用户id',
 * create_time TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '记录创建时间',
 * update_time TIMESTAMP NOT NULL COMMENT '最后更新时间',
 * status TINYINT NOT NULL DEFAULT 0 COMMENT '记录状态信息',
 * enroll_status TINYINT NOT NULL DEFAULT 0 COMMENT '报名状态',
 * pay_status TINYINT NOT NULL DEFAULT 0 COMMENT '缴费状态',
 * FOREIGN KEY(exam_id) REFERENCES exam(id) ON DELETE CASCADE ON UPDATE CASCADE,
 * FOREIGN KEY(uid) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
 * )DEFAULT CHARSET=utf8 COMMENT='报名信息表';
*/
class Enroll extends Model{
    const INUSE = 0;
    const DELETED = 1;
    const ENROLLED = 1;
    const NOT_ENROLLED = 0;
    const PAYED = 1;
    const NOT_PAYED = 0;

    public function checkHave($exam_id, $uid){
        $stmp = $this->db->prepare("SELECT id FROM enroll WHERE exam_id=:exam_id AND uid=:uid");
        $stmp->bindParam(':uid', $uid);
        $stmp->bindParam(':exam_id', $exam_id);
        if($stmp->execute()){
            if($stmp->rowCount() == 0){
                return false;   // 表示没有该记录
            }
            $result = $stmp->fetch();
            if($result === false){
                throw new \Exception('数据库查询失败', 500);
            }else{
                return $result[0];  // 返回该记录的id
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    public function add($exam_id, $uid, $enroll_status = self::ENROLLED, $pay_status = self::NOT_PAYED, $status = self::INUSE){
        $stmp = $this->db->prepare("INSERT INTO enroll (exam_id, uid, update_time, status, enroll_status, pay_status) VALUES (:exam_id, :uid, :update_time, :status, :enroll_status, :pay_status)");
        $stmp->bindParam(':exam_id', $exam_id);
        $stmp->bindParam(':uid', $uid);
        $stmp->bindValue(':update_time', time());
        $stmp->bindParam(':status', $status);
        $stmp->bindParam(':enroll_status', $enroll_status);
        $stmp->bindParam(':pay_status', $pay_status);
        if($stmp->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的新增考试失败', 500);
        }
    }

    public function setEnrollStatus($id, $status){
        $stmp = $this->db->prepare("UPDATE enroll SET enroll_status = :enroll_status WHERE id = :id LIMIT 1");
        $stmp->bindParam(':id', $id);
        $stmp->bindParam(':enroll_status', $status);
        if($stmp->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的设置报名状态失败', 500);
        }
    }
}
?>
