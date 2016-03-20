<?php
namespace Kezhi\Controller;
use Smarty;
class Controller{
    protected $smarty;
    public function __construct(){
        $this->smarty = new Smarty;
        $this->smarty->setTemplateDir(__WEB__ . 'templates/');
        $this->smarty->setCompileDir(__WEB__ . 'templates_c/');
        $this->smarty->setConfigDir(__WEB__ . 'configs/');
        $this->smarty->setCacheDir(__WEB__ . 'cache/');
    }
}
?>
