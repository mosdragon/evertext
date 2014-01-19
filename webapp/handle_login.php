<?php
if(isset($_POST["phone"])){
		$phone = $_POST["phone"];
	}
if(isset($_POST["password"])){
	$password = $_POST["password"];
}
$id = login($phone,$password);

if($id === false) {
	echo"wrong login info";
	echo '<META http-equiv="refresh" content="5;URL=index.php">';
} else {
setcookie("id", $id, time()+3600 * 24); 
	echo '<META http-equiv="refresh" content="0;URL=splash.php">';
}
$given = $_POST["name"];
?>
<script type="text/javascript">alert("Nice! You're all set. Continue to the home page now." </script>