<?php
	require_once(__DIR__."/../lib/twilioDatabase.php");
	if(isset($_POST["phone"])){
		$phone = $_POST["phone"];
	}
	if(isset($_POST["password"])){
		$password = $_POST["password"];
	}
	if(isset($_POST["name"])){
		$name = $_POST["name"];
	}
	if(isset($_POST["email"])){
		$email = $_POST["email"];
	}
	$id = getUserID($phone);
	if($id === false) {
		newUser($phone,$name,$email,$password);
	} else {
		updateUser($id,$name,$email,$password);
	}
	
	echo '<META http-equiv="refresh" content="0;URL=splash.php">';
	
?>
<script type="text/javascript">alert("Nice! You're all set. Continue to the home page now." </script>