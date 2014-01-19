 <?php
 $id = $_COOKIE["id"];
 require_once 'htmlfunc.php';
 require_once(__DIR__."/../lib/twilioDatabase.php");
 require_once(__DIR__."/../lib/evernoteSignIn.php");


 
 function wantAuthKey() {
  global $id;
  $api = getUserEvernote($id);
  //echo $id;
  //echo $api;
  if (empty($api)) { ?>
    <h4>Uh-Oh</h4><br/>
    <p> Looks like we need your authorization key to integrate EverNote with your account. We've made it extremely
      easy for you. Just <a href="<?php echo generateEvernoteButton(); ?>">click here.</a> </p>

  <?php
  } 
 }
 insertHeader("My Account | EverTexts", '<link href="css/splash.css" rel="stylesheet">');
 insertNav("enter");
 wantAuthKey();
 ?>

 <body>
  <h3> Account Information
  </h3> <br/>
  <p>
    Here are all of your past messages from your current conversation.
    <div class="message" id="" style=""> 
	<?php 
		$conversations = getUserConversations($id);
		$messages = array();
		foreach ($conversations as $con) {
			$messages = getMessages($con);

			for($x=0; $x<sizeOf($messages[0]); $x++) {
				echo "<div class='sender'>".$messages[0][$x]. ":</div><div class='mes'>". $messages[1][$x] . "<div/><br />";
			}
		}
		//$messages
	?>

    </div>
  </p>
<?php
  insertFooter();
  insertEndTags();
?>