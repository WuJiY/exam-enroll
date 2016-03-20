<?php
namespace Kezhi\Model;
class Model {
    protected $connect;
    protected $dsn;
    public function __construct(){
        global $conf;
        $this->dsn = $conf['db.type'] . ':host=' . $conf['db.host'] . ';port=' . $conf['db.port'] . ';dbname=' . $conf['db.name'];
        try{
            $this->connect = new \PDO($this->dsn, $conf['db.user'], $conf['db.password']);
        }catch(\PDOException $e){
            throw $e;
        }
    }

    public function __destruct(){
        $this->connect = null;
    }
}
?>
