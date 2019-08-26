<?php
	unset($_SESSION[WEBSITE_NAME]);
	session_destroy();
	header("Location: ".INDEX_PAGE."login");
	
	setcookie("3rd_party_ta_code_ref", "", time() - 3600);
?>