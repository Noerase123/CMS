<?php
require ( 'config.php' );
require ( 'data.php' );

$target_url = INDEX_PAGE.$page_option.'&mode=';
?>


<!-- MESSAGE RESULTS (START) -->
<div class="system-message-wrapper">
	<?php if ( isset($_GET['a']) && $_GET['a'] != '' ) { ?><div class="system-message"><?php	if($helper->operation_msg($_GET['a'], $_GET['success'], "Record")=="System Function ERROR!"){ 	$alert_type = "alert";	}else{	$alert_type = "info";	}	?><div class="<?php echo $alert_type; ?>"><div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "Record")?></div></div></div><?php } ?>
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
				<div class="panel-body">
					<div class="dataTable_wrapper">
						<table class="table table-striped table-bordered table-hover" id="dataTables-example">
							<thead>
								<tr>
									<th>Actions</th>
									<th>Contact From</th>
									<th>Last Update</th>
									
								</tr>
							</thead>
							<tbody>
								
								<?php
								
								$result_list	=	$db->get_results("SELECT * FROM ".$table_name);
								
								foreach($result_list as $result_list_val){
								
									$record_id 	= $result_list_val->$record_uid;
									
									$action	= '';
									$action .= '<a class="action-icon" href="'.$target_url.'view&id='.$record_id.'"><button class="btn btn-primary btn-circle" type="button" title="view">'.ICON_VIEW.'</button></a>&nbsp;';
									$action .= '<a class="action-icon" href="'.$target_url.'edit&id='.$record_id.'"><button class="btn btn-primary btn-circle" type="button" title="update">'.ICON_EDIT.'</button></a>&nbsp;';
									$action .= '<a class="action-icon" href="'.$target_url.'delete&id='.$record_id.'"><button class="btn btn-danger btn-circle" type="button" title="delete">'.ICON_DELETE.'</button></a>';
									
									$enabled 	= $result_list_val->activated > 0 ? "<i class=\"fa fa-toggle-on color-green fa-2x enable-disable-btn\" parameters=\"".$table_name."|".$record_uid."|".$record_id."\"><div class=\"sr-only\">a</div></i>" : "<i class=\"fa fa-toggle-off fa-2x enable-disable-btn\" parameters=\"".$table_name."|".$record_uid."|".$record_id."\"><div class=\"sr-only\">b</div></i>";
									
									$date_updated = $helper->readable_datetime($result_list_val->date_updated);
									$contact_from	= $result_list_val->contact_from;
									$cotact_id	= $result_list_val->contact_id;

							
								?>
									<tr class="odd gradeX">
										<td><center><?php echo $action; ?></center></td>
										<td><?php echo $contact_from; ?></td>
										<td class="center"><?php echo $date_updated; ?></td>
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