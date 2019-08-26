<?php	
$get_module = $db->get_row("SELECT * FROM tbl_module WHERE slug LIKE \"".$page_option."\" and root=1");
if($get_module){

	$page_heading 	= $get_module->module_name;
	$module_id 		= $get_module->module_id;
	$page_heading_2 = str_replace('MANAGER','',$get_module->module_name);
	$category_id	= $get_module->category_id;
	$page_name  	= $get_module->slug;
	$module 		= $get_module->slug."/";

	$get_mo			= $get_module->module_order;
	$explode_mo		= explode(".",$get_mo);
	$countlessone	= count($explode_mo)-1;
	
	if($category_id==0){

		$backmodule = 'home';
		
	}else{

		$new_module = $db->get_row("SELECT * FROM tbl_module WHERE module_id = \"".$category_id."\"");
		$backmodule = $new_module->slug;
		
	}

	for($x=$countlessone;$x>=0;$x--){
	
		if($x==$countlessone){
		
			$breadcrumbs[$x] = $module_id;
			
		}else{
		
			$new_module		= $db->get_row("SELECT * FROM tbl_module WHERE module_id = \"".$category_id_."\"");
			$module_id		= $new_module->module_id;
			$category_id_	= $new_module->category_id;
			$breadcrumbs[$x]= $module_id;
			
		}
		
	}

	$module_id 		= $get_module->module_id;
	$get_permission = $db->get_row("SELECT * FROM tbl_permission WHERE module_id = \"".$module_id."\" AND user_role_id = \"".$_SESSION[WEBSITE_ALIAS]["user"]['user_role_id']."\"");

	$view =  $get_permission->view > 0 ? '1' : '0';
	$edit =  $get_permission->edit > 0 ? '1' : '0';
	$delete =  $get_permission->delete > 0 ? '1' : '0';
	$add =  $get_permission->add > 0 ? '1' : '0';
	$print =  $get_permission->print > 0 ? '1' : '0';
	$export =  $get_permission->export > 0 ? '1' : '0';
	$all_mode = $get_permission->view + $get_permission->edit + $get_permission->delete + $get_permission->add + $get_permission->print + $get_permission->export;
	$all_mode = $all_mode > 0 ? '1' : '0';

	$role = $db->get_var("SELECT activated FROM tbl_user_role WHERE user_role_id='".$_SESSION[WEBSITE_ALIAS]["user"]['user_role_id']."' ");
	
	if(!$role || !$all_mode){
	
		header("Location: ".INDEX_PAGE.urlencode($backmodule));
		
	}

	if(isset($_GET['mode']) || isset($_POST['form_action'])){

		if((!$view && $_GET['mode'] == 'view') || (!$edit && $_GET['mode'] == 'edit') || (!$delete && $_GET['mode'] == 'delete')){
		
			header("Location: ".INDEX_PAGE.urlencode($page_name));
			
		}
		
		if(isset($_POST['form_action'])){
		
			$logs['log_date'] 		 = date('Y-m-d');
			$logs['log_time'] 		 = date('H:i:s');
			$logs['user'] 	  		 = $_SESSION[WEBSITE_ALIAS]['email_address'];
			$logs['log_module']		 = $module_id;
			$logs['log_description'] = $_POST['form_action']. " Record (".str_replace("'","&#39;",$_POST['sm_name']).")";
			$logs['ip_address'] 	 = $_SERVER['REMOTE_ADDR'];		
			
			$id = $sql_helper->insert_all('tbl_activity_log',$logs);
			
		}
		
		$chain_link = "";
		$chain_link .= "<li><a href=\"index.php\">Dashboard</a></li>";
		
		/*for($z=0;$z<=$countlessone;$z++){
		
			$get_module_for_breadcrumbs = $db->get_row("SELECT * FROM tbl_module WHERE module_id = '".$breadcrumbs[$z]."'");
			$chain_link .= "<li><a href=\"".INDEX_PAGE.urlencode($get_module_for_breadcrumbs->slug)."\">".$get_module_for_breadcrumbs->module_name."</a></li>";
		}*/
		
		$chain_link .= "<li class=\"active\">".$page_heading." Editor</li>";
		require(PATH_COMPONENTS.$module.'editor.php');
		
		$main_checker++;
		
	}else{
		
		$chain_link = "";
		$chain_link .= "<li><a href=\"index.php\">Dashboard</a></li>";
		
		for($z=0;$z<=$countlessone;$z++){
		
			$get_module_for_breadcrumbs = $db->get_row("select * from tbl_module where module_id = '".$breadcrumbs[$z]."'");
			
			if($z==$countlessone){
			
				$chain_link .= "<li class=\"active\">".$get_module_for_breadcrumbs->module_name." Editor</li>";
				
			}else{
			
				$chain_link .= "<li><a href=\"".INDEX_PAGE.urlencode($get_module_for_breadcrumbs->slug)."\">".$get_module_for_breadcrumbs->module_name."</a></li>";
			
			}
		
		}
		require(PATH_COMPONENTS.$module.'root.php');
		$main_checker++;
		
	}

}


?>