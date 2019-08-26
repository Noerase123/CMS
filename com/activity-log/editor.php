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

switch($form_action){
	case 'ADD':
		
		$post_data['date_created'] = 'now';
		$post_data['date_updated'] = 'now';
		$table_name = $table_name;
		//$count_list = $sql_helper->get_var("SELECT count(*) FROM ".$table_name);
		//$post_data['sort_order'] = $count_list + 1;
		print_r($post_data);
		$result = $sql_helper->insert_all($table_name,$post_data);
		$result = ($result) ? 'true': 'false';	
		header("Location: ".INDEX_PAGE.urlencode($page_name)."&a=add&success=".$result);
		
	break;
	case 'EDIT':

		$post_data['date_updated'] = 'now';
		$result = $sql_helper->update_all($table_name,$primary_id ,$reference_id,$post_data);
		$result = ($result) ? 'true': 'false';	
		header("Location: ".INDEX_PAGE.urlencode($page_name)."&a=edit&success=".$result);
		
	break;
	case 'DELETE':
			$reference_id=$_POST['reference_id'];
		if((strtoupper($_POST["Delete"]) == 'YES')){
			$count_deleted = $sql_helper->delete($table_name,$primary_id,$reference_id);
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE.urlencode($page_name)."&a=delete&success=".$result);
		}else{
			header("Location: ".INDEX_PAGE.urlencode($page_name));
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
							<form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" name="frm_<?php echo $page_name; ?>">
							<input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
							<input type="hidden" name="mode" value="<?php echo $mode?>">	
							<input type="hidden" name="reference_id<?php //echo $record_uid; ?>" value="<?php echo $reference_id?>">	
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
				
						<form action="<?php //echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>" enctype="multipart/form-data">
							<input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
							<input type="hidden" name="mode" value="<?php echo $mode?>">
							<input type="hidden" name="<?php echo $record_uid; ?>" value="<?php echo $reference_id?>">	
							

							<div class="col-sm-12">
								<table class="table table-striped custom_table">
								<?php 
									$select_user = $db->get_results("SELECT * FROM tbl_activity_log where activity_log_id = '".$reference_id."'");
									
									foreach($select_user as $select_user_val){
										$select_user_email = $db->get_row("SELECT * FROM tbl_user where user_id = '".$select_user_val->user_id."'");
										$select_module_name = $db->get_row("SELECT * FROM tbl_module where module_id = '".$select_user_val->module_id."'");
										
										
								?>
									<tr>
										<th>User:</th>
										<td><?php echo $select_user_email->email_address; ?></td>
									</tr>
									<tr>
										<th>Module:</th>
										<td><?php echo $select_module_name->module_name; ?></td>
									</tr>
									<tr>
										<th>IP Address:</th>
										<td><?php echo $select_user_val->ip_address; ?></td>
									</tr>
									<tr>
										<th>Date / Time:</th>
										<td><?php echo $select_user_val->date_updated; ?></td>
									</tr>
									<tr>
										<th>Action:</th>
										<td><?php echo $select_user_val->action_made; ?></td>
									</tr>
									<tr>
										<th>Description:</th>
										<td><?php echo  empty($select_user_val->description) ? 'None' : $select_user_val->description ; ?></td>
									</tr>
								<?php 
									} 
								?>
								</table>
							</div>
							
							
							
							<?php 
							if($mode != 'delete'){ 
							?>       
							<div class="col-xs-12">
								<input class="btn btn-primary" name="Submit" id="Submit" type="submit" value="<?php echo $button?>">
								<?php if ( $is_editable_field ) { ?>
								&nbsp;&nbsp;<input class="btn btn-primary" name="btnCancel" id="btnCancel" type="button" value="Cancel">
								<?php } ?>
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
	
	.custom_table th:first-child {
		width:30%;
	}
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
			<?php echo $editor_fields_val['field']; ?>:{
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
			}<?php echo $field_count==$ctr_fields?'':',';	

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
	
	$('#btnCancel').click(function () {
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