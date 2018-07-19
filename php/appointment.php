<?php

/*
 * ------------------------------------
 * Reservation Form Configuration
 * ------------------------------------
 */
 
$to    			= "test@surjithctly.in"; // <--- Website Admin email ID here

/*
 * ------------------------------------
 * END CONFIGURATION
 * ------------------------------------
 */
 
$name     = $_POST["name"];
$email    = $_POST["email"];
$website  = (isset($_SERVER['HTTPS']) ? "https" : "http") . "://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (isset($email) && isset($name)) {
    $subject  = "New Appointment from $name"; // <--- Change Email Subject here.
	$headers  = "MIME-Version: 1.0" . "\r\n";
	$headers .= "Content-type:text/html;charset=iso-8859-1" . "\r\n";
	$headers .= "From: ".$name." <".$email.">\r\n"."Reply-To: ".$email."\r\n" ;
	$msg      = 'Hello Doctor, <br/> <br/> Here are the Appointment details:';
	$msg     .= ' <br/> <br/> <table border="1" cellpadding="6" cellspacing="0" style="border: 1px solid  #eeeeee;">';
	foreach ($_POST as $label => $value) {
	    $msg .= "<tr><td width='100'>". ucfirst($label) . "</td><td width='300'>" . $value . " </tr>";
	}
	$msg      .= " </table> <br> --- <br>This e-mail was sent from $website";
	 
	$mail =  mail($to, $subject, $msg, $headers);

	/* Please do not change the values below. */
	if($mail) {
			echo 'success';
	} else {
			echo 'failed';
	}

} // END isset

?>