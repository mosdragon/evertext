 <?php
 require_once 'htmlfunc.php';
 require_once(__DIR__."/../lib/twilioDatabase.php");
 $user = $_POST["number"];

function renderRegistration() {
  insertHeader("Registration | EverTexts");
  insertNav("enter"); ?>
    
    <body>
      <div>
        <h1>Almost There</h1>
        <p>Looks like you need to complete registration. Complete the form and you're all set.</p>
        <form id="register" action="handle.php" method="post">
          
        </form>
      </div> 
    <?php
}

function renderLogin() {
  insertHeader("Login | EverTexts");
  insertNav("enter");
}
 //handles phone number from index page
 if (isUserRegistered($user)) {
    renderLogin();
 } else {
    renderRegistration();
 }

 ?>

<?php
  insertFooter();
  insertEndTags();
?>