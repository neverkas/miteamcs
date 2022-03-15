<?php
function add_account($page_name, $profile_id, $profile_email){	
#	echo "$profile_id, $profile_email<hr />";
	try{
		$user_key 	= generate_activation();
		$db 		= new PDO('mysql:dbname=emmade6_miteamcs; host=localhost;', 'emmade6_5y5g4m3s', '@)!%g!CX6IZOm-%');				
		$query 		= $db->query("select account_id from accounts where account_id='$profile_id' AND email='$profile_email'");
		$result 	= $query->fetch(PDO::FETCH_ASSOC);

		if($result == false){
			$insert = $db->prepare("insert into accounts (account_id, email, page, userkey) values ('$profile_id', '$profile_email', '$page_name', '$user_key')");
			$insert->execute();
		}
	}catch(PDOException $e){
#		echo $e->getMessage();
	}
}
?>
