<?php
namespace Files;

class Model extends \Common\Model {
    public $error;

    public function __construct(){
        parent::__construct();
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
        // TODO
        // ファイル名に[]が入ると配列として認識されてしまう。
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
                /*
                $image = new Image();
                $image->imageresize($upload_thumb_file,$upload_file,200);
                $image->imageresize($upload_large_file,$upload_file,1000,1000);
                 */
                /*
                $image = new Image();
                $image->resize("upload/thumb/".$filename,$upload_file,200,300);
                $image->resize("upload/large/".$filename,$upload_file,600,900);
                */
                $parent_id = $req['id'];
                if(is_file("upload/large/$filename")){
                    unlink("upload/large/$filename");
                }
                if(is_file("upload/thumb/$filename")){
                    unlink("upload/thumb/$filename");
                }
                if(is_file("upload/preview/".$parent_id.".jpg")){
                    unlink("upload/preview/".$parent_id.".jpg");
                }
                //$id = $req['id'].$file["name"];
                $pathinfo = pathinfo($file["name"]);
                $id = $req['id'].($req['id'] ? "/":"").$pathinfo['filename'];
                //$id = implode("/", array($req['id'],$pathinfo['filename']));
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
            //$id = $req['id']."/".date('YmdHi');
            $id = $req['id'].($req['id'] ? "/":"").substr(md5(time()),0,5);
            $param['id'] = $id;
            $param['parent_id'] = dirname($id);
            $param['created'] = date('Y-m-d H:i:s');
            $this->dbh->insert($this->table,$param);
        }
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
            if(is_file("upload/preview/".$row['parent_id'].".jpg")){
                unlink("upload/preview/".$row['parent_id'].".jpg");
            }
            $this->dbh->delete($this->table,array($row['id']));
        }
        //$sql = "DELETE FROM {$this->table} WHERE id = ?";
        //$this->dbh->query($sql,array($req['id']));

        //$this->templatemodel->deletetemplate($this->param);
    }
}
?>
