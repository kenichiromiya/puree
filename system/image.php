<?php
class Image {

        public function __construct()
        {
        }

	public function getresampledimagesize($filename,$max_width = '',$max_height = '') {
		list($width, $height,$imagetype) = getimagesize($filename);

		$ratio = $width/$height;

		if ($ratio > 1) {
			$new_width = $max_width;
			$new_height = $max_height/$ratio;
		} else {
			$new_width = $max_width*$ratio;
			$new_height = $max_height;
		}
		return array($new_width,$new_height);
	} 
	public function resize($newfilename,$filename,$max_width = '',$max_height = '') {
		// 長辺指定だったら、max_widthとmax_heightが同じ
		// 新規サイズを取得します
		list($width, $height,$imagetype) = getimagesize($filename);
		$new_width = $width;
		$new_height = $height;

		if($new_width > $max_width) {
			$new_height *= $max_width / $new_width;
			$new_width = $max_width;
		}

		if($new_height > $max_height) {
			$new_width *= $max_height / $new_height;
			$new_height = $max_height;
		}

		// 再サンプル
		$image_p = imagecreatetruecolor($new_width, $new_height);
		switch ($imagetype)
		{
		case 1:
			$image = imagecreatefromgif($filename);
			break;
		case 2:
			$image = imagecreatefromjpeg($filename);
			break;
		case 3:
			$image = imagecreatefrompng($filename);
			break;
		}
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		//$matrix = array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1));   
		//imageconvolution($image_p, $matrix, 8, 0);   


		// 出力

		if (!is_dir(dirname($newfilename))) {
			mkdir(dirname($newfilename),0777,true);
		}
		if ($format == "jpeg" or preg_match("/jpg|jpeg/i",$newfilename,$m)) {
			imagejpeg($image_p, $newfilename,90);
			//imagejpeg($image_p, $newfilename, 95);
		}
		if ($format == "gif" or preg_match("/gif/i",$newfilename,$m)) {
			imagegif($image_p, $newfilename);
		}
		if ($format == "png" or preg_match("/png/i",$newfilename,$m)) {
			imagepng($image_p, $newfilename);
		}

		$img = imagecreatefromjpeg($newfilename);
		$matrix = array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1));
		imageconvolution($img, $matrix, 8, 0);

	}

	public function imageresize($newfilename,$filename,$max_width = '',$max_height = '',$format = '') {
		// 長辺指定だったら、max_widthとmax_heightが同じ
		// 新規サイズを取得します
		list($width, $height,$imagetype) = getimagesize($filename);
		$new_width = $width;
		$new_height = $height;

		$ratio = $width/$height;

		// 両方指定されてたら元画像の長いほうを指定してリサイズ
		if ($max_width && $max_height){
			if ($ratio > 1) {
				if ($width > $max_width) {
					$new_width = $max_width;
					$new_height = $max_width/$ratio;
				}
			} else {
				if ($height > $max_height) {
					$new_width = $max_height*$ratio;
					$new_height = $max_height;
				}
			}
		} elseif($max_width) {
			if ($width > $max_width) {
				$new_width = $max_width;
				$new_height = $max_width/$ratio;
			}
		} elseif($max_height) {
			if ($height > $max_height) {
				$new_width = $max_height*$ratio;
				$new_height = $max_height;
			}
		}

		// 再サンプル
		$image_p = imagecreatetruecolor($new_width, $new_height);
		switch ($imagetype)
		{
		case 1:
			$image = imagecreatefromgif($filename);
			break;
		case 2:
			$image = imagecreatefromjpeg($filename);
			break;
		case 3:
			$image = imagecreatefrompng($filename);
			break;
		}
		imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
		//$matrix = array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1));   
		//imageconvolution($image_p, $matrix, 8, 0);   


		// 出力
		if (!is_dir(dirname($newfilename))) {
			mkdir(dirname($newfilename));
		}
		if ($format == "jpeg" or preg_match("/jpg|jpeg/i",$newfilename,$m)) {
			imagejpeg($image_p, $newfilename,90);
			//imagejpeg($image_p, $newfilename, 95);
		}
		if ($format == "gif" or preg_match("/gif/i",$newfilename,$m)) {
			imagegif($image_p, $newfilename);
		}
		if ($format == "png" or preg_match("/png/i",$newfilename,$m)) {
			imagepng($image_p, $newfilename);
		}

		$img = imagecreatefromjpeg($newfilename);
		$matrix = array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1));
		imageconvolution($img, $matrix, 8, 0);

	}
}
?>


<?php

function getpath() {
	
	$parseurl = parse_url("http://".$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']);
	$path = explode('/', $parseurl['path']); 

	return $path;
}


function getdone() {
	return urlencode("http://".$_ENV["HTTP_HOST"].$_ENV["REQUEST_URI"]);
}

function getresampledimagesize($filename,$max_width,$max_height) {
	list($width, $height,$imagetype) = getimagesize($filename);

	$ratio = $width/$height;

	if ($ratio > 1) {
		$new_width = $max_width;
		$new_height = $max_height/$ratio;
	} else {
		$new_width = $max_width*$ratio;
		$new_height = $max_height;
	}
	return array($new_width,$new_height);
} 

function imageresize($newfilename,$filename,$max_width,$max_height) {
	// 新規サイズを取得します
	list($width, $height,$imagetype) = getimagesize($filename);

	$ratio = $width/$height;

	if ($ratio > 1) {
		$new_width = $max_width;
		$new_height = $max_width/$ratio;
	} else {
		$new_width = $max_height*$ratio;
		$new_height = $max_height;
	}

	//$new_width = $max_width;
	//$new_height = $max_height/$ratio;

	// 再サンプル
	$image_p = imagecreatetruecolor($new_width, $new_height);
	switch ($imagetype)
	{
		case 1:
			$image = imagecreatefromgif($filename);
			break;
		case 2:
			$image = imagecreatefromjpeg($filename);
			break;
		case 3:
			$image = imagecreatefrompng($filename);
			break;
	}
	imagecopyresampled($image_p, $image, 0, 0, 0, 0, $new_width, $new_height, $width, $height);
//$matrix = array(array(-1, -1, -1), array(-1, 16, -1), array(-1, -1, -1));   
//imageconvolution($image_p, $matrix, 8, 0);   
  

// 出力
	if (!is_dir(dirname($newfilename))) {
		mkdir(dirname($newfilename));
	}
	if (preg_match("/jpg|jpeg/i",$newfilename,$m)) {
		imagejpeg($image_p, $newfilename, 95);
	}
	if (preg_match("/gif/i",$newfilename,$m)) {
		imagegif($image_p, $newfilename);
	}
	if (preg_match("/png/i",$newfilename,$m)) {
		imagepng($image_p, $newfilename);
	}
}

# PHP Calendar (version 2.3), written by Keith Devens
# http://keithdevens.com/software/php_calendar
#  see example at http://keithdevens.com/weblog
# License: http://keithdevens.com/software/license


//http://www.php-z.net/c10/n84.html
function list_to_tree($category = array(),
		$idField = 'id',$parentField='parent_id'){
	if(!is_array($category)) exit("配列ではありません");

	$index = array();
	$tree = array();

	foreach($category as $value){
		$id     = $value[$idField];
		$parent = $value[$parentField];

		if(isset($index[$id])){
			$value['child'] = $index[$id]['child'];
			$index[$id] = $value;

		} else {
			$index[$id] = $value;
		}

		if($parent == 0){
			$tree[] =& $index[$id];

		} else {
			$index[$parent]['child'][] =& $index[$id];
		}


	}
	return $tree;
}


function tree_walk($data=array(),$callback){

	if(is_array($data)){
		foreach($data as $key => $value){
			$callback($value);
			if(is_array($value['child'])) {
				tree_walk($value['child']);
			}
		}
	}
}
?>
