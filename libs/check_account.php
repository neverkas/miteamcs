<?php
function check_account($page_name, $profile_id, $profile_email){
	try{
		$db 	= new PDO('mysql:dbname=emmade6_miteamcs; host=localhost;', 'emmade6_5y5g4m3s', '@)!%g!CX6IZOm-%');				
		$query 	= $db->query("select account_id from accounts where account_id=$profile_id AND email='$profile_email' AND page='$page_name'");
		$result = $query->fetch(PDO::FETCH_ASSOC);
		
		if($result == true){
			return true;			
		}
	}catch(PDOException $e){
#		echo $e->getMessage();
	}

	return false;
}
?>
