<?php

/**
* 
*/
class ControllerMail{

	public function send($dados) {

		require_once("../libs/PHPMailer/PHPMailerAutoload.php");

		$mail = new PHPMailer();

		$mail->CharSet = 'UTF-8';
		$mail->IsSMTP(); // telling the class to use SMTP
		$mail->Host      = 'smtp.ssentregas.com.br'; // SMTP server
		$mail->SMTPDebug = false; // enables SMTP debug information (for testing)
		// 1 = errors and messages
		// 2 = messages only

		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->SMTPSecure = false;                 // sets the prefix to the servier
		$mail->Port       = 587;                   // set the SMTP port for the GMAIL server
		$mail->Username   = "suporte@ssentregas.com.br";  // GMAIL username
		$mail->Password   = "Mudar_123";            // GMAIL password

		$mail->IsHTML(true);
		$mail->SetFrom($dados['from'][0],$dados['from'][1]);
		$mail->Subject = $dados['assunto'];
		$mail->MsgHTML($dados['mensagem']);
		$mail->AddAddress($dados['to'][0],$dados['to'][1]);

		return !$mail->Send() ? false : true;
	}
}