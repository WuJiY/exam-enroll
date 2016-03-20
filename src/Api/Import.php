<?php
namespace Kezhi\Api;
use Kezhi\Common;
class Import extends Api{
    public function student_account(){
        if(isset($_FILE['student_account_file'])){
            $upload = new \Kezhi\Common\Upload();
            var_dump($upload->excel('student_account_file'));
        }else{
            echo "string";
        }
    }
}
?>
