<?php
/** 控制器 */
namespace Kezhi\Controller;

use Kezhi\Model as Model;
use Kezhi\Lib as Lib;
/**
 * 考试控制器
*/
class Exam extends Controller{
    public function __construct(){
        parent::__construct();
        $this->smarty->assign('navbar_active', 'exam');
    }

    public function index(){
        $page_id = isset($_GET['page']) ?: 1;
        try{
            $exam = new Model\Exam();
            $totle_num = $exam->getCount();
            $page = new Lib\Page($totle_num, $page_id);
            $data = $exam->queryAllLimit($page->getCurrentNum(), $page->getPerPageNum());
            $this->smarty->assign('data', $data);
            $this->smarty->assign('current_page', $page->getCurrentPage());
            $this->smarty->assign('max_page_num', $page->getTotlePages());
            $this->smarty->assign('pages', $page->getPages());
        }catch(\Exception $e){
            $this->error($e->getMessage(), $e->getCode());
        }
        $this->smarty->assign('left_nav_active', 'exam');
        $this->display('exam.tpl');
    }

    public function add(){
        $exam = new Model\Exam();
        $this->smarty->assign('exam_types', $exam->getExamTypes());
        $this->display('exam_add.tpl');
    }

    public function edit($id){
        try{
            $exam = new Model\Exam();
            $data = $exam->query($id);
            $this->smarty->assign('exam_types', $exam->getExamTypes());
            $this->smarty->assign('data', $data);

        }catch(\Exception $e){
            $this->error($e->getMessage(), $e->getCode());
        }
        $this->display('exam_edit.tpl');
    }
}
?>
