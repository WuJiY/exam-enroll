<?php
namespace Kezhi\Controller;
class Room extends Controller{
    public function __construct(){
        parent::__construct();
        $this->smarty->assign('navbar_active', 'room');
    }
    /**
     * 查看考场页面
    */
    public function index(){
        $this->smarty->assign('left_nav_active', 'index');
        $this->display('room.tpl');
    }

    /**
     * 新增考场页面
    */
    public function add(){
        $this->smarty->assign('left_nav_active', 'add');
        $this->display('add_room.tpl');
    }

    /**
     * 分配考场页面
    */
    public function allot(){
        $this->smarty->assign('left_nav_active', 'allot');
        $this->display('allot_room.tpl');
    }
}
 ?>
