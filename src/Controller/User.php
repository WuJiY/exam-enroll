<?php
/** 控制器 */
namespace Kezhi\Controller;
use Kezhi;
/**
 * User 控制器
 * 处理用户的相关操作
 * @author parallel(mao@malatoday.com)
*/
class User extends Controller{
    /**
     * 测试方法
    */
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

    public function index(){
        $this->smarty->assign('username', $_SESSION['username']);
        $this->smarty->display('user.tpl');
    }
}
?>
