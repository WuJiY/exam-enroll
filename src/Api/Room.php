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
}
?>
