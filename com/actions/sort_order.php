<?php
require ( '../../inc/config.php' );
require ( '../../'.PATH_LIBRARIES.'libraries.php' );
// GET URL OR POST VARIABLES
$id 			= $_REQUEST['id'];
$table_name 	= $_REQUEST['table'];
$direction 		= $_REQUEST['direction'];
$column			= $_REQUEST['column'];
$exact_order	= $_REQUEST['exact_order'] > 0 ? $_REQUEST['exact_order'] : 0;
$extra_query	= str_replace("'","",$_REQUEST['extra_query']);
$extra_query	= strlen($extra_query) > 2 ? "AND $extra_query" : "";
echo $extra_query;
$current_order	= 0;
$new_order		= 0;
$set			= 0;

//echo $extra_query;
//exit();

// MAX VALUE
$max_sql_sort_order = mysql_query("SELECT * FROM ".$table_name);
$max_row_sort_order = mysql_fetch_array($max_sql_sort_order);
$max_sort_order		= mysql_num_rows($max_sql_sort_order);
// MIN VALUE
$min_sql_sort_order = mysql_query("SELECT min(sort_order) FROM ".$table_name);
$min_row_sort_order = mysql_fetch_array($min_sql_sort_order);
$min_sort_order		= 1;

// RETRIEVE DATA
$record 		= $sql_helper->cget_row($table_name, "$column = '$id'");
$current_order 	= $record->sort_order;

// DIRECTION CHECKER
if($direction == 'MOVE DOWN'){
	$ctr = $current_order + 1;
	while($set!=1){
		$sql_check = mysql_query("SELECT * FROM ".$table_name." WHERE sort_order='".$ctr."' AND ".$column." != '".$id."' $extra_query");
		if( mysql_num_rows($sql_check) > 0){
			$new_order = $ctr;
			$set	   = 1;
		}
		
		if($ctr > $max_sort_order){
			$new_order = $ctr;
			$set	   = 1;
			break;
		}
		$ctr++;
	}
	
}elseif($direction == 'MOVE UP'){
	$ctr = $current_order - 1;
	while($set!=1){
	//echo "SELECT * FROM ".$table_name." WHERE sort_order='".$ctr."' AND ".$column." != '".$id."' $extra_query";
		$sql_check = mysql_query("SELECT * FROM ".$table_name." WHERE sort_order='".$ctr."' AND ".$column." != '".$id."' $extra_query");
		if( mysql_num_rows($sql_check) > 0){
			$new_order = $ctr;
			$set	   = 1;
		}
		
		if($ctr < $min_sort_order){
			$new_order = $ctr;
			$set	   = 1;
			break;
		}
		$ctr--;
	}
}else{
	$new_order = $exact_order;
}
// CHECK FOR EXISTING SORT ORDER
if($new_order >= 1){
	
	
	if($direction == 'MOVE UP' or $direction == 'MOVE DOWN'){
	echo $min_sort_order;
		if($new_order >= $min_sort_order and $new_order <= $max_sort_order){
		
			mysql_query("UPDATE ".$table_name." SET sort_order = '".$new_order."' WHERE ".$column." = '".$id."'") or exit(mysql_error());
			
			if($set>0){
				$row_check = mysql_fetch_array($sql_check);
				mysql_query("UPDATE ".$table_name." SET sort_order = '".$current_order."'  WHERE ".$column."='".$row_check[$column]."'") or exit(mysql_error());
			}
		}
	}else{
		$sql_check = mysql_query("SELECT * FROM ".$table_name." WHERE sort_order='".$new_order."' AND ".$column." != '".$id."' $extra_query");
		$row_check = mysql_fetch_array($sql_check);
		
		if($new_order >= $min_sort_order and $new_order <= $max_sort_order){
			if( mysql_num_rows($sql_check) > 0 ){
				mysql_query("UPDATE ".$table_name." SET sort_order = '".$current_order."'  WHERE ".$column."='".$row_check[$column]."'");
				mysql_query("UPDATE ".$table_name." SET sort_order = '".$new_order."' WHERE ".$column." = '".$id."'");
			}else{
				mysql_query("UPDATE ".$table_name." SET sort_order = '".$new_order."' WHERE ".$column." = '".$id."'");
			}
		}
	}
	
	
}

?>