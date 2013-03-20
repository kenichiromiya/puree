<?php
namespace Pure;

class View
{
    function __construct($template) {
        //$this->param = Sanitizer::sanitize();
        //$this->template = $this->param['controller'];
        $this->template = $template;
    }

    /*
    function getcontents($view,$data = array())
    {
        global $_LANG;
        extract($data);
        $cwd = getcwd();
        chdir("views");
                ob_start();
        //include_once("functions.php");
        include($view);
                $contents = ob_get_contents();
                ob_end_clean();
        chdir($cwd);
        return $contents;
    }
     */

    function getcontents($data = array())
    {
        global $_LANG;
        extract($data);
        $cwd = getcwd();
        //chdir("app/views");
        //echo $cwd;
        //chdir("views");
        ob_start();
        //include_once("functions.php");
        include("views/".$this->template);
        $contents = ob_get_contents();
        ob_end_clean();
        //chdir($cwd);
        chdir($cwd);
        return $contents;
    }
/*
    function getcontents($data = array())
    {
        global $_LANG;
        extract($data);
        $cwd = getcwd();
        //chdir("app/views");
        $dir = dirname($this->template);
        $dirs = array("$cwd/Puree/views/$dir");
        while($dir){
            $dir = dirname($dir);
            if ($dir == "."){ $dir = "";}
            array_push($dirs,"$cwd/Puree/views/$dir");
        }
        set_include_path(implode(':',$dirs));
        //chdir("app/views/".dirname($this->template));
                ob_start();
        //include_once("functions.php");
        include(basename($this->template));
                $contents = ob_get_contents();
                ob_end_clean();
        //chdir($cwd);
        return $contents;
    }
 */

    function display($data = array())
    {
        global $_LANG;
        extract($data);
        $cwd = getcwd();
        //chdir("app/views");
        chdir("Puree/views/".dirname($this->template));
        set_include_path(".:$cwd/Puree/views/");
        //include_once("functions.php");
        include(basename($this->template));
        chdir($cwd);
    }
}
?>
