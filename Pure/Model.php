<?php
namespace Pure;

class Model
{

    public function __construct() {
        $singleton = DB::singleton();
        $this->dbh = $singleton->dbh;

        $classname = get_class($this);
        //$classname = get_class();
        //error_log($classname);
        //preg_match("/(.*)Model/",$classname,$m);
        preg_match("/Puree\\\\(.*)\\\\Model/",$classname,$m);
        $this->modelsname = strtolower($m[1]);
        $this->table = TABLE_PREFIX.$this->modelsname;
    }

    public function get($req){
        $var = $req;

        if ($req['id']) {
            $sql = "SELECT * FROM {$this->table} ";
            $values = array();
            $sql .= "WHERE id = ? ";
            array_push($values,$req['id']);
            $var['row'] = $this->dbh->getRow($sql,$values);
        } else {
            $sql = "SELECT * FROM {$this->table} ";
            $values = array();
            $sql .= "ORDER BY id ";
            if ($req['limit']) {
                $sql .= "LIMIT {$req['limit']}";
            }
            $var['rows'] = $this->dbh->getAll($sql,$values);
        }
        return $var;
    }


    public function put($req){
        $values = array();
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE id = ?";
        array_push($values,$req['id']);
        $count = $this->dbh->getOne($sql,$values);
        $param = $req['post'];
        //$param['id'] = $req['id'];
        // TODO ここでbodyとtitle加工
        //	error_log(print_r($req['post'],true));
        if ($count) {
            $this->dbh->update($this->table,$req['id'],$param);
        } else {
            $this->dbh->insert($this->table,$param);
        }
    }

    public function post($req){
        $param = $req['post'];
        $param['id'] = $req['id'];
        $this->dbh->insert($this->table,$param);
    }

    public function delete($req){
        $this->dbh->delete($this->table,$req['id']);
        //$sth = $this->dbh->prepare($sql);
        //$sth->execute(array($req['id']));
    }
    public function move($req){
        //$this->dbh->delete($this->table,$req['id']);
        $param = $req['post'];
        $param['id'] = preg_replace("#".BASE."#","",$param['Destination']);
        error_log($param['id']);
        unset($param['Destination']);	
        $this->dbh->update($this->table,$req['id'],$param);
        //$sth = $this->dbh->prepare($sql);
        //$sth->execute(array($req['id']));
    }


}
?>
