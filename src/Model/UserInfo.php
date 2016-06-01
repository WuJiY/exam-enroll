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
 * status TINYINT default 0 COMMENT '状态位',
 * FOREIGN KEY(uid) REFERENCES user(id) ON DELETE CASCADE ON UPDATE CASCADE
 * )default charset=utf8 COMMENT='学生信息表';
*/
class UserInfo extends Model{
    private $_user = null;
    private $student_number;
    private $id_card_number;
    private $telephone_number;

    const INUSE = 0;
    const DELETED = 1;

    public function __construct(){
        parent::__construct();
        $this->_user = new User();
    }
    
    /**
     * 新增一条记录
     *
     * @param Int $id user_id
     * @param array $data 用户的个人信息
     * @return Boolean
     * @throws \Exception
    */
    public function add($id, Array $data){
        try{
            is_null($data['student_number']) ? "" : $this->validate_student_number($data['student_number']);
            is_null($data['id_card_number']) ? "" : $this->validate_id_card_number($data['id_card_number']);
            is_null($data['telephone_number']) ? "" : $this->validate_telephone_number($data['telephone_number']);
            $stmt = $this
            ->db
            ->prepare("INSERT INTO user_info (uid, student_number, name, sex, nation, id_card_number, telephone_number, college, grade, major, class, status) VALUES (:id, :student_number, :name, :sex, :nation, :id_card_number, :telephone_number, :college, :grade, :major, :class, :status)");
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':student_number', $student_number);
            $stmt->bindParam(':name', $name);
            $stmt->bindParam(':sex', $sex);
            $stmt->bindParam(':nation', $nation);
            $stmt->bindParam(':id_card_number', $id_card_number);
            $stmt->bindParam(':telephone_number', $telephone_number);
            $stmt->bindParam(':college', $college);
            $stmt->bindParam(':grade', $grade);
            $stmt->bindParam(':major', $major);
            $stmt->bindParam(':class', $class);
            $stmt->bindValue(':status', self::INUSE, \PDO::PARAM_INT);
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
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }catch(\Exception $e){
            throw $e;
        }
    }

    /**
     * 软删除用户信息
     *
     * @param integer $id 要删除的用户信息的id
     * @return bool 成功返回true，失败返回false
     * @throws \Exception
    */
    public function delete($id = 0){
        if($id == 0){
            throw new \Exception('请求的数据不存在', 404);
        }
        try{
            $stmt = $this->db->prepare("UPDATE user_info SET status = :status WHERE uid = :id");
            $stmt->bindValue(':status', self::DELETED, \PDO::PARAM_INT);
            $stmt->bindParam(':id', $id);
            if($stmt->execute()){
                return true;
            }else{
                return false;
            }
        }catch(\Exception $e){
            throw $e;
        }
    }
    
    public function findUserIdByIdCardNumber($idcardnumber){
        $stmt = $this->db->prepare("SELECT uid FROM user_info
            WHERE id_card_number = :idcardnumber LIMIT 1
            ");
        $stmt->bindParam(':idcardnumber', $idcardnumber);
        if($stmt->execute()){
            $result = $stmt->fetch();
            if($result != false){
                if(!empty($result)){
                    return $result['uid'];
                }
            }
            return false;
        }else{
            throw new \Exception('数据库错误');
        }
    }
    
    public function findUserIdByStudentNumber($studentnumber){
        $stmt = $this->db->prepare("SELECT uid FROM user_info
            WHERE student_number = :studentnumber LIMIT 1
            ");
        $stmt->bindParam(':studentnumber', $studentnumber);
        if($stmt->execute()){
            $result = $stmt->fetch();
            if($result != false){
                if(!empty($result)){
                    return $result['uid'];
                }
            }
            return false;
        }else{
            throw new \Exception('数据库错误');
        }
    }

    public function query($uid = 0){
        if($uid == 0){
            throw new \Exception('请求的用户信息不存在', 404);
        }
        try{
            $stmt = $this->db->prepare("SELECT a.* FROM user_info a LEFT JOIN photo b ON b.uid = a.uid WHERE a.uid = :id");
            $stmt->bindValue(':id', $uid, \PDO::PARAM_INT);
            if($stmt->execute()){
                $result = $stmt->fetch();
                if($result != false){
                    if(!empty($result)){
                        return $result;
                    }else{
                        throw new \Exception('请求的用户信息不存在', 404);
                    }
                }else{
                    throw new \Exception('数据库查询失败', 500);
                }
            }else{
                throw new \Exception('数据库查询失败', 500);
            }
        }catch(\Exception $e){
            throw $e;
        }
    }

    public function queryAllLimit($start, $num){
        $stmt = $this->db->prepare("SELECT * FROM user_info WHERE status = :status LIMIT :start,:num");
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

    /**
     * 获取记录总数
     *
     * @throws \Exception
     * @return integer 记录数量
    */
    public function getCount(){
        $result = $this
        ->db
        ->query("SELECT COUNT(*) FROM user_info WHERE status = " . self::INUSE);
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

    /**
     * 导入操作
     *
     * @param array &$data 要导入的数据，二维数组，是一个引用，导入结果将在$data中修改
    */
    public function import(Array &$data){
        $stmt = $this
        ->db
        ->prepare("INSERT INTO user_info (uid, student_number, name, sex, nation, id_card_number, telephone_number, college, grade, major, class, status) VALUES (:id, :student_number, :name, :sex, :nation, :id_card_number, :telephone_number, :college, :grade, :major, :class, :status)");
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':student_number', $student_number);
        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':sex', $sex);
        $stmt->bindParam(':nation', $nation);
        $stmt->bindParam(':id_card_number', $id_card_number);
        $stmt->bindParam(':telephone_number', $telephone_number);
        $stmt->bindParam(':college', $college);
        $stmt->bindParam(':grade', $grade);
        $stmt->bindParam(':major', $major);
        $stmt->bindParam(':class', $class);
        $stmt->bindValue(':status', self::INUSE, \PDO::PARAM_INT);
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
                if($stmt->execute()){
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
     * @param array $data 需要过滤的数据
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
                        'sex'   =>  empty($v['sex']) ? 2 : ($v['sex'] == '男' ? 0 : ($v['sex'] == '女' ? 1 : 2)),
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
     * @param Int $student_number 学号
     * @throws \Exception
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
     * @param Int $id_card_number 身份证号
     * @throws \Exception
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
     * @param string $telephone_number 手机号码
     * @throws \Exception
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
