<?php
namespace Kezhi\Common;
/**
 * 上传处理类
 * 上传操作处理，包括image,excel,pdf等
*/
class Upload {
    private $upload_dir = '';
    private $upload_sub_dir = '';
    private $storage = null;
    public function __construct(){
        global $conf;
        $conf->load(__CONF__ . '/' . $conf['upload']['upload_config_file']);
        $this->upload_dir = isset($conf['upload_dir']) ? $conf['upload_dir'] : '';
    }

    private function getName(){
        return uniqid();
    }

    public function excel($key){
        $this->storage = new \Upload\Storage\FileSystem($this->upload_dir);
        $file = new \Upload\File($key, $this->storage);
        $file->setName($this->getName());
        $file->addValidations(array(
            // new \Upload\Validation\Mimetype('application/vnd.ms-excel'),
            new \Upload\Validation\Extension(array('xls','xlsx')),
            new \Upload\Validation\Size('10M')
        ));

        try{
            $file->upload();
            $data = $this->getData($file);
            return $data;
        }catch(\Exception $e){
            throw new \Exception($e->getMessage(), 500);
        }
    }

    public function image($key){

    }

    private function getData($file){
        return [
            'name'  =>  $file->getNameWithExtension(),
            'extension' =>  $file->getExtension(),
            'mime'  =>  $file->getMimetype(),
            'size'  =>  $file->getSize(),
            'md5'   =>  $file->getMd5(),
            'dimensions'    =>  $file->getDimensions(),
            'dir'   =>  $this->upload_dir
        ];
    }
}
?>
