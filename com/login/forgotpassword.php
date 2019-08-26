<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title><?php echo WEBSITE_NAME?></title>
    <link rel="icon" href="images/favicon.ico" type="image/x-icon" />
    <link href="images/favicon.ico" rel="shortcut icon" type="image/x-icon" />
    <link href="<?php echo CSS?>core.css" rel="stylesheet" type="text/css" />
    <script src="<?php echo PLUGINS?>jquery/jquery.js" type="text/javascript" language="Javascript"></script>
    <script src="<?php echo VALIDATORS?>jquery.validate.js" type="text/javascript" language="Javascript"></script>
    <script src="<?php echo PATH_COMPONENTS?>login/forgotpassword.js" type="text/javascript" language="Javascript"></script>
</head>
<body>
    <div class="login-container"> 
        <div class="login-content"> 
            <div class="login-logo"><img src="img/company-logo-login.png"></div>
            <h2>Forgot Password?</h2>
            <p>Please enter your email address.</p>
            <div class="spacer10"></div>
            <form method="post" id="frm_forgotpassword" action="">
                <label>Email Address</label>
                <input type="text" class="input1" id="email" name="email" size="42" />
                <div class="spacer5"></div>
                <a href="index.php?option=login">Back to login?</a>
                <div class="spacer5"></div>
                <div class="login-button">
                	 <div id="login-indicator">
                        <span id="login-indicator-msg"></span>
                    </div>
                    <input class="btn-image" name="Login" type="image" value="Login" src="<?php echo IMAGES?>btn-forgot.png" alt="Login" />
                </div>
            </form>
        </div>
    </div>
</body>
</html>
