<?php
function print_results($user_name, $get_data){
	$html='<ul id="results-fields">';

	foreach($get_data as $data){
		$date 		= $data['date'];
		$team 		= $data['team'];
		$result_1 	= $data['result'][1];
		$result_2 	= $data['result'][2];

		if($result_1 > $result_2) $result_1 	= "<span class='text-style-green'>$result_1</span>";
		if($result_2 > $result_1) $result_2 	= "<span class='text-style-green'>$result_2</span>";

		if($result_1 > $result_2) $user_name 	= "<b>$user_name</b>";
		if($result_2 > $result_1) $team 		= "<b>$team</b>";

		$html.="
		<li class='results-item'>
			<span class='results-date text-size-small text-color-white'>{$date}</span>
			<span class='text-size-small text-color-white'>Team Ske vs {$team}</span>
		</li>		
		";
	}

	$html.='</ul>';

	return $html;
}
?>