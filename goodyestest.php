<?php
function sendText ($from, $to, $body)

// Install the library via PEAR or download the .zip file to your project folder.
// This line loads the library
//require('/path/to/twilio-php/Services/Twilio.php');
require('/api_lib/twilio-php-master/Services/Twilio.php');

$sid = "ACb6da7e66ee47b598e53735fdc209bcd1"; // Your Account SID from www.twilio.com/user/account
$token = "4020b1c25d6a320ad78560ae857be064"; // Your Auth Token from www.twilio.com/user/account

$client = new Services_Twilio($sid, $token);
$message = $client->account->messages->sendMessage(
  '9149404409', // From a valid Twilio number
  '6786567476', // Text this number
  "Hello yo!"
);
