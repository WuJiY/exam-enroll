<?php
/** 控制器 */
namespace Kezhi\Controller;
/**
 * 报名控制器
*/
class Enroll extends Controller{
    public function __construct(){
        parent::__construct();
        $this->smarty->assign('navbar_active', 'enroll');
    }
    /**
     * 报名情况页面
    */
    public function index(){
        $this->smarty->assign('left_nav_active', 'enroll_info');
        $this->smarty->display('enroll_info.tpl');
    }

    /**
     * 报名操作页面
    */
    public function enroll(){
        $this->smarty->assign('left_nav_active', 'enroll');
        $this->smarty->display('enroll.tpl');
    }
}
?>
