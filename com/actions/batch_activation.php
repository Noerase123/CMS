<?php
require ( '../../inc/config.php' );
require ( '../../'.PATH_LIBRARIES.'libraries.php' );
// GET URL OR POST VARIABLES
$itemlist		= explode(",", $_REQUEST['itemlist']);
$table_name 	= $_REQUEST['table'];
$action 		= $_REQUEST['action'];
$column			= $_REQUEST['column'];

$mod_id 		= $_REQUEST['mod_id'];

// ACTION CHECKER
$enabled = $action == 'ACTIVATE' ? 1:0;


// ACTIVATE LIST OF ID
foreach($itemlist as $record_id){
	
	switch ($table_name){			
	
	default:
	mysql_query("UPDATE ".$table_name." SET enabled = '".$enabled."'  WHERE ".$column."='".$record_id."'");
	}
	
	
		$logs['log_date'] 		 = date('Y-m-d');
		$logs['log_time'] 		 = date('H:i:s');
		$logs['user'] 	  		 = $_SESSION[WEBSITE_ALIAS]['email_address'];
		$logs['log_module']		 = $mod_id;
		$logs['log_description'] = "Enabled Record";
		$logs['ip_address'] 	 = $_SERVER['REMOTE_ADDR'];
		
		
		$id = $sql_helper->insert_all('tbl_activity_log',$logs);
	
}
?>