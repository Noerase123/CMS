<?php
require ( 'config.php' );
$grid_id = $page_name;
$target_url = INDEX_PAGE.$page_option.'-m&mode=';
$url_addons = '';
$extra_query = '';
	for($ctr=1; $ctr<=41; $ctr++){
    	$sql_permission = mysql_query("SELECT * FROM tbl_permission WHERE module_id='".$ctr."' AND user_role_id='".$_SESSION[WEBSITE_ALIAS]['user_role_id']."' ");
		$row_permission = mysql_fetch_array($sql_permission);
		$module_id[$ctr] =  $row_permission['view'] > 0 ? '1' : '0';
		$add[$ctr] =  $row_permission['add'] > 0 ? '1' : '0';
		$edit[$ctr] =  $row_permission['edit'] > 0 ? '1' : '0';
		$delete[$ctr] =  $row_permission['delete'] > 0 ? '1' : '0';
		$export[$ctr] =  $row_permission['export'] > 0 ? '1' : '0';
		$print[$ctr] =  $row_permission['print'] > 0 ? '1' : '0';
	}

?>
<!-- FORM SEARCH BOX (START) -->

	<div class="customer-filter-list"><label style="margin-left:200px">Quick Access</label><ul style="margin-left:-50px"><li><a href="<?php echo INDEX_PAGE.$page_name?>&quick_access=number" <?php if ($_GET['quick_access'] == "number"){echo ' class="activated"';}?>>0-9</a></li><?php foreach(range('z','a') as $i){ if ($i == $_REQUEST['quick_access']){	echo '<li><a href="#" class="activated">'.$i.'</a></li>'; }else{ echo '<li><a href="'.INDEX_PAGE.$page_name.'&quick_access='.$i.'">'.$i.'</a></li>';} } ?><li><a href="<?php echo INDEX_PAGE.$page_name; ?>" <?php if ($_GET['quick_access'] == ""){echo ' class="activated"';}?> >All</a></li></ul></div>
	

<br style="clear:both">
<div style="margin-top:10px;margin-left:650px;height:50px">	
	<form action="" id="frm_customsearch"/>
	<table>
			<tr>
				
				<td>
					<b>Search for</b>
				</td>
				<td>&nbsp;</td>
				<td>
					<input type="text" id="search_field" class="fieldinp" name="search_field" style="width: 100px;" /> 
					<span class="fieldinp"  style="padding: 4px;"><b> in </b></span>
				
				
					<select id="filter_by" name="filter_by" class="fieldinp">
					
						<option value="">--Select--</option>
						  <option value="email">User Login Name</option>
						  <option value="email">User Email</option>
						  <option value="role">User Role</option>
						  <option value="activated">Activated</option>
						 
					</select>
				
					<input type="submit" id="btn_customsearch" name="btn_customsearch" class="show_btn" value="Search" />
				</td>
				
			</tr>
		
		</table>
	</form>
</div>	

<!-- FORM SEARCH BOX (END) -->

<!-- MESSAGE RESULTS (START) -->
<div class="system-message-wrapper">
	<?php if ( isset($_GET['a']) && $_GET['a'] != '' ) { ?><div class="system-message"><?php	if($helper->operation_msg($_GET['a'], $_GET['success'], "Record")=="System Function ERROR!"){ 	$alert_type = "alert";	}else{	$alert_type = "info";	}	?><div class="<?php echo $alert_type; ?>"><div class="message"><?php echo $helper->operation_msg($_GET['a'], $_GET['success'], "Record")?></div></div></div><?php } ?>
</div>
<!-- MESSAGE RESULTS (END) -->

<div class="clr"></div>
<?php echo $helper->init_grid($grid_id); ?>

<script type="text/javascript">
	$("#<?php echo $grid_id; ?>").flexigrid({
		url: '<?php echo PATH_COMPONENTS.$module.$page_name?>-list.php<?php if (isset($_GET['quick_access'])){ echo "?quick_access=".$_GET['quick_access'];}?>',
		dataType: 'json',
		colModel : [
			{display: '#', width : 20, align: 'center'},
			{display: '<input type="checkbox" class="checkbox" name="check_all" id="check_all" onClick="return checkall(this)">', width : 10, align: 'center'},
			{display: 'Action', width : <?php echo GRID_3COL ?>, align: 'center'},
			{display: 'Username', name : 'email_address', width : 300, sortable : true, align: 'center'},
			{display: 'Fullname', name : 'lastname', width : 240, sortable : true, align: 'center'},
			{display: 'User Role', name : 'user_role_name', width : 150, sortable : true, align: 'center'},
			{display: 'Activated', name : 'activated', width : 50, sortable : true, align: 'center'},
			{display: 'Last Updated', name : 'date_updated', width : 140, sortable : true, align: 'center'}
			],
		buttons : [
			<?php if($add[28] > 0){?>
			{name: 'ADD', bclass: 'add', onpress : ButtonAction},
			<?php } ?>
			<?php if($delete[28] > 0){?>
			{name: 'DELETE', bclass: 'delete', onpress : ButtonAction},
			{separator: true},
			<?php } ?>
			{name: 'ACTIVATE', bclass: 'activated', onpress : ButtonAction},
			{name: 'DEACTIVATE', bclass: 'deactivated', onpress : ButtonAction},
			{separator: true}
			],
		sortname: '<?php echo $fg_flexiconfig['sortname']?>',
		sortorder: '<?php echo $fg_flexiconfig['sortorder']?>',
		usepager: true,
		useRp: true,
		title: '<center><?php echo strtoupper($page_heading) ?></center>',
		rp: '<?php echo $fg_flexiconfig['rp']?>',
		width: '<?php echo $fg_flexiconfig['width']?>',
		height: '<?php echo $fg_flexiconfig['height']?>',
		multiSelect: true,
		onSubmit: addFormData
	});  
	<?php require(PATH_INCLUDES.'standard-actions.js.php'); ?>	
	<?php require(PATH_INCLUDES.'customsearch.js.php'); ?>					
</script>