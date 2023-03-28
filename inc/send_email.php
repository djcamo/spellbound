<?php
	$name=stripslashes($_POST["name"]);
    $email=stripslashes($_POST["email"]);
    $phone=stripslashes($_POST["phone"]);
	$message=stripslashes($_POST["message"]);
	$secret="6LfumX4UAAAAANvTptoSr8J5W6rj3vcNpY1K7mjz";
	$response=$_POST["captcha"];
	$verify=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$secret}&response={$response}");
	$captcha_success=json_decode($verify);
	var_dump($captcha_success->success);
	if ($captcha_success->success==false) {
		return false;
	}
	else if ($captcha_success->success==true) {
		$to = 'djcamo@internode.on.net';
	    $subject = 'New contact form have been submitted';
	    $htmlContent = "
	        <h3>Contact request details</h3>
	        <p><b>Name: </b>".$name."</p>
            <p><b>Email: </b>".$email."</p>
            <p><b>Phone: </b>".$phone."</p>
	        <p><b>Message: </b>".$message."</p>
	    ";
	    $headers = "MIME-Version: 1.0" . "\r\n";
	    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
	    $headers .= 'From:'.$name.' <'.$email.'>' . "\r\n";
	    @mail($to,$subject,$htmlContent,$headers);
		return true;	
	}