<?php
/** 控制器 */
namespace Kezhi\Controller;
/**
 * 分数成绩控制器
*/
class Score extends Controller{
    public function __construct(){
        parent::__construct();
        $this->smarty->assign('navbar_active', 'score');
    }
    /**
     * 成绩查询页面
    */
    public function index(){
        $this->smarty->assign('left_nav_active', 'score');
        $this->smarty->display('score.tpl');
    }


}
?>
