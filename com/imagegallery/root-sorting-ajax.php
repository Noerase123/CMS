<?php 

require ( '../../inc/config.php' );
require ( '../../'.PATH_LIBRARIES.'libraries.php' );

$tablename 		= $_REQUEST['tablename'];
$id 			= $_REQUEST['id'];
$sort_mode 	= $_REQUEST['sort_mode'];
$id_field 			= $_REQUEST['id_field'];
$order_field 	= $_REQUEST['order_field'];

if($sort_mode=='moveup' or $sort_mode=='movedown'){ //////////// SORT ORDER 

	// GET MAX ROWS
	
	$max_row = $db->get_var("SELECT count(*) FROM ".$tablename."");
	// RETRIEVE DATA
	$record 		= $sql_helper->cget_row($tablename, "".$id_field." = ".$id."");
	$current_order 	= $record->$order_field;
	
	if($sort_mode == 'movedown'){
		$new_order = $current_order + 1;
	}else{
		$new_order = $current_order - 1;
	}
	
	
	// CHECK FOR EXISTING SORT ORDER
	if($new_order >= 1){
		$sql_check = mysql_query("SELECT * FROM ".$tablename." WHERE ".$order_field."='".$new_order."' AND ".$id_field."!='".$id."'");
		$row_check = mysql_fetch_array($sql_check);
		
		if( mysql_num_rows($sql_check) > 0 ){
			mysql_query("UPDATE ".$tablename." SET ".$order_field." = '".$current_order."'  WHERE ".$id_field."='".$row_check[''.$id_field.'']."'");
			mysql_query("UPDATE ".$tablename." SET ".$order_field." = '".$new_order."' WHERE ".$id_field."='".$id."'");
		}else{
			mysql_query("UPDATE ".$tablename." SET ".$order_field." = '".$new_order."' WHERE ".$id_field."='".$id."'");
		}
	}

 }
 
?>