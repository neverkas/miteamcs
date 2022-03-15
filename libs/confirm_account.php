<?php
$db 		= new PDO('mysql:dbname=emmade6_miteamcs; host=localhost;', 'emmade6_5y5g4m3s', '@)!%g!CX6IZOm-%');			

$query 		= $db->query('select account_id from accounts where userkey="'.$code.'"');
$user_id 	= $query->fetch(PDO::FETCH_ASSOC);

echo "<pre>";
print_r($user_id);
echo "</pre>";

/*
$user_id = $user_id[0]['user_id'];
dbQuery('update clients set activate=1 where activate=0 and id='.$user_id);
dbQuery('delete from code_activation where code="'.$code.'"');
$msg = 'Has activado tu cuenta..!';
*/
?>