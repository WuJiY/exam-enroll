<?php
/**
 * 模型
*/
namespace Kezhi\Model;
/**
 * 模型基类
*/
class Model {
    /** @var Object $db PDO实例 */
    protected $db;
    /** @var String $dsn 数据库源 */
    protected $dsn;
    /**
     * 构造函数
     * 根据配置文件的数据库信息实例化数据库连接
     * @global Object $conf 全局配置
     * @throws PDOException
    */
    public function __construct(){
        global $conf;
        $this->dsn = $conf['db.type'] . ':host=' . $conf['db.host'] . ';port=' . $conf['db.port'] . ';dbname=' . $conf['db.name'];
        try{
            $this->db = new \PDO($this->dsn, $conf['db.user'], $conf['db.password']);
        }catch(\PDOException $e){
            throw $e;
        }
    }

    /**
     * 析构函数
     * 释放数据库连接
    */
    public function __destruct(){
        $this->db = null;
    }
}
?>
