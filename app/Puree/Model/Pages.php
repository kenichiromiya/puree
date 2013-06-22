<?php
namespace Puree\Model;

class Pages extends \Puree\Model\Common {
    public $error;

    public function __construct(){
        parent::__construct();
        $this->table = TABLE_PREFIX."pages";
        $this->files_table = TABLE_PREFIX.'files';
    }
    public function get($req){
        $var = $req;

        if ($req['tag']) {
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} ";
            $values = array();
            $sql .= "WHERE tags LIKE ? ";
            $sql .= "ORDER BY createtime DESC ";
            if ($req['page']) {
                $start = ($req['page']-1) * PER_PAGE;
                $sql .= "LIMIT ".$start.",".PER_PAGE;
            } else {
                $sql .= "LIMIT ".PER_PAGE;
            }
            array_push($values,"%".$req['tag']."%");
            $var['rows'] = $this->dbh->getAll($sql,$values);
            $var['count'] = $this->dbh->rowCount();

        } elseif($req['id']) {
            $values = array();
            $sql = "SELECT T1.*,";
            $sql .= "T1.id AS id1,T1.title AS title1,";
            $sql .= "T2.id AS id2,T2.title AS title2,";
            $sql .= "T3.id AS id3,T3.title AS title3,";
            $sql .= "T4.id AS id4,T4.title AS title4,";
            $sql .= "T5.id AS id5,T5.title AS title5 ";
            $sql .= "FROM {$this->table} T1 ";
            $sql .= "LEFT JOIN {$this->table} T2 ON T1.parent_id = T2.id ";
            $sql .= "LEFT JOIN {$this->table} T3 ON T2.parent_id = T3.id ";
            $sql .= "LEFT JOIN {$this->table} T4 ON T3.parent_id = T4.id ";
            $sql .= "LEFT JOIN {$this->table} T5 ON T4.parent_id = T5.id ";
            $sql .= "WHERE T1.id = ? ";
            if ($req['id']) {
                array_push($values,$req['id']);
            } else {
                array_push($values,'');
            }
            if ($row = $this->dbh->getRow($sql,$values)) {
                //$var = $var + $row;
                $var['breadcrumbs'] = $row;
                //print_r($row);
            }

            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} ";
            $values = array();
            $sql .= "WHERE id = ? ";
            array_push($values,$req['id']);
            $var['row'] = $this->dbh->getRow($sql,$values);
            // 0 or 1
            //$var['count'] = $this->dbh->rowCount();

/*
            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} ";
            $sql .= "WHERE parent_id = ? ";
            $values = array();
            array_push($values,$req['id']);
            $var['rows'] = $this->dbh->getAll($sql,$values);
 */
/*
            $sql = "SELECT SQL_CALC_FOUND_ROWS T1.*,T2.filename FROM {$this->table} T1 ";
            $values = array();
            //$sql .= "WHERE id != ? AND id LIKE ? ";
            $sql .= "LEFT JOIN {$this->files_table} T2 ON T2.parent_id = T1.id ";
            $sql .= "WHERE T1.parent_id = ? ";
            $sql .= "GROUP BY T1.id ";
            $sql .= "ORDER BY T1.createtime DESC ";
            if ($req['page']) {
                $start = ($req['page']-1) * PER_PAGE;
                $sql .= "LIMIT ".$start.",".PER_PAGE;
            } else {
                $sql .= "LIMIT ".PER_PAGE;
            }
            $values = array();
            array_push($values,$req['id']);
            $var['rows'] = $this->dbh->getAll($sql,$values);
 */
            $sql = "SELECT SQL_CALC_FOUND_ROWS T1.*,T2.filename FROM {$this->table} T1 ,{$this->files_table} T2 ";
            $values = array();
            //$sql .= "WHERE id != ? AND id LIKE ? ";
            $sql .= "WHERE T1.id REGEXP ? AND T2.parent_id = T1.id ";
            $sql .= "GROUP BY T1.id ";
            $sql .= "ORDER BY T1.createtime DESC ";
            if ($req['page']) {
                $start = ($req['page']-1) * PER_PAGE;
                $sql .= "LIMIT ".$start.",".PER_PAGE;
            } else {
                $sql .= "LIMIT ".PER_PAGE;
            }
            array_push($values,"^".$req['id']."/");
            $var['rows'] = $this->dbh->getAll($sql,$values);
            $var['count'] = $this->dbh->rowCount();

            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} ";
            //$sql .= "WHERE id != ? AND id LIKE ? ";
            $sql .= "ORDER BY createtime DESC ";
            $sql .= "LIMIT 50";
            $var['pages'] = $this->dbh->getAll($sql,$values);
            // rowsの一覧に出ちゃう
            //$var['rows']['count'] = $this->dbh->rowCount();

            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->files_table} ";
            $sql .= "WHERE parent_id = ? ";
            $values = array();
            array_push($values,$req['id']);
            $var['files'] = $this->dbh->getAll($sql,$values);
            //$var['files']['count'] = $this->dbh->rowCount();
        } else {
            $sql = "SELECT * FROM {$this->table} ";
            $values = array();
            $sql .= "WHERE id = '' ";
            $var['row'] = $this->dbh->getRow($sql,$values);


            $sql = "SELECT SQL_CALC_FOUND_ROWS T1.*,T2.filename FROM {$this->table} T1 ,{$this->files_table} T2 ";
            $values = array();
            //$sql .= "WHERE id != ? AND id LIKE ? ";
            $sql .= "WHERE T1.id != '' AND T2.parent_id = T1.id ";
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

            $sql = "SELECT SQL_CALC_FOUND_ROWS * FROM {$this->table} ";
            //$sql .= "WHERE id != ? AND id LIKE ? ";
            $sql .= "ORDER BY createtime DESC ";
            $sql .= "LIMIT 50";
            $var['pages'] = $this->dbh->getAll($sql,$values);
            //if(preg_match("#^[^/]*/[^/]*$#",$req['id'])) {
        }
        return $var;
    }

    public function put($req){
        // TODO $req['post']['ids']
        $id = ($req['id']) ? $req['id'] : '';
        $values = array();
        $sql = "SELECT COUNT(*) FROM {$this->table} WHERE id = ?";
        array_push($values,$id);
        $count = $this->dbh->getOne($sql,$values);
        $param = $req['post'];
        $param['id'] = $id;
        $param['parent_id'] = dirname($id);
        if ($count) {
            $param['modified'] = date('Y-m-d H:i:s');
            $this->dbh->update($this->table,$id,$param);
/*
            if ($req['id'] != $req['post']['id']){
                $sql = "SELECT * FROM {$this->table} ";
                $values = array();
                $sql .= "WHERE id != ? AND id REGEXP ? ";
                array_push($values,$req['id'],"^".$req['id']);
                $rows = $this->dbh->getAll($sql,$values);
                foreach($rows as $row) {
                    $id = preg_replace("#".$req['id']."#",$req['post']['id'],$row['id']);
                    $this->dbh->update($this->table,$row['id'],array("id"=>$id));
                }
            }
 */
        } else {
            $param['created'] = date('Y-m-d H:i:s');
            $this->dbh->insert($this->table,$param);
        }
    }

    public function post($req){
        if (count($_FILES)){
            foreach($_FILES as $file) {
                $dirname = "upload";
                if (!is_dir($dirname)){
                    mkdir($dirname,0777,true);
                }
                $filename = $req['id'].($req['id'] ? "/":"").$file["name"];
                $upload_file = "$dirname/$filename";
                if (!is_dir(dirname($upload_file))){
                    mkdir(dirname($upload_file),0777,true);
                }
                if(move_uploaded_file($file["tmp_name"],$upload_file))
                {
                    chmod($upload_file,0644);
                }

        $im = new Imagick();
        $im->readImage("upload/".$filename);
        $width = $im->getImageWidth();
        if ($width > 600) {
            $im->resizeImage(600, 0, imagick::FILTER_MITCHELL, 1);
        }
        $large = "upload/large/".$filename;
        if (!is_dir(dirname($large))) {
            mkdir(dirname($large),0777,true);
        }
        $im->writeImage($large);
        $im->destroy();

        $im = new Imagick();
        $im->readImage("upload/".$filename);
        $width = $im->getImageWidth();
        if ($width > 150) {
            $im->resizeImage(150, 0, imagick::FILTER_MITCHELL, 1);
        }
        $small = "upload/small/".$filename;
        if (!is_dir(dirname($small))) {
            mkdir(dirname($small),0777,true);
        }
        $im->writeImage($small);
        $im->destroy();

                /*
                $image = new Image();
                $image->imageresize($upload_thumb_file,$upload_file,200);
                $image->imageresize($upload_large_file,$upload_file,1000,1000);
                 */
                //$image = new Image();
                //$image->resize("upload/thumb/".$filename,$upload_file,200,300);
                //$image->resize("upload/large/".$filename,$upload_file,600,900);
                //$id = $req['id'].$file["name"];
                $pathinfo = pathinfo($file["name"]);
                $id = $req['id'].($req['id'] ? "/":"").$pathinfo['filename'];
                //$id = implode("/", array($req['id'],$pathinfo['filename']));
                $parent_id = $req['id'];
                $type = 'image';
                //$sql = "DELETE FROM {$this->table} WHERE id = ?";
                //$this->dbh->query($sql,array($id));
                $size = getimagesize($upload_file);
                $width = $size[0];
                $height = $size[1];
                $this->dbh->delete($this->table,$id);
                $created = date('Y-m-d H:i:s');
                $this->dbh->insert($this->table,array("id"=>$id,"parent_id"=>$parent_id,"filename"=>$filename,"width"=>$width,"height"=>$height,"type"=>$type,"user_id"=>$req['user_id'],"created"=>$created));
            }
        } else {
            $param = $req['post'];
            $rand = $this->getRandomString();
            $id = $req['id'].($req['id'] ? "/":"").$rand;
            //echo $id;
            //$id = $req['id'].($req['id'] ? "/":"").date('ymdHis');
            //$id = $req['id'].($req['id'] ? "/":"").substr(md5(time()),0,5);
            //$id = $req['id'].($req['id'] ? "/":"").substr(md5(time()),0,5);
            $param['id'] = $id;
            $param['parent_id'] = dirname($id);
            $param['created'] = date('Y-m-d H:i:s');
            $this->dbh->insert($this->table,$param);
        }
    }

    public function getRandomString($nLengthRequired = 5){
        $sCharList = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_";
        mt_srand();
        $sRes = "";
        for($i = 0; $i < $nLengthRequired; $i++) {
            $sRes .= $sCharList{mt_rand(0, strlen($sCharList) - 1)};
        }
        return $sRes;
    }

    public function delete($req) {
        $sql = "SELECT * FROM {$this->table} ";
        $values = array();
        $sql .= "WHERE id REGEXP ? ";
        if ($req['id']) {
            array_push($values,"^".$req['id']);
        } else {
            array_push($values,"");
        }
        $rows = $this->dbh->getAll($sql,$values);
        // TODO $req['post']['ids']
        foreach ($rows as $row) {
            if(is_file("upload/{$row['filename']}")){
                unlink("upload/{$row['filename']}");
            }
            if(is_file("upload/large/{$row['filename']}")){
                unlink("upload/large/{$row['filename']}");
            }
            if(is_file("upload/thumb/{$row['filename']}")){
                unlink("upload/thumb/{$row['filename']}");
            }
            $this->dbh->delete($this->table,array($row['id']));
        }
        //$sql = "DELETE FROM {$this->table} WHERE id = ?";
        //$this->dbh->query($sql,array($req['id']));

        //$this->templatemodel->deletetemplate($this->param);
    }
}
?>
