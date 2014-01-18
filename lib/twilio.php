<?php
require_once(__DIR__.'/../config/config.php');
require_once(__DIR__.'/../api_lib/twilio-php-master/Services/Twilio.php');

function sendText($from, $to, $body) {
    global $config_twilio_sid, $config_twilio_token;
    
    $sid = $config_twilio_sid; // Your Account SID from www.twilio.com/user/account
    $token = $config_twilio_token; // Your Auth Token from www.twilio.com/user/account
    $client = new Services_Twilio($sid, $token);

    // Loops through array of recipients and send the message.
    for($x = 0; $x<sizeOf($to); $x++) {
        $message = $client->account->messages->sendMessage(
        $from, // From a valid Twilio number. Pranav's Twilio #: 9149404409
        $to[$x], // Text this number
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

