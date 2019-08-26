<?php
require ( '../../inc/config.php' );
require ( '../../'.PATH_LIBRARIES.'libraries.php' );
// GET URL OR POST VARIABLES
$itemlist		= explode(",", $_REQUEST['itemlist']);

$allocationlist		= explode(",", $_REQUEST['allocationlist']);
$blockedlist		= explode(",", $_REQUEST['blockedlist']);
$dailyratelist		= explode(",", $_REQUEST['dailyratelist']);

$table_name 	= $_REQUEST['table'];
$action 		= $_REQUEST['action'];
$column			= $_REQUEST['column'];



// ACTIVATE LIST OF ID
$ctr=0;
foreach($itemlist as $record_id){
	mysql_query("UPDATE ".$table_name." SET room_allocation = '".
	$allocationlist[$ctr]."',room_blocked = '".$blockedlist[$ctr]."',daily_rate = '".
	$dailyratelist[$ctr]."',date_updated=now()  WHERE ".$column."='".$record_id."'");
	$ctr++;
}
?>