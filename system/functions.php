<?php
function httprequest($url) {
	$parsed_url = parse_url($url);
	$file = "cache/".basename($parsed_url['path']).'?'.$parsed_url['query'];
	if(file_exists($file)){
		$mtime = filemtime($file);
	} else {
		$mtime = time();
	}
	$lastmodified = gmdate ("D, d M Y H:i:s T", $mtime);
		//echo $lastmodified;
		//echo file_get_contents($file);
	//} else {
		$opts = array(
				'http'=>array('method' => "GET",
					'header' => "Accept-language: ".$_SERVER['HTTP_ACCEPT_LANGUAGE']."\r\n".
						"If-Modified-Since: ".$lastmodified."\r\n")
			     );

		$context = stream_context_create($opts);
		$contents = file_get_contents($url, false, $context);
		file_put_contents($file,$contents);
		echo $contents;
		
	//}
}

function find_all_files($dir) 
{ 
    $root = scandir($dir); 
    foreach($root as $value) 
    { 
        if($value === '.' || $value === '..') {continue;} 
        if(is_file("$dir/$value")) {$result[]="$dir/$value";continue;} 
	$files = find_all_files("$dir/$value");
	if (is_array($files)){
		foreach($files as $file) 
		{ 
			$result[]=$file; 
		} 
	}
    } 
    return $result; 
} 

        function getDirectory( $outerDir ){
                $dirs = array_diff( scandir( $outerDir ), Array( ".", ".." ));
                $dir_array = Array();
                foreach( $dirs as $d )
                        if(is_dir($outerDir."/".$d)) {
                                 $dir_tree = getDirectory( $outerDir."/".$d);
                                $dir_array = array_merge($dir_array,$dir_tree);
                        } else {
                                $dir_array[ $outerDir."/".$d ] = $outerDir."/".$d;
                        }
                return $dir_array;
        }

/*
function getbase() {
	return "http://".$_SERVER["HTTP_HOST"].dirname($_SERVER["SCRIPT_NAME"])."/";
}
*/


/*
function getpagination($param) {
	$page = $param['page'];
	$count = $param['count'];
	$total = $param['total'];
	$page = isset($page) ? $page : '1';
	$min_page = 1;
	$max_page = ceil($total/$count);
	$pages = array($page);
	$offset = 1;
	while ($i < 5 and (($page - $offset > 0) or ($page + $offset <= $max_page))) {
		if ($page - $offset > 0 ){
			array_unshift($pages,$page - $offset);
			$i++;
		}
		if ($page + $offset <= $max_page ){
			array_push($pages,$page + $offset);
			$i++;
		}
		$offset++;
	}
	$pagination['page'] = $page;
	$pagination['pages'] = $pages;

	$pagination['min_page'] = 1;
	if($page > $min_page){
		$pagination['prev_page'] = $page-1;
	}
	if($page < $max_page){
		$pagination['next_page'] = $page+1;
	}
	$pagination['max_page'] = $max_page;
	return $pagination;
}
*/
?>
