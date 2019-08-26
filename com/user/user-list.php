<?php
require ( '../../inc/config.php' );
require ( 'config.php' );
require ( 'main.php' );
require ( '../../'.PATH_LIBRARIES.'libraries.php' );
require ( '../../'.PATH_INCLUDES.'json-headers.php' );
	for($ctr=1; $ctr<=41; $ctr++){
    	$sql_permission = mysql_query("SELECT * FROM tbl_permission WHERE module_id='".$ctr."' AND user_role_id='".$_SESSION[WEBSITE_ALIAS]['user_role_id']."' ");
		$row_permission = mysql_fetch_array($sql_permission);
		$module_id[$ctr] =  $row_permission['view'] > 0 ? '1' : '0';
		$add[$ctr] =  $row_permission['add'] > 0 ? '1' : '0';
		$edit[$ctr] =  $row_permission['edit'] > 0 ? '1' : '0';
		$delete[$ctr] =  $row_permission['delete'] > 0 ? '1' : '0';
		$export[$ctr] =  $row_permission['export'] > 0 ? '1' : '0';
		$print[$ctr] =  $row_permission['print'] > 0 ? '1' : '0';
	}


$table_name = $fg_flexiconfig['table_name'];
$page = $_REQUEST['page'];
$rp = $_REQUEST['rp'];
$sortname = $_REQUEST['sortname'];
$sortorder = $_REQUEST['sortorder'];

if (!$sortname) $sortname = $fg_flexiconfig['sortname'];
if (!$sortorder) $sortorder = $fg_flexiconfig['sortorder'];

$sort = "ORDER BY $sortname $sortorder";
if (!$page) $page = 1;
if (!$rp) $rp = 10;
$start = (($page-1) * $rp);
$limit = "LIMIT $start, $rp";
$where = " WHERE ".$fg_flexiconfig['record_uid']." > 0 ";

// FORM BOX VARIABLES
$quick_access 	= $_REQUEST['quick_access'];
$search_keyword = $_REQUEST['search_keyword'];
$searchkey = $_REQUEST['filter_by'];
$searchf = $_REQUEST['search_field'];

if($quick_access != ""){
	if ($quick_access != "number"){
		$where .= " AND ($sortname LIKE '$quick_access%')";
	}elseif($quick_access=='ALL'){	
		$where = "";
	}else{	
		$where .= " AND ($sortname LIKE '0%' or $sortname LIKE '1%' or $sortname LIKE '2%' or $sortname LIKE '3%' or $sortname LIKE '4%' or $sortname LIKE '5%' or $sortname LIKE '6%' or $sortname LIKE '7%' or $sortname LIKE '8%' or $sortname LIKE '9%')";	
	}
}




if($searchf !="")
{
	
		if($searchkey=='email'){
			$where .= " AND email_address  like '%$searchf%' ";
		}elseif($searchkey=='role')
		{
			
		$record = $sql_helper->cget_row("tbl_user_role", "user_role_title LIKE '%".$searchf."%'");
		$role_id= $record->user_role_id;
		$where .= " AND user_role_id = $role_id ";
		}
		elseif($searchkey=='activated')
		{
			
			$where .= " AND activated  like '%$searchf%' ";
		}
		
}







$sql = "SELECT * FROM $table_name $where $sort $limit";

$result = mysql_query($sql);
$total = $sql_helper->get_var("SELECT count(*) FROM $table_name $where $sort") ;
$total = $total ? $total : 0;



$json = "";
$json .= "{\n";
$json .= "page: $page,\n";
$json .= "total: $total,\n";
$json .= "rows: [";

$operation_url = INDEX_PAGE.$page_name.'-m&mode=';
$rc = false;	
$item_ctr = 0;
while ($row = mysql_fetch_array($result))
{
	$item_ctr++;
	$record_id 	= $row[$fg_flexiconfig['record_uid']];
	$activated 	= $row['activated'] > 0 ? '<img src="img/check.png" alt="Active" title="Active">' : '<img src="img/x.png" alt="In-active" title="In-active">';
	
	$action	= '';
	$action .= '<a class="action-icon" href="'.$operation_url.'view&id='.$record_id.'">'.ICON_VIEW.'</a>';
	if($edit[28] > 0){
	$action .= '<a class="action-icon" href="'.$operation_url.'edit&id='.$record_id.'">'.ICON_EDIT.'</a>';
	}
	if($delete[28] > 0){
	$action .= '<a class="action-icon" href="'.$operation_url.'delete&id='.$record_id.'">'.ICON_DELETE.'</a>';
	} 
	
	$checkbox = '<input type="checkbox" class="cr_checkbox checkbox" id="checkbox_'.$record_id.'" onClick="checkrow('.$record_id.')"/> ';
	
	$date_updated = $helper->readable_datetime($row['date_updated']);
	$date_created = $helper->readable_datetime($row['date_created']);
	
	$record 		= $sql_helper->cget_row(DB_TABLE_PREFIX."user_role", "user_role_id = '".$row['user_role_id']."'") ;
	$user_role_name	= $record->user_role_title;
	
	$fullname = $row['firstname'].' '.$row['lastname'];
	
	if ($rc) $json .= ",";
	$json .= "\n{";
	$json .= "id:'".$record_id."',";
	$json .= "cell:['".$item_ctr."'";
	$json .= ",'".$checkbox."'";
	$json .= ",'".$action."'";
	$json .= ",'".$string->grid_safe($row['email_address'])."'";
	$json .= ",'".$string->grid_safe($fullname)."'";
	$json .= ",'".$user_role_name."'";
	$json .= ",'".$activated."'";
	$json .= ",'".$string->grid_safe($date_updated)."']";
	$json .= "}";
	$rc = true;		
}
$json .= "]\n";
$json .= "}";
echo $json;
?>