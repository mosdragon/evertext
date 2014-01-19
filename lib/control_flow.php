<?php
function parse () {
// Constants defined for the keyword functionality created for texts
define('NEW',"@new");
define('INVITE',"@invite");
define('LEAVE',"@leave");
define('SAVE',"@save");
define('LOGIN',"@login");
// Condition for the do-while loop. Parses for keyword functionality and creates, invites,
// leaves, or saves the conversation.
// Where applicable, removes the already-parsed keyword and the argument it passed with it.
// Loop continues 



$msgArray = explode(" ", $msg);

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

}

?>
