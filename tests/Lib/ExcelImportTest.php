<?php
include_once '../../src/Lib/ExcelImport.php';
require '../../vendor/autoload.php';
use Kezhi\Lib;
class ExcelImportTest extends PHPUnit_Framework_TestCase{
    /**
     * @dataProvider importTypeProvider
    */
    public function testImport($rules, $exts){
        $file = dirname(__DIR__) . '/files/import_user_account.xls';
        $excel_importer = new Kezhi\Lib\ExcelImport($rules, $exts);
        $excel = $excel_importer->import($file);
        if(empty($excel)){
            print '.......';
        }else{
            $excel->worksheet(0)
            ->getValue();
            print_r($result);
        }
    }

    public function importTypeProvider(){
        return array(
            "both_null" =>  [null, null],
            "rules_null"    =>  [null, ['xls'=>true]],
            "etxs_null" =>  [["id"=>1], null],
            "both_exist"    =>  [['id'=>1], ['xls'=>true]]
        );
    }
}
?>
