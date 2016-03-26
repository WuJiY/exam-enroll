<?php
require 'TestCase.php';
class UserTest extends TestCase{

    public function testAdd(){

    }

    /**
     * @return PHPUnit_Extensions_Database_DataSet_IDataSet
    */
    public function getDataSet(){
        return $this->createFlatXMLDataSet(dirname(__FILE__) . '../files/mao.xml');
    }
}
?>
