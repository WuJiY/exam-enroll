<?php
namespace Kezhi\Controller;
class Student extends Controller{
    public function __construct(){
        parent::__construct();
        $this->smarty->assign('navbar_active', 'student');
    }

    public function student_info(){
        $this->smarty->assign('left_nav_active', 'student_info');
        $this->display('student_info.tpl');
    }

    public function pay_info(){
        $this->smarty->assign('left_nav_active', 'pay_info');
        $this->display('pay_info.tpl');
    }

    public function photos(){
        $this->smarty->assign('left_nav_active', 'photos');
        $this->display('photos.tpl');
    }
}
?>
