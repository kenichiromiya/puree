<?php

class AccountsModel extends Model {

	public function __construct(){
		parent::__construct();
	}

	public function post($req) {

	}

	public function put($req) {
		$sql = "SELECT COUNT(*) FROM {$this->table} WHERE id = ?";
		$count = $this->dbh->getOne($sql,array($req['id']));
		$param = $req['post'];
		if(isset($param['password'])){
			$param['password'] = md5($param['password']);
		}
		if ($count) {
			// Account confirmation
			if(isset($req['code'])) {
				$values = array();
				$sql = "SELECT * FROM {$this->table} ";
				$sql .= "WHERE id = ? ";
				array_push($values,$req['id']);
				$row = $this->dbh->getRow($sql,$values);
				if ($row['code'] == $req['code']) {
					$param['code'] = "";
					$this->dbh->update($this->table,$req['id'],$param);
				} else {
					return FALSE;
				}
				$upload_file = "images/pic_noimage110_dgray.jpg";
			}
			// TODO only sign in
			if (count($_FILES)){
				$file = $_FILES['icon'];
				$dirname = "upload/accounts/";
				$filename = $req['id']."/"."icon.jpeg";
				$upload_file = "$dirname/$filename";
				if (!is_dir(dirname($upload_file))){
					mkdir(dirname($upload_file),0777,true);
				}
				if(move_uploaded_file($file["tmp_name"],$upload_file))
				{
					chmod($upload_file,0644);
				}
			}
			if ($upload_file) {
				$filename = $req['id']."/"."icon.jpeg";
				$thumb_dirname = "upload/accounts/thumb";
				$upload_thumb_file = "$thumb_dirname/$filename";
				if (!is_dir(dirname($upload_thumb_file))){
					mkdir(dirname($upload_thumb_file),0777,true);
				}
				$large_dirname = "upload/accounts/large";
				$upload_large_file = "$large_dirname/$filename";
				if (!is_dir(dirname($upload_large_file))){
					mkdir(dirname($upload_large_file),0777,true);
				}
				$image = new Image();
				$image->resize($upload_thumb_file,$upload_file,50,50);
				$image->resize($upload_large_file,$upload_file,100,100);
				//$pathinfo = pathinfo($file["name"]);
				//$icon = $req['id']."/".$pathinfo['filename'];
				$param['icon'] = $req['id']."/"."icon.jpeg";
			}

/*
			$sets = array("icon = ?");
			$values = array($icon);
			$set = implode(",", $sets);
			$sql = "UPDATE {$this->table} SET $set WHERE id = ?";
			array_push($values,$req['id']);
			$this->dbh->query($sql,$values);
*/
			$this->dbh->update($this->table,$req['id'],$param);
			/*
			$sets = array("id = ?","password = ?","email = ?","role = ?","url = ?","about = ?","icon = ?");
			$values = array($req['id'],$password,$req['email'],$req['role'],$req['url'],$req['about'],$icon);
			$set = implode(",", $sets);
			$sql = "UPDATE {$this->table} SET $set WHERE id = ?";
			array_push($values,$req['id']);
			$this->dbh->query($sql,$values);
			*/

		} else {
			$code = rand();
			$subject = _("Account confirmation");
			$message = BASE."accounts/".$req['id']."?code=".$code."&view=confirm";
			mail($req['email'], $subject, $message);
			$param['code'] = $code;
			$this->dbh->insert($this->table,$param);
/*
			$sql = "INSERT INTO {$this->table} (id,password,email,role,url,about,icon) VALUES(?,?,?,?,?,?,?)";
			$sth = $this->dbh->prepare($sql);
			$sth->execute(array($req['id'],$password,$req['email'],$req['role'],$req['url'],$req['about'],$icon));
*/
		}
	}
}
/*
Twitter account confirmation

Hi, miyaa

Twitterアカウントを確認するにはこのリンクをクリックし、このメールアドレス(miyaa@yahoo.co.jp)を照合してください。
http://twitter.com/account/confirm_email/miyaa/2ECF2-HCG39

Thanks! ついったーチームより

安全上の理由で、あなたのアカウントについてお伺いします。
*/
?>
