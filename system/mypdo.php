<?php
class MyPDO extends PDO
{
//                                $sql = "INSERT INTO {$this->table} (id,account_id) VALUES(?,?)";
//                                $sth = $this->dbh->prepare($sql);
//                                $sth->execute(array($session_id,$req['id']));

        public function get($table,$id) {

                if (is_array($id)) {
			$places = array();
			$values = array();
                        $sql = "SELECT * FROM $table ";
                        //$sql .= "ORDER BY id ";
                        //if ($req['limit']) {
                        //        $sql .= "LIMIT {$req['limit']}";
                        //}

                        foreach ($id as $value) {
				array_push($places,"?");
				array_push($values,$value);
                        }
                        $place = implode(",", $places);
                        $sql .= "WHERE id IN ($place) ";
                        $rows = $this->getAll($sql,$values);
                } else {
                        $sql = "SELECT * FROM $table ";
                        $values = array();
                        $sql .= "WHERE id = ? ";
                        array_push($values,$id);
                        $rows = $this->getAll($sql,$values);
                }
                return $rows;
        }

	public function insert($table,$param) {
		$colnames = array();
		$places = array();
		$values = array();
		foreach ($param as $key => $value) {
			if(!is_array($value)) {
				array_push($colnames,$key);
				array_push($places,"?");
				array_push($values,$value);
			}
		}
		$colname = implode(",", $colnames);
		$place = implode(",", $places);
		//print_r($values);
		//exit;
		$sql = "INSERT INTO $table ($colname) VALUES($place)";
		$this->query($sql,$values);
	}

	public function update($table,$id,$param) {
		$sets = array();
		$values = array();
		foreach ($param as $key => $value) {
			if(!is_array($value)) {
				array_push($sets,"$key = ?");
				array_push($values,$value);
			}
		}

		$set = implode(",", $sets);
		$sql = "UPDATE $table SET $set WHERE id = ?";
		array_push($values,$id);
		//print_r($values);
		$this->query($sql,$values);
	}

	public function delete($table,$id) {
		if(is_array($id)){
			$places = array();
			$values = array();
                        foreach ($id as $value) {
				array_push($places,"?");
				array_push($values,$value);
                        }
                        $place = implode(",", $places);
			$sql = "DELETE FROM $table WHERE id IN ($place)";
			$sth = $this->query($sql,$values);
		} else {
			$sql = "DELETE FROM $table WHERE id = ?";
			$sth = $this->query($sql,$id);
		}
	}
	public function query($query,$params = array()){
		$sth = $this->prepare($query);
		$sth->execute($params);
		return $sth;
	}
	public function getAll($query,$params = array()){
		$sth = $this->prepare($query);
		$sth->execute($params);
		return $sth->fetchAll();
	}

	public function getRow($query,$params = array()){
		$sth = $this->prepare($query);
		$sth->execute($params);
		return $sth->fetch();
	}
	public function getOne($query,$params = array()){
		$sth = $this->prepare($query);
		$sth->execute($params);
		$row = $sth->fetch();
		return $row[0];
	}
	public function rowCount(){
		$query = "SELECT FOUND_ROWS()";
		$sth = $this->prepare($query);
		$sth->execute($params);
		$row = $sth->fetch();
		return $row[0];
	}
}
?>
