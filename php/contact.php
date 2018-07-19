<?php

/*
 * ------------------------------------
 * Contact Form Configuration
 * ------------------------------------
 */
 
$to    = "test@surjithctly.in"; // <--- Your email ID here

/*
 * ------------------------------------
 * END CONFIGURATION
 * ------------------------------------
 */
 
$name  	 = $_REQUEST["name"];
$email 	 = $_REQUEST["email"];
$subject = $_REQUEST["subject"];
$message = $_REQUEST["message"];

if (isset($email) && isset($name)) {

		$website = "http://" . $_SERVER['SERVER_NAME'] . $_SERVER['REQUEST_URI']; 
		$headers = "MIME-Version: 1.0" . "\r\n";
		$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
		$headers .= "From: ".$name." <".$email.">\r\n"."Reply-To: ".$email."\r\n" ;
		$message     = "From: $name<br/> Email: $email <br/> Subject: $subject <br/>Message: $message <br><br> -- <br>This e-mail was sent from a contact form on $website";
	
   $mail =  mail($to, $subject, $message, $headers);
  if($mail)
	{
		echo 'success';
	}

else
	{
		echo 'failed';
	}
}

?>