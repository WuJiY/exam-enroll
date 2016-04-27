<?php
namespace Kezhi\Controller;
use Kezhi\Model as Model;

class Image extends Controller{
    public function show($filename){
        $image = file_get_contents(__IMAGES__ . $filename);
        header('Content-type : image/jpeg, image/png');
        echo $image;
        exit;
    }

    public function getPhoto($uid){
        $photo = new Model\Photo();
        if($photo->checkHas($uid)){
            $info = $photo->query($uid);
        }else{
            $info = [
                'name'  =>  'default.png'
            ];
        }

        $this->show($info['name']);
    }

    public function upload(){
        $upload = new \Kezhi\Common\Upload();
        if($_SESSION['role'] == 'student'){
            $uid = $_SESSION['uid'];
        }else{
            $uid = isset($_POST['uid']) ? intval($_POST['uid']) : 0;
        }
        if(isset($_FILES['photo'])){
            try{
                $file = $upload->image('photo');
                $photo = new Model\Photo();
                if($photo->checkHas($uid)){
                    $photo->update($uid, $file);
                }else{
                    $photo->add($file, $uid);
                }
                if($_SESSION['role'] == 'student'){
                    $this->redirect('/index.php/modify_photo');
                }else{
                    $this->redirect('/index.php/student/edit/student_info/' . $uid);
                }

            }catch(\Exception $e){
                $this->error('数据库处理失败');
            }
        }else{
            $this->error('文件上传失败');
        }
    }
}
