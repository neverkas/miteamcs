<?php
function print_servidores($get_data){
#	$html = '<div id="block-servers">';

	foreach($get_data as $data){
		$address 	= $data['address'];
		$name 		= $data['name'];

		$html.="{$address} {$name}<br />";
/*
		$html.="
		<div>
			<img src='http://cache.www.gametracker.com/server_info/{$address}/b_560_95_1.png' width='560' height='95' alt='$name'/>
		</div>
		";
*/
	}
#	$html.='</div>';

	return $html;
}
?>