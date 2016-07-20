<?php
namespace Kezhi\Api;

use Kezhi\Model as Model;

class Room extends Api{
    public function add(){
        $volume = isset($_POST['volume']) ? intval($_POST['volume']) : null;
        $code = isset($_POST['code']) ? $_POST['code'] : null;
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $building = isset($_POST['building']) ? intval($_POST['building']) : null;
        if(is_null($volume) || is_null($code) || is_null($title) || is_null($building)){
            $this->invalid_request();
        }
        try{
            $room = new Model\Room();
            $room->add($building, $code, $title, $volume);
            $this->result['status'] = parent::CREATED;
            $this->result['data'] = [
                'desc'  =>  '新增教室信息成功',
                'uri'   =>  '/index.php/room'
            ];
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }

    public function edit(){
        $volume = isset($_POST['volume']) ? intval($_POST['volume']) : null;
        $code = isset($_POST['code']) ? $_POST['code'] : null;
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $building = isset($_POST['building']) ? intval($_POST['building']) : null;
        $id = isset($_POST['id']) ? intval($_POST['id']) : null;
        if(is_null($volume) || is_null($code) || is_null($title) || is_null($building) || is_null($id)){
            $this->invalid_request();
        }
        try{
            $room = new Model\Room();
            $room->update($id, $building, $code, $title, $volume);
            $this->result['status'] = parent::CREATED;
            $this->result['data'] = [
                'desc'  =>  '修改教室信息成功',
                'uri'   =>  '/index.php/room'
            ];
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }

    public function delete(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        try{
            $room = new Model\Room();
            $room->delete($id);
            $this->result['status'] = parent::NO_CONTENT;
            $this->result['data'] = '删除教室信息成功';
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }

    public function building_add(){
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $code = isset($_POST['code']) ? $_POST['code'] : null;
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        if(is_null($name) || is_null($code) || is_null($title)){
            $this->invalid_request();
        }
        try{
            $building = new Model\Building();
            $building->add($name, $code, $title);
            $this->result['status'] = parent::CREATED;
            $this->result['data'] = [
                'desc'  =>  '新增教学楼信息成功',
                'uri'   =>  '/index.php/building'
            ];
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }

    public function building_edit(){
        $name = isset($_POST['name']) ? $_POST['name'] : null;
        $code = isset($_POST['code']) ? $_POST['code'] : null;
        $title = isset($_POST['title']) ? $_POST['title'] : null;
        $id = isset($_POST['id']) ? intval($_POST['id']) : null;
        if(is_null($name) || is_null($code) || is_null($title) || is_null($id)){
            $this->invalid_request();
        }
        try{
            $building = new Model\Building();
            $building->update($id, $name, $code, $title);
            $this->result['status'] = parent::CREATED;
            $this->result['data'] = [
                'desc'  =>  '修改教学楼信息成功',
                'uri'   =>  '/index.php/building'
            ];
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }

    public function building_delete(){
        $id = isset($_POST['id']) ? intval($_POST['id']) : 0;
        try{
            $building = new Model\Building();
            $building->delete($id);
            $this->result['status'] = parent::NO_CONTENT;
            $this->result['data'] = '删除教学楼信息成功';
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }

    /**
     * 获取所有的考场信息
     */
    public function all_rooms(){
        try{
            $room = new Model\Room();
            $results = $room->queryAll();
            $this->result['status'] = parent::OK;
            $this->result['data'] = [
                'message'   =>  '成功获取到考试项目信息',
                'data'  =>  $results
            ];
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }

    /**
     * 考场分配操作
     */
    public function allot()
    {
        $exams = isset($_POST['exams']) ? $_POST['exams'] : null;
        $rooms = isset($_POST['rooms']) ? $_POST['rooms'] : null;
        if(is_null($exams) || is_null($rooms)){
            $this->invalid_request();
        }
        try{
            // TODO 获取报名且缴费的学生信息及总数。对学生根据学号排序
            $enroll = new Model\Enroll();
            $students = $enroll->queryPayUserInfo($exams);
            // TODO 获取考场信息及可容纳学生总数
            $room = new Model\Room();
            $room_list = $room->queryRooms($rooms);
            $volume = $room->queryVolumes($rooms);
            // TODO 检测是否足够容纳这么多学生
            if($volume < $students){
                // 放不下这么多学生
                $this->result['status'] = parent::OK;
                $this->result['data'] = '选择的考场容纳不下这么多学生';
                $this->sendJson();
            }
            // TODO 开始进行分配，考号规则为2016 0/1 25 0304 08 ,分别对应年份，每年的考次，教学楼编号，教室编号，座位流水号。
            $date = getdate();
            $year = $date['year'];  // 考号的年份
            $times = $date['mon'] > 6 ? '1' : '0';    // 考号的考次，根据月份决定
            $exam_info = new Model\ExamInfo();
            $result = [];
            foreach ($room_list as $v){
                $building_code = sprintf("%'.02d", $v['building_code']);
                $room_code = sprintf("%'.04d", $v['code']);
                for($i = 1; $i <= $v['volume']; $i++){
                    $seat_number = sprintf("%'.02d", $i);
                    $exam_number = $year . $times . $building_code . $room_code . $seat_number;
                    $result[] = $building_code;
                    $student = array_shift($students);
                    if(is_null($student)){
                        // 学生已经全部分配完毕，跳出循环
                        break 2;    // 跳出两层循环
                    }
                    try{
                        if(!$exam_info->checkHas($student['uid'], $student['exam_id'])){
                            $exam_info->add($exam_number, $student['uid'], $student['exam_id']);
                        }else{
                            // 已经存在了分配了的记录，重新分配
                            $exam_info->update($exam_number, $student['uid'], $student['exam_id']);
                        }
                        $result[$exam_number] = [
                            $student,$v
                        ];
                    }catch (\Exception $e){
                        // 不继续抛出，忽略掉此学生继续进行分配
                        // TODO 记录下情况
                    }
                }
            }
            // 到此为止 终于分配完毕了，返回分配的数据给前台。
            $this->result['status'] = parent::CREATED;
            $this->result['data'] = $result;
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();

    }

    /**
     * 导出准考证
     * 可以传入学生uid导出一个学生，也可以传入学生uid数组导出多个学生，也可以传入考试项目id导出某个考试项目的学生，也可以传入考试项目数组导出多个考试项目的学生
     */
    public function export_tickets()
    {
        // TODO 获取输入信息并进行判断
        // TODO 获取需要导出的学生信息的数组
        // TODO 将数组传递给PDF操作类生成PDF文件
        // TODO 返回文件下载链接
    }
}
?>
