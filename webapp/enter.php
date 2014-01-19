 <?php
 require_once 'htmlfunc.php';
 require_once(__DIR__."/../lib/twilioDatabase.php");
  require_once(__DIR__."/../lib/twilio.php");
 $user = $_POST["number"];

function renderRegistration() {
  insertHeader("Registration | EverTexts");
  insertNav("enter"); ?>
    
    <body>
      <div>
        <h1>Almost There</h1>
        <p>Looks like you need to complete registration. Complete this form and you're all set.</p>
                <form id="register" action="handle_register.php" method="post">
        <div class="row marketing">
        <div class="col-md-4">
                

        </div>
        <div class="col-md-4">
		<table cellpadding="10">
		<tr><td>Phone Number: </td>	<td><input type="text" name="phone" value = "<?php if(isset($_POST["number"])){echo numberParse($_POST["number"]); echo '"readonly="true';}?>" ></td></tr>
		<tr><td>Password: 	</td>		<td><input type="password" name="password"></td></tr>
		<tr><td>Name:		</td>		<td><input type="text" name="name"></td></tr>
		<tr><td>Email: 		</td>		<td><input type="text" name="email"></td></tr>
		</table>
                </div>
              </div> 
              <p> 
      <button type="submit" class="btn btn-primary" onclick = "$('#register').submit();">Complete Registration</button>
              </p>
            </form>
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
                Password: 
                <input type="password" name="pass"><br />

                <br /> 
    
              <p> 
              <button type="submit" class="btn btn-primary" onclick ="$('#phone').submit()">Complete Registration</button>
              </p>
            </form>
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