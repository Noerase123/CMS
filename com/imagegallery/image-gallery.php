<?php 
//$tablename 		= DB_TABLE_PREFIX."image_about";
$tablename 		= 'tbl_image_gallery';
?>

<?php

 $ctr = 0;
 $sqlgallery = $db->get_results("SELECT * FROM tbl_image_gallery WHERE type='".$type."' AND ref_id='".$ref_id."' ORDER BY sort_order ASC");				
 $count_image =  count($sqlgallery);
 if ($count_image > 0) {
	 ?>
		<div class="row">
		<div class="gap gap-mini"></div>
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					
				</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="">
							<h4>Modal Images</h4>
							<thead>
								<tr>
									<th>#</th>
									<?php if($mode!='view'){ ?>
									<th>SORT ORDER</th>
									<th>SHOW</th>
									<th>ACTION</th>
									<?php } ?>
									<th <?php echo $mode=='view'?'style="width: 43%;"':''; ?>>IMG</th>
									<TH>NAME</TH>
								</tr>
							</thead>
							
							<tbody>
								<?php
								$ctr 		= 0;
								$result_list = $db->get_results("SELECT * FROM ".$tablename." WHERE type='".$type."' AND ref_id='".$ref_id."' ORDER BY sort_order ASC");
								
								foreach($result_list as $result_list_val){
									$ctr++;
									mysql_query("UPDATE ".$tablename." SET sort_order = '".$ctr."' WHERE image_id = '".$result_list_val->image_id."'");
									$image_id = $result_list_val->image_id;
									$move	= '';
									$move 	.= '<a class="action-icon" href="#up" onclick="sort_gallery(\''.$tablename.'\', '.$result_list_val->image_id.',\'moveup\', \''.$ref_id.'\', \''.$type.'\')" >'.ICON_MOVEUP.'</a>';
									$move 	.= '<a class="action-icon" href="#down" onclick="sort_gallery(\''.$tablename.'\', '.$result_list_val->image_id.',\'movedown\', \''.$ref_id.'\', \''.$type.'\')" >'.ICON_MOVEDOWN.'</a>';
									
									$action	= '';
									$action .= '<a class="action-icon btn btn-primary btn-circle" href="#edit" id="edit_'.$result_list_val->image_id.'" onclick="edit_image(\''.$tablename.'\','.$result_list_val->image_id.',\'edit\')">'.ICON_EDIT.'</a>';
									$action .= '<a class="action-icon btn btn-danger btn-circle" href="#delete" id="delete_'.$result_list_val->image_id.'" onclick="delete_image(\''.$tablename.'\','.$result_list_val->image_id.',\'delete\')"><i class="fa fa-eraser fa-fw" title="delete"></i></a>';
									
									$activated 	= $result_list_val->activated > 0 ? '<img src="img/check.png" alt="Active" title="Active">' : '<img src="img/x.png" alt="In-active" title="In-active">';
											
									$image = '';
									$image = '<div style="margin:0 auto;height:80px; width:150px; background: url(uploads/image_gallery/'.$result_list_val->image.') center center no-repeat; border:1px solid #999;"></div>';		
									?>
									<tr class="odd gradeX">
										<td><?php echo $image_id;?></td>
										<?php if($mode!='view'){ ?>
										<td><?php echo $move; ?></td>
										<td><?php echo $activated; ?></td>
										<td><?php echo $action; ?></td>
										<?php } ?>
										<td class="center"><?php echo $image; ?></td>
										<td><?php echo $result_list_val->image_name; ?></td>
									</tr>
									<?php	
								}
								?>
							</tbody>
						
						</table>
					</div>
				</div>
			</div>
		</div>
		
	</div>
	<?php
	}
	else{
	?>
			<tr>
				<td class="col-spanner" valign="middle" <?php echo $mode=='view'?'colspan="3"':'colspan="6"'; ?> style="line-height:78px;<?php echo $mode=='view'?'width: 864px;':'';?>"><strong><center>NO IMAGE(S) ADDED YET</center></strong></td>
			</tr>		
	<?php
	}	
	?>	

	<div class="spacer5"></div>
	<div id="gallery_form" class="left height-auto width-full">
	</div>
	<div class="spacer5"></div>
	<div class="spacer5"></div>
	<?php if($mode!='view'){ ?>
	<div id="required_image_size_note" class="left height-auto width-full" style="text-align:center;">
		<b style="color:#f00">NOTE: </b>
		<b style="padding-left: 6px;">MINIMUM REQUIRED SIZE: </b>
		<span style="padding-left: 6px;">Height: <?php echo $required_height; ?>px</span>
		<span style="padding-left: 6px;">Width: <?php echo $required_width; ?>px</span>
		<b style="padding-left: 10px;">REQUIRED FILE TYPE:</b>
		<span style="padding-left: 10px;">('.jpg' , '.jpeg' , '.png')</span>
	</div>
	 
	<?php } if($mode!='view'){ 
	?>
	<Br>
	
	&nbsp&nbsp&nbsp<input style="background-color: #337ab7; color:#fff; font-weight:bold; padding:10px 20px 10px 20px; border:none; border-radius:8px;" class="button left" id="btn_addimage" type="button" value="ADD MODAL IMAGE" onclick="imageaction(<?php echo "'".$tablename."','".$type."','".$ref_id."','".$limit."','".$upload_dir2."','add'"; ?>);">
	<input style="background-color: #337ab7; color:#fff; font-weight:bold; padding:10px 20px 10px 20px; border:none; border-radius:8px;" class="button left" id="btn_cancelimageupload" type="button" value="CANCEL UPLOAD" style="margin-left:10px;display:none;" onclick="cancelimageupload();">
<!--	<input class="button left" id="btn_cancelimageupdate" type="button" value="CANCEL UPDATE" style="margin-left:240px;" onclick="cancelimageupdate();">//-->
	<?php } ?>
