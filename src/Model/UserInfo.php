<?php
namespace Kezhi\Model;
/**
 * 学生信息表
 * CREATE TABLE user_info(
 * uid INT(8) NOT NULL PRIMARY KEY,
 * student_number VARCHAR(45) default NULL,
 * name VARCHAR(45) default NULL,
 * sex INT(8) default 2 COMMENT '0表示男，1表示女，2表示未知',
 * nation INT(8) default 0 COMMENT '0表示未知',
 * id_card_number VARCHAR(45) default NULL COMMENT ;身份证号;,
 * telephone_number VARCHAR(45) default NULL,
 * college VARCHAR(45) default NULL,
 * grade VARCHAR(45) default NULL,
 * major VARCHAR(45) default NULL,
 * class VARCHAR(45) default NULL,
 * FOREIGN KEY(uid) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
 * )default charset=utf8 COMMENT='学生信息表';
*/
class UserInfo extends Model{
    private $_user = null;
    private $student_number;
    private $id_card_number;
    private $telephone_number;

    public function __construct(){
        parent::__construct();
        $this->_user = new User();
    }
    /**
     * 新增一条记录
     *
     * @param integer $id user_id
     * @param Array $data 用户的个人信息
    */
    public function add($id, Array $data){

    }

    /**
     * 导入操作
     *
     * @param $data 要导入的数据，二维数组，是一个引用，导入结果将在$data中修改
    */
    public function import(&$data){
        foreach($data as &$v){
            $has_user = $this->_user->query(0, 'sn_' . $v['student_number']);
            if($has_user === false){    // 没有用户记录 需要进行插入操作

            }else{

            }
        }
    }

    /**
     * Validate student Number
     * min_length : 3
     * max_length : 13
     *
    */
    public function validate_student_number(){
        $this->student_number = trim($this->student_number);
        $preg = "/^\d{3,13}/";
        if(!preg_match($preg, $this->student_number)){
            throw new \Exception('学号只能包含数字，长度必须在3-15之间', 400);
        }
    }

    public function validate_id_card_number(){
        $this->id_card_number = trim($this->id_card_number);
        $preg = "/^\d{18}/";
    }

    public function validate_telephone_number(){

    }
}
?>
