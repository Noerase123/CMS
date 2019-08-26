<?php
ini_set("error_reporting",		"off");
session_start();

define("BRAND_NAME"		,	"Content Management System");
define("WEBSITE_ALIAS"	,	"CMSV2");

define( 'BASE_URL'		,	"http://localhost/cms_alone/" );
// define( 'BASE_URL'		,	"http://hotelmanila.com/cms/" );

define( 'WEBSITE_URL'	,	"" );
define( 'DB_HOST'		,	"localhost" );		
define( 'DB_USER'		,	"root" );		
define( 'DB_PASSWORD'	,	"" );		
define( 'DB_NAME'		,	"cms_alone" );

define( 'GIT_WEBSITE',			'http://www.glocorpwebdesign.com/' );
define( 'WEBSITE_FOOTER',		'&copy; Atlantis - Content Management System, developed by <a href="'.GIT_WEBSITE.'">Glocorp IT Solutions, Inc.</a> All Rights Reserved' );
define( 'INDEX_PAGE',			'index.php?option=');
define( 'DB_TABLE_PREFIX',		'tbl_' );

define( 'PATH_LIBRARIES',	 	'lib/' );
define( 'PATH_INCLUDES',		'inc/'   );
define( 'PATH_COMPONENTS',		'com/' );
define( 'PATH_TEMPLATES',		'temp/' );
define( 'PATH_STANDARDACTIONS',	'com/actions/' );
define( 'PATH_STANDARDGALLERY',	'com/imagegallery/' );
define( 'IMG'			,	BASE_URL."img/" );
define( 'CSS'			,	BASE_URL.'css/' );
define( 'JS'			,	BASE_URL.'js/' );
define( 'PLUGINS'		,	BASE_URL.'plug/' );
define( 'ENCRYPT_KEY'	,	'fg5gjk' );

$page_option = "";

define( 'PWD_MIN_LEN',			6 );
define( 'MAX_LEN16',			16 );
define( 'MAX_LEN20',			20 );
define( 'MAX_LEN25',			25 );
define( 'MAX_LEN30',			30 );
define( 'MAX_LEN',				50 );
define( 'MAX_LEN1',				100 );

define( 'REQ_FIELD',			'<span class="required">*</span>' );
define( 'CONFIRM_DELETE',		'Are you sure you want to DELETE the selected ' );

// STANDARD PLUGINS

define( 'TREEVIEW',			PLUGINS.'jquery/treeview/' );
define( 'VALIDATORS',		PLUGINS.'jquery/validate/' );
define( 'FANCYBOX',			PLUGINS.'jquery/fancybox/' );
define( 'DATEPICKER',		PLUGINS.'jquery/datepicker/' );
define( 'SUPERFISH',		PLUGINS.'jquery/superfish/' );
define( 'CALENDAR',			PLUGINS.'jquery/calendar/' );
define( 'PATH_FLEXIGRID', 	PLUGINS.'jquery/flexigrid/' );
define( 'CKEDITORSOURCE', 	PLUGINS.'ckeditor/' );
define( 'TIMEPICKER',	 	PLUGINS.'jquery/timepicker/' );

// STANDARD ACTIONS

// ADDITIONAL PLUGINS

// FILE UPLOADS CONFIGURATIONS
define( 'CKIMGURL',			'/instantonlinebooking.com/uploads/ckeditor/' );

// REGISTRATION STATUS
$status_values 	= array('For Verification','Suspended','Inactive','Active'); 
$status_options	= array('For Verification','Suspended','Inactive','Active');

// Messages
//
$messages = array();
$messages['fg']['sel_rec_delete'] 	= "Please select record(s) to DELETE!";
$messages['fg']['sel_rec_edit'] 	= "Please select a record to EDIT!";
$messages['fg']['sel_rec_view'] 	= "Please select a record to VIEW!";
$messages['fg']['sel_rec_print'] 	= "Please select record(s) to PRINT!";
$messages['fg']['sel_rec_export'] 	= "Please select record(s) to EXPORT!";

$messages['validate']['required'] 			= "Required Field";
$messages['validate']['pwd_mismatch'] 		= "Password mismatch";
$messages['validate']['mail_mismatch'] 		= "Email mismatch";
$messages['validate']['min_len'] 			= "Required minimun length: ";
$messages['validate']['max_len'] 			= "Required maximum number: ";
$messages['validate']['min_input'] 			= "Required minimun input: ";
$messages['validate']['max_input'] 			= "Required maximum input: ";
$messages['validate']['unavailable'] 		= " is already in use";
$messages['validate']['accept_jpg'] 		= "Must be in JPG format";
$messages['validate']['accept_video'] 		= "Must be in FLV format";
$messages['validate']['accept_img'] 		= "Must be in '.png' | '.jpeg' | '.jpg' ";
$messages['validate']['number'] 			= "Must be numeric";
$messages['validate']['amount'] 			= "Invalid Amount";
$messages['validate']['url_format'] 		= "Invalid URL";
$messages['validate']['email_format'] 		= "Invalid Email Address";
$messages['validate']['lessthanequalto'] 	= "Input must be less than or equal to ";
$messages['validate']['greaterthanequalto'] = "Input must be greater than or equal to ";
$messages['system']['exists'] = " already exists!&nbsp;&nbsp;Please choose another.";



// 
// Grid Settings
//
define( 'GRID_1COL',				'20' );
define( 'GRID_2COL',				'40' );
define( 'GRID_3COL',				'60' );
define( 'GRID_4COL',				'80' );
define( 'GRID_5COL',				'100' );

define( 'ICON_HOME' ,				'<img class="left" style="margin:4px 3px 0px 0px;" src="'.IMG.'icon-home.png" alt="Home" title="Home" border="0" />' );
define( 'ICON_VIEW' ,				'<i class="fa fa-search fa-fw" title="view"></i>' );
define( 'ICON_ADD' ,				'<i class="fa fa-plus fa-fw" title="add"></i>' );
define( 'ICON_GALLERY' ,			'<img class="ico-action" src="'.IMG.'icon-gallery.png" alt="Gallery" title="Gallery" border="0" />' );
define( 'ICON_EDIT' ,				'<i class="fa fa-edit fa-fw" title="update"></i>' );
define( 'ICON_DELETE' ,				'<i class="fa fa-eraser fa-fw" title="delete"></i>' );
define( 'ICON_IMAGE' ,				'<img class="ico-action" src="'.IMG.'image.png" alt="Image" title="Image" border="0" />' );
define( 'ICON_ECANCEL' ,			'<img class="ico-action" src="'.IMG.'icon-ecancel.png" alt="Early Cancel" title="Early Cancel" border="0" />' );
define( 'ICON_LCANCEL' ,			'<img class="ico-action" src="'.IMG.'icon-lcancel.png" alt="Late Cancel" title="Late Cancel" border="0" />' );
define( 'ICON_PLUS' ,				'<img class="ico-action" src="'.IMG.'icon-plus.png" alt="Plus" title="Plus" border="0" />' );
define( 'ICON_MINUS' ,				'<img class="ico-action" src="'.IMG.'icon-minus.png" alt="Minus" title="Minus" border="0" />' );
define( 'ICON_MOVEUP' ,				'<img class="ico-action" src="'.IMG.'moveup.png" alt="Move Up" title="Move Up" border="0" />' );
define( 'ICON_MOVEDOWN' ,			'<img class="ico-action" src="'.IMG.'movedown.png" alt="Move Down" title="Move Down" border="0" />' );

$fgrid_rp_options 					= "[5,10,20,40,50,100,150,200]";	//updated 8-12-11

$fg_flexiconfig = array();
$fg_flexiconfig['table_name']	= DB_TABLE_PREFIX."user";
$fg_flexiconfig['record_uid']	= "user_id";
$fg_flexiconfig['sortname'] 	= "email_address";
$fg_flexiconfig['sortorder'] 	= "asc";
$fg_flexiconfig['rp'] 			= "20";
$fg_flexiconfig['rpOptions'] 	= $fgrid_rp_options;
$fg_flexiconfig['width'] 		= "1100";
$fg_flexiconfig['height'] 		= "600";


// FILE UPLOADS CONFIGURATIONS
?>