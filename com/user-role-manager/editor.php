<?php 
error_reporting(1);
require ( 'config.php' );
require ( 'data.php' );

/** DEVELOPER'S NOTES 
	REQUIREMENTS FOR THIS MODULE TO WORK:
	1. TABLE WITH SAME NAME
	2. DATA INSIDE THE TABLE BECAUSE THIS MODULE WORKS ON UPDATE, NOT DELETE
	3. CORRECT FILE PATH -> $upload_dir
**/

$primary_id = $record_uid;
$mode = isset($_REQUEST['mode']) ? strtolower(trim($_REQUEST['mode'])) : "";
$reference_id =isset($_REQUEST['id']) ? $_REQUEST['id'] : 0;


$sub_heading = ucfirst($mode);

//set all image height
foreach($editor_fields as $editor_fields_val){

	if($editor_fields_val['type']=='image'){
		$required_width[$editor_fields_val['field']] =	$editor_fields_val['size']['width'];
		$required_height[$editor_fields_val['field']] = $editor_fields_val['size']['height'];
		$required_width_thumb[$editor_fields_val['field']] =	$editor_fields_val['thumbsize']['width'];
		$required_height_thumb[$editor_fields_val['field']] = $editor_fields_val['thumbsize']['height'];
	}
	
}	

$button = $helper->button_val($mode, "");

$is_editable_field = $helper->is_editable($mode);

$req_fld = $is_editable_field==true ? REQ_FIELD : "";

$tbl_image_gallery = $fg_flexiconfig['table_gallery_name'];

$form_action = strtoupper($_POST['form_action']);
if($form_action != ''){

	$post_data = array();
	$post_ = array();
	
	foreach($_POST as $varname => $value){
		
		if($varname=='description'){
			$post_data[$varname] = $value;
		}else{
			$$varname = str_replace("'","&#39;",$value);
			$$varname = str_replace('"',"&quot;",$$varname);
			$post_data[$varname] = $$varname;
		}
		
	}
	
	unset($post_data['form_action']);
	unset($post_data['mode']);
	unset($post_data['Submit']);
	unset($post_data['_id']);
	
	foreach($editor_fields as $editor_fields_val){
		if($editor_fields_val['type']=='image'){
			$saveimage = $image->save_image($_FILES[$editor_fields_val['field']],$required_width[$editor_fields_val['field']],$required_height[$editor_fields_val['field']],$required_width_thumb[$editor_fields_val['field']],$required_height_thumb[$editor_fields_val['field']],$upload_dir);
			if($saveimage!=''){
				$post_data[$editor_fields_val['field']] = $saveimage;
			}	
		}elseif($editor_fields_val['type']=='files'){
			$new_file = $_FILES['image_menu'];
			$filename = $new_file['name'];
			$filename = str_replace(' ', '_', $filename);
			$ext = strtolower(strrchr($filename,'.'));	
			$findduplicate = $db->get_var("SELECT count(".$primary_id.") FROM ".$table_name." WHERE ".$editor_fields_val['field']." = \"".$filename."\"");
			$filename = $findduplicate > 0 ? str_insert($filename,$ext,"_new") : $filename;
			if($filename != ""){
				$file_tmp = $new_file['tmp_name'];
				move_uploaded_file($file_tmp,$upload_dir.$new_filename);
				$post_data[$editor_fields_val['field']] = $filename;
			}			
		}
	}

}

$add_permission		= $_POST["add"];
$edit_permission	= $_POST["edit"];
$delete_permission	= $_POST["delete"];
$view_permission	= $_POST["view"];
$print_permission	= $_POST["print"];
$export_permission	= $_POST["export"];

switch($form_action){
	case 'ADD':
		
		$post_data['date_created'] = 'now';
		$post_data['date_updated'] = 'now';
		
		$user_post_data = array();
		
		$user_post_data['user_role_title'] = $post_data['user_role_title'];
		$user_post_data['user_role_description'] = $post_data['user_role_description'];
		$user_post_data['date_created'] = $post_data['date_created'];
		$user_post_data['date_updated'] = $post_data['date_updated'];
		$user_post_data['activated'] = $post_data['activated'];
		
		$user_role_id = $sql_helper->insert_all($table_name,$user_post_data);
		
		
		
		$sql_module = $db->get_results("SELECT * FROM tbl_module ORDER BY module_name ASC");
		foreach($sql_module as $sql_module_val){
			
			
			
			$module_id = $sql_module_val->module_id;
			
			unset($permission_data);
			$permission_data = array();
			$permission_data["module_id"]		= $module_id;
			$permission_data["user_role_id"]	= $user_role_id;
			
			$permission_data["add"]		= isset($add_permission[$module_id]) ? "1" : "0";
			$permission_data["edit"]	= isset($edit_permission[$module_id]) ? "1" : "0";
			$permission_data["delete"]	= isset($delete_permission[$module_id]) ? "1" : "0";
			$permission_data["view"]	= isset($view_permission[$module_id]) ? "1" : "0";
			$permission_data["print"]	= isset($print_permission[$module_id]) ? "1" : "0";
			$permission_data["export"]	= isset($export_permission[$module_id]) ? "1" : "0";
			
			$result = $sql_helper->insert_all("tbl_permission",$permission_data);
			
			
		}
		
		//Activity Log
		$post_activity_data = array();
		
		$post_activity_data['module_id'] = $get_module_for_breadcrumbs->module_id;
		$post_activity_data['user_id'] = $_SESSION[WEBSITE_ALIAS]["user"]['user_id'];
		$post_activity_data['action_made'] = "ADD";
		$post_activity_data['description'] = "<strong>".$post_data['user_role_title']."</strong>";		
		$post_activity_data['date_updated'] = $post_data['date_updated'];
		$post_activity_data['ip_address'] = $_SERVER['REMOTE_ADDR'];			

		$result = $sql_helper->insert_all('tbl_activity_log',$post_activity_data);
		header("Location: ".INDEX_PAGE.urlencode($page_name)."&a=add&success=".$result);
		
	break;
	case 'EDIT':
		
		$post_activity_data = array(); //Activity Log
		
		$user_post_data = array();
		$user_post_data['user_role_title'] = $post_data['user_role_title'];
		$user_post_data['user_role_description'] = $post_data['user_role_description'];
		$user_post_data['activated'] = $post_data['activated'];
		$user_post_data['date_updated'] = 'now';		

		
		//ACTIVITY LOG
		$sql_user_role_val = $db->get_row("SELECT * FROM tbl_user_role WHERE user_role_id ='".$reference_id."'");
	
		$post_activity_data['description'] .= $sql_helper->activity_log($sql_user_role_val,$post_data,$form_action);	
		
		$post_data['date_updated'] = 'now';	

		$is_updated = $sql_helper->update_all($table_name,$primary_id ,$reference_id,$user_post_data);
		
		///////////////////////////////////////////////////////////////////

		$updated = 0;
		
		$sql_module = $db->get_results("SELECT * FROM tbl_module AS tm ORDER BY tm.module_name ASC");
		
		foreach($sql_module as $sql_module_val){
		
			$sql_permission = $db->get_row("SELECT * FROM tbl_permission WHERE module_id='".$sql_module_val->module_id."' AND user_role_id='".$reference_id."' ");

			if($sql_permission){
			
				$module_id		= $sql_module_val->module_id;
				$permission_id	= $sql_permission->permission_id;
				
				unset($permission_data);
				$permission_data = array();
				$permission_data["add"]		= isset($add_permission[$module_id]) ? "1" : "0";
				$permission_data["edit"]	= isset($edit_permission[$module_id]) ? "1" : "0";
				$permission_data["delete"]	= isset($delete_permission[$module_id]) ? "1" : "0";
				$permission_data["view"]	= isset($view_permission[$module_id]) ? "1" : "0";
				$permission_data["print"]	= isset($print_permission[$module_id]) ? "1" : "0";
				$permission_data["export"]	= isset($export_permission[$module_id]) ? "1" : "0";

						
				$updated += $sql_helper->update_all("tbl_permission" ,"permission_id" ,$permission_id,$permission_data);
			}else{
				
				unset($permission_data);
				$permission_data = array();
				
				$permission_data["add"]		= isset($add_permission[$module_id]) ? "1" : "0";
				$permission_data["edit"]	= isset($edit_permission[$module_id]) ? "1" : "0";
				$permission_data["delete"]	= isset($delete_permission[$module_id]) ? "1" : "0";
				$permission_data["view"]	= isset($view_permission[$module_id]) ? "1" : "0";
				$permission_data["print"]	= isset($print_permission[$module_id]) ? "1" : "0";
				$permission_data["export"]	= isset($export_permission[$module_id]) ? "1" : "0";

				$post_activity_data['description'] = $sql_helper->activity_log($permission_data,$post_data,$form_action);		

				echo "<pre>";
				print_r($permission_data);
				echo "</pre>";	
				
				$result = $sql_helper->insert_all('tbl_permission',$permission_data);
				
			}
			$post_activity_data['description'] .= $sql_helper->activity_log($sql_permission,$permission_data,$form_action);				

			
		}
		//Activity Log
		
		$post_activity_data['module_id'] = $get_module->module_id;
		$post_activity_data['user_id'] = $_SESSION[WEBSITE_ALIAS]["user"]['user_id'];
		$post_activity_data['action_made'] = "EDIT";	
		$post_activity_data['date_updated'] = $post_data['date_updated'];
		$post_activity_data['ip_address'] = $_SERVER['REMOTE_ADDR'];	
		
		$result = $sql_helper->insert_all('tbl_activity_log',$post_activity_data);
		
		if ($is_updated > 0 or $updated > 0) {
			$user_role_post_data['date_updated'] = "now";	
			$is_updated = $sql_helper->update_all($table_name,"user_role_id" ,$reference_id ,$user_role_post_data);
			$result='true';
		} elseif ( $is_updated == 0 or $updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}

		//header("Location: ".INDEX_PAGE.urlencode($page_name)."&a=edit&success=".$result);
		
	break;
	case 'DELETE':

		if((strtoupper($_POST["Delete"]) == 'YES')){
			$sql_user_role = $db->get_row("SELECT * FROM tbl_user_role WHERE user_role_id ='".$reference_id."'");
			$user_title = $sql_user_role->user_role_title;
			
			$count_deleted = $sql_helper->delete($table_name,$primary_id,$reference_id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			
			//Activity Log
			$post_data['date_updated'] = 'now';
			
			$post_activity_data = array();
			
			$post_activity_data['module_id'] = $get_module->module_id;
			$post_activity_data['user_id'] = $_SESSION[WEBSITE_ALIAS]["user"]['user_id'];
			$post_activity_data['action_made'] = "DELETE";
			$post_activity_data['description'] = "<strong>".$user_title."</strong>";		
			$post_activity_data['date_updated'] = $post_data['date_updated'];
			$post_activity_data['ip_address'] = $_SERVER['REMOTE_ADDR'];			
			$result = $sql_helper->insert_all('tbl_activity_log',$post_activity_data);
			
			header("Location: ".INDEX_PAGE.urlencode($page_name)."&a=delete&success=".$result);
		}	
		
	break;

	case 'VIEW':
		
		header("Location: ".INDEX_PAGE.urlencode($page_name));
		
	break;
}	
$record = $sql_helper->cget_row($table_name,$primary_id." = ".$reference_id);
?>


<div id="page-wrapper">
	<div class="row">
		<div class="gap gap-mini"></div>
		<div class="col-lg-12">
			<?php
			include(PATH_TEMPLATES."chain-link.php");
			?>
		</div>
		
		<div class="col-lg-12">
			<h3 class="page-header nomargin-top"><?php echo $page_heading; ?></h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	<div class="row">
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php if ( $is_editable_field ) { ?><div class="standard-form-instruction"><strong>Note:</strong> <?php echo $req_fld?> denotes required field.</div><?php } ?>
				</div>
				<div class="panel-body">
					<div class="row">
					
						<?php if ( $mode == 'delete' ) { ?>
						<div class="system-message">
							<form action="" method="post" name="frm_<?php echo $page_name; ?>">
							<input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
							<input type="hidden" name="mode" value="<?php echo $mode?>">	
							<div class="alert">
								<div class="message" style="font-size:20px;">
									<center><?php echo CONFIRM_DELETE . "Record" ?><br>
									<input class="button btn btn-warning" name="Delete" type="submit" value="Yes" />&nbsp;&nbsp;
									<input class="button btn btn-success" name="Delete" type="submit" value="No" />
									</center>
								</div>
							</div>
							</form>
						</div>
						<?php } ?>
				
						<form action="<?php //echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>"  enctype="multipart/form-data">
							<input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
							<input type="hidden" name="mode" value="<?php echo $mode?>">
							<input type="hidden" name="<?php echo $record_uid; ?>" value="<?php echo $reference_id?>">	
							<!--<input type="hidden" name="sort_order" value="<?php echo $sort_order ?>">-->
							
							
							<div class="col-sm-12">
						
								<?php
								
								$result_role_title = $db->get_results("SELECT * FROM tbl_user_role");
								$role_title_array = array();
								
								foreach($result_role_title as $result_role_title_val){
									$role_title_array[$result_role_title_val->user_role_id] = $result_role_title_val->user_role_title;
								}	
								
								foreach($editor_fields as $editor_fields_val){
									switch($editor_fields_val['type']){
										
										case 'files':
											$support = "(".implode(",",$editor_fields_val['support']).")";
											echo $form_object->files($editor_fields_val['label'],$editor_fields_val['field'],$is_editable_field,$record->$editor_fields_val['field'],$required_width[$editor_fields_val['field']],$required_height[$editor_fields_val['field']],$support,$editor_fields_val['req'],$upload_dir,$editor_fields_val['note']);
										break;
										case 'ckeditor':
											echo $form_object->ckeditor($editor_fields_val['label'], $editor_fields_val['field'], $is_editable_field, $record->$editor_fields_val['field'], $editor_fields_val['req'], $editor_fields_val['max'], $editor_fields_val['note']);

										break;
										case 'text':
											echo $form_object->input_text($editor_fields_val['label'],$editor_fields_val['field'],$is_editable_field,$record->$editor_fields_val['field'],$editor_fields_val['req'],$editor_fields_val['max'],$editor_fields_val['class'],$editor_fields_val['note']);
										break;
										case 'select':
											echo $form_object->select_array($is_editable_field, $role_title_array, $record->$editor_fields_val['field'],$editor_fields_val['label'],$editor_fields_val['req'],$editor_fields_val['field']);
										break;
									}
								}
								
							
								echo "<table class='table table-striped' >";
								echo "
								<tr style='text-align:center;'>
									<TD></TD>
									<td><strong>Add</strong></td>
									<td><strong>Edit</strong></td>
									<td><strong>Delete</strong></td>
									<td><strong>View</strong></td>
									<td><strong>Print</strong></td>
									<td><strong>Export</strong></td>
									
								</tr>";
								$sql_module = $db->get_results("SELECT * FROM tbl_module ORDER BY module_order ASC");
									foreach($sql_module as $sql_module_val){
									
										$module_id = $sql_module_val->module_id;
									
										if($sql_module_val->category_id == 0){
											$module_name = "<strong>".$sql_module_val->module_name."</strong>";
										}
										else{
											$module_name = $sql_module_val->module_name;											
										}
										echo "<tr > 
											<td>".$module_name."</td>";
											
									$sql_permission_val = $db->get_row("SELECT * FROM tbl_permission WHERE module_id='".$sql_module_val->module_id."' AND user_role_id='".$reference_id."' ");
									$pid			= $sql_permission_val->permission_id;
									$permission_id	= $sql_permission_val->permission_id;
									$add_atr 		= $sql_permission_val->add > 0 ? 'checked="checked"' : '' ;
									$edit_atr		= $sql_permission_val->edit > 0 ? 'checked="checked"' : '' ;
									$delete_atr		= $sql_permission_val->delete > 0 ? 'checked="checked"' : '' ;
									$view_atr		= $sql_permission_val->view > 0 ? 'checked="checked"' : '' ;
									$print_atr		= $sql_permission_val->print > 0 ? 'checked="checked"' : '' ;
									$export_atr		= $sql_permission_val->export > 0 ? 'checked="checked"' : '' ;
								?>
									<td style='text-align:center;'>
									<?php $disabled = $mode == 'view' ? 'disabled' : '' ; ?>
									<?php if($sql_module_val->add > 0){	?>
										<input type="checkbox" name="add[<?php echo $module_id; ?>]" class="checker" id="add<?php echo $module_id; ?>" <?php echo $add_atr . $disabled;?> />
                                    <?php	}	?>
									</td>
									<td style='text-align:center;'>
									<?php if($sql_module_val->edit > 0){	?>
										<input type="checkbox" name="edit[<?php echo $module_id; ?>]" class="checker" id="edit<?php echo $module_id; ?>"  <?php echo $edit_atr . $disabled; ?> />
                                    <?php	}	?>
									</td>
									<td style='text-align:center;'>
									<?php if($sql_module_val->delete > 0){	?>
										<input type="checkbox" name="delete[<?php echo $module_id; ?>]" class="checker" id="delete<?php echo $module_id; ?>"  <?php echo $delete_atr . $disabled; ?> /> 
                                    <?php	}	?>
									</td>
									<td style='text-align:center;'>
									<?php if($sql_module_val->view > 0){	?>
										<input type="checkbox" name="view[<?php echo $module_id; ?>]" class="checker" id="view<?php echo $module_id; ?>"  <?php echo $view_atr . $disabled; ?> /> 
                                    <?php	}	?>                               
									</td>
									<td style='text-align:center;'>	
									<?php if($sql_module_val->print > 0){	?>
										<input type="checkbox" name="print[<?php echo $module_id; ?>]" class="checker" id="print<?php echo $module_id; ?>"  <?php echo $print_atr . $disabled; ?> /> Print
                                    <?php	}	?>                               
									</td>
									<td style='text-align:center;'>									
									<?php if($sql_module_val->export > 0){	?>
										<input type="checkbox" name="export[<?php echo $module_id; ?>]" class="checker" id="export<?php echo $module_id; ?>"  <?php echo $export_atr . $disabled; ?> /> Export
                                    <?php	}	?>   
									
									
									</td>
								<?php
									echo "</tr>";
									}
									echo "</table>";	
									echo "<br>".$form_object->enabled($is_editable_field,$mode,$record->activated,$table_name,'');
								?>
							</div>
							
							<?php 
								if($mode != 'delete'){ 

							?>      
							<BR><BR>
							<legend></legend>							
							<div class="col-xs-12">
								<center>
									<input class="btn btn-primary" name="Submit" id="Submit" type="submit" value="<?php echo $button?>">
								<?php if ( $is_editable_field ) { ?>
								&nbsp;&nbsp;<input class="btn btn-primary" name="btnCancel" id="btnCancel2" type="button" value="Cancel">
								<?php } ?>
								</center>
							</div>
							<?php 
							} 
							?>
						</form>
					</div>
						
				</div>
			</div>
		</div>
	
	</div>

</div>


<?php
require(PATH_TEMPLATES.'require_js.php');
?>

<style type="text/css">
	.flds{width:400px;margin-top:10px}
</style>


<script type="text/javascript">
$(document).ready(function() {

	
	$.validator.addMethod("email", function(value, element) {
		return this.optional(element) || /[a-z]+@[a-z]+\.[a-z]+/.test(value);
	}, "Must be in email address format");



	$.validator.addMethod("alphanumeric", function(value, element) {
		return this.optional(element) || /^[a-z0-9\- '\s]+$/i.test(value);
	}, "Must contain only letters, numbers, or dashes.");

	var validator = $("#frm_<?php echo $page_name?>").validate({
		rules: {
			<?php
			$ctr_fields = 1;
			foreach($editor_fields as $editor_fields_val){
			$validator_count = count($editor_fields_val['validator']);
			?>
			<?php echo $editor_fields_val['field']; ?>
				<?php 
				$ctr_validator = 1;
				foreach($editor_fields_val['validator'] as $validator){ 
					switch ($validator){
						case 'required':
							if($editor_fields_val['type']=='image' && $mode=="add"){
								echo "required: true";								
							}else{
								if($editor_fields_val['type']!='image'){
									echo "required: true";
								}
							}
						break;
						case 'accept':
							$support = implode("|",$editor_fields_val['support']);
							echo 'extension: "('.$support.')"';
						break;
						default:
							echo $validator.": true";
						break;
					}
					echo $ctr_validator==$validator_count?'':',';	
				$ctr_validator++;
				} ?>
			<?php echo $field_count==$ctr_fields?'':',';	

			$ctr_fields++;
			}
		?>	
		},
		messages: {
		},
		errorPlacement: function(error, element) {
			if(element.is(":radio")){
				error.appendTo( element.parent().next().next() );
			}else if(element.is(":checkbox")){
				error.appendTo ( element.next() );
			}else{
				error.appendTo( element.parent().find('span.validation-status') );
			}
		},
		success: "valid",
		submitHandler: function(form){
			//return false;
			$('input[type=submit]').attr('disabled', 'true');
			$(this).bind("keypress", function(e) { if (e.keyCode == 13) return false; });
			form.submit(form);
		}
	});
	
	$('#btnCancel2').click(function () {
		location.href = '<?php echo INDEX_PAGE.urlencode($page_name); ?>';
	});

});

</script>

<script type="text/javascript">

<?php
/*
foreach($editor_fields as $editor_fields_val){
	if($editor_fields_val['type']=='ckeditor'){
		//echo $form_object->ckeditorscript($editor_fields_val['field']); 
	}
}
*/
?>
</script>