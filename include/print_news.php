<?php
function print_news($user_id, $get_data){
#	$html = '<div id="block-list-news">';
	foreach($get_data as $data){
		$title 		= strtoupper($data['title']);
		$date 		= $data['date'];
		$content 	= $data['content'];
		$alternate 	= $data['alternate'];
		$content 	= preg_replace('/\<a(.*)\/a\>/', '', $content);
#		$content 	= preg_replace('/\<img(.*)\>/', '', $content);
		

		preg_match_all('/photo.php\?fbid\=(.*)\&set/', $alternate, $photo);
		if($photo[1][0]){
			$image_src = $photo[1][0];
		}else{
			$image_src = $user_id;			
		}


#		print_x($photo);
# image 210x135
		# 464462326903399
		$html.="
		<div class='article'>
			<div class='thumbnail align-left'>
				<span class='date text-size-medium'>{$date}</span>
				<img src='http://graph.facebook.com/{$image_src}/picture?width=300&height=179' width='300' border='0' />
			</div>
			<div class='content align-right'>
				<div class='author'>
					<span class='text-color-white text-size-small'>By Admin</span>
				</div>
				<div class='title'>
					<span class='text-color-orange-dark text-size-small'>{$title}</span>
				</div>
				<div class='description'>
					<span class='text-color-gray text-size-small'>{$content}</span>
				</div>
			</div>
			<div class='clear'></div>
		</div>
		";
	#	$html.="<h3>$title</h3> $date <br /><span>$content</span><br />";
	}
#	$html.='</div>';

	return $html;
}
?>