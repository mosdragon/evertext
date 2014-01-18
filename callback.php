<?php
	$tempString="";
	 foreach ($_POST as $columnName => $columnData) {
		$tempString = $tempString.$columnName.": ".$columnData."\n";
	 }
	 
	 file_put_contents("test.txt", $tempString);
	 
	 //header("content-type: text/xml");
    //echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
    <Message><?php echo $tempString; ?></Message>
</Response>
