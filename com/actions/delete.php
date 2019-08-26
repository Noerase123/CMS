<?php
require ( '../../inc/config.php' );
require ( '../../'.PATH_LIBRARIES.'libraries.php' );

$table_name = '';
$field_name = '';
$val = ''; 								// To contain all the selected record IDs to delelete

$table_name = trim($_GET['tn'])!='' ? trim($_GET['tn']) : '';
$table_name = $crypt->decrypt($table_name);
$field_name = trim($_GET['fn'])!='' ? trim($_GET['fn']) : '';
$field_name = $crypt->decrypt($field_name);
$val = trim($_POST['items']);			// $_POST['items'] are being passed as 1,3,4,7,12,15, <-- with extra comma at the end

$page_id=trim($_POST['page_id']);
$record_ids = explode(",", $val);
array_pop($record_ids); 				// Remove the last empty value cause by extra comma at the $_POST['items']
$total_ids = count($record_ids);

$total_deleted = 0;
$count_deleted = 0;
foreach($record_ids as $record_id){

// SYSTEM MODULE INCLUSIONS
	// directory path can be either absolute or relative
	$parent_path = "..";
	// open the specified directory and check if it's opened successfully
	if ($parent = opendir($parent_path)) {
	   // keep reading the directory entries 'til the end
	   while (false !== ($file = readdir($parent))) {
		  // just skip the reference to current and parent directory
		  if ($file != "." && $file != "..") {	if (is_dir("$parent_path/$file")) {	if( file_exists("$parent_path/$file/delete.php") and  file_exists("$parent_path/$file/config.php") ){	include("$parent_path/$file/config.php"); include("$parent_path/$file/delete.php");	}	}	}
	   }
	   // ALWAYS remember to close what you opened
	   closedir($parent);
	}

}
$result = '<span style="color:#f00;">'.$total_deleted.'</span> of '.$total_ids.' record(s) DELETED!';		
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT" ); 
header("Last-Modified: " . gmdate( "D, d M Y H:i:s" ) . "GMT" ); 
header("Cache-Control: no-cache, must-revalidate" ); 
header("Pragma: no-cache" );
header("Content-type: text/x-json");
?>
{ affected_rows: '<?php echo $total_deleted?>', total_records : '<?php echo $total_ids?>' , result: '<?php echo $result?>' }