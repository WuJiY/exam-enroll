<?php
/** 公共类库 */
namespace Kezhi\Common;
/**
 * 上传处理类
 * 上传操作处理，包括image,excel,pdf等
*/
class Upload {
    /** @var String $upload_dir 上传文件存储目录 */
    private $upload_dir = '';
    /** @var String $upload_sub_dir 上传文件存储子目录 */
    private $upload_sub_dir = '';
    /** @var \Upload\Storage\FileSystem $storage 上传文件存储类实例 */
    private $storage = null;

    /**
     * 构造函数
     * @global Object $conf
    */
    public function __construct(){
        global $conf;
        $conf->load(__CONF__ . '/' . $conf['upload']['upload_config_file']);
        $this->upload_dir = isset($conf['upload_dir']) ? $conf['upload_dir'] : '';
    }

    /**
     * 生成随机的文件名
    */
    private function getName(){
        return uniqid();
    }

    /**
     * 处理excel文件的上传
     * @param $key String 表单中的name属性值
     * @throws Exception 500
     * @return Array 上传后的文件属性
    */
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

    /**
     * 处理图片上传
     * @param $key String 表单中的name属性值
    */
    public function image($key){

    }

    /**
     * 获取文件上传成功后的相关信息
     * @param $file \Upload\File 文件类的实例
     * @return Array 该$file的属性
    */
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
