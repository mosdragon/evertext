<?php
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
if ($recipient == 999999999 ) { // INSERT CENTRAL HERE

    //if statement for whether it contains new
    if (strpos($body, NEW) === false ) { // contains new
        $to = array($sender);
        $invalidMssg = "sorry. no command found";
        sendMessage($recipient, $to, $invalidMssg);
    } else {    //does not contain new
       

    }

} else {    // is a group number
    if (strpos($body, "@") === false) {     // no commands
        sendToGroup (getConversationID($recipient), $body);
    } else {    // commands exist
        if (strpos($body, LEAVE) !== false) {
            leaveConversation(getConversationID($recipient), $sender);
        } else if (strpos($body, SAVE) !== false) {
            saveToEvernote($msg, $groupName, $timeStamp, $authKey);
        }
        while (strpos($body, INVITE) !== false) {
            $person = substr ($body, strpos($body, INVITE) + 8, (strpos(substr ($body, strpos($body, SAVE) + 8), " ") - strpos($body, INVITE) ) );
            $body = substr ($body, 0, strpos($body, INVITE) ) . substr($body, strpos($body, INVITE) + 8 );
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
