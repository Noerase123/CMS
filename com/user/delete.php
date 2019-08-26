<?php		
switch ($table_name){	
	case "tbl_user":	
		$sql = mysql_query("SELECT * FROM ".$table_name." WHERE ".$field_name."='".$record_id."'");
		$row = mysql_fetch_array($sql);
		$count_deleted = $sql_helper->delete($table_name ,$field_name ,$record_id);
		if ( $count_deleted > 0 ) {
			$total_deleted++; 
		}	
	break;	

	case $fg_user_role['table_name']:	
		$sql = mysql_query("SELECT * FROM ".$table_name." WHERE ".$field_name."='".$record_id."'");
		$row = mysql_fetch_array($sql);
		$count_deleted = $sql_helper->delete($table_name ,$field_name ,$record_id);
		if ( $count_deleted > 0 ) {
			$total_deleted++; 
		}	
	break;	
}
?>