<?php
namespace Kezhi\Common;
class Zip{
    protected $zipfile = null;

    /**
     * 构造方法
    */
    public function __construct($filename){
        $this->zipfile = zip_open($filename);
    }

    /**
     * 解压操作
     *
     * @param String $filename 要解压的文件名
     * @param String $result_path 解压后的结果存放的路径
     * @return bool 解压成功返回true，失败返回false
    */
    public function decompression($filename, $result_path){
        while(1){
            $zip = zip_open($this->zipfile);
            if($zip === false){
                break;  // 读取结束
            }
            $chars = zip_entry_read($zip);
        }
    }

    private function read($zip){
        $temp = zip_entry_read($zip);
        while($temp !== false){

        }
    }

    /**
     * 压缩操作
     *
     *
    */
    public function compression($){

    }
}
?>
