 <?php
 require_once 'htmlfunc.php';
 require_once(__DIR__."/../lib/twilioDatabase.php");
$id = $_COOKIE["id"];

 
 function wantAuthKey() {

  if (!getUserEvernote($id)) { ?>
    <h4>Uh-Oh</h4><br/>
    <p> Looks like we need your authorization key to integrate EverNote with your account. </p>
        

  <?php
  } 
 }
 insertHeader("My Account | EverTexts");
 insertNav("enter");
 ?>
      <body>
        <div>
          <h2>Glad You Could Make It!
          </h2>
          </div>
          <div class="row marketing">
            <h4>Our Mission:</h4> <blockquote>
        We're creating the best possible group chatting experience out there for everyone. No smartphones, apps
        , or even internet connection needed. Initiate chats, invite friends, export the last message sent out to your
        Evernote account
        </blockquote>
      </div>
<?php
  insertFooter();
  insertEndTags();
?>