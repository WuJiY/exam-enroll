<?php
/**
 * Created by PhpStorm.
 * User: swumao
 * Date: 2016/6/5
 * Time: 16:39
 */

namespace Kezhi\Model;

/**
 * Class ExamInfo
 * CREATE TABLE `exam_info` (
`id` int(11) NOT NULL AUTO_INCREMENT,
`exam_number` varchar(255) NOT NULL DEFAULT '' COMMENT '学生考号',
`uid` int(11) NOT NULL DEFAULT '0' COMMENT '用户id',
`exam_id` int(11) NOT NULL DEFAULT '0' COMMENT '考试项目id',
`status` tinyint(3) NOT NULL DEFAULT '0' COMMENT '是否被删除',
`grade` float(6,5) NOT NULL DEFAULT '-1.00000' COMMENT '成绩',
PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
 * @package Kezhi\Model
 */
class ExamInfo extends Model
{
    /**
     * @var int 正在使用中的状态
     */
    const INUSE = 0;
    /**
     * @var int 已经被删除的状态
     */
    const DELETED = 1;

    public function add($exam_number, $uid, $exam_id, $status = self::INUSE, $grade = -1.0)
    {
        $stmt = $this->db->prepare("INSERT INTO exam_info (exam_number, uid, exam_id, status, grade) 
VALUES (:exam_number, :uid, :exam_id, :status, :grade)");
        $stmt->bindParam('exam_number', $exam_number);
        $stmt->bindParam('uid', $uid);
        $stmt->bindParam('exam_id', $exam_id);
        $stmt->bindParam('status', $status);
        $stmt->bindParam('grade', $grade);
        if($stmt->execute()){
            return true;
        }else{
            throw new \Exception('数据库错误', 500);
        }
    }
}