<?php
	require_once(__DIR__.DIRECTORY_SEPARATOR."..".DIRECTORY_SEPARATOR."lib".DIRECTORY_SEPARATOR."twilioDatabase.php");
	
	//$id = createConversation("4048893664", "EVERTEXT", "1");
	//echo $id;
	$id = 7;
	$userID = 2;
	$number = "9149404409";
	$name = "Pranav";
	$owner = 2;
	
	newUser("9149404409","Pranav","pranavmkshenoy@gmail.com","schoolz");
	createConversation($number, $name, $owner);
	
	//setUserEvernote($userID, "asdfhajkldsfh");
	//echo getUserEvernote($userID);
	//leaveConversation($id, 1);
	//leaveConversation($id, $userID);
	//joinConversation($id, $userID );
	//echo getUserName(1);
	//var_dump( getConversationUsers($id));
	//postMessage(6, 3, "HELLO");
	
	?>