<?php
session_start();
require ( '../../inc/config.php' );
require ( '../user/config.php' );
require ( '../../'.PATH_LIBRARIES.'libraries.php' );
$type		= $_REQUEST['type'];


$result = array();

if( isset($_POST['username']) and isset($_POST['password']) ){

	$username = $string->sql_safe($_REQUEST['username']);
	$password = $string->sql_safe($_REQUEST['password']);
	$row = $db->get_row("SELECT * FROM ".$fg_flexiconfig['table_name']." WHERE BINARY email_address = '$username' AND activated = '1'") ;
	
	//for($x = 1;$x<5000;$x++){
	//	$row = $db->get_row("SELECT * FROM ".$fg_flexiconfig['table_name']." WHERE BINARY email_address = '$username' AND activated = '1'") ;	
	//}
	
	if($row->user_id > 0){
		
		$passwordcrypt 	= new hash_encryption($row->varkey);
		$dbpassword = $passwordcrypt->decrypt($row->password);
		
		
		if($dbpassword==$password){
		
			$_SESSION[WEBSITE_ALIAS]["user"]['user_id']    		= $row->user_id;
			$_SESSION[WEBSITE_ALIAS]["user"]['user_fullname']  	= $row->firstname.' '.$row->lastname;
			$_SESSION[WEBSITE_ALIAS]["user"]['user_role_id'] 	= $row->user_role_id;
			$_SESSION[WEBSITE_ALIAS]["user"]['email_address'] 	= $row->email_address;
			$result["result"] = "success";
			
		}else{
			
			$result["result"] = "error";
			$result["error_message"] = "Invalid user credentials";
		
		}
		
	}else{
		
		$result["result"] = "error";
		$result["error_message"] = "User does not exist";
		
	}
}
	
echo json_encode($result);	
?>