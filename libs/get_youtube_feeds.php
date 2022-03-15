<?php
function youtube_get_feeds($get_data){	
	$data = array();

	for($i=0; $i < count($get_data[0]); ++$i){
		$name 	= $get_data[2][$i];
		$name 	= str_replace('user/', '', $name);
		$social = $get_data[1][$i];
		
		if($social == 'youtube'){
			$youtube_url = "http://gdata.youtube.com/feeds/base/users/$name/uploads?alt=rss&v=2&orderby=published&amp";
		}
	}

	$xml = new DOMDocument();
	$xml->load($youtube_url);
	$channel 	= $xml->getElementsByTagName('channel')->item(0);
	$items 		= $channel->getElementsByTagName('item');

	foreach($items as $item){
		$guid 		= $item->getElementsByTagName('guid')->item(0)->nodeValue;
		$title 		= $item->getElementsByTagName('title')->item(0)->nodeValue;
		$link 		= $item->getElementsByTagName('link')->item(0)->nodeValue;
		preg_match_all('/video\:(.*)/', $guid, $get_video_id);
		$video_id 	= $get_video_id[1][0];

		$data[] = array(
			'title' 	=> $title,
			'image' 	=> "//i2.ytimg.com/vi/{$video_id}/mqdefault.jpg",
			'video' 	=> "http://www.youtube.com/embed/{$video_id}?autoplay=1",
		);
	}

	return $data;
}
?>