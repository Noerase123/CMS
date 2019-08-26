/*
$(document).ready(function(){
	$('#login_preloader').hide();		
	
	$("#frm_login").submit(function(){
		
		
		$(".login-output-message").text('Validating...').fadeIn(1000);
		
		
		var formData = new FormData(this);
		
		$.ajax({
			url: "com/login/login-process.php",
			type:"POST",
			data: formData,
			cache: false,
			contentType: false,
			processData: false,
			success: function(result) {
				if(result=='yes'){ //if correct login detail
					document.location='index.php?option=home';
					
				}else{
					
					$(".login-output-message").fadeTo(200,0.1,function()  {
						//Add message and change the class of the box and start fading
						$(this).html('Invalid Username/Password').fadeTo(900,1,function() { 
							//Redirect to secure page
						});	
					});
					
				}
				return false;
			},
			error: function() {
				return false;
				
			}
		});
		
		$('.login-dimmer1').fadeOut('fast');
		$('.login-dimmer2').fadeOut('fast');
		$('#login_preloader').hide();	
		$('#btn_login').fadeIn('fast');	
		return false; //Not to post the form physically
	});
		
});
*/