<?php
ob_start();
require_once ( 'inc/config.php' );
require_once ( PATH_LIBRARIES.'libraries.php' );
// TIMEZONE SETTING
/*
$record_timezone = $sql_helper->get_row("SELECT * FROM ".DB_TABLE_PREFIX."timedatesetup AS td INNER JOIN ".DB_TABLE_PREFIX."timezone AS tz ON td.timezone_id = tz.timezone_id WHERE timedatesetup_id='1'");
$_SESSION[WEBSITE_ALIAS]['timezone'] 	= $record_timezone->timezone;
$_SESSION[WEBSITE_ALIAS]['dateformat'] 	= $record_timezone->dateformat;
$_SESSION[WEBSITE_ALIAS]['timeformat'] 	= $record_timezone->timeformat;
*/
$timezone = "Asia/Manila";
date_default_timezone_set($timezone);
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<link rel="icon" href="<?php echo IMG; ?>favicon.ico" type="image/x-icon" />
	<link href="<?php echo IMG; ?>favicon.ico" rel="shortcut icon" type="image/x-icon" />
	<title><?php echo BRAND_NAME; ?></title>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="Robots" content="NOINDEX,NOFOLLOW,NOARCHIVE">
	<link href="<?php echo CSS; ?>bootstrap.min.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>font-awesome.min.css" rel="stylesheet" type="text/css">
	<link href="<?php echo CSS; ?>metisMenu.min.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>timeline.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>morris.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>dataTables.bootstrap.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>menu.css" rel="stylesheet" type="text/css">

	<!-- Custom CSS -->
	<link href="<?php echo CSS; ?>styles.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>sb-admin-2.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>modstrap.css" rel="stylesheet">
	<link href="<?php echo CSS; ?>flat-ui.css" rel="stylesheet">
	<style>
	.colorpicker{
		position: relative !important;
		top: -100% !important;
		left: 85% !important;
	}
	</style>
</head>
<body>
<?php
$passwordcrypt 	= new hash_encryption('1DSGMGU2iTaf');
$dbpassword = $passwordcrypt->decrypt('DyXe57nuelcG3PF8E5iUz5qUdMiXJPn5zR5s+Wr0');
//echo $dbpassword;

$page_option = trim($_GET['option']);
$page_option = isset($_REQUEST['option']) ? strtolower(trim($_REQUEST['option'])) : "home";

if(!isset($_SESSION[WEBSITE_ALIAS])){
	if($page_option == "login"){
	
		include PATH_COMPONENTS."login/login.php";
		
	}elseif($page_option == "forgotpassword"){
	
		include PATH_COMPONENTS."login/forgotpassword.php";
		
	}elseif($page_option == "passwordsent"){
	
		include PATH_COMPONENTS."login/passwordsent.php";
		
	}else{
	
		include PATH_COMPONENTS."login/login.php";
		
	}
}else{
	
	include PATH_COMPONENTS."main.php";
	
}
?>
</body>
</html>
<?php
ob_end_flush();
?>