<div class="container">
	<div class="row">
		<div class="col-md-4 col-md-offset-4">
			<div class="login-panel panel panel-default">
				<div class="panel-heading">
					<h3 class="panel-title">Please Sign In</h3>
				</div>
				<div class="panel-body">
					<!--<form role="form">-->
					<form action="" id="frm_login" method="post" role="form">
						<input type="hidden" name="type" value="<?php echo isset($_REQUEST["type"]) && $_REQUEST["type"] == 2 ? "2" : "1"; ?>" />
						<fieldset>
							<div class="form-group">
								<input class="form-control email-format" placeholder="E-mail" name="username" id="username" type="email" autofocus>
							</div>
							<div class="form-group">
								<input class="form-control" placeholder="Password" name="password" id="password" type="password" value="">
							</div>
						
							<input type="submit" class="btn btn-lg btn-success btn-block" value="Login" />
							<div class="form-group nomargin-bottom">
								<p class="login-output-message mt10"></p>
							</div>
						</fieldset>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>



<?php

require(PATH_TEMPLATES.'require_js.php');

?>


<script type="text/javascript">
$(document).ready(function() {
	

	$('#frm_login').validate({
		  rules: {
				
			  username: {
				 
				  required	:	true,
				  email		:	true,
				  maxlength	: 	50
			  },
			  password: {
				  required	:	true,
				  maxlength	: 	50
			  }
			  
		  },
		  messages: {
			
			  username: {
				  required	:	"Please fill in this Username field."
			  },
			  password: {
				  required	:	"Please fill in this Password field."
			  }
		  },
		  submitHandler: function(form) {
			
			$(".login-output-message").text('Validating...').fadeIn(1000);
		
			
			var formData = new FormData(form);
			
			$.ajax({
				url: "com/login/login-process.php",
				type:"POST",
				data: formData,
				cache: false,
				contentType: false,
				processData: false,
				success: function(results) {
					
					var results = JSON.parse(results);
					//console.log(results);
					preloader(0);
					
					
					switch(results.result){
						case "error":
							
							var error_message = results.error_message;
							
							$(".login-output-message").fadeTo(200,0.1,function()  {
								//Add message and change the class of the box and start fading
								$(this).html(error_message).fadeTo(900,1,function() { 
									//Redirect to secure page
								});	
							});
						break;
						case "success":
							document.location='index.php?option=home';
						break;
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
		
			
				
		}
	});
	
	
	
	
	
	
	
});

</script>