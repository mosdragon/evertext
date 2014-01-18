<?php
	require_once(__DIR__.DIRECTORY_SEPARATOR."database.php");
	
	
	function getUserName($id) {
		global $db, $db_userTable;
		try {
			$selectQuery = $db->prepare("SELECT `name`, `username`, `email`, `phone` FROM $db_userTable 
											WHERE `id` = :id");  
			$data = array("id" => $id);
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			while($row = $selectQuery->fetch()) {
				if(empty($row["name"])==false) {
					return $row["name"];
				} else if(empty($row["username"])==false) {
					return $row["username"];
				} else if(empty($row["email"])==false) {
					return strstr($row["email"], "@", true);
				} else if(empty($row["phone"])==false) {
					return $row["phone"];
				} else {
					return 
				}
					
				
			}
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
			return false;
		}  
	}
	function getConversationUsers($id) {
		global $db, $db_consTable;
		try {
			$selectQuery = $db->prepare("SELECT `users` FROM $db_consTable 
											WHERE `id` = :id");  
			$data = array("id" => $id);
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			while($row = $selectQuery->fetch()) {  
				return array_filter(explode(",", $row["users"]));
			}
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
			return false;
		}  
		
	}
	
	function getConversationID($number) {
		global $db, $db_consTable;
		
		try {
			$selectQuery = $db->prepare("SELECT `id` FROM $db_consTable 
											WHERE `number` = :number");  
			$data = array("number" => $number);
		
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			while($row = $selectQuery->fetch()) {  		
				return $row["id"];
			}
		} catch(PDOException $e) {  
			echo $e->getMessage();  
			return false;
		}  
	}
	
	function createConversation($number, $name, $owner) {
		global $db, $db_consTable;
		
		try {
			$data = array( 'number' => $number, 'name' => $name, 'owner' => $owner);
			$insertQuery = $db->prepare("INSERT INTO $db_consTable (`number`, `name`, `owner`) 
							VALUES (:number, :name, :owner)");  
			
			$response = $insertQuery->execute($data);
			if($response == 1) {
				return true;
			} else {
				echo $response;
				return false;
			}
		} catch(PDOException $e) {  
			echo $e->getMessage();  
			return false;
		}  
	}
	
	function checkEmpty($in) {
		if(empty($in)) {
			return ;
		} else {
			return $in;
		}
	}
	
	
	
	function newUser($phone,$name,$email,$user,$password) {
		global $db, $db_userTable;
		$phone = checkEmpty($phone);
		$email = checkEmpty($email);
		$user = checkEmpty($user);
		$name = checkEmpty($name);
		$password = checkEmpty($password);
		
		try {
			$data = array( 'name' => $name, 'email' => $email, 'user' => $user, 
								'password' => $password, 'phone' => $phone);
			$insertQuery = $db->prepare("INSERT INTO $db_userTable (`name`, `email`, `username`, `password`, `phone`) 
							VALUES (:name, :email, :user, :password, :phone)");  			
			$response = $insertQuery->execute($data);
			if($response == 1) {
				return true;
			} else {
				echo $response;
				return false;
			}
		} catch(PDOException $e) {  
			echo $e->getMessage();  
			return false;
		}  
	}
	
	function postMessage($conversationID, $senderID, $message) {
		global $db, $db_messTable;
		try {
			$time = time();
			
			$data = array( 'conversation' => $conversationID, 'sender' => $senderID, 'message' => $message, 
								'postTime' => $time);
			$insertQuery = $db->prepare("INSERT INTO $db_messTable (`conversation`, `sender`, `message`, `postTime`) 
							VALUES (:conversation, :sender, :message, FROM_UNIXTIME(:postTime))");  
			//FROM_UNIXTIME($time
			$response = $insertQuery->execute($data);
			if($response == 1) {
				return true;
			} else {
				echo $response;
				return false;
			}
		} catch(PDOException $e) {  
			echo $e->getMessage();  
			return false;
		}  
	}
	
	/*
	function 
	$selectQuery = $db->prepare("SELECT `username`, `email` FROM $db_userTable WHERE username = :username OR email = :email");  
	$data = array( 'username' => $username,  'email' => $email ); 
	echo $selectQuery->execute($data); 
			
	$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			
	while($row = $selectQuery->fetch()) { 
	*/
?>