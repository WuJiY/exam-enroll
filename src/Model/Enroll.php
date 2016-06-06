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

    /**
     * @param $exam_id
     * @param $uid
     * @return bool
     * @throws \Exception
     */
    public function checkHave($exam_id, $uid){
        $stmt = $this->db->prepare("SELECT id FROM enroll WHERE exam_id=:exam_id AND uid=:uid");
        $stmt->bindParam(':uid', $uid);
        $stmt->bindParam(':exam_id', $exam_id);
        if($stmt->execute()){
            if($stmt->rowCount() == 0){
                return false;   // 表示没有该记录
            }
            $result = $stmt->fetch();
            if($result === false){
                throw new \Exception('数据库查询失败', 500);
            }else{
                return $result[0];  // 返回该记录的id
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    /**
     * @param $exam_id
     * @param $uid
     * @param int $enroll_status
     * @param int $pay_status
     * @param int $status
     * @return bool
     * @throws \Exception
     */
    public function add($exam_id, $uid, $enroll_status = self::ENROLLED, $pay_status = self::NOT_PAYED, $status = self::INUSE){
        $stmt = $this->db->prepare("INSERT INTO enroll (exam_id, uid, update_time, status, enroll_status, pay_status) VALUES (:exam_id, :uid, :update_time, :status, :enroll_status, :pay_status)");
        $stmt->bindParam(':exam_id', $exam_id);
        $stmt->bindParam(':uid', $uid);
        $stmt->bindValue(':update_time', time());
        $stmt->bindParam(':status', $status);
        $stmt->bindParam(':enroll_status', $enroll_status);
        $stmt->bindParam(':pay_status', $pay_status);
        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的新增报名信息失败', 500);
        }
    }

    /**
     * @param $id
     * @param $status
     * @return bool
     * @throws \Exception
     */
    public function setEnrollStatus($id, $status){
        $stmt = $this->db->prepare("UPDATE enroll SET enroll_status = :enroll_status WHERE id = :id LIMIT 1");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':enroll_status', $status);
        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的设置报名状态失败', 500);
        }
    }

    /**
     * @param $data
     */
    public function importPay(&$data){
        $stmt = $this->db->prepare("UPDATE enroll SET pay_status = :paystatus WHERE id = :id LIMIT 1");
        foreach ($data as &$value){
            if($value['ispay'] == '是' || $value['ispay'] == '已缴费'){
                $stmt->bindValue('paystatus', self::PAYED);
            }else{
                $stmt->bindValue('paystatus', self::NOT_PAYED);
            }
            $stmt->bindValue('id', $value['id']);
            if($stmt->execute()){
                $value['opstatus'] = 'success';
            }else{
                $value['opstatus'] = 'error';
            }
        }
        unset($value);
    }

    /**
     * @param $id
     * @param $status
     * @param $uid
     * @return bool
     * @throws \Exception
     */
    public function setEnrollStatusStudent($id, $status, $uid){
        $stmt = $this->db->prepare("UPDATE enroll, exam SET enroll.enroll_status = :enroll_status WHERE enroll.id = :id AND enroll.exam_id = exam.id AND enroll.uid = :uid AND exam.enroll_status = 1");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':enroll_status', $status);
        $stmt->bindParam(':uid', $uid);
        if($stmt->execute()){
            if($stmt->rowCount() == 0){
                throw new \Exception('取消失败，可能是由于当前不在报名期', 403);
            }else{
                return true;
            }

        }else{
            throw new \Exception('未知原因导致的设置报名状态失败', 500);
        }
    }

    /**
     * @param Int $id
     * @param Int $pay_status
     * @return bool
     * @throws \Exception
     */
    public function setPayStatus($id, $pay_status)
    {
        $stmt = $this->db->prepare("UPDATE enroll SET pay_status = :pay_status WHERE id = :id LIMIT 1");
        $stmt->bindParam('pay_status', $pay_status);
        $stmt->bindParam('id', $id);
        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的设置报名状态失败', 500);
        }
    }

    /**
     * @param $uid
     * @param $start
     * @param $num
     * @return array
     * @throws \Exception
     */
    public function queryAllUserLimit($uid, $start, $num){
        $stmt = $this->db->prepare("SELECT a.*, b.name, b.exam_time FROM enroll a LEFT JOIN exam b ON b.id = a.exam_id WHERE a.uid = :uid AND a.status = :status AND a.enroll_status = :enroll_status LIMIT :start, :num");
        $stmt->bindValue(':status', self::INUSE, \PDO::PARAM_INT);
        $stmt->bindValue(':start', $start, \PDO::PARAM_INT);
        $stmt->bindValue(':num', $num, \PDO::PARAM_INT);
        $stmt->bindParam(':uid', $uid);
        $stmt->bindValue(':enroll_status', self::ENROLLED, \PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            if($result === false){
                throw new \Exception('数据库查询失败', 500);
            }else{
                return $result;
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    /**
     * @param int $uid
     * @return mixed
     * @throws \Exception
     */
    public function getCountUser($uid = 0){
        if ($uid == 0){
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM enroll WHERE status = :status AND enroll_status = :enroll_status");
        }else{
            $stmt = $this->db->prepare("SELECT COUNT(*) FROM enroll WHERE uid = :uid AND status = :status AND enroll_status = :enroll_status");
            $stmt->bindParam(':uid', $uid);
        }
        $stmt->bindValue(':status', self::INUSE, \PDO::PARAM_INT);
        $stmt->bindValue(':enroll_status', self::ENROLLED, \PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetch();
            if($result === false){
                throw new \Exception('数据库查询失败', 500);
            }else{
                return $result[0];
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    /**
     * @return mixed
     * @throws \Exception
     */
    public function getCount(){
        return $this->getCountUser(0);
    }

    /**
     * @param array $exams
     * @return array
     * @throws \Exception
     */
    public function getExportData(Array $exams){
        $stmt = $this
        ->db
        ->prepare("SELECT a.id, a.pay_status, b.student_number, b.name, b.sex, b.nation, b.id_card_number, b.telephone_number, b.college, b.grade, b.major, b.class, b.status, c.type
             FROM enroll a
             LEFT JOIN user_info b ON b.uid = a.uid
             LEFT JOIN exam c ON c.id = a.exam_id
             WHERE a.exam_id IN (:exams)
             AND a.enroll_status = :enroll_status");
        $stmt->bindValue(':exams', implode(',', $exams));
        $stmt->bindValue(':enroll_status', self::ENROLLED, \PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            if($result === false){
                throw new \Exception('数据库查询失败', 500);
            }else{
                return $result;
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    /**
     * @param array $exams
     * @return array
     * @throws \Exception
     */
    public function getExportDatas(Array $exams){
        $stmt = $this
        ->db
        ->prepare("SELECT a.id AS id, b.type AS type, c.student_number, c.name, c.sex, c.nation, c.id_card_number, c.telephone_number, c.college, c.grade, c.major, c.class
        FROM (enroll a,exam b)
        LEFT JOIN user_info c ON c.uid = a.uid
        WHERE a.exam_id = b.id AND a.exam_id IN (:exams) AND a.enroll_status = :enroll_status
        ORDER BY a.uid");
        $stmt->bindValue(':exams', implode(',', $exams));
        $stmt->bindValue(':enroll_status', self::ENROLLED, \PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            if($result === false){
                throw new \Exception('数据库查询失败', 500);
            }else{
                return $result;
            }
        }else{
            throw new \Exception('数据库查询失败1', 500);
        }
    }

    /**
     * @return Object
     * @throws \Exception
     */
    public function getPayInfoLimit($start, $num)
    {
        $stmt = $this->db->prepare("SELECT a.pay_status, a.id, a.uid, b.name, b.student_number, b.id_card_number, b.telephone_number, b.college, b.grade, b.major, b.class
                  FROM enroll a
                  LEFT JOIN user_info b ON a.uid = b.uid
                  WHERE a.status = :status AND a.enroll_status = :enroll_status
                  LIMIT :start, :num");
        $stmt->bindValue('status', self::INUSE);
        $stmt->bindParam(':start', $start, \PDO::PARAM_INT);
        $stmt->bindParam(':num', $num, \PDO::PARAM_INT);
        $stmt->bindValue(':enroll_status', self::ENROLLED, \PDO::PARAM_INT);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            if($result === false){
                throw new \Exception('数据库查询失败', 500);
            }else{
                return $result;
            }
        }else{
            throw new \Exception('数据库查询失败1', 500);
        }
    }

    /**
     * 获取所有报名且缴费成功的用户信息，根据传入的参数决定
     * @param $exams array
     * @throws \Exception
     * @return array 获取到的结果
     */
    public function queryPayUserInfo($exams)
    {
        $stmt = $this->db->prepare("SELECT a.*, b.student_number FROM enroll a
            LEFT JOIN user_info b ON a.uid = b.uid 
            WHERE exam_id IN (:exams) AND enroll_status = :enroll_status AND pay_status = :pay_status
            ORDER BY b.student_number");
        $stmt->bindValue('exams', explode(',', $exams));
        $stmt->bindValue('enroll_status', self::ENROLLED);
        $stmt->bindValue('pay_status', self::PAYED);
        if($stmt->execute()){
            $result = $stmt->fetchAll();
            if($result === false){
                throw new \Exception('获取数据集失败', 500);
            }else{
                return $result;
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }
}
?>
