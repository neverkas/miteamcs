<?php
function generate_activation(){
	$code_key = uniqid('5y5_M1T3AMc5', TRUE);
	$code_key = hash('md5', $code_key);

	#return $this;
	return $code_key;
}
?>