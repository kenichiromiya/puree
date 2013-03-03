<?php
class UsersModel extends Model {
	public $error;

	public function __construct(){
		parent::__construct();
        $this->pages_table = TABLE_PREFIX.'pages';
        $this->files_table = TABLE_PREFIX.'files';
	}
    public function get($req){
        $var = $req;

        if($req['id']) {
            $sql = "SELECT SQL_CALC_FOUND_ROWS T1.*,T2.filename FROM {$this->pages_table} T1 ";
            $values = array();
            //$sql .= "WHERE id != ? AND id LIKE ? ";
            $sql .= "LEFT JOIN {$this->files_table} T2 ON T2.parent_id = T1.id ";
            $sql .= "WHERE T1.account_id = ? ";
            $sql .= "GROUP BY T1.id ";
            $sql .= "ORDER BY T1.createtime DESC ";
            if ($req['page']) {
                $start = ($req['page']-1) * PER_PAGE;
                $sql .= "LIMIT ".$start.",".PER_PAGE;
            } else {
                $sql .= "LIMIT ".PER_PAGE;
            }
            array_push($values,$req['id']);
            $var['rows'] = $this->dbh->getAll($sql,$values);
            $var['count'] = $this->dbh->rowCount();
        } else {
            $sql = "SELECT * FROM {$this->table} ";
            $values = array();
            $sql .= "WHERE id = '' ";
            $var = $this->dbh->getRow($sql,$values);


            $sql = "SELECT SQL_CALC_FOUND_ROWS T1.*,T2.filename FROM {$this->table} T1 ";
            $values = array();
            //$sql .= "WHERE id != ? AND id LIKE ? ";
            $sql .= "LEFT JOIN {$this->files_table} T2 ON T2.parent_id = T1.id ";
            $sql .= "WHERE T1.id != '' ";
            $sql .= "GROUP BY T1.id ";
            $sql .= "ORDER BY T1.createtime DESC ";
            if ($req['page']) {
                $start = ($req['page']-1) * PER_PAGE;
                $sql .= "LIMIT ".$start.",".PER_PAGE;
            } else {
                $sql .= "LIMIT ".PER_PAGE;
            }
            $var['rows'] = $this->dbh->getAll($sql,$values);
            $var['count'] = $this->dbh->rowCount();
            //if(preg_match("#^[^/]*/[^/]*$#",$req['id'])) {
        }
        return $var;
    }

}
?>
