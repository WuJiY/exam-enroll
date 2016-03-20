<?php
namespace Kezhi\Controller;
use Kezhi;
class User extends Controller{
    public function get_all_users_handler(){
        global $conf;
        try{
            $Model = new Kezhi\Model\Model();
        }catch(\PDOException $e){
            echo $e->getMessage();
        }
        $this->smarty->assign('name', $conf['common.name']);
        $this->smarty->display('index.tpl');
    }
}
?>
