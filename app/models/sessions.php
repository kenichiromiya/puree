<?php

class SessionsModel extends Model {
    function __construct() {
        parent::__construct();
        $this->userstable = TABLE_PREFIX."users";
    }

    public function get($req) {
        try {
            $session_id = $_COOKIE['session_id'];
            $var = array();
            if ($session_id){
                $sql = "SELECT s.id,s.user_id,a.role FROM {$this->table} s,{$this->userstable} a WHERE s.id = ? AND s.user_id = a.id";
                $var['session'] = $this->dbh->getRow($sql,array($session_id));
            }
            return $var;
        } catch (PDOException $e) {
            return FALSE;
        }
    }

    public function post($req) {
        try {
            $password = md5($req['password']);
            $sql = "SELECT * FROM {$this->userstable} WHERE id = ? and password = ? and code = ?";
            $var['user'] = $this->dbh->getRow($sql,array($req['user_id'],$password,''));

            //print_r(array($req['id'],$password));
            if ($var['user']){
                $this->delete($req);

                $session_id = md5(uniqid(mt_rand(), true));
                $var['session_id'] = $session_id;
                if ($req['persistent']){
                    setcookie("session_id",$session_id,time()+60*60*24*7,'/');
                } else {
                    setcookie("session_id",$session_id,0,'/');
                }
                //$sql = "INSERT INTO {$this->table} (id,user_id) VALUES(?,?)";
                //$sth = $this->dbh->prepare($sql);
                //$sth->execute(array($session_id,$req['id']));
                $this->dbh->insert($this->table,array("id"=>$session_id,"user_id"=>$req['user_id']));
                return $var;
            } else {
                return FALSE;
            }
        } catch (PDOException $e) {
            return FALSE;
        }
    }

    function delete($req) {
        //$session_id = $_COOKIE['session_id'];
        try {
            $this->dbh->delete($this->table,$req['id']);
            setcookie("session_id","",time()+60*60*24*7,'/');
            return TRUE;
        } catch (PDOException $e) {
            return FALSE;
        }
    }

}
?>
