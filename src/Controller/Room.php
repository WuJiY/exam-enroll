<?php
namespace Kezhi\Controller;

use Kezhi\Model as Model;
use Kezhi\Lib as Lib;

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

    public function building_add(){
        $this->display('room_building_add.tpl');
    }

    /**
     * 分配考场页面
    */
    public function allot(){
        $this->smarty->assign('left_nav_active', 'allot');
        $this->display('allot_room.tpl');
    }

    public function building(){
        $page_id = isset($_GET['page']) ? intval($_GET['page']) : 1;
        try{
            $building = new Model\Building();
            $totle_number = $building->getCount();
            $page = new Lib\Page($totle_number, $page_id);
            $data = $building->queryAllLimit($page->getCurrentNum(), $page->getPerPageNum());
            $this->smarty->assign('data', $data);
            $this->smarty->assign('current_page', $page->getCurrentPage());
            $this->smarty->assign('max_page_num', $page->getTotlePages());
            $this->smarty->assign('pages', $page->getPages());
        }catch(\Exception $e){
            $this->error($e->getMessage(), $e->getCode());
        }
        $this->smarty->assign('left_nav_active', 'building');
        $this->display('room_building.tpl');
    }

    public function building_edit($id){
        $id = intval($id);
        try{
            $building = new Model\Building();
            $data = $building->query($id);
            $this->smarty->assign('data', $data);
        }catch(\Exception $e){
            $this->error($e->getMessage(), $e->getCode());
        }
        $this->display('room_building_edit.tpl');
    }
}
 ?>
