<?php
/** 公共Traits */
namespace Kezhi\Traits;
/**
 * 导入表格公用函数
 *
 * 导入表格公用函数
 */
trait ImportExcel{
    /**
     * 获取配置
     * 导入全局配置并根据关键字获取配置
     * @param $key 要获取的配置的键，可以为空，返回表格导入配置，可以为exts，返回扩展名，为对应业务定义key，则返回对应rule
     * @return Array 对应的配置
    */
    private function getConfig($key = null){
        global $conf;
        $conf->load(__CONF__.'/'.$conf['rules']['import_excel_config_file']);
        if(is_null($key)){
            return $conf['import_excel'];
        }elseif($key == 'exts'){
            return $conf['import_excel'][$key];
        }else{
            $result = $conf['import_excel']['rules'][$key];
            $exts = array_merge($conf['import_excel']['exts'], isset($result['exts']) ? $result['exts'] : []);
            $result['exts'] = $exts;
            return $result;
        }
    }
}

?>
