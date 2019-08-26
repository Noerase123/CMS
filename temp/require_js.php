<script type="text/javascript">
var BASE_URL	=	"<?php echo BASE_URL; ?>";
</script>
<!-- jQuery -->
<script src="<?php echo JS; ?>jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="<?php echo JS; ?>bootstrap.min.js"></script>

<!-- Metis Menu Plugin JavaScript -->
<script src="<?php echo JS; ?>metisMenu.min.js"></script>

<!-- Custom Theme JavaScript -->
<!--
<script src="dist/js/sb-admin-2.js"></script>
-->

<script type="text/javascript" src="<?php echo CKEDITORSOURCE."ckeditor.js";?>" language="Javascript"></script>
<script type="text/javascript" src="<?php echo DATEPICKER; ?>jquery-ui-1.8.16.custom.min.js"></script>
<script src="<?php echo JS ?>jquery.alphanumeric.js" type="text/javascript" language="Javascript"></script>
<!--
<script src="<?php echo JS ?>jquery.maskedinput-1.2.2.min.js" type="text/javascript" language="Javascript"></script>
-->
<script src="<?php echo JS ?>jquery.validate.min.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo JS ?>additional-methods.min.js" type="text/javascript" language="Javascript"></script>

<script src="<?php echo PATH_COMPONENTS?>login/function.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo JS; ?>additional.methods.js" type="text/javascript" language="Javascript"></script>
<script src="<?php echo JS;?>jscolor.min.js" type="text/javascript" language="javascript"></script>
<!-- DataTables JavaScript -->
<script src="<?php echo JS ?>jquery.dataTables.min.js"></script>
<script src="<?php echo JS ?>dataTables.bootstrap.min.js"></script>

<!-- Custom Theme JavaScript -->
<script src="<?php echo JS ?>sb-admin-2.js"></script>

<!-- Page-Level Demo Scripts - Tables - Use for reference -->
<script type="text/javascript">

//Gallery
$(document).ready(function(){
	$('#btn_cancelimageupload').hide();
	$('#btn_addimage').click(function(){
		$('#btn_cancelimageupload').show();
	});
	
});

$('#btn_cancelimageupload').click(function (){
	$('.ico-action').show();
	$('#required_image_size_note').hide();
	$(this).hide();
});

$('.ico-action').click(function (){
		$(this).hide();
		$('#btn_cancelimageupload').show();
		$('#required_image_size_note').show();
});
////////////////////////////////////////////////

function convertToSlug(value){
    return value.toLowerCase().replace(/[^\w ]+/g,'').replace(/ +/g,'-');
}

$("#slug").keyup(function(){
	var val = $(this).val();
	var slug_text = convertToSlug(val);
	//$("#slug").val(slug_text);
	
	$("#module_url").val("<?php echo BASE_URL; ?>"+slug_text);
	
});

	
function preloader(num){
	if(num > 0){
		$("#infopreloader").fadeIn();
	}else{
		$("#infopreloader").fadeOut();
	}
}

$(document).keydown(function(e) {
    if (e.keyCode == 27){ 
		alert("Escape Button disabled");
		return false
	
	};
});

$(document).ready(function() {
	
	
	//$("#module_url").val("<?php echo BASE_URL."home/"; ?>"+slug_text);
	
	$('#btnCancel').click(function () {
		location.href = '<?php echo INDEX_PAGE.$hyperlink; ?>';
	});
	$('#btnCancel2').click(function () {
		location.href = '<?php echo INDEX_PAGE.urlencode($page_name); ?>';
	});
	$('#dataTables-example').DataTable({
			responsive: true
	});
	preloader(0);
	
	$(".alphanumeric").alphanumeric({allow:" "});
	$(".email-format").alphanumeric({allow:"@_.-"});
	$(".alphanumericdashed").alphanumericdashed(); // 
	$(".numericplusopen").numericplusopen(); // 
	$(".numeric").numeric(); //1234567890
	$(".float").numeric({allow:"."}); //1234567890
	$(".contact_number").numeric({allow:"()- +/"}); //

	$(".disable-copy-paste").bind("paste", function(e){
	e.preventDefault();
	});
});
</script>