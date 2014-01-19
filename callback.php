<?php
require_once(__DIR__.'/lib/twilio.php');
require_once(__DIR__.'/lib/twilioDatabase.php');
define('NEW',"@new");
define('INVITE',"@invite");
define('LEAVE',"@leave");
define('SAVE',"@save");
define('LOGIN',"@login");
	$body = $_POST['Body'];
	$recipient = numberParse($_POST['To']);
	$sender = numberParse($_POST['From']);

	$msgArray = explode(" ", $body);


//logiicccc
//if statement for whether it is a central number
if ($recipient == $config_central_twilio_number ) { // INSERT CENTRAL HERE

    //if statement for whether it contains new
	if (strpos($body, constant("NEW")) === false ) {
    //if(true){
        $to = array($sender);
        $invalidMssg = "sorry. no command found";
        sendText($recipient, $to, $invalidMssg);
    } else {    //does contain new
        $dawords = explode(" ", strstr($body, "@new"));
        $groupname = "default Name";
        for ($af = 0; $af < sizeOf($dawords); $af ++ ) {
            if ($dawords[$af] == "@new"){
                $groupname = $dawords[$af+1];
                break;
            }
        }
		$groupPhone = 9149404409;
        createConversation($groupPhone, $groupname, getmakeID($sender)); 
		sendText($groupPhone, array($sender), "Group ".$groupname. " created.");

    }

} else {    // is a group number
	$conversationID = getConversationID($recipient);
	$senderID = getUserID($sender);
    postMessage($conversationID , $senderID, $body);
	$users = getConversationUsers (getConversationID($recipient));
    if (strpos($body, "@") === false) {     // no commands
        
		var_dump($users);
        if (isset($users)&&($key = array_search(getUserID($sender), $users)) !== false) {
            unset($users[$key]);
        }
		
		if(count($users)>0) {
			$tempString = getUserName($senderID) . ": ". $body;
			sendMessage($recipient, $users, $tempString);
		} else {
			sendText($recipient, array($sender), "Get some friends. :(");
		}
    } else {    // commands exist
        if (strpos($body, LEAVE) !== false) {
            leaveConversation(getConversationID($recipient), $senderID);
			$tempString = getUserName($senderID)." has left the conversation.";
			sendMessage($recipient, $users, $tempString);
			postMessage($conversationID, $senderID, $tempString);
        } else if (strpos($body, SAVE) !== false) {
			
            saveToEvernote($body, getConversationID($recipient), getUserID($sender));
			$tempString = getUserName($senderID) . ": ". $body;
			sendMessage($recipient, $users, $tempString);
        }
		$inviteList = array();
        if (strpos($body, INVITE) !== false) {
            $dawords = explode(" ", strstr($body, INVITE));
            for ($af = 0; $af < sizeOf($dawords); $af ++ ) {
                if ($dawords[$af] == INVITE){
                    $person = $dawords[$af+1];
					array_push($inviteList, invite($person, $conversationID, $recipient));
                }
            }
			$tempString = "";
			foreach($inviteList as $person) {
				$tempString = $tempString. ", " . getUserName($person);
			}
			$tempString = substr($tempString,2);
			
			if(sizeOf($inviteList) > 1) {
				$tempString = $tempString . " have been added to the group chat.";
			}	else	{
				$tempString = $tempString . " has been added to the group chat.";
			}
			
			sendMessage($recipient, $users, $tempString);
			postMessage($conversationID, $senderID, $tempString);
			
        }

    }
/*
    for($x = 0, $x<sizeof($msgArray);x++) {
        if($msgArray[x] == INVITE) {
            invite($msgArray[x+1]);
        }
        elseif($msgArray[x] == LEAVE) {
            leaveConversation($groupName);
            break;
        }
        elseif($msgArray[x] == SAVE) {
            saveToEvernote($msg, $groupName, $timeStamp, $authKey);
        } 
    }
	sentToAll($body, $sender);
*/
}


?>
