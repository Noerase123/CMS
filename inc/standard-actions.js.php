	// THIS FUNCTION IS FOR THE STANDARD ACTIONS
	function ButtonAction(com,grid){
		if (com=='DELETE')
		{
			if($('.trSelected',grid).length>0)
			{
				if(confirm('Delete ' + $('.trSelected',grid).length + ' record(s)?'))
				{
					var items = $('.trSelected',grid);
					var itemlist ='';
					for(i=0;i<items.length;i++) {
						itemlist+= items[i].id.substr(3)+",";
					}

					$.ajax 
					({
						type: "POST",
						dataType: "json",
						url: "<?php echo PATH_STANDARDACTIONS ?>delete.php?tn=<?php echo urlencode($crypt->encrypt($fg_flexiconfig['table_name']))?>&fn=<?php echo urlencode($crypt->encrypt($fg_flexiconfig['record_uid']))?>&mod_id=<?php echo $mod_id; ?>",
						data: "items="+itemlist,
						success: function(data) {
							if ( data.total_records > 0 ) {
								$('.system-message-wrapper').fadeOut(100);
								$('.system-message-wrapper').html('<div class="system-message"><div class="alert"><div class="message">'+data.result+'</div></div></div>');							
								$('.system-message-wrapper').fadeIn(300);
							}
							$("#<?php echo $grid_id?>").flexReload();
						}
					});
				}
			} else {
				alert("<?php echo $messages['fg']['sel_rec_delete']?>");
				return false;
			}
		}else if (com=='ADD'){
			location.href = '<?php echo $target_url?>add'
		}else if (com=='DEFAULT LISTING'){
			location.href = '<?php echo INDEX_PAGE.$page_option.$url_addons; ?>'
		}else if (com=='DEFAULT VIEW'){
			location.href = '<?php echo INDEX_PAGE.$page_option.$url_addons; ?>'
		}else if (com=='SELECT ALL'){
			$('.bDiv tbody tr',grid).addClass('trSelected');
		}else if (com=='DESELECT ALL'){
			$('.bDiv tbody tr',grid).removeClass('trSelected');
		}else if (com=='MOVE UP' || com=='MOVE DOWN' || com=='MOVE'){
			if($('.trSelected',grid).length>0){
				var items = $('.trSelected',grid);
				var exact_order = $('#moveto').val();
				if (items.length == 1) {
					var id = items[0].id.substr(3);
					$.get('<?php echo PATH_STANDARDACTIONS ?>sort_order.php', {
						id : id,
						column : '<?php echo $fg_flexiconfig['record_uid']; ?>',
						direction: com,
						exact_order: exact_order,
						extra_query: '<?php echo $extra_query ?>',
						table: '<?php echo $fg_flexiconfig['table_name']; ?>',
					},function(){
						$("#<?php echo $grid_id?>").flexReload();
					});
				}else{
					alert("You can only move 1 Item");
					$('.bDiv tbody tr',grid).removeClass('trSelected');
					$('.cr_checkbox').attr('checked', false);	
					
				}
			}else{
				alert("Please select 1 Item");	
			}
		}else if (com=='ACTIVATE' || com=='DEACTIVATE'){
			if($('.trSelected',grid).length>0){
				var items = $('.trSelected',grid);
				var itemlist ='';
				for(i=0;i<items.length;i++) {
					itemlist+= items[i].id.substr(3)+",";
				}
				
				if (items.length > 0) {
					$.get('<?php echo PATH_STANDARDACTIONS ?>batch_activation.php', {
						itemlist : itemlist,
						column : '<?php echo $fg_flexiconfig['record_uid']; ?>',
						action: com,
						table: '<?php echo $fg_flexiconfig['table_name']; ?>',
                        mod_id:'<?php echo $mod_id; ?>'
					},function(){
						$("#<?php echo $grid_id?>").flexReload();
					});
				}else{
					alert("Please select atleast 1 Item");	
					$('.bDiv tbody tr',grid).removeClass('trSelected');
					$('.cr_checkbox').attr('checked', false);	
				}
					
			}else{
				alert("Please select alteast 1 Item");	
			}
		}else if(com=='CLOSE'){
			location.href = '<?php echo INDEX_PAGE.'reservation-management'; ?>';
		
		}else if(com=='UPDATE'){
				
				var items = $('.allocation',grid);
				var itemlist ='';
				var allocationlist ='';
				var blockedlist ='';
				var dailyratelist ='';
								
				for(i=0;i<items.length;i++) {
					allocationlist+= parseInt($("#allocation_"+items[i].id.substr(11)).val())+",";
					blockedlist+= parseInt($("#blocked_"+items[i].id.substr(11)).val())+",";
					dailyratelist+= $("#dailyrate_"+items[i].id.substr(11)).val()+",";
					itemlist+= items[i].id.substr(11)+",";
					
				}
				if (items.length > 0) {
					$.get('<?php echo PATH_STANDARDACTIONS ?>updateallocation.php', {
						itemlist : itemlist,
						allocationlist: allocationlist,
						blockedlist: blockedlist,
						dailyratelist: dailyratelist,
						column : '<?php echo $fg_flexiconfig['record_uid']; ?>',
						action: com,
						table: '<?php echo $fg_flexiconfig['table_name']; ?>',
					},function(){
						$("#<?php echo $grid_id?>").flexReload();
					});
				}
		}else if(com=='EXPORT SELECTED'){
			
			var items = $('.trSelected',grid);
			var itemlist ='';
			if($('.trSelected',grid).length>0){
			
				for(i=0;i<items.length;i++) {
					itemlist+= items[i].id.substr(3)+",";
				}	
				
				if (items.length > 0){
					location.href = 'com/reservationmanager/reservation-to-excel.php?items='+itemlist;
				}
				
			}else{
				alert("Please select alteast 1 Item");
			}
			
		}else if(com=='PRINT SELECTED'){
			
			var items = $('.trSelected',grid);
			var itemlist ='';
			if($('.trSelected',grid).length>0){
			
				for(i=0;i<items.length;i++) {
					itemlist+= items[i].id.substr(3)+",";
				}	
				
				if (items.length > 0){
					window.open ('com/reservationmanager/reservation-list-print.php?items='+itemlist,'_blank');
				}
				
			}else{
				alert("Please select alteast 1 Item");
			}
			
		}
	
	}