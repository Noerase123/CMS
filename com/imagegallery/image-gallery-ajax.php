<?php 
$gallery_mode 	= $_REQUEST['gallery_mode'];
if($gallery_mode!='save'){
	require ( '../../inc/config.php' );
	require ( '../../'.PATH_LIBRARIES.'libraries.php' );

	
	
	$tablename 		= $_REQUEST['tablename'];
	$type 			= $_REQUEST['type'];
	$id 			= $_REQUEST['id'];
	$ref_id 		= $_REQUEST['ref_id'];
	$counter		= $_REQUEST['counter'];
	$limit 			= $_REQUEST['limit'];
	$upload_dir 	= $_REQUEST['upload_dir'];
	$gallery_mode 	= $_REQUEST['gallery_mode'];
	$countr			= $_REQUEST['countr'];
	$r_delete		= $_REQUEST['r_delete'];
}

$total = $sql_helper->get_var("SELECT count(*) FROM ".$tablename."");
$total = $total + 1;
?>
<?php if($gallery_mode=='add'){ //////////// ADD  ?>
<div id="div_<?php echo $counter; ?>">

	<input type="hidden" name="gallerystate<?php echo $counter; ?>" value="add">	
	<input type="hidden" name="sort_order<?php echo $counter; ?>" value="<?php echo $total; ?>">	
	<script type="text/javascript">
	function removex(id){
			//alert(1);
			//alert(id);
			counter = counter -1;
			
			if(counter == 0){
				$('#btn_cancelimageupload').hide();
			}
			
			
			$("#edit_"+id).show();
			// $("#row_"+id).remove(); 
			$("#div_"+id).remove(); 
			$("#btn_addimage").show();
		}
		$("#image_name<?php echo $counter; ?>").rules("add", {
		
			
			required: true,
			
						
			messages: {
				requried: "<?php echo $messages['validate']['required']?>"
			}
		});
		
		$("#image<?php echo $counter; ?>").rules("add", {
			required: true,
			
		
			
			messages: {
				requried: "<?php echo $messages['validate']['required']?>"
			}
		});
	</script>
	<table class="form-table gallery-form-table">
		<tr>
        	<td class="key wide10" valign="top" style="width: 78px"><label for="image_name<?php echo $counter; ?>">Image Name <?php echo $req_fld?></label></td>
            <td class="wide35" valign="top" style="width: 25%;">
            	<input type="text" name="image_name<?php echo $counter; ?>" id="image_name<?php echo $counter; ?>" size="30" maxlength="255" value="" />
                <span class="validation-status"></span>
            </td>
			<td class="key wide10" valign="top" style="width: 41px;"><label for="image<?php echo $counter; ?>">Image <?php echo $req_fld?></label></td>
            <td class="wide30" valign="top">
				<input name="image<?php echo $counter; ?>" id="image<?php echo $counter; ?>" type="file" size="30" class="left" />
				<span class="validation-status"></span>
			</td> 
			<td class="key wide5" valign="top" style="width: 39px;"><label for="activated<?php echo $counter; ?>">Active </label></td>
			<td class="wide10" valign="top">
				<?php
					$activated = 1;
					echo $scaffold->radio_arr($options=array('Yes','No'), $values=array(1, 0), "activated".$counter , $activated, "&nbsp;&nbsp;&nbsp;", $other_attributes="style='border:0;'");
				?>
				<span class="validation-status"></span>
			</td>
			<td valign="top">
				<a class="remove" style="text-decoration: underline;" onclick="removex(<?php echo $counter; ?>)" href="#delete">remove</a>
			</td>			
		</tr>
	</table>
</div>
<?php }elseif($gallery_mode=='edit'){ //////////// EDIT  


$counter			= $countr;
$record 			= $sql_helper->cget_row($tablename, "image_id = '".$id."'") ;
$image_name 		= $record->image_name;
$sort_order			= $record->sort_order;
$activated			= $record->activated;

?>
<div id="div_<?php echo $id; ?>">
	<input type="hidden" name="gallerystate<?php echo $counter; ?>" value="edit">	
	<input type="hidden" name="id<?php echo $counter; ?>" value="<?php echo $id; ?>">	
	<input type="hidden" name="sort_order<?php echo $counter; ?>" value="1">		
	<input type="hidden" name="date_updated<?php echo $counter; ?>" value="<?php echo date("Y-m-d"); ?>">	
	<script type="text/javascript">
		$("#image_name<?php echo $counter; ?>").rules("add", {
			required: true,
			accept: "(png|jpg|jpe?g)"
			messages: {
				requried: "<?php echo $messages['validate']['required']?>"
			}
		});
		
		function removex(id){
			//alert(1);
			//alert(id);
			$("#edit_"+id).();
			// $("#row_"+id).remshowove(); 
			$("#div_"+id).remove(); 
			location.reload(true);
		}
		
		// $(".remove").click(function() {
			// $(this).parent();
			
		// });
		
		
	</script>
	<table class="form-table gallery-form-table">
		<tr id="row_<?php echo $id ?>">
        	<td class="key wide10" valign="top"><label for="image_name<?php echo $counter; ?>">Image Name <?php echo $req_fld?></label></td> 
            <td class="wide35" valign="top" style="width: 25%;">
            	<input type="text" name="image_name<?php echo $counter; ?>" id="image_name<?php echo $counter; ?>" size="30" maxlength="255" value="<?php echo $image_name; ?>" />
                <span class="validation-status"></span>
            </td>
			<td class="key wide10" valign="top"><label for="image<?php echo $counter; ?>">Image <?php echo $req_fld?></label></td>
            <td class="wide30" valign="top">
				<input name="image<?php echo $counter; ?>" id="image<?php echo $counter; ?>" type="file" size="30" class="left" />
				<span class="validation-status"></span>
			</td> 
			<td class="key wide5" valign="top"><label for="activated<?php echo $counter; ?>">Active </label></td>
			<td class="wide10" valign="top">
				<?php
					echo $scaffold->radio_arr($options=array('Yes','No'), $values=array(1, 0), "activated".$counter , $activated, "&nbsp;&nbsp;&nbsp;", $other_attributes="style='border:0;'");
				?>
				
				<span class="validation-status"></span>
			</td>  
			<td valign="top">
				<a class="remove" style="text-decoration: underline;" onclick="removex(<?php echo $id; ?>)" href="#delete">remove</a>
			</td>
		</tr>
	</table>
</div>
<?php }elseif($gallery_mode=='delete'){ //////////// DELETE 
		mysql_query("DELETE FROM $tablename WHERE image_id = '$id'");
		//echo $id;
?>

<?php }elseif($gallery_mode=='save'){ //////////// SAVE 
$image_gallery_status = 0;
$gallerystate = $post_data['gallerystate'];
for($ctr=1; $ctr<=$limit; $ctr++){
		
	/////////////////////////////////////////////////  STEP 1
	$new_file = $_FILES['image'.$ctr];
	$filename = $new_file['name'];
	$filename = str_replace(' ', '_', $filename);	
	$file_tmp = $new_file['tmp_name'];
	$ext = strtolower(strrchr($filename,'.'));	
	$new_filename = '';
	$unique_id = $helper->unique_id();
	
	/////////////////////////////////////////////////  STEP 2
	if ($filename != ""){
		// DELETE PREVIOUS FILE
		$helper->delete_image_wt($upload_dir,DB_TABLE_PREFIX."image","image_id",$id,"image");
		// UPLOAD THE FILE
		$new_filename = $unique_id.$ext;
		if (move_uploaded_file($file_tmp,$upload_dir.$new_filename)){	
			$img_width 			= $required_width;
			$img_height 		= $required_height;
			$img_thumb_width 	= $required_thumb_width;
			$img_thumb_height 	= $required_thumb_height;
			$new_filename_thumb = $unique_id.'_s'.$ext;
			// Resize to required size
			if ( $image->create_image( $upload_dir, $new_filename, $new_filename, $img_width, $img_height, true, false) ){
				if ( $image->create_image( $upload_dir, $new_filename, $new_filename_thumb, $img_thumb_width, $img_thumb_height, true, false) ){
					$is_file_uploaded = true;		
				}else{	$is_file_uploaded = false;	}	 
			}else{	$is_file_uploaded = false;	}
		}
	}
	/////////////////////////////////////////////////  STEP 3
	if ($new_filename != "")	{	$post_data['image'.$ctr] = $new_filename;	}
	else						{	unset($post_data['image'.$ctr]);			}
	
	if( ($post_data['image_name'.$ctr]) ){
		$post_gallery_data = array();
		unset($post_gallery_data);
		$post_gallery_data['type'] 			= $type;
		$post_gallery_data['ref_id'] 		= $ref_id;
		$post_gallery_data['image_name'] 	= $post_data['image_name'.$ctr];
		$post_gallery_data['image'] 		= $post_data['image'.$ctr];
		$post_gallery_data['sort_order'] 	= $post_data['sort_order'.$ctr];	
		$post_gallery_data['activated'] 	= $post_data['activated'.$ctr];
		$post_gallery_data['date_created'] 	= 'now';
		$post_gallery_data['date_updated'] 	= 'now';
		
		$helper->pre_print_r($post_gallery_data);
		if($gallerystate=="add"){
			$image_gallery_status += $sql_helper->insert_all(DB_TABLE_PREFIX."image",$post_gallery_data);
		}else{
			$image_gallery_status += $sql_helper->update_all(DB_TABLE_PREFIX."image","image_id" ,$id ,$post_gallery_data);
		}
		
		unset($post_data['image_name'.$ctr]);
		unset($post_data['image'.$ctr]);
		unset($post_data['sort_order'.$ctr]);
		unset($post_data['activated'.$ctr]);
		unset($post_data['gallerymode']);
			
	}
}	
?>

<?php }elseif($gallery_mode=='moveup' or $gallery_mode=='movedown'){ //////////// SORT ORDER 

	// GET MAX ROWS
	
	$max_row = $db->get_var("SELECT count(*) FROM tbl_image_gallery");
	// RETRIEVE DATA
	$record 		= $sql_helper->cget_row($tablename, "image_id = $id");
	$current_order 	= $record->sort_order;
	
	if($gallery_mode == 'movedown'){
		$new_order = $current_order + 1;
	}else{
		$new_order = $current_order - 1;
	}
	
	
	// CHECK FOR EXISTING SORT ORDER
	if($new_order >= 1){
		$sql_check = mysql_query("SELECT * FROM ".$tablename." WHERE sort_order='".$new_order."' AND type='".$type."' AND ref_id='".$ref_id."' AND image_id!='".$id."'");
		$row_check = mysql_fetch_array($sql_check);
		
		if( mysql_num_rows($sql_check) > 0 ){
			mysql_query("UPDATE ".$tablename." SET sort_order = '".$current_order."'  WHERE image_id='".$row_check['image_id']."'");
			mysql_query("UPDATE ".$tablename." SET sort_order = '".$new_order."' WHERE image_id='".$id."'");
		}else{
			mysql_query("UPDATE ".$tablename." SET sort_order = '".$new_order."' WHERE image_id='".$id."'");
		}
	}

 }

?>
