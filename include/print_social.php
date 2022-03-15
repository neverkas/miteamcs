<?php

function print_social($get_data){
	print_x($get_data);
	
	for($i=0; $i < count($get_data[0]); ++$i){
		$social = $get_data[1][$i];

		  echo "$social <br />";
	}
}
?>