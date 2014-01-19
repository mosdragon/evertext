<?php
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../api_lib/twilio-php-master/Services/Twilio.php');
require_once(__DIR__."/twilioDatabase.php");
require_once(__DIR__."/evernoteFunctions.php");

function sendMessage($from, $to, $body) {
	$users = array();
	foreach($to as $id) {
		array_push($users, getUserPhone($id));
	}
	sendText($from, $users, $body);
}

function saveToEvernote($message, $groupNam, $auth) {
		makeNote($message,$groupNam,$auth);
	}

function invite($phoner, $convoID, $groupNumber) {
    $id = getUserID($phoner);
    if ($id === false) {
        newUser($phoner,"","","");
    } else {
        joinConversation($convoID, $id);
    }
    sendText($groupNumber,array($phoner), "You have been added to group chat" . getConversationName($convoID) . "!!");
}

//initial condition is that 
//number starts with +1 and may or may not have dashes
function numberParse($number) {
    $number = preg_replace('/\D/', '', $number);
    if (strlen($number) > 10) {
        $number = substr($number, strlen($number) -10);
    }
    return $number;
}

function sendText($from, $to, $body) {
    global $config_twilio_sid, $config_twilio_token;
    
    $sid = $config_twilio_sid; // Your Account SID from www.twilio.com/user/account
    $token = $config_twilio_token; // Your Auth Token from www.twilio.com/user/account
    $client = new Services_Twilio($sid, $token);

    // Loops through array of recipients and send the message.
    foreach($to as $t) {
        $message = $client->account->messages->sendMessage(
        $from, // From a valid Twilio number. Pranav's Twilio #: 9149404409
        $t, // Text this number
      $body); // Body of the Message Sent
    }
}
/*
Test Code:

$me = "9149404409";
$them = "4043981208 6786567476";
$sendArray = explode(" ", $them);
$body = "I am iron man. Don't deny it";
sendText($me, $sendArray, $body);
*/

