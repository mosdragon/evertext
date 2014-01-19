 <?php
 require_once 'htmlfunc.php';
 require_once(__DIR__."/../lib/twilioDatabase.php");
$id = $_COOKIE["id"];

 
 function wantAuthKey() {

  if (!getUserEvernote($id)) { ?>
    <h4>Uh-Oh</h4><br/>
    <p> Looks like we need your authorization key to integrate EverNote with your account. We've made it extremely
      easy for you. Just <a href="">click here.</a> </p>

  <?php
  } 
 }
 insertHeader("My Account | EverTexts");
 insertNav("enter");
 ?>

 <body>
  
<?php
  insertFooter();
  insertEndTags();
?>