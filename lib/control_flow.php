<?php
require(__DIR__.DIRECTORY_SEPARATOR."parser_help.php")

// Constants defined for the keyword functionality created for texts
define('NEW',"@new");
define('INVITE',"@invite");
define('LEAVE',"@leave");
define('SAVE',"@save");

// Condition for the do-while loop. Parses for keyword functionality and creates, invites,
// leaves, or saves the conversation.
// Where applicable, removes the already-parsed keyword and the argument it passed with it.
// Loop continues 
$incomplete = true;

do {
    if (checkMsg($msg, INVITE) {
        invite($msg);
        $msg = removeChunk($msg, INVITE);

    } elseif (checkMsg($msg, LEAVE) {
        leaveConversation($groupName);
        $incomplete = false;

    } elseif (checkMsg($msg, SAVE) {
        saveToEvernote($msg, $groupName, $timeStamp, $authKey);
        $incomplete = false;

    } else {
        $incomplete = false;
    }
} while ($incomplete)

/*
if (checkMsg($msg, NEW)) {
       createConversation($msg);
       $msg = removeChunk($msg, NEW);
    } 
*/
?>