<div class="info-preloader" id="infopreloader" style="display:block">
	<div class="process-logo">
		<div class="progress">
		  <div class="indeterminate"></div>
		</div>

		<div class="progress" style="position:absolute; bottom:0;">
		  <div class="indeterminate"></div>
		</div>
	</div>
</div>

<div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
			
			<!----#################### FOR DESKTOP MENU #####################----->
            
			<div class="navbar-header">
				<!--
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
				-->
               <a class="navbar-brand" href="" style="padding:2px;"><img src="img/atlantis.png" class="" style="height:51px; width:100px; padding:3px;"></a>
                <!--<a class="" href="" ><img src="img/hotel-logo.png" class="" style="height:50px; padding:10px;" /></a>-->
            </div>
            
			<!-- /.navbar-header -->
			<ul class="nav navbar-top-links navbar-right visible-lg visible-md">
                
                <!-- /.dropdown -->
                <li class="dropdown">
                    
					<a class="dropdown-toggle" data-toggle="dropdown" href="#">
						<?php
							if(isset($_SESSION[WEBSITE_ALIAS]["corporate"])){
							
								echo "WELCOME ".$_SESSION[WEBSITE_ALIAS]["corporate"]['firstname'];
							
							}else{
							
								echo "WELCOME ".$_SESSION[WEBSITE_ALIAS]["user"]['user_fullname'];
							
							}
						?>
                        <i class="fa fa-user fa-fw"></i>
						<i class="fa fa-caret-down"></i>
                    </a>
                    
					<ul class="dropdown-menu dropdown-user">
						
						<?php
						if(isset($_SESSION[WEBSITE_ALIAS]["corporate"])){
						?>
                        <li>
							<a href="<?php echo INDEX_PAGE?>corporate-account-manager-m&mode=edit&id=<?php echo $_SESSION[WEBSITE_ALIAS]["corporate"]["corporate_id"]; ?>"><i class="fa fa-user fa-fw"></i> User Profile</a>
                        </li>
						<?php
						}else{
						?>
						
						<?php
						}
						?>
						
                        <li class="divider"></li>
                        <li>
							<a href="<?php echo INDEX_PAGE?>logoff">
								<i class="fa fa-sign-out fa-fw"></i> Logout
							</a>
							<!--<a href="<?php echo INDEX_PAGE?>logoff" class="log-off" title="LOGOFF">LOGOFF</a>-->
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
                <!-- /.dropdown -->
            
			</ul>
            
            <!-- /.navbar-top-links -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
						<!--
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                          
                        </li>
						-->
						<li>
                            <a href="index.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
						
						
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
									echo "<li>";
										
									if($list->module_id == 49 || $list->module_id == 12 || $list->module_id == 46 || $list->module_id == 40 || $list->module_id == 47 || $list->module_id == 45 || $list->module_id == 7){
										
										if($list->module_id == 49){
											$get_other_settings_id = $db->get_row("select * from tbl_other_settings");
											$module_id = $get_other_settings_id->other_settings_id;
										}
										else if($list->module_id == 12){
											$get_smtp_id = $db->get_row("select * from tbl_smtp");
											$module_id = $get_smtp_id->smtp_id;
										}
										else if($list->module_id == 46){
											$room_id = $db->get_row("select * from tbl_logo");
											$module_id = $room_id->room_id;
										}
										else if($list->module_id == 40){
											$room_id = $db->get_row("select * from tbl_mission_vision");
											$module_id = $room_id->mv_id;
										}
										else if($list->module_id == 47){
											$room_id = $db->get_row("select * from tbl_video");
											$module_id = $room_id->vid_id;
										}
										else if($list->module_id == 45){
											$room_id = $db->get_row("select * from tbl_copyright");
											$module_id = $room_id->room_id;
										}
										else if($list->module_id == 7){
											$room_id = $db->get_row("select * from tbl_contact_content");
											$module_id = $room_id->content_id;
										}
										

										//Link
										echo "<a href=\"".INDEX_PAGE.urlencode($list->slug)."&mode=edit&id=".$module_id."\"><i class=\" ".$list->module_icon." fa-fw\"></i>&nbsp;".$list->module_name."</a>";
									}
									
									else {	
										
										//Link
										echo "<a href=\"".INDEX_PAGE.urlencode($list->slug)."\"><i class=\" ".$list->module_icon." fa-fw\"></i>&nbsp;".$list->module_name."</a>";
									
									}
									
									/////////////////////////////////////////////////////////////////////////////////////////////////
									/////////////////////////////////////////////////////////////////////////////////////////////////
									
									$get_sub_list = $db->get_results("select * from tbl_module where category_id = ".$list->module_id." and activated = 1 order by module_order");	
									
									if($get_sub_list){
									
										echo "<ul class=\"nav nav-list\">";
									
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
											
											echo "<li>";
											
											if($sub_list->module_id == 7 || $sub_list->module_id == 16 || $sub_list->module_id == 46 || $sub_list->module_id == 40 || $sub_list->module_id == 47 || $sub_list->module_id == 45 || $sub_list->module_id == 49){
												
												if($sub_list->module_id == 7){
													$get_id = $db->get_row("select * from tbl_contact_content");
													$module_id = $get_id->content_id;
												}		
												
												if($sub_list->module_id == 16){
													$get_id = $db->get_row("select * from tbl_contact_content");
													$module_id = $get_id->contact_id;
												}
												
												if($sub_list->module_id == 46){
													$get_id = $db->get_row("select * from tbl_logo");
													$module_id = $get_id->room_id;
												}
												
												if($sub_list->module_id == 40){
													$get_id = $db->get_row("select * from tbl_mission_vision");
													$module_id = $get_id->mv_id;
												}
												
												if($sub_list->module_id == 47){
													$get_id = $db->get_row("select * from tbl_video");
													$module_id = $get_id->vid_id;
												}

												if($sub_list->module_id == 45){
													$get_id = $db->get_row("select * from tbl_copyright");
													$module_id = $get_id->room_id;
												}

												if($sub_list->module_id == 49){
													$get_id = $db->get_row("select * from tbl_other_settings");
													$module_id = $get_id->other_settings_id;
												}
												
												

												echo
												"<a href=\"".INDEX_PAGE.urlencode($sub_list->slug)."&mode=edit&id=".$module_id."\">".$sub_list->module_name."</a>";
											}											
											
											else{
												echo "<a href=\"".INDEX_PAGE.urlencode($sub_list->slug)."\">".$sub_list->module_name."</a>";
											}
											
												
												$get_sub_list = $db->get_results("select * from tbl_module where category_id = ".$sub_list->module_id." and activated = 1 order by module_order");			
												if($get_sub_list){
													
													echo "<ul class=\"nav nav-list\">";
												
													foreach($get_sub_list as $sub_list){
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
														?>
															<li>
																<a href="<?php echo INDEX_PAGE.urlencode($sub_list->slug)?>" ><i class="fa fa-newspaper-o fa-fw"></i><?php echo $sub_list->module_name; ?></a>
															</li>
														<?php
														}
													}
													
													echo "</ul>";
												
												}
												
											echo "</li>";	
											
											}
										}
										
										echo "</ul>";
									
									}
								
								echo "</li>";
								
								}
								
							}
						?>
						
                    </ul>
                </div>
                <!-- /.sidebar-collapse -->
            </div>
			
			
            <!-- /.navbar-static-side -->
			<!----####################
			FOR DESKTOP MENU 
			#####################----->
			
			
			<!----####################
			FOR MOBILE MENU 
			#####################----->
			<a class="cmn-toggle-switch cmn-toggle-switch__htx open_close hidden-sm" href="javascript:void(0);" style='z-index:220000000;'><span>Menu mobile</span></a>
			
			<div class="main-menu visible-xs">
				<div id="header_menu">
					<img src="http://asiancities.com/img/logo_aqua_sticky.png" width="160" height="34" alt="City tours" data-retina="true">
				</div>
				<a href="#" class="open_close" id="close_in"><i class="icon_set_1_icon-77"></i></a>
				<h5 class="text-center">
				<?php
				
				if(isset($_SESSION[WEBSITE_ALIAS]["corporate"])){
				
					echo "WELCOME ".$_SESSION[WEBSITE_ALIAS]["corporate"]['firstname'];
				
				}else{
				
					echo "WELCOME ".$_SESSION[WEBSITE_ALIAS]["user"]['user_fullname'];
				
				}
				?>
				</h5>
				<ul class="text-right">
					<li><a href="index.php">Dashboard</a></li>
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
									echo "<li>";			
									//////////////////////////////////////////////////////////////////////////////////////////////////////////////
										
										//INSERT Main module id for EDIT & VIEW only 
										if($list->module_id == 49 || $list->module_id == 12 || $list->module_id == 46 || $list->module_id == 40 || $list->module_id == 47 || $list->module_id == 45 || $list->module_id == 7){
											
											if($list->module_id == 49){
												$get_id = $db->get_row("select * from tbl_other_settings");
												$module_id = $get_id->other_settings_id;
											}
											else if($list->module_id == 12){
												$get_id = $db->get_row("SELECT * FROM tbl_smtp");
												$module_id = $get_id->smtp_id;
											}
											else if($list->module_id == 46){
												$get_id = $db->get_row("SELECT * FROM tbl_logo");
												$module_id = $get_id->room_id;
											}
											
											else if($list->module_id == 40){
												$get_id = $db->get_row("SELECT * FROM tbl_mission_vision");
												$module_id = $get_id->mv_id;
											}
											
											else if($list->module_id == 47){
												$get_id = $db->get_row("SELECT * FROM tbl_video");
												$module_id = $get_id->vid_id;
											}
											
											else if($list->module_id == 45){
												$get_id = $db->get_row("SELECT * FROM tbl_copyright");
												$module_id = $get_id->room_id;
											}

											else if($list->module_id == 7){
												$get_id = $db->get_row("SELECT * FROM tbl_contact_content");
												$module_id = $get_id->content_id;
											}
											
											echo "<a href=\"".INDEX_PAGE.urlencode($list->slug)."&mode=edit&id=".$module_id."\"> &nbsp;".$list->module_name."</a>";
											
										}
										
										//INSERT Main module id without root page 
										else if($list->module_id == 1 || $list->module_id == 4 || $list->module_id == 13 || $list->module_id == 15){
											
											echo "<a href=\"#\">&nbsp;".$list->module_name."</a>";
										
										}
										
										//ELSE
										else{
											
											echo "<a href=\"".INDEX_PAGE.urlencode($list->slug)."\">&nbsp;".$list->module_name."</a>";
										
										}
										
									//////////////////////////////////////////////////////////////////////////////////////////////////////////////	
								
									$get_sub_list = $db->get_results("select * from tbl_module where category_id = ".$list->module_id." and activated = 1 order by module_order");	
									
									if($get_sub_list){
									
										echo "<ul class=\"nav nav-list\">";
									
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
											
											echo "<li>";
											//////////////////////////////////////////////////////////////////////////////////////////////////////////////
											
											//INSERT Sub module id for EDIT & VIEW only 
											if($sub_list->module_id == 7 || $sub_list->module_id == 16 || $sub_list->module_id == 46 || $sub_list->module_id == 40 || $sub_list->module_id == 47 || $sub_list->module_id == 45 || $sub_list->module_id == 49){
												
												if($sub_list->module_id == 7){
													$get_id = $db->get_row("select * from tbl_contact_content");
													$module_id = $get_id->content_id;
												}
												
												if($sub_list->module_id == 16){
													$get_id = $db->get_row("select * from tbl_contact_content");
													$module_id = $get_id->contact_id;
												}
												
												if($sub_list->module_id == 46){
													$get_id = $db->get_row("select * from tbl_logo");
													$module_id = $get_id->room_id;
												}
												
												if($sub_list->module_id == 40){
													$get_id = $db->get_row("select * from tbl_mission_vision");
													$module_id = $get_id->mv_id;
												}
												
												if($sub_list->module_id == 47){
													$get_id = $db->get_row("select * from tbl_video");
													$module_id = $get_id->vid_id;
												}
												
												if($sub_list->module_id == 45){
													$get_id = $db->get_row("select * from tbl_copyright");
													$module_id = $get_id->room_id;
												}

												if($sub_list->module_id == 49){
													$get_id = $db->get_row("select * from tbl_other_settings");
													$module_id = $get_id->other_settings_id;
												}
												
												
												echo "<a style=\"background:#ededed;\" href=\"".INDEX_PAGE.urlencode($sub_list->slug)."&mode=edit&id=".$module_id."\"> &nbsp;".$sub_list->module_name."</a>";
											}
									
											//ELSE
											else{
												
												echo "<a style=\"background:#ededed;\" href=\"".INDEX_PAGE.urlencode($sub_list->slug)."\">&nbsp;".$sub_list->module_name."</a>";
											
											}
											
											//////////////////////////////////////////////////////////////////////////////////////////////////////////////	
												
											
												$get_sub_list = $db->get_results("select * from tbl_module where category_id = ".$sub_list->module_id." and activated = 1 order by module_order");			
												if($get_sub_list){
													
													echo "<ul class=\"nav nav-list\">";
												
													foreach($get_sub_list as $sub_list){
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
														?>
															<li>
																<a href="<?php echo INDEX_PAGE.urlencode($sub_list->slug)?>" ><i class="fa fa-newspaper-o fa-fw"></i><?php echo $sub_list->module_name; ?></a>
															</li>
														<?php
														}
													}
													
													echo "</ul>";
												
												}
												
											echo "</li>";	
											
											}
										}
										
										echo "</ul>";
									
									}
								
								echo "</li>";
								
								}
								
							}
						?>
				</ul>
			</div>
			
			<!----####################
			FOR MOBILE MENU 
			#####################----->
			
        </nav>
		
		


<?php
	
	$main_checker = 0;	
	
	switch ($page_option){
	
		case 'home':
			require('home.php');
			$main_checker++;
		break;
		
		case 'system-settings':
			$page_heading = "SYSTEM SETTINGS";
			$page_name = "system-settings";
			require(PATH_COMPONENTS.'system-settings.php');
			$main_checker++;
		break; 	
		
		case 'logoff':
			require(PATH_COMPONENTS.'login/logout.php');
			$main_checker++;
		break; 

	}
	/*
	
	// SYSTEM MODULE INCLUSIONS
	// directory path can be either absolute or relative
	$parent_path = './com/';
	// open the specified directory and check if it's opened successfully
	if ($parent = opendir($parent_path)) {
		// keep reading the directory entries 'til the end
		while (false !== ($file = readdir($parent))) {
			// just skip the reference to current and parent directory
			if ($file != "." && $file != "..") {
				if (is_dir($parent_path."/".$file)) {	
					if( file_exists($parent_path."/".$file."/main.php") ){	
						include($parent_path."/".$file."/main.php");
					}
				}	
			}
		}
		// ALWAYS remember to close what you opened
		closedir($parent);
	}
	
	if($main_checker==0){
	
		require('home.php');
	}
	*/
	
	
	if($_SESSION[WEBSITE_ALIAS]["user"]){
	
		$parent_path = 'com/';
		
		if($page_option ==''){
		
			$file	=	PATH_COMPONENTS."home.php";
			$page	=	"home";
			
		}else{
		
			$file	=	BASE_URL.$parent_path.$page_option."/main.php";
			
		}
		$file_headers = @get_headers($file);

		if($file_headers[0] == 'HTTP/1.1 404 Not Found') {
			$exists = false;
			require_once($parent_path."404.php");
			
		}else {
			//echo $page_option;
			$exists = true;
			require_once($parent_path.$page_option."/main.php");

		}
	
	}else{
		
		require(PATH_COMPONENTS.'login/login.php');
	
	}

?>

</div>



