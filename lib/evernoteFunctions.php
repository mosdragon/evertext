

<?php
	$id = 2;
    /*
     * Copyright 2011-2012 Evernote Corporation.
     *
     * This file contains functions used by Evernote's PHP OAuth samples.
     */

    // Include the Evernote API from the lib subdirectory.
    // lib simply contains the contents of /php/lib from the Evernote API SDK
    define("EVERNOTE_LIBS", dirname(__FILE__) . DIRECTORY_SEPARATOR . "lib");
    ini_set("include_path", ini_get("include_path") . PATH_SEPARATOR . EVERNOTE_LIBS);

	require_once (__DIR__."/twilioDatabase.php");
    require_once __DIR__.'/../api_lib/evernote-sdk/lib/Evernote/Client.php';
    require_once __DIR__.'/../api_lib/evernote-sdk/lib/packages/Types/Types_types.php';
	require_once __DIR__.'/../api_lib/evernote-sdk/lib/config.php';
    // Import the classes that we're going to be using
    use EDAM\Error\EDAMSystemException,
        EDAM\Error\EDAMUserException,
        EDAM\Error\EDAMErrorCode,
        EDAM\Error\EDAMNotFoundException;
    use Evernote\Client;
	use EDAM\Types\Data, EDAM\Types\Note, EDAM\Types\Notebook, EDAM\Types\NoteAttributes, EDAM\Types\Resource, EDAM\Types\ResourceAttributes;

	
    // Verify that you successfully installed the PHP OAuth Extension
    if (!class_exists('OAuth')) {
        die("<span style=\"color:red\">The PHP OAuth Extension is not installed</span>");
    }

    // Verify that you have configured your API key
    if (strlen(OAUTH_CONSUMER_KEY) == 0 || strlen(OAUTH_CONSUMER_SECRET) == 0) {
        $configFile = dirname(__FILE__) . '/config.php';
        die("<span style=\"color:red\">Before using this sample code you must edit the file $configFile " .
              "and fill in OAUTH_CONSUMER_KEY and OAUTH_CONSUMER_SECRET with the values that you received from Evernote. " .
              "If you do not have an API key, you can request one from " .
              "<a href=\"http://dev.evernote.com/documentation/cloud/\">http://dev.evernote.com/documentation/cloud/</a></span>");
    }

    /*
     * The first step of OAuth authentication: the client (this application)
     * obtains temporary credentials from the server (Evernote).
     *
     * After successfully completing this step, the client has obtained the
     * temporary credentials identifier, an opaque string that is only meaningful
     * to the server, and the temporary credentials secret, which is used in
     * signing the token credentials request in step 3.
     *
     * This step is defined in RFC 5849 section 2.1:
     * http://tools.ietf.org/html/rfc5849#section-2.1
     *
     * @return boolean TRUE on success, FALSE on failure
     */
    function getTemporaryCredentials()
    {
        global $lastError, $currentStatus, $id;;
        
            $client = new Client(array(
                'consumerKey' => OAUTH_CONSUMER_KEY,
                'consumerSecret' => OAUTH_CONSUMER_SECRET,
                'sandbox' => SANDBOX
            ));
			
            $requestTokenInfo = $client->getRequestToken(getCallbackUrl());
            if ($requestTokenInfo) {
                $_SESSION['requestToken'] = $requestTokenInfo['oauth_token'];
                $_SESSION['requestTokenSecret'] = $requestTokenInfo['oauth_token_secret'];
                $currentStatus = 'Obtained temporary credentials';

                return TRUE;
            } else {
                $lastError = 'Failed to obtain temporary credentials.';
            }
        

        return FALSE;
    }

    /*
     * The completion of the second step in OAuth authentication: the resource owner
     * authorizes access to their account and the server (Evernote) redirects them
     * back to the client (this application).
     *
     * After successfully completing this step, the client has obtained the
     * verification code that is passed to the server in step 3.
     *
     * This step is defined in RFC 5849 section 2.2:
     * http://tools.ietf.org/html/rfc5849#section-2.2
     *
     * @return boolean TRUE if the user authorized access, FALSE if they declined access.
     */
    function handleCallback()
    {
        global $lastError, $currentStatus,$id;;
        if (isset($_GET['oauth_verifier'])) {
            $_SESSION['oauthVerifier'] = $_GET['oauth_verifier'];
            $currentStatus = 'Content owner authorized the temporary credentials';
			
			getTokenCredentials();
            return TRUE;
        } else {
            // If the User clicks "decline" instead of "authorize", no verification code is sent
            $lastError = 'Content owner did not authorize the temporary credentials';

            return FALSE;
        }
    }

    /*
     * The third and final step in OAuth authentication: the client (this application)
     * exchanges the authorized temporary credentials for token credentials.
     *
     * After successfully completing this step, the client has obtained the
     * token credentials that are used to authenticate to the Evernote API.
     * In this sample application, we simply store these credentials in the user's
     * session. A real application would typically persist them.
     *
     * This step is defined in RFC 5849 section 2.3:
     * http://tools.ietf.org/html/rfc5849#section-2.3
     *
     * @return boolean TRUE on success, FALSE on failure
     */
    function getTokenCredentials()
    {
        global $lastError, $currentStatus,$id;

		/*
        if (isset(getUserEvernote($id))) {
            $lastError = 'Temporary credentials may only be exchanged for token credentials once';
            return FALSE;
        }*/

        try {
            $client = new Client(array(
                'consumerKey' => OAUTH_CONSUMER_KEY,
                'consumerSecret' => OAUTH_CONSUMER_SECRET,
                'sandbox' => SANDBOX
            ));

		
            $accessTokenInfo = $client->getAccessToken($_SESSION['requestToken'], $_SESSION['requestTokenSecret'], $_SESSION['oauthVerifier']);
            if ($accessTokenInfo) {
                setUserEvernote($id, $accessTokenInfo['oauth_token']);
                $currentStatus = 'Exchanged the authorized temporary credentials for token credentials';

                return TRUE;
            } else {
                $lastError = 'Failed to obtain token credentials.';
            }
        } catch (OAuthException $e) {
            $lastError = 'Error obtaining token credentials: ' . $e->getMessage();
        }

        return FALSE;
    }

    /*
     * Demonstrate the use of token credentials obtained via OAuth by listing the notebooks
     * in the resource owner's Evernote account using the Evernote API. Returns an array
     * of String notebook names.
     *
     * Once you have obtained the token credentials identifier via OAuth, you can use it
     * as the auth token in any call to an Evernote API function.
     *
     * @return boolean TRUE on success, FALSE on failure
     */
    function makeNote($msg, $groupName, $everId)
    {
		global $id ;
		
		//Currently for testing
		$messageBody = $msg;
		$hasHex = "";
		
		$id = $everId;
		/*
		$timeStamp = $message->timeStamp;
		$messageBody = $message->body;
		$hashHex = $message->hashHex;
		$groupName = $message->from;
		*/
	
	
        global $lastError, $currentStatus;
	
       
			$accessToken = getUserEvernote($id); //$api;
			$client = new Client(array(
                'token' => $accessToken,
                'sandbox' => SANDBOX
            ));
			
			
			
			$noteStore = $client->getNoteStore();
			$nameOfNotebook = "Evernote " . $groupName;
			$notebookGUID = "";

			// List all of the notebooks in the user's account
			$notebooks = $noteStore->listNotebooks();
			print "Found " . count($notebooks) . " notebooks\n";
			$notebookExists = false;
			foreach ($notebooks as $notebook) {
				print "    * " . $notebook->name . "\n";
				if ( strcasecmp ( $notebook->name, $nameOfNotebook) == 0) { //make the name groupname + notes or something
					$notebookExists = true;
					$notebookGUID = $notebook->guid;
					
					break;
				}
			}

			$note = new Note();
			$note->title = "Saved Message from " . $groupName;
			$note->content = 
				'<?xml version="1.0" encoding="UTF-8"?>' .
				'<!DOCTYPE en-note SYSTEM "http://xml.evernote.com/pub/enml2.dtd">' .
				'<en-note>text being saved' . $messageBody . '<br/>' .
				'<en-media type="image/png" hash="' . $hashHex . '"/>' .
				'</en-note>';
			$note->guid = null;
			$note->contentHash = null;
			$note->contentLength = null;
			$note->created = time()*1000;
			$note->updated = time()*1000;
			$note->deleted = null;
			$note->active = null;
			$note->updateSequenceNum = null;
			$note->tagGuids = null;
			$note->resources = null;
			$noteAttr = new NoteAttributes();
			$note->attributes = $noteAttr;
			$note->tagNames = null;
			
				
			if ($notebookExists) {
				//create a new note
				$note->notebookGUID = $notebookGUID;
				
			} else {
				//first create a new notebook
				$notebook = new Notebook();
				$notebook->name = "Evernote " . $groupName;
				$notebook->defaultNotebook = true;
				$noteStore->createNotebook($notebook);
				//$note->notebookGUID = $notebook->GUID;
			}
			
			$noteStore->createNote($accessToken,$note);
			echo count($client->getNoteStore()->listNotebooks());
			$currentStatus = 'Successfully made a note';
			
			
			return TRUE;
		
        return FALSE;
		
    }

    /*
     * Reset the current session.
     */
    function resetSession()
    {
        if (isset($_SESSION['requestToken'])) {
            unset($_SESSION['requestToken']);
        }
        if (isset($_SESSION['requestTokenSecret'])) {
            unset($_SESSION['requestTokenSecret']);
        }
        if (isset($_SESSION['oauthVerifier'])) {
            unset($_SESSION['oauthVerifier']);
        }
        if (isset($_SESSION['accessToken'])) {
            unset($_SESSION['accessToken']);
        }
        if (isset($_SESSION['accessTokenSecret'])) {
            unset($_SESSION['accessTokenSecret']);
        }
        if (isset($_SESSION['noteStoreUrl'])) {
            unset($_SESSION['noteStoreUrl']);
        }
        if (isset($_SESSION['webApiUrlPrefix'])) {
            unset($_SESSION['webApiUrlPrefix']);
        }
        if (isset($_SESSION['tokenExpires'])) {
            unset($_SESSION['tokenExpires']);
        }
        if (isset($_SESSION['userId'])) {
            unset($_SESSION['userId']);
        }
        if (isset($_SESSION['notebooks'])) {
            unset($_SESSION['notebooks']);
        }
    }

    /*
     * Get the URL of this application. This URL is passed to the server (Evernote)
     * while obtaining unauthorized temporary credentials (step 1). The resource owner
     * is redirected to this URL after authorizing the temporary credentials (step 2).
     */
    function getCallbackUrl()
    {
        $thisUrl = (empty($_SERVER['HTTPS'])) ? "http://" : "https://";
        $thisUrl .= $_SERVER['SERVER_NAME'];
        $thisUrl .= ($_SERVER['SERVER_PORT'] == 80 || $_SERVER['SERVER_PORT'] == 443) ? "" : (":".$_SERVER['SERVER_PORT']);
        $thisUrl .= $_SERVER['SCRIPT_NAME'];
        $thisUrl .= '?action=callback';

        return $thisUrl;
    }

    /*
     * Get the Evernote server URL used to authorize unauthorized temporary credentials.
     */
    function getAuthorizationUrl()
    {
        $client = new Client(array(
            'consumerKey' => OAUTH_CONSUMER_KEY,
            'consumerSecret' => OAUTH_CONSUMER_SECRET,
            'sandbox' => SANDBOX
        ));

        return $client->getAuthorizeUrl($_SESSION['requestToken']);
    }
	
	//session_start();
	
	/*
	?>

	<p>
            <a href="evernoteFunctions.php?action=reset">Click here</a> to start over
    </p>
	<?php
	echo getUserEvernote($id);
	$access = getUserEvernote($id);
	if (isset($_GET['action'])) {
        $action = $_GET['action'];
        if ($action == 'requestToken') {
            getTemporaryCredentials();
        } elseif ($action == 'callback') {
            handleCallback();
        } elseif ($action == 'accessToken') {
            getTokenCredentials();
        } elseif ($action == 'makeNote') {
            makeNote("Test","Test",2);
			
        } elseif ($action == 'reset') {
            resetSession();
        }
    }
	
	if (empty($access)) {
	//Code in this block is for those who need to authorize their accounts.  For those who already have it, they can save immediately or something..
			if (!(isset($_SESSION['requestToken']))) {
			getTemporaryCredentials();
			}
	?>
	
	<li>
	
	<?php if (isset($_SESSION['requestToken']) && !isset($_SESSION['oauthVerifier'])) { ?>
                <a href="<?php echo htmlspecialchars(getAuthorizationUrl()); ?>">Click here</a> to authorize the temporary credentials
				<?php } ?>
	</li>
	<?php  
	
		
		if (isset($_SESSION['requestToken']) && isset($_SESSION['oauthVerifier']) && (empty($access))) { ?>
                <a href="evernoteFunctions.php?action=accessToken">Click here</a> to enter into database
<?php }
	}
	
	else {
		 ?>
                <a href="evernoteFunctions.php?action=makeNote"> Click here</a> to make a note
<?php } */?>