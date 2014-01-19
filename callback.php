<?php
require_once(__DIR__.'/lib/twilio.php');
require_once(__DIR__.'/lib/twilioDatabase.php');
define('NEW',"@new");
define('INVITE',"@invite");
define('LEAVE',"@leave");
define('SAVE',"@save");
define('LOGIN',"@login");
	$body = $_POST['Body'];
	$recipient = $_POST['To'];
	$sender = $_POST['From'];

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
       

    }

} else {    // is a group number
    if (strpos($body, "@") === false) {     // no commands
        $users = getConversationUsers (getConversationID($recipient));
		var_dump($users);
        if (isset($users)&&($key = array_search($sender, $users)) !== false) {
            unset($users[$key]);
        }
		
		if(count($users)>0) {

			sendText($recipient, $users, $body);
		} else {
			sendText($recipient, array($sender), "Get some friends. :(");
		}
    } else {    // commands exist
        if (strpos($body, LEAVE) !== false) {
            leaveConversation(getConversationID($recipient), getUserID($sender) );
        } else if (strpos($body, SAVE) !== false) {
            saveToEvernote($msg, $groupName, $timeStamp, $authKey);
        }
        while (strpos($body, INVITE) !== false) {
            strstr();
            $dawords = explode(" ", strstr($body, INVITE));
            for ($af = 0; $af < sizeOf($dawords); $af ++ ) {
                if ($dawords[af] == INVITE){
                    $person = $dawords[af+1];
                }
            }
            $body = strstr($body, INVITE) . strstr($person);
            invite($person);
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
