 <?php
 require_once 'htmlfunc.php';
 require_once(__DIR__."/../lib/twilioDatabase.php");
 require_once(__DIR__."/../lib/evernoteSignIn.php");
$id = $_COOKIE["id"];

 
 function wantAuthKey() {

  if (!getUserEvernote($id)) { ?>
    <h4>Uh-Oh</h4><br/>
    <p> Looks like we need your authorization key to integrate EverNote with your account. We've made it extremely
      easy for you. Just <a href="<?php echo generateEvernoteButton(); ?>">click here.</a> </p>

  <?php
  } 
 }
 insertHeader("My Account | EverTexts");
 insertNav("enter");
 wantAuthKey();
 echo $id;
 ?>

 <body>
  <h3> Account Information
  </h3> <br/>
  <p>
    Here are all of your past messages from your current conversation.
    <div class="small"> 

    </div>
  </p>
<?php
  insertFooter();
  insertEndTags();
?>