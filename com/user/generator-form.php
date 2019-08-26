<style type="text/css">
.pass_generator_form{
	float		: left;
	height		: 230px;
	width		: 250px;
	overflow	: hidden;
	background	: #000;
	color		: #fff;
	padding		: 6px;
}
#passwordStrength, .strength0, .strength1, .strength2, .strength3, .strength4, .strength5{
	float		: left;
	height		: 10px;
	width		: 100%;
}
.strength0{
	background:#cccccc;
}
.strength1{
	background:#ff0000;
}
.strength2{
	background:#ff5f5f;
}
.strength3{
	background:#56e500;
}
.strength4{
	background:#4dcd00;
}
.strength5{
	background:#399800;
}
</style>

<script type="text/javascript">
$(document).ready(function() {
	$("#pass_generator").click(function() {
		var desc = new Array();
		desc[0] = "Very Weak (0/100)";
		desc[1] = "Weak (20/100)";
		desc[2] = "Better (40/100)";
		desc[3] = "Medium (60/100)";
		desc[4] = "Strong (80/100)";
		desc[5] = "Strongest (100/100)";
		var genpass =$('#generator_password').val();
		var score   = 0;

		//if password bigger than 6 give 1 point
		if (genpass.length > 6) score=1;
		//if password has both lower and uppercase characters give 1 point	
		if ( ( genpass.match(/[a-z]/) ) && ( genpass.match(/[A-Z]/) ) ) score=2;
		//if password has at least one number give 1 point
		if (genpass.match(/\d+/)) score=3;
		//if password has at least one special caracther give 1 point
		if ( genpass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) )	score=4;
		//if password bigger than 12 give another 1 point
		if (genpass.length > 12) score=5;

		$('#passwordDescription').html(desc[score]);
		$('#passwordStrength').addClass('strength'+score);
	});
	function password_status() {
		var desc = new Array();
		desc[0] = "Very Weak (0/100)";
		desc[1] = "Weak (20/100)";
		desc[2] = "Better (40/100)";
		desc[3] = "Medium (60/100)";
		desc[4] = "Strong (80/100)";
		desc[5] = "Strongest (100/100)";
		var genpass =$('#generator_password').val();
		var score   = 0;

		//if password bigger than 6 give 1 point
		if (genpass.length > 6) score=1;
		//if password has both lower and uppercase characters give 1 point	
		if ( ( genpass.match(/[a-z]/) ) && ( genpass.match(/[A-Z]/) ) ) score=2;
		//if password has at least one number give 1 point
		if (genpass.match(/\d+/)) score=3;
		//if password has at least one special caracther give 1 point
		if ( genpass.match(/.[!,@,#,$,%,^,&,*,?,_,~,-,(,)]/) )	score=4;
		//if password bigger than 12 give another 1 point
		if (genpass.length > 12) score=5;

		$('#passwordDescription').html(desc[score]);
		$('#passwordStrength').addClass('strength'+score);
	}
})

	var button_gen 		= document.getElementById('pass_generator');
	
	var lower_case 		= document.getElementById('lowercase');
	var upper_case 		= document.getElementById('uppercase');
	var number_field 	= document.getElementById('number');
	var symbol_field 	= document.getElementById('symbol');
	
	var pass_use = document.getElementById('pass_use');
	
	var password = document.getElementById('password');
	var confirm_password = document.getElementById('confirm_password');
	
	var passwd = $("#generator_password").val();
	var length_password = $("#length_password").val();
	
	length_password.onchange = function(){
		
	  if ($("#length_password").val() <= 5){
		alert("Password length must be equal to and greater than to 6!");
	  }else{
		password.value = $("#generator_password").val();
		document.getElementById('fancybox-wrap').style.display ="none";
		document.getElementById('fancybox-overlay').style.display ="none";		
	  }
	}
	
	pass_use.onclick = function(){
	  if ($("#length_password").val() <= 5){
		alert("Password length must be equal to and greater than to 6!");
	  }else{
		password.value = $("#generator_password").val();
		confirm_password.value = $("#generator_password").val();
		document.getElementById('fancybox-wrap').style.display ="none";
		document.getElementById('fancybox-overlay').style.display ="none";		
	  }
	}
	
	button_gen.onclick = function(){
	
		
	
	//$('.password').pstrength();
	//alert(length_password);
	if ($("#length_password").val() < 6){
		alert("Password length must be equal to and greater than to 6!");
	}else{
		if(upper_case.checked == true){
			if(lower_case.checked == true){
				if(number_field.checked == true){
					if(symbol_field.checked == true){
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?all=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}else{
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?nosymbol=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}
				}else{
					if(symbol_field.checked == true){
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?nonumber=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
						
					}else{
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?nonumberandsymbol=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}
				}
			}else{
				if(number_field.checked == true){
					if(symbol_field.checked == true){
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?all_tw=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}else{
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?num_up=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}
					
				}else{
					if(symbol_field.checked == true){
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?uppercasesymbolsonly=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}else{
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?uppercaseonly=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}
				}
			}
				
		}else{
			if(lower_case.checked == true){
				if(number_field.checked == true){
					if(symbol_field.checked == true){
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?all_t=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}else{
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?lowercaseandnumberonly=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}
				}else{
					if(symbol_field.checked == true){
						$.ajax({
							type: "GET",						  
							url: "com/password-generator.php?onlylowercaseSymbol=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}else{
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?onlylowercase=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}
				}
			}else{
				if(number_field.checked == true){
					if(symbol_field.checked == true){
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?nouppercaseandlowercase=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
						
					}else{
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?onlynumber=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
					}
				}else{
					if(symbol_field.checked == true){
						$.ajax({
							type: "GET",						  
							url: "com/user/password-generator.php?symbolsonly=true&length=" + $("#length_password").val(),
							success: function(msg){	$("#generator_password").val(msg);	}
						});
						
					}else{
						alert("Please check atleast one of the option!");
					}
				}
			}
		}
				
	}
}
</script>
<div class="pass_generator_form">
	<div style="font-weight:bold;font-size:13px;align:center;text-align:center;margin-bottom:10px;">PASSWORD GENERATOR</div>
	<div style="float:left; height: auto; width:100%;">
		<div class="gen_left">
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td align="center">
						<input type="text" class="password" style="width:150px; text-align:center;" id="generator_password" name="generator_password" value="" onkeyup="password_status_change()"/>
						<input type="button" id="pass_generator" value="GENERATE" class="button" style="background: #000;"/>
					</td>
				</tr>
				<tr>
					<td align="center" style="padding-top: 5px;">
						<font style="font: normal 11px arial;">Password Strength</font><br/>
						<div id="passwordDescription" style="font-weight:bold;padding-top;5px;">Very Weak (0/100)</div>
						<div id="passwordStrength" class="strength0"></div>
					</td>
				</tr>
			</table>
		</div>
		<div class="gen_right">
			<table width="100%" cellspacing="0" cellpadding="0">
				<tr>
					<td align="left" style="padding-bottom:5px;">Uppercase</td>
					<td align="center" style="padding-bottom:5px;"><input type="checkbox" id="uppercase" /></td>
				</tr>
				<tr>
					<td align="left" style="padding-bottom:5px;">Lowercase</td>
					<td align="center" style="padding-bottom:5px;"><input type="checkbox" id="lowercase"/></td>
				</tr>
				<tr>
					<td align="left" style="padding-bottom:5px;">Numbers</td>
					<td align="center" style="padding-bottom:5px;"><input type="checkbox" id="number"/></td>
				</tr>
				<tr>
					<td align="left" style="padding-bottom:5px;">Symbols</td>
					<td align="center" style="padding-bottom:5px;"><input type="checkbox" id="symbol"/></td>
				</tr>
				<tr>
					<td align="left" style="padding-bottom:5px;">Password Length</td>
					<td align="center" style="padding-bottom:5px;"><input type="text" id="length_password" value="12" maxlength="2" style="width:30px; text-align: center;"/></td>
				</tr>
			</table>
		</div>
	</div>
	<div style="width:100%; display: block; text-align: center; padding: 5px 0px 5px 0px;">
		<input type="button" id="pass_use" value="USE PASSWORD" class="button" style="background: #000;" onclick="password_status_change()"/>
	</div>
</div>