<?php
	require_once(__DIR__."/mail/email.php");
	require_once(__DIR__.DIRECTORY_SEPARATOR."twilio.php");
	
	
	function mailExport($id) {
		$message = export($id);
		$email = getEmail($id);
		if($email === false) {
			return false;
		}
		$subject = "EverText Transcript";
		sendEmail($email, $message, $subject);
	}
?>