<?php		
$mod_id 		= $_REQUEST['mod_id'];

switch ($table_name){	
	case $fg_flexiconfig['table_name']:	
		$sql = mysql_query("SELECT * FROM ".$table_name." WHERE ".$field_name."='".$record_id."'");
		$row = mysql_fetch_array($sql);
		$count_deleted = $sql_helper->delete($table_name ,$field_name ,$record_id);
		if ( $count_deleted > 0 ) {
			$total_deleted++; 
			
			$logs['log_date'] 		 = date('Y-m-d');
			$logs['log_time'] 		 = date('H:i:s');
			$logs['user'] 	  		 = $_SESSION[WEBSITE_ALIAS]['email_address'];
			$logs['log_module']		 = $mod_id;
			$logs['log_description'] = "DELETE Record (".str_replace("'","&#39;",$row['sm_name']).")";
			$logs['ip_address'] 	 = $_SERVER['REMOTE_ADDR'];		
			
			$id = $sql_helper->insert_all('tbl_activity_log',$logs);
			
		}
		
	break;
}
?>