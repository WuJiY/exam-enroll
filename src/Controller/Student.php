<?php
namespace Kezhi\Controller;
use Kezhi\Model as Model;
use Kezhi\Lib as Lib;
class Student extends Controller{
    public function __construct(){
        parent::__construct();
        $this->smarty->assign('navbar_active', 'student');
    }

    public function student_info(){
        $page_id = isset($_GET['page']) ? intval($_GET['page']) : 1;
        $userinfo = new Model\UserInfo();
        try{
            $totle_number = $userinfo->getCount();
            $page = new Lib\Page($totle_number, $page_id);
            $data = $userinfo->queryAllLimit($page->getCurrentNum(), $page->getPerPageNum());
            $this->smarty->assign('data', $data);
            $this->smarty->assign('current_page', $page->getCurrentPage());
            $this->smarty->assign('max_page_num', $page->getTotlePages());
            $this->smarty->assign('pages', $page->getPages());
        }catch(\Exception $e){
            $this->error($e->getMessage(), $e->getCode());
        }
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
