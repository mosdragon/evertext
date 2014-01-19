<?php
require_once(__DIR__."/../lib/twilioDatabase.php");
$user = $_POST["number"];

if (getUserID($user)) {
    echo "yo dawg, you have an account.";
} else {
    echo "you funny, bro";
}


?>