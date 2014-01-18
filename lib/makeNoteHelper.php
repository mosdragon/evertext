<?php

//assumes login info is already stored etc.
function saveToEvernote($messageBody, $groupName, $timeStamp, $authkey) {

//INSERT ALL AUTHORIZATION STUFF HERE!!

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

    $note = new Note();
    $note->title("text at " . $timeStamp);
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
        $notebook->title = "Evernote " . $groupName;
        $notebook->defaultNotebook = true;
        $noteStore->createNotebook($notebook);
        $note->notebookGUID = $notebook->GUID;
    }
    $noteStore->createNote($note);

}

?>
