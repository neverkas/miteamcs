<?php
function fb_get_data($get_url, $get_option){
	preg_match_all('/(((http|https)\:\/\/(www\.|))(facebook|fb)\.com\/)+(.*)/', $get_url, $url);

	$user_id 	= $url[6][0];
	$facebook 	= "http://graph.facebook.com/{$user_id}";
	$content 	= file_get_contents($facebook);
	$json 		= json_decode($content, true);
	
	if($content) return $json;
}
?>