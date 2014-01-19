	<?php
	require_once __DIR__.'/evernoteFunctions.php';
	session_start();
	echo getUserEvernote($id);
	//$access = getUserEvernote($id);
	if (isset($_GET['action']) && $_GET['action'] == 'callback') {
        handleCallback();
    }
	if (!(isset($_SESSION['requestToken']))) {
	getTemporaryCredentials();
	}
	
	function generateEvernoteButton() { 
        return htmlspecialchars(getAuthorizationUrl());
    } ?>
