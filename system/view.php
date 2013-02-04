<?php
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
                ob_start();
		//include_once("functions.php");
		//set_include_path(".:app/views/");
		include(PUREE_DIR."app/views/".$this->template);
                $contents = ob_get_contents();
                ob_end_clean();
		//chdir($cwd);
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
		$dirs = array("$cwd/app/views/$dir");
		while($dir){
			$dir = dirname($dir);
			if ($dir == "."){ $dir = "";}
			array_push($dirs,"$cwd/app/views/$dir");
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
		chdir("app/views/".dirname($this->template));
		set_include_path(".:$cwd/app/views/");
		//include_once("functions.php");
		include(basename($this->template));
		chdir($cwd);
	}
}
?>
