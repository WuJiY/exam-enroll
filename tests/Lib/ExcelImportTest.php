<?php
include_once __DIR__ . '/../../src/Lib/ExcelImport.php';
require __DIR__ . '/../../vendor/autoload.php';
use Kezhi\Lib;
class ExcelImportTest extends PHPUnit_Framework_TestCase{
    /**
     * @dataProvider importTypeProvider
    */
    public function testImport($rules, $exts){
        $file = dirname(__DIR__) . '/files/import_user_account.xls';
        $excel_importer = new Kezhi\Lib\ExcelImport($rules, $exts);
        $excel = $excel_importer->import($file);
        $this->assertInstanceOf('\Kezhi\Lib\ExcelImport', $excel);
    }

    public function importTypeProvider(){
        return array(
            "both_null" =>  [null, null],
            "rules_null"    =>  [null, ['xls'=>true]],
            "etxs_null" =>  [["id"=>1], null],
            "both_exist"    =>  [['id'=>1], ['xls'=>true]]
        );
    }

    /**
     * @dataProvider importTypeProvider
     * @expectedException Exception
     * @expectedExceptionCode 500
    */
    public function testNoFile($rules, $exts){
        $file = '/files/no_this_file.xls';
        $excel_importer = new Kezhi\Lib\ExcelImport($rules, $exts);
        $excel = $excel_importer->import($file);
    }

    /**
     * @dataProvider importTypeProvider
    */
    public function testWorksheet($rules, $exts){
        $file = dirname(__DIR__) . '/files/import_user_account.xls';
        $excel_importer = new Kezhi\Lib\ExcelImport($rules, $exts);
        $excel = $excel_importer->import($file);
        $this->assertInstanceOf('\Kezhi\Lib\ExcelImport', $excel->worksheet(0));
    }

    /**
     * @dataProvider importTypeProvider
    */
    public function testArea($rules, $exts){
        $file = dirname(__DIR__) . '/files/import_user_account.xls';
        $excel_importer = new Kezhi\Lib\ExcelImport($rules, $exts);
        $excel = $excel_importer->import($file);
        $this->assertInstanceOf('\Kezhi\Lib\ExcelImport', $excel->worksheet(0)->area(0, 5));
    }

    /**
     * @dataProvider importTypeProvider
    */
    public function testGetValue($rules, $exts){
        $file = dirname(__DIR__) . '/files/import_user_account.xls';
        $excel_importer = new Kezhi\Lib\ExcelImport($rules, $exts);
        $excel = $excel_importer->import($file);
        $excel->worksheet(0)->area(0, 5);
        $this->assertTrue(true, is_array($excel->getValue()));
    }
}
?>
