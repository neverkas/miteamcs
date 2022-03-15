<?php
function checkPage($fanpage){
#	echo "$profile_id, $profile_email<hr />";
	try{
		$db 	= new PDO('mysql:dbname=emmade6_miteamcs; host=localhost;', 'emmade6_5y5g4m3s', '@)!%g!CX6IZOm-%');				
		$query 	= $db->query("select account_id from accounts where page='$fanpage'");
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