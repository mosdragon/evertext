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
        createConversation($groupPhone,$groupname, getmakeID($sender)); 
		sendText($groupPhone, array($sender), "Group ".$groupname. " created.");

    }

} else {    // is a group number
	$conversationID = getConversationID($recipient);
    postMessage(getConversationID($recipient), getUserID($sender), $body);
    if (strpos($body, "@") === false) {     // no commands
        $users = getConversationUsers (getConversationID($recipient));
		var_dump($users);
        if (isset($users)&&($key = array_search(getUserID($sender), $users)) !== false) {
            unset($users[$key]);
        }
		
		if(count($users)>0) {

			sendMessage($recipient, $users, $body);
		} else {
			sendText($recipient, array($sender), "Get some friends. :(");
		}
    } else {    // commands exist
        if (strpos($body, LEAVE) !== false) {
            leaveConversation(getConversationID($recipient), getUserID($sender) );
            // add has left convo
        } else if (strpos($body, SAVE) !== false) {
            saveToEvernote($msg, $groupName, $timeStamp, $authKey);
        }
		$inviteList = array();
        if (strpos($body, INVITE) !== false) {
            $dawords = explode(" ", strstr($body, INVITE));
            for ($af = 0; $af < sizeOf($dawords); $af ++ ) {
                if ($dawords[$af] == INVITE){
                    $person = $dawords[$af+1];
					array_push($inviteList, $person);
					invite($person, $conversationID, $recipient);
                }
            }
            // add __ has joined
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
