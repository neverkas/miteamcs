<?php
function editpage($fanpage, $account_id){	
#	echo "$profile_id, $profile_email<hr />";
	try{
		$db 	= new PDO('mysql:dbname=emmade6_miteamcs; host=localhost;', 'emmade6_5y5g4m3s', '@)!%g!CX6IZOm-%');				
		$query 	= $db->query("select name from fanpages where name='$fanpage'");
		$result = $query->fetch(PDO::FETCH_ASSOC);

		if($result == false){ # sino existe entonces que lo cambie
			# que cambie solo si la cuenta logeada le pertenece
			#echo "update fanpages set name='$fanpage' where account_id='$account_id'";
			$update = $db->prepare("update fanpages set name='$fanpage' where account_id='$account_id'");
			$update->execute();
			return true;
		}
	}catch(PDOException $e){
#		echo $e->getMessage();
	}

	return false;
}
?>