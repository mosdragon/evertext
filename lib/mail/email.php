<html>
<body>
<?php
include_once(__DIR__ . "/class.phpmailer.php");
include_once(__DIR__ . "/class.smtp.php");

function sendEmail($email, $message, $subject, $text="") {

	$mail             = new PHPMailer();

	$body             = $message;

	$mail->IsSMTP();
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->SMTPSecure = "ssl";                 // sets the prefix to the servier
	$mail->Host       = "smtp.gmail.com";      // sets GMAIL as the SMTP server
	$mail->Port       = 465;                   // set the SMTP port

	$mail->Username   = "evetest256@gmail.com";  // GMAIL username
	$mail->Password   = "evertech";            // GMAIL password

	$mail->From       = "evetest256@gmail.com";
	$mail->FromName   = "EverText Bot";
	$mail->Subject    = $subject;
	$mail->WordWrap   = 50; // set word wrap

	$mail->MsgHTML($body);

	$mail->AddAddress("$email");

	$mail->IsHTML(true); // send as HTML
	$mail->AddReplyTo("evetest256@gmail.com","EverText");

	if(!$mail->Send()) {
		echo "Mailer Error: " . $mail->ErrorInfo;
		return false;
	} else {
		return true;
	}
}

?>
</body>
</html>