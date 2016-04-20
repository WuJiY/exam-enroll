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
