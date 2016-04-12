<?php
namespace Kezhi\Controller;
class Diploma extends Controller{
    public function __construct(){
        parent::__construct();
        $this->smarty->assign('navbar_active', 'diploma');
    }

    public function index(){
        $this->display('diploma.tpl');
    }
}
 ?>
