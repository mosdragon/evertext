<?php

//assumes login info is already stored etc.
//function saveToEvernote($messageBody, $groupName, $timeStamp, $authkey) {

//INSERT ALL AUTHORIZATION STUFF HERE!!
//
// A simple command-line Evernote API demo script that lists all notebooks in
// the user's account and creates a simple test note in the default notebook.
//
// Before running this sample, you must fill in your Evernote developer token.
//
// To run:
//   php EDAMTest.php
//

// Import the classes that we're going to be using
use EDAM\Types\Data, EDAM\Types\Note, EDAM\Types\Resource, EDAM\Types\Notebook, EDAM\Types\ResourceAttributes;
use EDAM\Error\EDAMUserException, EDAM\Error\EDAMErrorCode;
use Evernote\Client;

ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR . "../../lib" . PATH_SEPARATOR);
require_once 'autoload.php';

require_once 'Evernote/Client.php';

require_once 'packages/Errors/Errors_types.php';
require_once 'packages/Types/Types_types.php';
require_once 'packages/Limits/Limits_constants.php';

// A global exception handler for our program so that error messages all go to the console
function en_exception_handler($exception)
{
    echo "Uncaught " . get_class($exception) . ":\n";
    if ($exception instanceof EDAMUserException) {
        echo "Error code: " . EDAMErrorCode::$__names[$exception->errorCode] . "\n";
        echo "Parameter: " . $exception->parameter . "\n";
    } elseif ($exception instanceof EDAMSystemException) {
        echo "Error code: " . EDAMErrorCode::$__names[$exception->errorCode] . "\n";
        echo "Message: " . $exception->message . "\n";
    } else {
        echo $exception;
    }
}
set_exception_handler('en_exception_handler');

// Real applications authenticate with Evernote using OAuth, but for the
// purpose of exploring the API, you can get a developer token that allows
// you to access your own Evernote account. To get a developer token, visit
// https://sandbox.evernote.com/api/DeveloperToken.action
$authToken = "S=s1:U=8db95:E=14afb48ee04:C=143a397c207:P=1cd:A=en-devtoken:V=2:H=20816c4e9d695c40ad4b2df076c32808";

if ($authToken == "your developer token") {
    print "Please fill in your developer token\n";
    print "To get a developer token, visit https://sandbox.evernote.com/api/DeveloperToken.action\n";
    exit(1);
}

// Initial development is performed on our sandbox server. To use the production
// service, change "sandbox.evernote.com" to "www.evernote.com" and replace your
// developer token above with a token from
// https://www.evernote.com/api/DeveloperToken.action
$client = new Client(array('token' => $authToken));

$userStore = $client->getUserStore();

// Connect to the service and check the protocol version
$versionOK =
    $userStore->checkVersion("Evernote EDAMTest (PHP)",
         $GLOBALS['EDAM_UserStore_UserStore_CONSTANTS']['EDAM_VERSION_MAJOR'],
         $GLOBALS['EDAM_UserStore_UserStore_CONSTANTS']['EDAM_VERSION_MINOR']);
print "Is my Evernote API version up to date?  " . $versionOK . "\n\n";
if ($versionOK == 0) {
    exit(1);
}

$groupName = "groupss";
    $noteStore = $client->getNoteStore();
    $nameOfNotebook = "Evernote " . $groupName;
    $notebookGUID = "";

    // List all of the notebooks in the user's account
    $notebooks = $noteStore->listNotebooks();
    print "Found " . count($notebooks) . " notebooks\n";
    $notebookExists = false;
    foreach ($notebooks as $notebook) {
        print "    * " . $notebook->name . "\n";
        if ( strcasecmp ( $notebook->name, $nameOfNotebook) == 0) { //make the name groupname + notes or something
            $notebookExists = true;
            $notebookGUID = $notebook->GUID;
            break;
        }
    }

$timeStamp = "yoo";
$messageBody = "somethignelsee";
$hashHex = "23423";
    $note = new Note();
    $note->title = ("text at " . $timeStamp);
    $note->content =
        '<?xml version="1.0" encoding="UTF-8"?>' .
        '<!DOCTYPE en-note SYSTEM "http://xml.evernote.com/pub/enml2.dtd">' .
        '<en-note>text being saved' . $messageBody . '<br/>' .
        '<en-media type="image/png" hash="' . $hashHex . '"/>' .
        '</en-note>';

    if ($notebookExists) {
        //create a new note
        $note->notebookGUID = $notebookGUID;

    } else {
        //first create a new notebook
        $notebook = new Notebook();
        $notebook->name = "Evernote " . $groupName;
        $notebook->defaultNotebook = true;
        $noteStore->createNotebook($notebook);
        $note->notebookGUID = $notebook->GUID;
    }
    $noteStore->createNote($note);

//}

?>
