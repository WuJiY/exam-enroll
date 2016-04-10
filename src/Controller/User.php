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
     * 用户首页
    */
    public function index(){
        $this->smarty->assign('username', $_SESSION['username']);
        $this->smarty->display('user.tpl');
    }

    /**
     * 用户个人信息页面
    */
    public function profile(){
        $this->smarty->display('profile.tpl');
    }

    /**
     * 修改照片页面
    */
    public function modify_photo(){
        $this->smarty->display('modify_photo.tpl');
    }

    /**
     * 修改密码页面
    */
    public function change_password(){
        $this->smarty->display('change_password.tpl');
    }
}
?>
