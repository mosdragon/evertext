<?php
	require_once(__DIR__."/../lib/twilioDatabase.php");
	if(isset($_POST["number"])){
		$number = $_POST["number"];
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
	$id = getUserID($number);
	if($id === false) {
	
	}
	
?>
<script type="text/javascript">alert("Nice! You're all set. Continue to the home page now." </script>