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
        <p>Looks like you need to complete registration. Complete this form and you're all set.</p>
                <form id="register" action="handle_register.php" method="post">
        <div class="row marketing">
        <div class="col-md-4">
                
                Phone Number: <br />
                Password: <br />
                Email: <br />
				Name: <br />

        </div>
        <div class="col-md-4">
				<input type="text" name="phone" value = "<?php if(isset($_POST["number"])){echo $_POST["number"]; echo '"readonly="true';}?>" ><br />
				<input type="password" name="pass"><br />
				
                <input type="text" name="name"><br />
                <input type="text" name="email"><br />
                
                

                <br /> 
    
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
                <form id="register" action="handle.php" method="post"> 
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