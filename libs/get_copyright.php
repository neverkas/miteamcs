<?php

function get_copyright($get_data){
	preg_match_all('/\n*+Generá tu Sitio Web Gratis para tu Comunidad o Team con MiTeamCs\s*\n+http\:\/\/www\.miteamcs\.com+\n*/', $get_data, $data);
	return $data;	
}
?>