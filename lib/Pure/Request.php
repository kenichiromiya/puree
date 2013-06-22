<?php
namespace Pure;
class Request
{
    private static $instance;
    private $count = 0;
    public $req;

    private function __construct()
    {
        $this->tags = '<img><p><a><br><div>';
        /*
        $cwd = getcwd();
        $uri = str_replace("$cwd","",$_SERVER["DOCUMENT_ROOT"].preg_replace("#\?.*$#","",$_SERVER["REQUEST_URI"]));

        if (preg_match("#^/(.*?)/(.*)$#",$uri,$m) and (file_exists("app/controllers/".$m[1].".php"))) {
            //if (preg_match("#^/(.*?)/(.*)$#",$uri,$m)) {
            $_GET['controller'] = $m[1];
            if ($m[2]){
                $_GET['id'] = $m[2];
            } else {
                $_GET['id'] = '';
            }
        } elseif (preg_match("#^/(.*)$#",$uri,$m)) {
            $_GET['controller'] = DEFAULT_CONTROLLER;
            if ($m[1]){
                $_GET['id'] = $m[1];
            } else {
                $_GET['id'] = '';
            }
        }
         */
    }

    public function get($key) {
        if (!isset($_GET[$key])) {
            return FALSE;
        } else {
            //return strip_tags($_GET[$key]);
            return strip_tags($_GET[$key],$this->tags);
        }
    }
    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            //echo 'Creating new instance.';
            $className = __CLASS__;
            self::$instance = new $className;
            self::$instance->sanitize();
        }
        return self::$instance;
    }

    function sanitize() {
        $post = array();
        $get = array();
        //print_r($_POST);
        foreach ($_POST as $key => $value) {
            if (is_array($value)) {
                // TODO array sanitize
                $post[$key] = $value;
            } else {
                //$post[$key] = strip_tags($value);
                $post[$key] = strip_tags($value,$this->tags);
            }
        }
        foreach ($_GET as $key => $value) {
            if (is_array($value)) {
                $get[$key] = $value;
            } else {
                //$get[$key] = strip_tags($value);
                $get[$key] = strip_tags($value,$this->tags);
            }
        }
        //$this->req = array_merge($get,$post);
        $this->req = array_merge($post,$get);
        $this->req['get'] = $get;
        /*
        if (!isset($post['id'])) {
            $post['id'] = $get['id'];
        }
         */
        $this->req['post'] = $post;
        /*
        if ($this->param['_method']) {
            $method = strtoupper($this->param['_method']);
        } else {
            $method = $_SERVER["REQUEST_METHOD"];
        }
        $this->param['method'] = $method;
         */
        /*
        $cwd = getcwd();
        //echo $cwd."<br>";
        $uri = str_replace("$cwd","",$_SERVER["DOCUMENT_ROOT"].$_SERVER["REQUEST_URI"]);

        if (preg_match("#^/(.*?)/(.*)$#",$uri,$m)) {
            $this->req['controller'] = $m[1];
            $this->req['id'] = $m[2];
        } elseif (preg_match("#^/(.*)$#",$uri,$m)) {
            $this->req['controller'] = "articles";
            $this->req['id'] = $m[1];
        }
         */
        //return $this->req;
    }
/*
    public function increment()
    {
        return $this->count++;
    }

    public function __clone()
    {
        trigger_error('Clone is not allowed.', E_USER_ERROR);
    }

    public function __wakeup()
    {
        trigger_error('Unserializing is not allowed.', E_USER_ERROR);
    }
 */
}

?>
