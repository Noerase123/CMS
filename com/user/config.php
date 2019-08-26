<?php 
// USER MANAGER (V1.0)
$fg_flexiconfig = array();
$fg_flexiconfig['table_name']	= DB_TABLE_PREFIX."user";
$fg_flexiconfig['record_uid']	= "user_id";
$fg_flexiconfig['sortname'] 	= "email_address";
$fg_flexiconfig['sortorder'] 	= "asc";
$fg_flexiconfig['rp'] 			= "20";
$fg_flexiconfig['rpOptions'] 	= $fgrid_rp_options;
$fg_flexiconfig['width'] 		= "1100";
$fg_flexiconfig['height'] 		= "600";

// USER ROLE MANAGER (V1.0)
$fg_user_role = array();
$fg_user_role['table_name']					= DB_TABLE_PREFIX."user_role";
$fg_user_role['record_uid']					= "user_role_id";
$fg_user_role['sortname'] 					= "user_role_title";
$fg_user_role['sortorder'] 					= "asc";
$fg_user_role['rp'] 						= "20";
$fg_user_role['rpOptions'] 					= $fgrid_rp_options;
$fg_user_role['width'] 						= "1100";
$fg_user_role['height'] 					= "450";

?>