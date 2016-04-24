<?php
/** 公共Traits */
namespace Kezhi\Traits;
/**
 * 导出表格公用函数
 *
 * 导出表格公用函数
 */
trait ExportExcel{
    /**
     * 获取配置
     * 导入全局配置并根据关键字获取配置
     * @param $key 要获取的配置的键，可以为空，返回表格导入配置，可以为exts，返回扩展名，为对应业务定义key，则返回对应rule
     * @return Array 对应的配置
    */
    private function getConfig($key = null){
        global $conf;
        $conf->load(__CONF__.'/'.$conf['rules']['export_excel_config_file']);
        if(is_null($key)){
            return $conf['export_excel'];
        }else{
            if(isset($conf['export_excel'][$key])){
                return $conf['export_excel'][$key];
            }
            return [];
        }
    }
}

?>
