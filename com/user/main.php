<?php	
// STANDARD VARS

$page_heading 	= "USER MANAGEMENT";
$page_name  	= "user";
$module 		= "user/";
$page_name2 	= "user-role";

switch ($page_option)
{
	// MAIN PAGES	
	case 'user':
	$mod_id = 22;
		$chain_link .= '<a href="'.INDEX_PAGE.'system-settings">SYSTEM SETTINGS</a><p>&raquo;</p>';
		$chain_link .= '<a href="#" class="active">'.$page_heading.'</a>';
		require(PATH_TEMPLATES.'chain-link.php');
		require(PATH_COMPONENTS.$module.$page_name.'.php');
		$main_checker++;
	break;
	
	case 'user-m':
	$mod_id = 22;
		$chain_link .= '<a href="'.INDEX_PAGE.'system-settings">SYSTEM SETTINGS</a><p>&raquo;</p>';
		$chain_link .= '<a href="'.INDEX_PAGE.$page_name.'">'.$page_heading.'</a><p>&raquo;</p>';
		$chain_link .= '<a href="#" class="active">USER EDITOR </a>';
		require(PATH_TEMPLATES.'chain-link.php');
		require(PATH_COMPONENTS.$module.$page_name.'-maint.php');
		$main_checker++;
	break;
	
	/*case 'user-role':
	$mod_id = 23;
		$chain_link .= '<a href="'.INDEX_PAGE.'system-settings">SYSTEM SETTINGS</a><p>&raquo;</p>';
		$chain_link .= '<a href="#" class="active">'.$page_heading.'</a>';
		require(PATH_TEMPLATES.'chain-link.php');
		require(PATH_COMPONENTS.$module.$page_name2.'.php');
		$main_checker++;
		
	break; 
	
	case 'user-role-m':
	$mod_id = 23;
		$chain_link .= '<a href="'.INDEX_PAGE.'system-settings">SYSTEM SETTINGS</a><p>&raquo;</p>';
		$chain_link .= '<a href="'.INDEX_PAGE.$page_name2.'">'.$page_heading.'</a><p>&raquo;</p>';
		$chain_link .= '<a href="#" class="active">USER ROLE EDITOR </a>';
		require(PATH_TEMPLATES.'chain-link.php');
		require(PATH_COMPONENTS.$module.$page_name2.'-maint.php');
		$main_checker++;
	break;
	*/
}
?>