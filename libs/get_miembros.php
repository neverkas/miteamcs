<?php
function get_miembros($get_data){
	# Miembros:(\s*\n.(.* +http\:\/\/www\.facebook\.com\/(.*)))*
	preg_match_all('/Miembros:\s*\n(.* http\:\/\/www\.facebook\.com\/.*\n*)*/', $get_data, $node);
	preg_match_all('/(.*) http\:\/\/www\.facebook\.com\/(.*)/', $node[0][0], $data);

	for($i = 0; $i < count($data[0]); ++$i){
		$info[$i]['name'] 		= $data[1][$i];
		$info[$i]['facebook'] 	= $data[2][$i];
	}

	return $info;
}
?>