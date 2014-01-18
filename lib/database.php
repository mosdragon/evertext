<?php
	require_once(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."config".DIRECTORY_SEPARATOR."config.php");
	
	try { 
		$db = new PDO("mysql:host=$db_server", $db_username, $db_password);
		$db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	} catch(PDOException $e) {  
		echo $e->getMessage();  
	}  
	
	//$selectQuery = $db->prepare("SELECT `username`, `email` FROM $db_userTable WHERE username = :username OR email = :email");  
	//$data = array( 'username' => $username,  'email' => $email ); 
	//echo $selectQuery->execute($data); 
			
	//$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			
	//while($row = $selectQuery->fetch()) {  
?>