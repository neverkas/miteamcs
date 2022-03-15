<?php
function get_social($get_data){
	preg_match_all('/Redes Sociales:\n\s*(http\:\/\/www\..*\.com.*\n*)*/', $get_data, $node);
	preg_match_all('/http\:\/\/www\.(facebook|twitter|youtube)\.com\/(.*)/', $node[0][0], $data);
	return $data;
}
?>