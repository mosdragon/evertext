<?php
require_once 'htmlfunc.php';
if ($login != null)
{
	header("Location: nearme.php");
}
insertHeader('Megaphone', 'index');
?>
<div class = "jumbotron">
    <h1>Megaphone</h1>
    <h2>Just shout.</h2>
    <p>Megaphone is about talking to those near you.  Post a message, and everyone in the area hears.</p>
    <a class = "btn btn-lg btn-primary" href = "newuser.php">Sign Up</a>
    <a class = "btn btn-lg btn-danger" href = "login.php">Login</a>
</div>
<div class = "container">
<div class = "panel panel-default centered">
	<h1>Watch the Ad</h1>
    <video src = "https://dl.dropboxusercontent.com/u/2217573/Megaphone%20Ad%20Web.m4v" controls></video>
</div>
</div>
<?php insertFooter(); ?>