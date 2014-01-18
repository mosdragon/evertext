<?php
	$body = $_POST['Body'];
	$recipient = $_POST['To'];
	$sender = $_POST['From'];

	$msgArray = explode(" ", $body);

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
?>