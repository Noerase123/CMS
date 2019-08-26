// CHECK BOX FLEXI GRID
// alert('teSt');
function checkrow(id){
		if ($('#checkbox_'+id).attr('checked')) {
			$('tr#row'+id).attr('class', 'trSelected');
		}else{
			$('tr#row'+id).attr('class', '');
			
		}
	}

function checkall(check_all){
	var is_checked = check_all.checked;
	if(is_checked){
		$('.cr_checkbox').attr('checked', true);
		ButtonAction("SELECT ALL");
	}else{
		$('.cr_checkbox').attr('checked', false);
		ButtonAction("DESELECT ALL");
	}
}

/*
	IMAGE GALLERY V1.0
*/
var counter = 0; 

function imageaction(tablename,type,ref_id,limit,upload_dir,gallery_mode){

	$('#sort_order'+counter).val(10);
	counter++;
	
	// VALIDATE # OF FILES TO UPLOAD
	if(counter==limit){
		$('#btn_addimage').hide();
	}else{
		$('#btn_addimage').show();
	}
	alert('test');
	$.get('com/imagegallery/image-gallery-ajax.php', {
		tablename: tablename,
		type: type,
		ref_id: ref_id,
		limit: limit,
		counter: counter,
		upload_dir: upload_dir,
		gallery_mode: gallery_mode,
	},function(data){
		$('#gallery_form').hide();
		$('#gallery_form').append(data);							
		$('#gallery_form').fadeIn(300);
		
	});
	
	//$('#btn_cancelimageupload').show();
	$('#required_image_size_note').show();
	
}
var countr = 0;
function edit_image(tablename, id, gallery_mode){
	countr++;	$('#edit'+id).hide();
	$.get('com/imagegallery/image-gallery-ajax.php', {
		tablename: tablename,
		id: id,
		gallery_mode: gallery_mode,
		countr: countr,
	},function(data){
		$('#gallery_form').hide();
		$('#gallery_form').append(data);							
		$('#gallery_form').fadeIn(300);
		
	});
	
}

function delete_image(tablename, id, gallery_mode){
	
	var conf = confirm("Press Ok to Delete the Image.");
	
	if(conf){
		$.get('com/imagegallery/image-gallery-ajax.php', {
			tablename: tablename,
			id: id,
			gallery_mode: gallery_mode
		},function(data){
			$('#row'+data).fadeOut(300);
		});
	}else{
	
	}
	
}

/*
	ROOM ALLOCATION V1.0
*/ 

function incrementvalue(id,maxval){
	var currentvalue = parseInt($('#'+id).val());
	currentvalue++;
	if (currentvalue<=maxval){
		$('#'+id).val(currentvalue);
	}else{
		alert('Value is greater than maximum available.');
	}
}

function decrementvalue(id){
	var currentvalue = parseInt($('#'+id).val());
	currentvalue--;
	if(currentvalue!=-1){
		$('#'+id).val(currentvalue);
	}
}

function incrementvalueb(id,alid,reid,res){
	var currentvalue = parseInt($('#'+id).val());
	var maxvalue = parseInt($('#'+alid).val()) - res;
		currentvalue++;
	if(currentvalue <= maxvalue){
		$('#'+id).val(currentvalue);
	}else{
		alert('Number of blocked is greater than the Available Rooms.');
		return false;
	}
	
}
function decrementvalueb(id){
	var currentvalue = parseInt($('#'+id).val());
	currentvalue--;
	if(currentvalue!=-1){
		$('#'+id).val(currentvalue);
	}
}

function isNumberKey(evt){
	 var charCode = (evt.which) ? evt.which : event.keyCode
	
	 if (charCode == 46)
		return true;
	 if (charCode > 31 && (charCode < 48 || charCode > 57))
		return false;
	
	 
	 return true;
}

function calendar_changer(id,id,date){
	
}

function sort_gallery(tablename, id, gallery_mode, ref_id, type){
		$.get('com/imagegallery/image-gallery-ajax.php', {
			tablename: tablename,
			id: id,
			ref_id: ref_id,
			type: type,
			gallery_mode: gallery_mode
		},function(data){
			//location.reload(true);
		});

}function cancelimageupload(resct){	counter = resct;	$('.gallery-form-table').remove();	$('#btn_addimage').show();	$('.editimg').show();	$('#required_image_size_note').hide();}
