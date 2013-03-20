<?php
/*
function curl_post($url,$postfields){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
//curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$return = curl_exec($ch);
curl_close($ch);
//print_r($return);
return $return;
}
*/
function curl_post($url,$postfields){
	$options = array(
		CURLOPT_URL => $url,
		CURLOPT_RETURNTRANSFER => true,
		CURLOPT_HEADER         => true,
		CURLOPT_POST => true,
		CURLOPT_POSTFIELDS => $postfields,
		CURLOPT_FOLLOWLOCATION => true,
	);

	$ch = curl_init();
	curl_setopt_array($ch, $options);
	$return = curl_exec($ch);
	if(!curl_errno($ch)) {
		$header = curl_getinfo($ch);
	}
	curl_close($ch);
	$header['http_code'];
	//print_r($return);
	error_log($header['http_code']);
	return $header['http_code'];
}
/*
function curl_post_binary($url,$postfields){
$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_POST, true);
curl_setopt($ch, CURLOPT_POSTFIELDS, $postfields);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 1);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_BINARYTRANSFER, 1);
$return = curl_exec($ch);
curl_close($ch);
//print_r($return);
return $return;
}
*/
?>
