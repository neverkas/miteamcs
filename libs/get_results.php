<?php
function get_results($get_data){
	preg_match_all('/Resultados:\n\s*(0?[0-9]{1,2}\/0?[0-9]{2}\/[0-9]{4} .* \[0?[0-9]{0,2}\-0?[0-9]{0,2}\]\n*)*/', $get_data, $node);
	preg_match_all('/(0?[0-9]|1[0-9]|2[0-9]|3[0-1])\/(0?[1-9]|1[0-2])\/(2[0-9]{3}) (.*) \[(0?[0-9]{0,2})\-(0?[0-9]{0,2})\]/', $node[0][0], $data);

	for($i = 0; $i < count($data[0]); ++$i){
		$info[$i]['date'] 		= $data[1][$i].'/'.$data[2][$i].'/'.$data[3][$i];
		$info[$i]['team'] 		= $data[4][$i];
		$info[$i]['result'][1] 	= $data[5][$i];
		$info[$i]['result'][2] 	= $data[6][$i];
	}

	return $info;
}
?>