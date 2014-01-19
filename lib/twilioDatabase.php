<?php
	require_once(__DIR__.DIRECTORY_SEPARATOR."database.php");
	
	function getNumber($userID) {
		global $db;
		
		try {
			$selectQuery = $db->prepare("SELECT `phone`, `id` FROM 'numbers' 
											WHERE `inUse` = 0");  
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC); 
			$conversations = array();
			if($row = $selectQuery->fetch()) {  		
				$id = $row['id'];
				$phone = $row['phone'];
				return $phone;
			} else {
				return false;
			}
			 
		} catch(PDOException $e) {  
			echo $e->getMessage();  
			return false;
		}  
	}
	
	function login($phone, $password) {
		$password = md5($password);
		global $db, $db_userTable;
		try {
			$data = array("phone" => $phone, "password" => $password);
			$selectQuery = $db->prepare("SELECT * FROM $db_userTable 
											WHERE `phone` = :phone AND `password` = :password");  
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			
			while($row = $selectQuery->fetch()) {
				return $row["id"];
			}
			
			return false;
			
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
		}  
	}
	function getUserConversations($userID) {
		global $db, $db_consTable;
		
		try {
			$selectQuery = $db->prepare("SELECT `id` FROM $db_consTable 
											WHERE `users` LIKE :id");  
			$data = array("id" => "%,".$userID.",%");
		
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC); 
			$conversations = array();
			while($row = $selectQuery->fetch()) {  		
				array_push($conversations, $row["id"]);
			}
			return $conversations;
		} catch(PDOException $e) {  
			echo $e->getMessage();  
			return false;
		}  
	}
	function updateUser($id,$name,$email,$password){
		global $db, $db_userTable;
		$id = checkEmpty($id);
		$email = checkEmpty($email);
		$name = checkEmpty($name);
		$password = md5(checkEmpty($password));
		
		try {
			$data = array( 'name' => $name, 'email' => $email,  
								'password' => $password, 'id' => $id);
			$updateQuery = $db->prepare("UPDATE $db_userTable SET `name` = :name, `email` = :email, `password` = :password
												WHERE `id` = :id");
			$response = $updateQuery->execute($data);
			if($response == 1) {
				return $db -> lastInsertId();
			} else {
				echo $response;
				return false;
			}
		} catch(PDOException $e) {  
			echo $e->getMessage();  
			return false;
		}  
	}
	
	function setUserName($id, $name) {
		global $db, $db_userTable;
		try {
			
			$data = array("id" => $id, "name" => $name);
			
			$updateQuery = $db->prepare("UPDATE $db_userTable SET `name` = :name
											WHERE `id`=:id");  
			$response = $updateQuery->execute($data);
			
			if($response == 1) {
				return true;
			} else {
				echo $response;
				return false;
			}
			
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
		}  			
	}
	function getEmail($id) {
		global $db, $db_userTable;
		try {
			$data = array("id" => $id);
			$selectQuery = $db->prepare("SELECT `email` FROM $db_userTable 
											WHERE `id` = :id");  
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			
			while($row = $selectQuery->fetch()) {
				if(!empty($row["email"])) return $row["email"];
			}
			
			return false;
			
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
		}  
	}
    function isUserRegistered ($number) {
        $id = getUserID($number);
        if ($id === false) {
            return false;
        } else {
            $email = getEmail($id);
            if ($email === false) {
				return false;
            }
        }
		return true;
    }
	
	function getUserPhone($id) {
		global $db, $db_userTable;
		try {
			$data = array("id" => $id);
			$selectQuery = $db->prepare("SELECT `phone` FROM $db_userTable 
											WHERE `id` = :id");  
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			
			while($row = $selectQuery->fetch()) {
				return $row["phone"];
			}
			
			return NULL;
			
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
		}  
	}
	
	function getUserEvernote($id) {
		global $db, $db_userTable;
		try {
			$data = array("id" => $id);
			$selectQuery = $db->prepare("SELECT `evernote` FROM $db_userTable 
											WHERE `id` = :id");  
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			
			while($row = $selectQuery->fetch()) {
				return $row["evernote"];
				
			}
			
			return NULL;
			
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
		}  
	}
	function setUserEvernote($id, $api) {
		global $db, $db_userTable;
		try {
			
			$data = array("id" => $id, "evernote" => $api);
			
			$updateQuery = $db->prepare("UPDATE $db_userTable SET `evernote` = :evernote
											WHERE `id`=:id");  
			$response = $updateQuery->execute($data);
			
			if($response == 1) {
				return true;
			} else {
				echo $response;
				return false;
			}
			
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
		}  			
	}
	
	function setConversation($conversationID, $users) {
		global $db, $db_consTable;
		try {
			$newUsers = ",";
			foreach($users as $user) {
				$newUsers = $newUsers . $user. ",";
			}
			if($newUsers == ",") {
				deleteConversation($conversationID);
			}
			
			$data = array("id" => $conversationID, "users" => $newUsers);
			
			$updateQuery = $db->prepare("UPDATE $db_consTable SET `users` = :users
											WHERE `id`=:id");  
			$updateQuery->execute($data);
			return $users;
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
		}  			
	}
	
	function joinConversation($conversationID, $userID) {
		global $db, $db_consTable;
		try {
			$users = getConversationUsers($conversationID);

			if(is_array($users) == false) {
				throw new Exception("Get Conversation Error.");
			}
			
			array_push($users, $userID);

			setConversation($conversationID, $users);
			return $users;
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
		}  			
	}
	
	function deleteConversation($id) {
		global $db, $db_consTable;
		try {
			$deleteQuery = $db->prepare("DELETE FROM $db_consTable WHERE `id`=:id");  
			$data = array("id" => $id);
			if($deleteQuery->execute($data) != 1) {
				echo "delete failed";
				return false;
			}
			return true;
		} catch(PDOException $e) {  
			echo $e->getMessage();  
		}  
	}
	function leaveConversation($conversationID, $userID) {
		global $db, $db_consTable;
		
		try {
			$users = getConversationUsers($conversationID);

			if(is_array($users) == false) {
				throw new Exception("Get Conversation Error.");
			}
			
			if (($key = array_search($userID, $users )) !== false) {
				unset($users[$key]);
			} else {
				throw new Exception("User not in the conversation");
			}

			setConversation($conversationID, $users);
			
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
		}  			
	}
	
    function getMakeID($phone) {
        $exists = getUserID($phone);
		echo $exists."hi";
        if ($exists === false) {
             return newUser($phone,"","","");
        } else {
            return $exists;
        }
    }
	
	function getUserID($phone) {
		global $db, $db_userTable;
		try {
			$selectQuery = $db->prepare("SELECT `id` FROM $db_userTable 
											WHERE `phone` = :phone");  
			$data = array("phone" => $phone);
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			while($row = $selectQuery->fetch()) {
				return $row["id"];
			}
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
		}  
		return false;
	}
	
	function getUserName($id) {
		global $db, $db_userTable;
		try {
			$selectQuery = $db->prepare("SELECT `name`, `email`, `phone` FROM $db_userTable 
											WHERE `id` = :id");  
			$data = array("id" => $id);
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			while($row = $selectQuery->fetch()) {
				if(empty($row["name"])==false) {
					return $row["name"];
				} else if(empty($row["email"])==false) {
					return strstr($row["email"], "@", true);
				} else if(empty($row["phone"])==false) {
					return $row["phone"];
				} else {
					return "Unknown";
				}
			}
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
			return "Unknown";
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
	function getConversationName($id) {
		global $db, $db_consTable;
		
		try {
			$selectQuery = $db->prepare("SELECT `name` FROM $db_consTable 
											WHERE `id` = :id");  
			$data = array("id" => $id);
		
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			while($row = $selectQuery->fetch()) {  		
				return $row["name"];
			}
		} catch(PDOException $e) {  
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
			$users = "," . $owner . ",";
			$data = array( 'number' => $number, 'name' => $name, 'owner' => $owner, 'users' => $users);
			$insertQuery = $db->prepare("INSERT INTO $db_consTable (`number`, `name`, `owner`, `users`) 
							VALUES (:number, :name, :owner, :users)");  
			
			$response = $insertQuery->execute($data);
			if($response == 1) {
				return $db -> lastInsertId();
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
	
	
	
	function newUser($phone,$name,$email,$password) {
		global $db, $db_userTable;
		$phone = checkEmpty($phone);
		$email = checkEmpty($email);
		$name = checkEmpty($name);
		$password =md5(checkEmpty($password));
		
		try {
			$data = array( 'name' => $name, 'email' => $email,  
								'password' => $password, 'phone' => $phone);
			$insertQuery = $db->prepare("INSERT INTO $db_userTable (`name`, `email`, `password`, `phone`) 
							VALUES (:name, :email, :password, :phone)");  			
			$response = $insertQuery->execute($data);
			if($response == 1) {
				return $db -> lastInsertId();
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
	function getAllUsers(){ 
		global $db, $db_userTable;
		try {
			$selectQuery = $db->prepare("SELECT `id`, `name`, `email`, `phone` FROM $db_userTable");  
			$selectQuery->execute();
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC); 
			
			while($row = $selectQuery->fetch()) {
				if(empty($row["name"])==false) {
					$users[$row["id"]] = $row["name"];
				} else if(empty($row["email"])==false) {
					$users[$row["id"]] = strstr($row["email"], "@", true);
				} else if(empty($row["phone"])==false) {
					$users[$row["id"]] = $row["phone"];
				} else {
					$users[$row["id"]] = "Unknown";
				}
			}
			
			return $users;
		}	catch(PDOException $e) {  
			echo $e->getMessage();  
			return false;
		}  
	}
	
	function export($id) {
		$conversations = getUserConversations($id);
		$messages = array();
		foreach ($conversations as $con) {
			$messages = getMessages($con);
			$string = "";
			for($x=0; $x<sizeOf($messages[0]); $x++) {
				$string = $string."<div class='sender'>".$messages[0][$x]. ": ".date("Y-m-d H:i:s", $messages[2][$x])." </div><div class='mes'>". $messages[1][$x] . "<div/><br />";
			}
		}
		return $string;
	}
	
	function getMessages($conversationID) {
		global $db, $db_messTable;
		try {
			$users = getAllUsers();
			$selectQuery = $db->prepare("SELECT * FROM $db_messTable 
											WHERE `conversation` = :conversation");  
			$data = array("conversation" => $conversationID);
			
			$selectQuery->execute($data);
			$selectQuery->setFetchMode(PDO::FETCH_ASSOC);  
			$messages = array();
			$messages[0] = array();
			$messages[1] = array();
			$messages[2] = array();
			while($row = $selectQuery->fetch()) {  
				array_push($messages[1], $row["message"]);
				array_push($messages[0], $users[$row["sender"]]);
				array_push($messages[2], strtotime($row["postTime"]));
			}
			return $messages;
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
