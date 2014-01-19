 <?php
 require_once 'htmlfunc.php';
 require_once(__DIR__."/../lib/twilioDatabase.php");
  require_once(__DIR__."/../lib/twilio.php");
 $user = $_POST["number"];

function getNum() {
  if (isset($_POST["number"])) {
    echo numberParse($_POST["number"]);
  // echo '"readonly="true';
  }
}

function renderRegistration() {
  insertHeader("Registration | EverTexts");
  insertNav("enter"); ?>
    
    <body>
      <div class="container">
        <h1>Almost There</h1>
        <p>Looks like you need to complete registration. Complete this form and you're all set.</p>
                <form id="register" action="handle_register.php" class="form-signin" method="post">
        <div class="row marketing">          
   <div class=".col-md-4">
    <div class="pull-left">
    <input type="text" name="phone" value = "<?php getNum() ?>" class="form-control" placeholder="Phone Number"> <br id="smallDrop"/>
    <input type="text" name="name" class="form-control" placeholder="Name"> <br id="smallDrop"/>
    <input type="text" name="email" class="form-control" placeholder="Email address"> <br id="smallDrop"/>
    <input type="password" name="password" class="form-control" placeholder="Password"> <br id="smallDrop"/>         
              <br id="smallDrop"/>         
      <button type="submit" class="btn btn-lg btn-primary" onclick = "$('#register').submit();">Complete Registration</button>
              
            </form>
          </div>
        </div> 
      </div>
    </div> 
    <?php
}

function renderLogin() {
  insertHeader("Login | EverTexts");
  insertNav("enter"); ?>
    
    <body>
      <div>
        <h1>Sweet!</h1>
        <p>Your account's already been set up. Finish logging in here.</p>
                <form id="register" action="handle_login.php" method="post"> 
                  
  <div class="row marketing">          
   <div class=".col-md-4">
    <div class="pull-left">
    <input type="text" name="phone" value = "<?php getNum() ?>" class="form-control" placeholder="Phone Number"> <br id="smallDrop"/>
    <input type="password" name="password" class="form-control" placeholder="Password"> <br id="smallDrop"/>         
              <br id="smallDrop"/>         
      <button type="submit" class="btn btn-lg btn-primary" onclick = "$('#register').submit();">Complete Registration</button>
              
            </form>
          </div>
        </div> 
      </div>
      </div> 
    <?php
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