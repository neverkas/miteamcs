<?php
function youtube_print_feeds($get_data, $limit = NULL){
	if($limit != NULL){
		$get_data = array_slice($get_data, 0, $limit);
	}

	$html='
	<div id="block-videos">
		<div id="videos-head">
			<h3 class="widget-title text-color-white text-size-big">VIDEOS</h3>
		</div>
		
		<div id="videos-content">
			<div id="videos-list">
	';

	$count_video 		= 0; 

	foreach($get_data as $data){
		++$count_video; 
		$title			= $data['title'];
		$title_short 	= mb_substr($title, 0, 38, 'utf-8');
		$title_short 	= (mb_strlen($title_short, 'utf-8') < 38) ? $title_short : $title_short."...";
		$image 			= $data['image'];
		$video 			= $data['video'];

		if($limit==NULL && $count_video == 3) $show_allVideos = true;
		else $show_allVideos = false;

		if($limit==NULL) $style_video = "style='width:210px;'";

		$html.="
			<div class='align-left video-row showModal-medium showModal' {$style_video}>
				<div class='thumbnail text-align-center'>
					<img width='185' src='$image' alt='$title' title='$title' />	
				</div>
				<div class='title text-align-center'>
					<span class='video-title text-size-medium text-color-white'>$title_short</span>
				</div>
				<input type='hidden' class='video_title' value='$title' />
				<input type='hidden' class='video_src' value='$video' /> 
			</div>
		";

		if($show_allVideos == true){
		$html.="<div class='clear'></div>";
		$count_video = 0;
		}
	}
	$html.='
			<div class="clear"></div>
			</div>
		</div>
	</div>

	<div id="myModal-video" style="display:none;">
		<input type="hidden" id="youtube_url" value="http://www.youtube.com/embed/" />
		<h1 class="text-style-black"></h1>
		<span class="text-type-small text-style-black">Este vídeo fué subido por esta persona, no nos hacemos responsables por el contenido que usted llegara a ver.</span>
	
		<div id="block-video">
			<iframe type="text/html" width="640" height="390" src="" frameborder="0"></iframe>
		</div>
	</div>
	';

	return $html;
}
/*
function youtube_print_feeds($get_data, $limit = NULL){
	if($limit != NULL){
		$get_data = array_slice($get_data, 0, $limit);
	}

	$html='
	<div id="block-videos">
		<div id="videos-head">
			<h3 class="text-type-small text-style-white">VIDEOS</h3>
		</div>
		<div id="videos-content">
			<div id="videos-list">
	';

	foreach($get_data as $data){
		$title			= $data['title'];
		$title_short 	= mb_substr($title, 0, 38, 'utf-8');
		$title_short 	= (mb_strlen($title_short, 'utf-8') < 38) ? $title_short : $title_short."...";
		$image 			= $data['image'];
		$video 			= $data['video'];

		$html.="
			<div class='align-left video-row showModal'>
				<div class='thumbnail text-align-center'>
					<img width='120' src='$image' alt='$title' title='$title' />	
				</div>
				<div class='title text-align-center'>
					<span class='text-type-small text-style-black'>$title_short</span>
				</div>
				<input type='hidden' class='video_title' value='$title' />
				<input type='hidden' class='video_src' value='$video' /> 
			</div>
		";
	}

	$html.='
			<div class="clear"></div>
			</div>
		</div>
	</div>
 
	<div id="myModal" class="reveal-modal">
		<input type="hidden" id="youtube_url" value="http://www.youtube.com/embed/" />
		<h1></h1>
		<span class="text-type-small">Este vídeo fué subido por esta persona, no nos hacemos responsables por el contenido que usted llegara a ver.</span>
		<a class="close-reveal-modal">&#215;</a>
	
		<div id="block-video">
			<iframe id="ytplayer" type="text/html" width="640" height="390" src="" frameborder="0"/>
		</div>
	</div>
	';

	return $html;
}
*/
?>