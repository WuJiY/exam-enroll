<?php
namespace Kezhi\Model;
/**
 * 学生信息表
 * CREATE TABLE user_info(
 * uid INT(8) NOT NULL PRIMARY KEY,
 * student_number VARCHAR(45) default NULL,
 * name VARCHAR(45) default NULL,
 * sex INT(8) default 2 COMMENT '0表示男，1表示女，2表示未知',
 * nation VARCHAR(45) default 0 COMMENT '0表示未知',
 * id_card_number VARCHAR(45) default NULL COMMENT '身份证号',
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
        try{
            is_null($data['student_number']) ? "" : $this->validate_student_number($data['student_number']);
            is_null($data['id_card_number']) ? "" : $this->validate_id_card_number($data['id_card_number']);
            is_null($data['telephone_number']) ? "" : $this->validate_telephone_number($data['telephone_number']);
            $stmp = $this
            ->db
            ->prepare("INSERT INTO user_info (uid, student_number, name, sex, nation, id_card_number, telephone_number, college, grade, major, class) VALUES (:id, :student_number, :name, :sex, :nation, :id_card_number, :telephone_number, :college, :grade, :major, :class)");
            $stmp->bindParam(':id', $id);
            $stmp->bindParam(':student_number', $student_number);
            $stmp->bindParam(':name', $name);
            $stmp->bindParam(':sex', $sex);
            $stmp->bindParam(':nation', $nation);
            $stmp->bindParam(':id_card_number', $id_card_number);
            $stmp->bindParam(':telephone_number', $telephone_number);
            $stmp->bindParam(':college', $college);
            $stmp->bindParam(':grade', $grade);
            $stmp->bindParam(':major', $major);
            $stmp->bindParam(':class', $class);
            $id = $id;
            $student_number = $data['student_number'];
            $name = $data['name'];
            $sex = $data['sex'];
            $nation = $data['nation'];
            $id_card_number = $data['id_card_number'];
            $telephone_number = $data['telephone_number'];
            $college = $data['college'];
            $grade = $data['grade'];
            $major = $data['major'];
            $class = $data['class'];
            if($stmp->execute()){
                return true;
            }else{
                return false;
            }
        }catch(\Exception $e){
            throw $e;
        }

    }

    public function query($uid){
        $stmp = $this->db->prepare("SELECT * FROM ");
    }

    /**
     * 导入操作
     *
     * @param Reference $data Array 要导入的数据，二维数组，是一个引用，导入结果将在$data中修改
    */
    public function import(Array &$data){
        $stmp = $this
        ->db
        ->prepare("INSERT INTO user_info (uid, student_number, name, sex, nation, id_card_number, telephone_number, college, grade, major, class) VALUES (:id, :student_number, :name, :sex, :nation, :id_card_number, :telephone_number, :college, :grade, :major, :class)");
        $stmp->bindParam(':id', $id);
        $stmp->bindParam(':student_number', $student_number);
        $stmp->bindParam(':name', $name);
        $stmp->bindParam(':sex', $sex);
        $stmp->bindParam(':nation', $nation);
        $stmp->bindParam(':id_card_number', $id_card_number);
        $stmp->bindParam(':telephone_number', $telephone_number);
        $stmp->bindParam(':college', $college);
        $stmp->bindParam(':grade', $grade);
        $stmp->bindParam(':major', $major);
        $stmp->bindParam(':class', $class);
        foreach($this->filter($data) as $v){
            try{
                $id = $v['id'];
                $student_number = $v['student_number'];
                $name = $v['name'];
                $sex = $v['sex'];
                $nation = $v['nation'];
                $id_card_number = $v['id_card_number'];
                $telephone_number = $v['telephone_number'];
                $college = $v['college'];
                $grade = $v['grade'];
                $major = $v['major'];
                $class = $v['class'];
                if($stmp->execute()){
                    $data[$v['k']]['operater_status'] = '操作成功';
                }else{
                    $data[$v['k']]['operater_status'] = '操作失败';
                }
            }catch(\Exception $e){
                $data[$v['k']]['operater_status'] =$e->getMessage();
            }
        }
    }

    /**
     * 数据过滤器
     *
     * @param Reference $data Array 需要过滤的数据
     * @return Array 每次调用将返回一条记录
    */
    private function filter(Array &$data){
        foreach($data as $k=>$v){
            try{
                $this->validate_student_number($v['student_number']);
                if(!empty($v['id_card_number'])){
                    $this->validate_id_card_number($v['id_card_number']);
                }
                if(!empty($v['telephone_number'])){
                    $this->validate_telephone_number($v['telephone_number']);
                }
                $has_user = $this->_user->query(0, 'sn_' . $v['student_number']);
                if($has_user === false){    // 没有用户记录 需要进行插入操作
                    if($this->_user->add( 'sn_' . $v['student_number'], empty($v['id_card_number']) ? "12345678" : $v['id_card_number']) == false){
                        $data[$k]['operater_status'] = '新增用户时出现了某些问题';
                    }else{
                        $has_user = $this->_user->query(0, $v['student_number']);
                    }
                }
                if($has_user !== false){
                    yield [
                        'id'    =>  $has_user['id'],
                        'student_number'    =>  $v['student_number'],
                        'name'  =>  empty($v['name']) ? "noname" : $v['name'],
                        'sex'   =>  empty($v['sex']) ? 2 : $v['sex'] == '男' ? 0 : $v['sex'] == '女' ? 1 : 2,
                        'nation'    =>  empty($v['nation']) ? "无" : $v['nation'],
                        'id_card_number'    =>  empty($v['id_card_number']) ? "" : $v['id_card_number'],
                        'telephone_number'  =>  empty($v['telephone_number']) ? "" : $v['telephone_number'],
                        'college'   =>  empty($v['college']) ? "无" : $v['college'],
                        'grade' =>  empty($v['grade']) ? "" : $v['grade'],
                        'major' =>  empty($v['major']) ? "" : $v['major'],
                        'class' =>  empty($v['class']) ? "" : $v['class'],
                        'k' =>  $k
                    ];
                }else{
                    $data[$k]['operater_status'] = '未知原因出现的问题';
                }
            }catch(\Exception $e){
                $data[$k]['operater_status'] = $e->getMessage();
            }
        }
        unset($v);
    }

    /**
     * Validate student Number
     * min_length : 3
     * max_length : 13
     * @param Reference $student_number 学号
    */
    public function validate_student_number(&$student_number){
        $student_number = $this->trimStr($student_number);
        $preg = "/^\d{3,13}/";
        if(!preg_match($preg, $student_number)){
            throw new \Exception('学号只能包含数字，长度必须在3-15之间', 400);
        }
    }

    /**
     * Validate id card number
     *
     * @param Reference $id_card_number 身份证号
    */
    public function validate_id_card_number(&$id_card_number){
        $id_card_number = $this->trimStr($id_card_number);
        $preg = "/^\d{17}([0-9]|X)$/";
        if(!preg_match($preg, $id_card_number)){
            throw new \Exception('身份证号码只支持18位，请检查身份证号码是否合法', 400);
        }
    }

    /**
     * Validate telephone_number
     *
     * @param Reference $telephone_number 手机号码
    */
    public function validate_telephone_number(&$telephone_number){
        $telephone_number = $this->trimStr($telephone_number);
        $preg = "/^\d{11}$/";
        if(!preg_match($preg, $telephone_number)){
            throw new \Exception('手机号码请输入11位数字', 400);
        }
    }

    private function trimStr($str){
        $str = trim($str);
        if(substr($str, 0, 1) == '\''){
            return substr_replace($str, '', 0, 1);
        }
        return $str;
    }
}
?>
