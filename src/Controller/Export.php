<?php
namespace Kezhi\Controller;

use Kezhi\Model as Model;

class Export extends Controller{
    public function __construct(){
        parent::__construct();
        $this->smarty->assign('navbar_active', 'exam');
    }

    public function index(){
        try{
            $exam = new Model\Exam();
            $data = $exam->queryAll();
            $this->smarty->assign('data', $data);
        }catch(\Exception $e){
            $this->error($e->getMessage(), $e->getCode());
        }
        $this->smarty->assign('left_nav_active', 'export');
        $this->display('export.tpl');
    }
}
