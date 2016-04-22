<?php
/**
 * 模型
*/
namespace Kezhi\Model;
/**
 * 考试信息表
 * CREATE TABLE exam (
 * id INT(8) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 * name VARCHAR(45) NOT NULL COMMENT '考试名称',
 * type TINYINT NOT NULL DEFAULT 0 COMMENT '考试类型',
 * title TEXT NOT NULL DEFAULT '无' COMMENT '考试说明',
 * create_time TIMESTAMP(14) NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT '记录创建时间',
 * update_time TIMESTAMP(14) NOT NULL DEFAULT 0 ON COMMENT '最后更新时间',
 * exam_time TIMESTAMP(14) NOT NULL COMMENT '考试开始时间',
 * status TINYINT NOT NULL DEFAULT 0 COMMENT '状态'
 * )DEFAULT CHARSET=utf8 COMMENT='考试信息表';
*/
class Exam extends Model{
    const INUSE = 0;
    const DELETED = 1;
    protected $exam_types = null;

    public function __construct(){
        parent::__construct();
        global $conf;
        $conf->load(__CONF__ . '/' . $conf['rules']['exam_types_config_file']);
        $this->exam_types = $conf['exam_types'];
    }

    public function getExamTypes(){
        return is_null($this->exam_types) ? [] : $this->exam_types;
    }

    public function getExamTypeName($id){
        if(is_null($this->exam_types)){
            return '无';
        }
        foreach($this->exam_types as $v){
            if($v['id'] == $id){
                return $v['name'];
            }
        }
        return '无';
    }

    public function add($name, $type, $title, $exam_time){
        $this->checkType($type);
        $stmp = $this->db->prepare("INSERT INTO exam (name, type, title, update_time, exam_time, status) VALUES (:name, :type, :title, :update_time, :exam_time, :status)");
        $stmp->bindParam(':name', $name);
        $stmp->bindParam(':type', $type);
        $stmp->bindParam(':title', $title);
        $stmp->bindValue(':update_time', date('YmdHis', time()));
        $stmp->bindParam(':exam_time', $exam_time);
        $stmp->bindValue(':status', self::INUSE, \PDO::PARAM_INT);
        if($stmp->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的新增考试失败', 500);
        }
    }

    public function update($id, $name, $type, $title, $exam_time){
        $this->checkType($type);
        $stmp = $this->db->prepare("UPDATE exam SET name = :name, type = :type, title = :title, update_time = :update_time, exam_time = :exam_time WHERE id = :id LIMIT 1");
        $stmp->bindParam(':name', $name);
        $stmp->bindParam(':type', $type);
        $stmp->bindParam(':title', $title);
        $stmp->bindValue(':update_time', date('YmdHis', time()));
        $stmp->bindParam(':exam_time', $exam_time);
        $stmp->bindValue(':id', $id, \PDO::PARAM_INT);
        if($stmp->execute()){
            return true;
        }else{
            throw new \Exception('未知原因导致的新增考试失败', 500);
        }
    }

    public function getCount(){
        $result = $this
        ->db
        ->query("SELECT COUNT(*) FROM exam WHERE status = " . self::INUSE);
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

    public function query($id = 0){
        if($id == 0){
            throw new \Exception('请求的考试信息不存在', 404);
        }
        $stmp = $this->db->prepare("SELECT * FROM exam WHERE id = :id LIMIT 1");
        $stmp->bindValue(':id', $id, \PDO::PARAM_INT);
        if($stmp->execute()){
            $result = $stmp->fetch();
            if($result != false){
                if(!empty($result)){
                    return $result;
                }else{
                    throw new \Exception('请求的考试信息不存在', 404);
                }
            }else{
                throw new \Exception('数据库查询失败', 500);
            }
        }else{
            throw new \Exception('数据库查询失败', 500);
        }
    }

    public function queryAllLimit($start, $num){
        $stmp = $this->db->prepare("SELECT * FROM exam WHERE status = :status LIMIT :start,:num");
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

    public function delete($id = 0){
        if($id == 0){
            throw new \Exception('请求的数据不存在', 404);
        }
        $stmp = $this->db->prepare("UPDATE exam SET status = :status WHERE id = :id");
        $stmp->bindValue(':status', self::DELETED, \PDO::PARAM_INT);
        $stmp->bindParam(':id', $id);
        if($stmp->execute()){
            return true;
        }else{
            return false;
        }
    }

    private function checkType($type){
        if(is_null($this->exam_types)){
            throw new \Exception('检测考试类型时发生错误', 500);
        }
        foreach($this->exam_types as $v){
            if($v['id'] == $type){
                return;
            }
        }
        throw new \Exception('检测考试类型时发生错误', 422);
    }
}
?>
