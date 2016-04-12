<?php
/** 控制器 */
namespace Kezhi\Controller;
/**
 * 考试控制器
*/
class Exam extends Controller{
    public function __construct(){
        parent::__construct();
        $this->smarty->assign('navbar_active', 'exam');
    }

    public function index(){
        $this->display('exam.tpl');
    }
}
 ?>
