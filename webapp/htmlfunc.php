<?php
// html functions
require __DIR__."\..\config\config.php";
function insertHeader($pageTitle) {
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <title>
      <?php
      echo $pageTitle;
      ?>
    </title>
      <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="shortcut icon" href="images/favicon.png">
    <!-- Bootstrap core CSS -->
    <link href="dist/css/bootstrap.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="dist/css/jumbotron-narrow.css" rel="stylesheet">

    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../docs-assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js"></script>
    <![endif]-->
  </head>
<?php

}

function insertNav($active) { ?>
    <div class="container">
      <div class="header">
        <ul class="nav nav-pills pull-right">
    
    <?php 
    if($active == "index") { ?>
          <li class ="active"><a href="#">Home</a></li>
          <li><a href="enter.php">Enter</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul> <?php
    }
    if($active == "enter") { ?>
          <li><a href="index.php">Home</a></li>
          <li class ="active"><a href="#">Enter</a></li>
          <li><a href="about.php">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul> <?php
    }
    if($active == "about") { ?>
          <li><a href="index.php">Home</a></li>
          <li><a href="enter.php">Enter</a></li>
          <li class ="active"><a href="#">About</a></li>
          <li><a href="contact.php">Contact</a></li>
        </ul> <?php
    }
    if($active == "contact") { ?>
          <li><a href="index.php">Home</a></li>
          <li><a href="enter.php">Enter</a></li>
          <li><a href="about.php">About</a></li>
          <li class ="active"><a href="#">Contact</a></li>
        </ul> <?php
    }
        ?>
        <h3 class="text-muted">
          <img src="images/favicon.png" />
          EverTexts
        </h3>
    </div> <?php
}


function insertJavascript()
{
	?>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js#sthash.A9QZfgQJ.dpuf">
  </script>
  <script type="text/javascript" src="js/modal.js"></script>
  <script type="text/javascript" src="dist/js/bootsrap.js"></script>
  <script type="text/javascript" src="dist/js/bootstrap.min.js"></script>
        <?php 
}
function insertEndTags()
{
?>
  </body>
  </html>

<?php
}
function insertFooter()
{
	insertJavascript();
	insertEndTags();
?>
  <div class="footer">
    <p> Copyright &copy; EverTexts Team | MHacks Winter 2014 | Powered by
     <a href="http://getbootstrap.com">Twitter BootStrap</a>
    </p>
  </div>

<?php
}

?>