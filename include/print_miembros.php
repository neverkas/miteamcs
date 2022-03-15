<?php
function print_miembros($get_data){
	$html='<div id="gallery">';
	foreach($get_data as $data){
		$name 		= $data['name'];
		$facebook 	= $data['facebook'];

		$html.="
		<div class='block-profile'>
			<div class='picture'>
				<a href='http://www.facebook.com/{$facebook}' target='_blank' alt='$name' class='text-style-black'>
					<img src='http://graph.facebook.com/{$facebook}/picture?width=150&height=150' alt='$name' title='$name' />
				</a>
			</div>
			<div class='nickname'>
				<a href='http://www.facebook.com/{$facebook}' target='_blank' alt='$name' class='text-style-black text-type-small'>
					$name
				</a>
			</div>
		</div>
		";
	}
	$html.='<div class="clear"></div>';
	$html.='</div>';

	return $html;
}
?>