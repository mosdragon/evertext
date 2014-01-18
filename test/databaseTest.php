<?php
	require_once(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR."twilioDatabase.php");
	
	//$id = createConversation("4048893664", "EVERTEXT", "1");
	//echo $id;
	$id = 7;
	$userID = 2;
	leaveConversation($id, 1);
	//leaveConversation($id, $userID);
	//joinConversation($id, $userID );
	//echo getUserName(1);
	//var_dump( getConversationUsers($id));
	//postMessage(6, 3, "HELLO");
	//newUser("4048893664","","ashaw596@gmail.com","school");
	?>