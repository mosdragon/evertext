
	<p>
            <a href="?action=reset">Click here</a> to start over
    </p>
	<?php
	require_once __DIR__.'/evernoteFunctions.php';
	session_start();
	echo getUserEvernote($id);
	//$access = getUserEvernote($id);
	if (isset($_GET['action']) && $_GET['action'] == 'callback') {
        handleCallback();
    }
	if (!(isset($_SESSION['requestToken']))) {
	getTemporaryCredentials();
	}
	
	function generateEvernoteButton() { ?>
	<a href="<?php echo htmlspecialchars(getAuthorizationUrl()); ?>">Click here</a> to authorize the temporary credentials
	<?php } ?>
