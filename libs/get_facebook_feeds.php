<?php
function fb_get_feeds($user_id){
//replace the Page ID with your own
$url = "http://www.facebook.com/feeds/page.php?id=".$user_id."&format=json "; 
 
// disguises the curl using fake headers and a fake user agent. 
	function disguise_curl($url){ 
		$curl = curl_init(); 

		// Setup headers - the same headers from Firefox version 2.0.0.6 
		// below was split up because the line was too long. 
		$header[0] = "Accept: text/xml,application/xml,application/xhtml+xml,"; 
		$header[0] .= "text/html;q=0.9,text/plain;q=0.8,image/png,*/*;q=0.5"; 
		$header[] = "Cache-Control: max-age=0"; 
		$header[] = "Connection: keep-alive"; 
		$header[] = "Keep-Alive: 300"; 
		$header[] = "Accept-Charset: ISO-8859-1,utf-8;q=0.7,*;q=0.7"; 
		$header[] = "Accept-Language: en-us,en;q=0.5"; 
		$header[] = "Pragma: "; // browsers keep this blank. 

		curl_setopt($curl, CURLOPT_URL, $url); 
		curl_setopt($curl, CURLOPT_USERAGENT, 'Mozilla'); 
		curl_setopt($curl, CURLOPT_HTTPHEADER, $header); 
		curl_setopt($curl, CURLOPT_REFERER, ''); 
		curl_setopt($curl, CURLOPT_ENCODING, 'gzip,deflate'); 
		curl_setopt($curl, CURLOPT_AUTOREFERER, true); 
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1); 
		curl_setopt($curl, CURLOPT_TIMEOUT, 10); 

		$html = curl_exec($curl); // execute the curl command 
		curl_close($curl); // close the connection 

		return $html; // and finally, return $html 
	} 

	// uses the function and displays the text off the website 
	$text = disguise_curl($url); 
	$json_feed_object = json_decode($text);
	$FB_Data = array();

	foreach ( $json_feed_object->entries as $entry )
	{
		$published = date("j M, Y", strtotime($entry->published));
#		$published = date("g:i A F j, Y", strtotime($entry->published));

		$FB_Data[] = array(
			'title' 	=> $entry->title,
			'date'  	=> $published,
			'content'   => $entry->content,
			'alternate' => $entry->alternate,
		);
	}

return $FB_Data;
}

?>