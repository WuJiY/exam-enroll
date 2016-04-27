<?php
namespace Kezhi\Api;
use Kezhi\Model as Model;

class Photo extends Api{
    public function upload(){
        $upload = new \Kezhi\Common\Upload();
        $uid = $_SESSION['role'] == 'teacher'
        ? (isset($_POST['uid']) ? intval($_POST['uid']) : 0)
        : ($_SESSION['uid']);
        if(isset($_FILES['photo'])){
            try{
                $file = $upload->image('photo');
                $photo = new Model\Photo();
                $id = $photo->add($file, $uid);
                $this->result['status'] = parent::CREATED;
                $this->result['data'] = '照片上传成功';
            }catch(\Exception $e){
                $this->result['status'] = $e->getCode();
                $this->result['data'] = $e->getMessage();
                $this->sendJson();
            }
        }else{
            $this->result['status'] = 400;
            $this->result['data'] = '请以键photo上传文件';
        }
        $this->sendJson();
    }

    public function setPhotoUser(){
        $uid = isset($_POST['uid']) ? intval($_POST['uid']) : null;
        $photo_id = isset($_POST['photo_id']) ? intval($_POST['photo_id']) : null;
        if(is_null($uid) || is_null($photo_id)){
            $this->invalid_request();
        }
        try{
            $photo = new Model\Photo();
            $photo->setUser($id, $uid);
            $this->result['status'] = parent::CREATED;
            $this->result['data'] = '设置成功';
        }catch(\Exception $e){
            $this->result['status'] = $e->getCode();
            $this->result['data'] = $e->getMessage();
        }
        $this->sendJson();
    }
}
