<?php
/** 控制器 */
namespace Kezhi\Controller;
use Smarty;
/**
 * 控制器基类
*/
class Controller{
    /** @var Object $smarty smarty框架实例*/
    protected $smarty;
    /**
     * 构造函数，实例化smarty框架并进行配置
    */
    public function __construct(){
        $this->smarty = new Smarty;
        $this->smarty->setTemplateDir(__WEB__ . 'templates/');
        $this->smarty->setCompileDir(__WEB__ . 'templates_c/');
        $this->smarty->setConfigDir(__WEB__ . 'configs/');
        $this->smarty->setCacheDir(__WEB__ . 'cache/');
    }
}
?>
