<?php
/** 控制器 */
namespace Kezhi\Controller;
use Kezhi\Lib as Lib;
use Kezhi\Common;
/**
 * 通过excel表格导入数据到系统中
 * 通过读取分析用户上传的excel文件，将用户信息导入到系统数据库中。
*/
class Import extends Controller{
    use \Kezhi\Traits\ImportExcel;
    public function __construct(){
        parent::__construct();
        $this->smarty->assign('navbar_active', 'student');
    }
    /**
     * 学生账号导入页面
    */
    public function student_account(){
        $this->smarty->assign('left_nav_active', 'student_account');
        $this->display('student_account.tpl');
    }

    public function pay_info(){
        $this->smarty->assign('left_nav_active', 'pay_info_import');
        $this->display('pay_info_import.tpl');
    }

    public function photos(){
        $this->smarty->assign('left_nav_active', 'photos_import');
        $this->display('photos_import.tpl');
    }

    public function score(){
        $this->smarty->assign('left_nav_active', 'score_import');
        $this->display('score_import.tpl');
    }
}
