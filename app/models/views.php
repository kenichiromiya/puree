<?php

class ViewModel extends Model {

    public function __construct(){
        parent::__construct();
    }

/*
    function getDirectoryTree( $outerDir, $filters = array() ){ 
        $dirs = array_diff( scandir( $outerDir ), array_merge( Array( ".", ".." ), $filters ) ); 
        $dir_array = Array(); 
        foreach( $dirs as $d ) 
            $dir_array[ $d ] = is_dir($outerDir."/".$d) ? getDirectoryTree( $outerDir."/".$d, $filters ) : $dir_array[ $d ] = $d; 
        return $dir_array; 
    }
 */
    function getDirectory( $outerDir ){ 
        $dirs = array_diff( scandir( $outerDir ), Array( ".", ".." )); 
        $dir_array = Array(); 
        foreach( $dirs as $d ) 
            if(is_dir($outerDir."/".$d)) {
                $dir_tree = $this->getDirectory( $outerDir."/".$d);
                $dir_array = array_merge($dir_array,$dir_tree);
            } else {
                $dir_array[ $outerDir."/".$d ] = $outerDir."/".$d; 
            }
        return $dir_array; 
    }


    function get($req) {
        if ($req['view'] == "edit"){
            if (is_file("views/{$req['file']}")){
                $var['view'] = basename($req['file']);
                $var['_method'] = "put";
            } else {
                $var['_method'] = "post";
            }
            $var['main'] = "view/edit.php";
        } else {
            //$var['views'] = $this->getDirectory("views");
            //$var['views'] = array_diff( scandir( "views" ), array( ".", ".." ));
            if (is_file("views/{$req['file']}")){
                $var['view'] = basename($req['file']);
                $var['main'] = "view/view.php";

            } else {
                $var['views'] = array_diff( scandir("views/{$req['file']}"), array( ".", ".." ));
                //print_r($var['views']);
                //exit;
                $var['main'] = "view/views.php";
            }
        }
        return $var;
    }

    public function post($req) {
        file_put_contents("views/{$req['file']}"."/".$req['post']['view'],$req['post']['contents']);
    }
    public function put($req) {
        file_put_contents("views/{$req['file']}",$req['post']['contents']);
    }

    public function delete($req) {
        unlink("views/{$req['file']}");
        //$this->viewmodel->deleteview($this->param);
    }

}
?>
