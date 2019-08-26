<?php 
require ( 'config.php' );
$mode = isset($_REQUEST['mode']) ? strtolower(trim($_REQUEST['mode'])) : "";
$user_id = $_REQUEST['id'] > 0 ? $_REQUEST['id'] : 0;
$sub_heading = ucfirst($mode);

$button = $helper->button_val($mode, "");
$is_editable_field = $helper->is_editable($mode);
$req_fld = $is_editable_field==true ? REQ_FIELD : "";

$form_action = strtoupper($_POST['form_action']);

$tablename = "tbl_user";

if ( $form_action != '' ) {
	$post_data = array();
	foreach( $_POST as $varname => $value ){
		$$varname = $string->sql_safe($value);
		$post_data[$varname] = $$varname;
	}	
	unset($post_data['form_action']);
	unset($post_data['mode']);	
	unset($post_data['user_id']);
	unset($post_data['Submit']);
	unset($post_data['confirm_email_address']);
	unset($post_data['confirm_password']);
	
	
	$post_data['email_address'] = strtolower($post_data['email_address']);
	$vardumkey 	= $helper->varkeydump();
	$passwordcrypt 	= new hash_encryption($vardumkey);
	$post_data['varkey']		= $vardumkey;
	$post_data['password'] 		= $passwordcrypt->encrypt($post_data['password']);
}

$result = '';

switch ($form_action){
	case 'ADD':		
		$post_data['date_updated'] = 'now';
		$post_data['date_created'] = 'now';
		$id = $sql_helper->insert_all($tablename,$post_data);		
		$is_added = $id > 0 ? true : false;		
		$result =  $is_added==true ? $result='true' : $result='false';
		header("Location: ".INDEX_PAGE.$page_name."&a=add&success=".$result);
		break;
	
	case 'EDIT':
		$is_updated = $sql_helper->update_all($tablename ,"user_id" ,$user_id ,$post_data);
		if ( $is_updated == 1 ) {
			$post_data['date_updated'] = 'now';
			$is_updated = $sql_helper->update_all($tablename ,"user_id" ,$user_id ,$post_data);
			$result='true';
		} elseif ( $is_updated == 0 ) {
			$result='';
		} else {
			$result='false';
		}
		header("Location: ".INDEX_PAGE.$page_name."&a=edit&success=".$result);
		break;
	
	case 'DELETE':
		if ( (strtoupper($_POST["Delete"]) == 'YES')) {
			$sql_check = mysql_query("SELECT * FROM $tablename WHERE user_id='$user_id'");
			if (mysql_num_rows($sql_check) > 0){
				$count_deleted = $sql_helper->delete($tablename ,"user_id" ,$user_id);
			}
			$result = $count_deleted > 0 ? 'true' : 'false';
			header("Location: ".INDEX_PAGE.$page_name."&a=delete&success=".$result);
		} else { 
			header("Location: ".INDEX_PAGE.$page_name);
		}				
		break;
	
	case 'VIEW':
		header("Location: ".INDEX_PAGE.$page_name);
		break;

}

// Retrieve record

$record 				= $sql_helper->cget_row($tablename, "user_id = '$user_id'") ;
$user_role_id			= $record->user_role_id;
$password 				= $record->password;
$passwordcrypt 			= new hash_encryption($record->varkey);
$password 				= $passwordcrypt->decrypt($password);
$email_address			= $record->email_address;
$firstname				= $record->firstname;
$middlename				= $record->middlename;
$lastname				= $record->lastname;
$job_title				= $record->job_title;
$department				= $record->department;
$contact_number_ext		= $record->contact_number_ext;
$contact_number			= $record->contact_number;
$mobile_number			= $record->mobile_number;
$activated				= $record->activated;
$notes					= $record->notes;
$date_updated			= $record->date_updated;
$date_created			= $record->date_created;
?>
<script type="text/javascript">
$(document).ready(function() {
	var validator = $("#frm_<?php echo $page_name?>").validate({
		rules: {
			user_role_id: {
				required: true
			},
			password: {
				required: true
			},
			email_address: {
				required: true,
				email: true,
				remote: "<?php echo PATH_STANDARDACTIONS?>is_exists.php?tn=<?php echo urlencode($crypt->encrypt($tablename))?>&fn=<?php echo urlencode($crypt->encrypt('email_address'))?>&current=<?php echo $email_address?>&m=<?php echo $mode?>"
			},
			confirm_password: {
				required: true,
				equalTo: '#password'
			},
			firstname: {
				required: true
			},
			lastname: {
				required: true
			}
		},
		messages: {
			user_role_id: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			password: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			email_address: {
				required: "<?php echo $messages['validate']['required']?>",
				email:"<?php echo $messages['validate']['email_format']?>",
				remote: $.format("<strong>{0}</strong> <?php echo $messages['validate']['unavailable']?>")			
			},
			confirm_password: {
				required: "<?php echo $messages['validate']['required']?>",
				equalTo: "<?php echo $messages['validate']['pwd_mismatch']?>"
			},
			firstname: {
				required: "<?php echo $messages['validate']['required']?>"
			},
			lastname: {
				required: "<?php echo $messages['validate']['required']?>"
			}
		},
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo( element.parent().find('span.validation-status') );
		},
		success: "valid",
		submitHandler: function(form){
			$('input[type=submit]').attr('disabled', 'true');
			$(this).bind("keypress", function(e) { if (e.keyCode == 13) return false; });
			form.submit(form);
		}
	});
	
	$('#btnCancel').click(function () {
		location.href = '<?php echo INDEX_PAGE.$page_name; ?>';
	});
	
	
	$('#sort_order').numeric();
	
	$('#firstname').namefield();
	$('#middlename').namefield();
	$('#lastname').namefield();
	
	$('#contact_number_ext').numeric();
	$("#contact_number").mask("+999(999) 999999999999");
	$("#mobile_number").mask("+(999) 999999999999");
});

</script>
<div class="form-search-container">

<h1><?php echo $page_heading?> <small>[ <?php echo $sub_heading?> ]</small></h1>

	<?php if ( $mode == 'delete' ) { ?>
	<div class="system-message">
		<form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" name="frm_<?php echo $page_name?>">
		<input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
		<input type="hidden" name="mode" value="<?php echo $mode?>">
		<input type="hidden" name="user_id" value="<?php echo $user_id?>">		
		<div class="alert">
			<div class="message">
				<?php echo CONFIRM_DELETE . "Record" ?>?&nbsp;&nbsp;
				<input class="button" name="Delete" type="submit" value="Yes" />&nbsp;&nbsp;
				<input class="button" name="Delete" type="submit" value="No" />
			</div>
		</div>
		</form>
	</div>
	<?php } ?>
	
	<div class="mid-container wide60">
	<?php if ( $is_editable_field ) { ?><div class="standard-form-instruction"><strong>Note:</strong> <?php echo $req_fld?> denotes required field.</div><?php } ?>
    <form action="<?php echo INDEX_PAGE . $page_option ?>" method="post" id="frm_<?php echo $page_name?>">
        <input type="hidden" name="form_action" value="<?php echo strtoupper($mode)?>">
        <input type="hidden" name="mode" value="<?php echo $mode?>">
		<input type="hidden" name="user_id" value="<?php echo $user_id?>">
		<input type="hidden" name="date_created" value="<?php echo $date_created ?>">	
		<input type="hidden" name="date_updated" value="<?php echo $date_updated ?>">	
        <fieldset class="standard-form">
            <legend>USER ACCOUNT DETAILS</legend>
            <table class="form-table">
				<tr>
					<td class="key wide40" valign="top"><label for="user_role_id">User Role <?php echo $req_fld?></label></td>
					<?php if ( $is_editable_field ) { ?>
					<td>
					<?php
						$value_display['value'] = "user_role_id";
						$value_display['display'] = "user_role_title";
						$rs = $db->get_results("SELECT * FROM ".DB_TABLE_PREFIX."user_role WHERE user_role_id > '1' ORDER BY user_role_title ASC");	
						echo $scaffold->dropdown_rs($rs,$value_display,"user_role_id",$user_role_id,"Select","style='width:264px;'");
					?>
					<span class="validation-status"></span>
					</td>
					<?php } else { ?>
					<td>
						<?php
							$record = $sql_helper->cget_row(DB_TABLE_PREFIX."user_role", "user_role_id = '$user_role_id '") ; 
							echo $record->user_role_title;
						?>
					</td>
					<?php } ?>                                                                                                    
				</tr>
				<tr>
                    <td class="key" valign="top"><label for="email_address">Login Email <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="email_address" id="email_address" size="40" maxlength="50" value="<?php echo $email_address ?>" style="text-transform:lowercase;"/>
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $email_address ?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key" valign="top"><label for="password">Login Password <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td class="password_area">
                    	<input type="password" name="password" id="password" size="40" maxlength="50" value="<?php echo $password ?>" />
						<a href="<?php echo PATH_COMPONENTS.$module; ?>generator-form.php" id="btn_password_generator" class="left">GENERATE PASSWORD</a>
						<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $password ?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key"><label for="confirm_password">Confirm Password <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="password" name="confirm_password" id="confirm_password" size="40" maxlength="50" value="<?php echo $password ?>" />
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $password ?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key" valign="top" style="width:250px;"><label for="firstname">First Name <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="firstname" id="firstname" size="40" maxlength="50" value="<?php echo $firstname ?>" />
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $firstname ?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key" valign="top"><label for="lastname">Last Name <?php echo $req_fld?></label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="lastname" id="lastname" size="40" maxlength="50" value="<?php echo $lastname ?>" />
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $lastname ?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key" valign="top"><label for="job_title">Job Title</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="job_title" id="job_title" size="40" maxlength="100" value="<?php echo $job_title ?>" />
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $job_title ?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key" valign="top"><label for="department">Department</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="department" id="department" size="40" maxlength="100" value="<?php echo $department ?>" />
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $department ?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key" valign="top"><label for="contact_number_ext">Contact Number</label></td>

                    <?php if ( $is_editable_field ) { ?>
                    <td>
						<input type="text" name="contact_number" id="contact_number" size="26" value="<?php echo $contact_number ?>"/>
						<label for="contact_number_ext">Ext</label>
                    	<input type="text" name="contact_number_ext" id="contact_number_ext" size="6" value="<?php echo $contact_number_ext ?>" style="margin-left:1px;" />
						<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $contact_number ?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key" valign="top"><label for="mobile_number">Mobile Number</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td>
                    	<input type="text" name="mobile_number" id="mobile_number" size="40" value="<?php echo $mobile_number ?>" />
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo $mobile_number ?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
                    <td class="key" valign="top"><label for="mobile_number">Notes</label></td>
                    <?php if ( $is_editable_field ) { ?>
                    <td valign="top">
                    	<textarea id="notes" name="notes" cols="44" rows="2"><?php echo htmlentities($notes) ?></textarea>
                    	<span class="validation-status"></span>
                    </td>
                    <?php } else { ?>
                    <td><?php echo htmlentities($notes) ?></td>
                    <?php } ?>                                                                                                    
                </tr>
				<tr>
					<td class="key" valign="top"><label for="activated">Active </label></td>
					<?php if ( $is_editable_field ) { ?>
					<td>
						<?php
							$activated = $mode=='add' ? 1 : $activated;
							echo $scaffold->radio_arr($options=array('Yes','No'), $values=array(1, 0), "activated", $activated, "&nbsp;&nbsp;&nbsp;", $other_attributes="style='border:0;'");
						?>
						<span class="validation-status"></span>
					</td>
					<?php } else { ?>
					<td><?php if($activated==1){	echo "Yes";	}else{ echo "No";	}	?></td>
					<?php } ?>                                                                                                    
				</tr>  
            </table>        	
        </fieldset>
		<?php if ( $mode != 'delete' ) { ?>       
        <div class="standard-form-buttons">
			<input class="button" name="Submit" id="Submit" type="submit" value="<?php echo $button?>">
            <?php if ( $is_editable_field ) { ?>
            &nbsp;&nbsp;<input class="button" name="btnCancel" id="btnCancel" type="button" value="Cancel">
            <?php } ?>
        </div>
        <?php } ?>
    </form>
</div>
</div>