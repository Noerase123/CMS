<?php
require ( '../../inc/config.php' );
require ( '../../'.PATH_LIBRARIES.'libraries.php' );

// GET URL OR POST VARIABLES
$status			= $_REQUEST['status'];
$table_name 	= $_REQUEST['table_name'];
$field_name 	= $_REQUEST['field_name'];

$record_id		= $_REQUEST['record_id'];
// ACTION CHECKER
$enabled = $status;

$data				=	array();
$table_name == 'tbl_listing' ? $data["enabled"]	= $enabled : $data["activated"] = $enabled;
$data["date_updated"]	=	'now';

$is_updated = $sql_helper->update_all($table_name ,$field_name ,$record_id ,$data);

echo $is_updated;

if($is_updated > 0){
	switch($table_name){
		
		case "tbl_corporate":
			
			$data	=	$db->get_row("SELECT * FROM tbl_corporate WHERE corporate_id = '".$record_id."'");
			$to	=	$data->email_address;
			
			$firstname	=	$data->contact1_firstname;
			$lastname	=	$data->contact1_lastname;
			
			$subject = BRAND_NAME.": Account Registration";
			$body = "<div style='font-family:tahoma;font-size:13px;size:13px;'>
			
			<img src=\"".WEBSITE_FE_URL."img/hotel-logo.png\" /><br /><br />
			
			Hello ".$firstname." ".$lastname.",<br /><br />
			
			Your corporate account registration has already been approved by ".BRAND_NAME.".<br/>
			Visit ".BRAND_NAME." website link: ".WEBSITE_FE_URL." and try your corporate account log-in.
			
			
			<br /><br />Thank you.
			<br /><br />
			".COMPANY_NAME."
			</div>";
				
			$from = CONTACT_EMAIL_FROM;
					
			$headers  = "MIME-Version: 1.0\r\n";
			$headers .= "Content-type: text/html; charset=iso-8859-1\r\n";
			$headers .= "From: $from\r\n";

			$result = mail($to,$subject,$body,$headers);
			
			
			
			
			
			
		break;

	}
}

?>