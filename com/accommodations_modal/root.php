<?php
require ( 'config.php' );
require ( 'data.php' );

$target_url = INDEX_PAGE.$page_option.'&mode=';
?>


<!-- MESSAGE RESULTS (START) -->
<div class="system-message-wrapper">
	<?php 
		if ( isset($_GET['a']) && $_GET['a'] != '' ) 
		{ 
	?>
		<div class="system-message">
			<?php	
				if($helper->operation_msg($_GET['a'], $_GET['success'], "Record")=="System Function ERROR!")
					{ 	
						$alert_type = "alert";	
					}
				else
					{
						$alert_type = "info";	
					}
			?>
			<div class="<?php echo $alert_type; ?>">
				<div class="message">
					<?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "Record")?>
				</div>
			</div>
		</div>
	<?php 
		}	
	?>
</div>
<!-- MESSAGE RESULTS (END) -->


<div id="page-wrapper">

	<div class="row">
		<div class="gap gap-mini"></div>
		<div class="col-lg-12">
			<?php
			include(PATH_TEMPLATES."chain-link.php");
			?>
		</div>
	</div>
	
	<div class="row">
		<div class="gap gap-mini"></div>
		<div class="col-lg-12">
			<div class="panel panel-primary">
				<div class="panel-heading">
					<?php echo strtoupper($page_heading); ?>
				</div>
				<div class="col-xs-12 pull-left mt10 mb10">
					<?php 
						$select_permission = $db->get_row("SELECT * FROM tbl_permission WHERE module_id = '".$get_module->module_id."' and user_role_id = '".$_SESSION[WEBSITE_ALIAS]["user"]['user_role_id']."' ");
						if($select_permission->add == 1){
					?>
					<a href="<?php echo $target_url.'add'; ?>" class="btn btn-primary">Add <i class="fa fa-plus"></i></a>
					<?php 
						}
					?>
				</div>
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Actions</th>
									<th>Title</th>
									<th>Enabled</th>
									<th>Last Update</th>
									<th>Sort</th>
								</tr>
							</thead>
							<tbody>
								
								<?php
								$ctr 		= 0;
								$result_list	=	$db->get_results("SELECT * FROM ".$table_name." ORDER BY room_order ASC");
								
								foreach($result_list as $result_list_val){
									//Sorting
									$ctr++;
									mysql_query("UPDATE ".$table_name." SET ".$record_order." = '".$ctr."' WHERE ".$record_uid." = '".$result_list_val->$record_uid."'");
									$image_id = $result_list_val->$record_uid;
									$move	= '';
									$move 	.= '<a class="action-icon" href="#up" onclick="sort_table_root(\''.$table_name.'\', '.$result_list_val->$record_uid.',\'moveup\',\''.$record_uid.'\',\''.$record_order.'\')" >'.ICON_MOVEUP.'</a>';
									$move 	.= '<a class="action-icon" href="#down" onclick="sort_table_root(\''.$table_name.'\', '.$result_list_val->$record_uid.',\'movedown\',\''.$record_uid.'\',\''.$record_order.'\')" >'.ICON_MOVEDOWN.'</a>';
									
									$select_permission = $db->get_row("SELECT * FROM tbl_permission WHERE module_id = '".$get_module->module_id."' and user_role_id = '".$_SESSION[WEBSITE_ALIAS]["user"]['user_role_id']."' ");

									$record_id 	= $result_list_val->$record_uid;
									
									$action	= '';
									if($select_permission->view == 1){
										$action .= '<a class="action-icon" href="'.$target_url.'view&id='.$record_id.'"><button class="btn btn-primary btn-circle" type="button" title="view">'.ICON_VIEW.'</button></a>&nbsp;';
									}
									if($select_permission->edit == 1){
										$action .= '<a class="action-icon" href="'.$target_url.'edit&id='.$record_id.'"><button class="btn btn-primary btn-circle" type="button" title="update">'.ICON_EDIT.'</button></a>&nbsp;';
									}
									if($select_permission->delete == 1){
										$action .= '<a class="action-icon" href="'.$target_url.'delete&id='.$record_id.'"><button class="btn btn-danger btn-circle" type="button" title="delete">'.ICON_DELETE.'</button></a>';
									}
									$enabled 	= $result_list_val->activated > 0 ? "<i class=\"fa fa-toggle-on color-green fa-2x enable-disable-btn\" parameters=\"".$table_name."|".$record_uid."|".$record_id."\"><div class=\"sr-only\">a</div></i>" : "<i class=\"fa fa-toggle-off fa-2x enable-disable-btn\" parameters=\"".$table_name."|".$record_uid."|".$record_id."\"><div class=\"sr-only\">b</div></i>";
									
									$date_updated = $helper->readable_datetime($result_list_val->date_updated);
									$module_name	= $result_list_val->room_title;
									?>
								
									<tr class="odd gradeX">
										<td><?php echo $action; ?></td>
										<td><?php echo $module_name; ?></td>
										<td><?php echo $enabled; ?></td>
										<td class="center"><?php echo $date_updated; ?></td>
										<td><?php echo $move; ?></td>
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
	
	
</div>


<?php

require(PATH_TEMPLATES.'require_js.php');

?>
<script type="text/javascript">
	$(".enable-disable-btn").click(function(){
		
		preloader(1);
		
		if($(this).is(".fa-toggle-on.color-green")){
			
			$(this).removeClass("fa-toggle-on");
			$(this).removeClass("color-green");
			$(this).addClass("fa-toggle-off");
			var status	=	0;
			
		}else{
			
			$(this).addClass("fa-toggle-on");
			$(this).addClass("color-green");
			$(this).removeClass("fa-toggle-off");
			var status = 1;
			
		}
		
		var parameters	=	$(this).attr("parameters");
		parameters		=	parameters.split("|");
		
		
		$.ajax({
			url: BASE_URL+"com/actions/activation.php",
			type:"POST",
			data: {
				status		:	status,
				table_name	:	parameters[0],
				field_name	:	parameters[1],
				record_id	:	parameters[2],
			},
			cache: false,
			success: function(result) {
				
				preloader(0);
				return false;
				
			},
			error: function() {
				return false;
				
			}
		});

	
	});
</script>