<?php
function get_servidores($get_data){
# En realidad funciona hacerlo con esos 2 preg, aunque estaría bueno que capturara con 1 solo
#	preg_match_all('/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\:\d{5})+(.*)/', $get_data, $data);
	preg_match_all('/Servidores:\n\s*(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\:\d{5} .*\n*)*/', $get_data, $node);
	preg_match_all('/(\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\:\d{5}) (.*)/', $node[0][0], $data);

	for($i = 0; $i < count($data[0]); ++$i){
		$info[$i]['address'] 	= $data[1][$i];
		$info[$i]['name'] 		= $data[2][$i];
	}

	return $info;
}
?>