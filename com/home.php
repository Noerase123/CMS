<?php 
	
	//echo $module[$ctr];
?>



 <div id="page-wrapper">
	<div class="row">
		<div class="col-lg-12">
			<h3 class="page-header">Content Management System</h3>
		</div>
		<!-- /.col-lg-12 -->
	</div>
	
	
	 <div class="row">
		<?php 
			$get_list = $db->get_results("select * from tbl_module where category_id = 0 and activated = 1 order by module_order");	
				foreach($get_list as $list){ 
				
					$sql_permission = $db->get_row("SELECT * FROM tbl_permission WHERE user_role_id='".$_SESSION[WEBSITE_ALIAS]["user"]['user_role_id']."' and module_id = ".$list->module_id);	
					$add =  $sql_permission->add > 0 ? '1' : '0';
					$edit =  $sql_permission->edit > 0 ? '1' : '0';
					$delete =  $sql_permission->delete > 0 ? '1' : '0';
					$view =  $sql_permission->view > 0 ? '1' : '0';
					$print =  $sql_permission->print > 0 ? '1' : '0';
					$export =  $sql_permission->export > 0 ? '1' : '0';
					$all_mode = $sql_permission->add + $sql_permission->edit + $sql_permission->delete + $sql_permission->view + $sql_permission->print + $sql_permission->export;
					$all_mode = $all_mode > 0 ? '1' : '0';
					$load_mode = $list->root == 1? $all_mode:$view;
					if($view){
						if($list->module_id == 1 || $list->module_id == 4 || $list->module_id == 13 || $list->module_id == 15){
							
						}
						else{
							if($list->slug == 'other-settings' || $list->slug == 'smtp'){
							
								if($list->slug == 'other-settings'){										
									$get_other_settings_id = $db->get_row("select * from tbl_other_settings");		
									$module_id = $get_other_settings_id->other_settings_id;
								}
								if($list->slug == 'smtp'){										
									$get_other_smtp_id = $db->get_row("select * from tbl_smtp");		
									$module_id = $get_other_smtp_id->smtp_id;
								}
							?>	
							<div class="col-lg-3 col-md-6">
								<div class="panel" style="background:<?php echo $list->module_background; ?>; color:white;">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<i class="<?php echo $list->module_icon; ?> fa-5x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<!--<div class="huge">13</div>-->
												<div><?php echo $list->module_name; ?></div>
											</div>
										</div>
									</div>
									<a href="<?php echo INDEX_PAGE.urlencode($list->slug)."&mode=edit&id=".$module_id.""?>">
										<div class="panel-footer">
											<span class="pull-left">View Details</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
							</div>	
								
							<?php 
							}
							else{
								?>
							<div class="col-lg-3 col-md-6">
								<div class="panel"style="background:<?php echo $list->module_background; ?>; color:white;">
									<div class="panel-heading">
										<div class="row">
											<div class="col-xs-3">
												<i class="<?php echo $list->module_icon; ?> fa-5x"></i>
											</div>
											<div class="col-xs-9 text-right">
												<!--<div class="huge">13</div>-->
												<div><?php echo $list->module_name; ?></div>
											</div>
										</div>
									</div>
									<a href="<?php echo INDEX_PAGE.urlencode($list->slug)?>">
										<div class="panel-footer">
											<span class="pull-left">View Details</span>
											<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
											<div class="clearfix"></div>
										</div>
									</a>
								</div>
							</div>	
						<?php
						}
						}
						$get_sub_list = $db->get_results("select * from tbl_module where category_id = ".$list->module_id." and activated = 1 order by module_order");	
									
							if($get_sub_list){
							
								foreach ($get_sub_list as $sub_list){
									$sql_permission = $db->get_row("SELECT * FROM tbl_permission WHERE user_role_id='".$_SESSION[WEBSITE_ALIAS]["user"]['user_role_id']."' and module_id = ".$sub_list->module_id);	
									$add =  $sql_permission->add > 0 ? '1' : '0';
									$edit =  $sql_permission->edit > 0 ? '1' : '0';
									$delete =  $sql_permission->delete > 0 ? '1' : '0';
									$view =  $sql_permission->view > 0 ? '1' : '0';
									$print =  $sql_permission->print > 0 ? '1' : '0';
									$export =  $sql_permission->export > 0 ? '1' : '0';
									$all_mode = $sql_permission->add + $sql_permission->edit + $sql_permission->delete + $sql_permission->view + $sql_permission->print + $sql_permission->export;
									$all_mode = $all_mode > 0 ? '1' : '0';
									$load_mode = $sub_list->root == 1? $all_mode:$view;
										
									if($view){
										
										//Sublist Filtering									
										if($sub_list->module_id == 7 || $sub_list->module_id == 16 || $sub_list->module_id == 9){
											
											if($sub_list->slug == 7){
												$get_id = $db->get_row("select * from tbl_email_template where activated = 1");
												$module_id = $get_id->contact_id;				
											}
											
											if($sub_list->slug == 16){
												$get_id = $db->get_row("select * from tbl_contact_content where activated = 1");
												$module_id = $get_id->contact_id;				
											}
						?>
									
									<div class="col-lg-3 col-md-6">
										<div class="panel" style="background:<?php echo $sub_list->module_background; ?>; color:white;">
											<div class="panel-heading">
												<div class="row">
													<div class="col-xs-3">
														<i class="<?php echo $sub_list->module_icon; ?> fa-5x"></i>
													</div>
													<div class="col-xs-9 text-right">
														<!--<div class="huge">13</div>-->
														<div><?php echo $sub_list->module_name; ?> </div>
													</div>
												</div>
											</div>
											<a href="<?php echo INDEX_PAGE.urlencode($sub_list->slug)."&mode=edit&id=".$module_id.""?>">
												<div class="panel-footer">
													<span class="pull-left">View Details</span>
													<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
													<div class="clearfix"></div>
												</div>
											</a>
										</div>
									</div>	
											
									<?php
										}else{
									?>
									<div class="col-lg-3 col-md-6">
										<div class="panel" style="background:<?php echo $sub_list->module_background; ?>;">
											<div class="panel-heading">
												<div class="row">
													<div class="col-xs-3">
														<i class="<?php echo $sub_list->module_icon; ?> fa-5x" style="color:white;"></i>
													</div>
													<div class="col-xs-9 text-right">
														<!--<div class="huge">13</div>-->
														<div style="color:white;"><?php echo $sub_list->module_name; ?></div>
													</div>
												</div>
											</div>
											<a href="<?php echo INDEX_PAGE.urlencode($sub_list->slug)?>">
												<div class="panel-footer">
													<span class="pull-left">View Details</span>
													<span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
													<div class="clearfix"></div>
												</div>
											</a>
										</div>
									</div>
								<?php
										}
									}
								}
							}
					}
				}
			?>
	</div>
	
</div>



<?php

require(PATH_TEMPLATES.'require_js.php');

?>