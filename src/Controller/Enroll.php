<?php
/** 控制器 */
namespace Kezhi\Controller;

use Kezhi\Model as Model;
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
        try{
            $exam = new Model\Exam();
            $data = $exam->queryAllEnrollable();
            foreach($data as &$v){
                $v['type_name'] = $exam->getExamTypeName($v['type']);
            }
            unset($v);
            $this->smarty->assign('data', $data);
        }catch(\Exception $e){
            $this->error($e->getMessage(), $e->getCode());
        }
        $this->smarty->assign('left_nav_active', 'enroll');
        $this->smarty->display('enroll.tpl');
    }
}
?>
