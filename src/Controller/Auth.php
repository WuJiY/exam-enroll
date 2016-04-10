<?php
/** 控制器 */
namespace Kezhi\Controller;
use Kezhi;
/**
 * Auth 控制器
 * 处理用户权限认证，包括注册登录等
*/
class Auth extends Controller{
    /**
     * 登录页面
    */
    public function signIn(){
        $this->smarty->display('auth.tpl');
    }

    /**
     * 注销登录
    */
    public function signOut(){
        session_destroy();
        $this->smarty->display('auth.tpl');
    }
}
?>
