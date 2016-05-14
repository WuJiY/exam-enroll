<?php 
namespace Kezhi\Controller;

use Alchemy\Zippy\Zippy;
use Kezhi\Model\UserInfo;
use Kezhi\Model\Photo;

/**
 * Zip文件管理
 * 文件上传
 * 下载
 * 导入等
 */
class Zip extends Controller {
    public function upload() {
        $upload = new \Kezhi\Common\Upload();
        if(isset($_FILES['zip'])){
            try{
                $file = $upload->zip('zip');
                if(!$this->extract($file['dir'] . $file['name'], $file['dir'] . 'temp/')){
                    throw new \Exception('解压压缩文件失败，请使用zip格式的压缩文件');
                }
                $result = [];
                foreach(scandir($file['dir'] . 'temp/') as $item){
                    if(is_file($file['dir'] . 'temp/' . $item)){
                        $a = $this->import($file['dir'] . 'temp/' . $item);
                        $result[$item] = $a ? '成功导入' : '导入失败';
                    }
                    // 其余是文件夹的情况忽略
                }
                $this->smarty->assign('result', $result);
                $this->display('zip_import_success.tpl');
            }catch(\Exception $e){
                $this->error($e->getMessage(), $e->getCode());
            }
        }else{
            $this->error('请上传文件');
        }
    }
    
    /**
     * 解压zip文件到某个目录下
     * 
     * @param string $zipfile 要解压的zip文件的路径
     * @param string $extract_path 要解压到的位置
     * @return boolean 解压成功返回true，否则返回false
     */
    private function extract($zipfile, $extract_path){
        if(!file_exists($zipfile)){
            return false;
        }
        // 如果是目录继续，否则尝试创建，成功后继续，失败后返回false
        if(is_dir($extract_path) || mkdir($extract_path)){
            $zippy = Zippy::load();
            $archive = $zippy->open($zipfile);
            $archive->extract($extract_path);
            return true;
        }
        return false;
    }
    
    /**
     * 将该文件导入到数据库中
     * 
     * @param string $file 文件的完整地址
     * @return boolean 成功返回true，失败返回false
     */
    private function import($file){
        $info = pathinfo($file);
        $userinfo = new UserInfo();
        $photo = new Photo();
        $uid = 0;
        $data = [
            'name'  =>  $info['basename'],
            'extension' =>  $info['extension'],
            'mime'  =>  '',
            'size'  =>  filesize($file),
            'md5'   =>  md5_file($file),
            'dir'   =>  __IMAGES__
        ];
        if(strlen($info['filename']) == 18){
            // 假设现在是身份证，在数据库中找找看
            $uid = $userinfo->findUserIdByIdCardNumber($info['filename']);
            if($uid){
                // 成功找到了，说明文件名字就是拿身份证号命名的
                // 先把这个文件移动到图片目录中去
                if(rename($file, __IMAGES__ . strtolower($info['basename']))){
                    // 将对应的记录存储到数据库中去
                    $photo->add($data, $uid);
                    return true;
                }
            }
        }
        $uid = $userinfo->findUserIdByStudentNumber($info['filename']);
        if($uid){
            if(rename($file, __IMAGES__ . strtolower($info['basename']))){
                // 将对应的记录存储到数据库中去
                $photo->add($data, $uid);
                return true;
            }
        }
        return false;
    }
}
?>