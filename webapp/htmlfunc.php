<?php
// html functions
require __DIR__."\..\config\config.php";
function insertHeader($pageTitle, $pageID) {

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
    <link rel="shortcut icon" href="http://getbootstrap.com/examples/jumbotron-narrow/../../docs-assets/ico/favicon.png">
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
  <body class = 
    <?php
    echo $pageID;
    ?>
    > 
<?php

}
function insertJavascript()
{
	echo '<script src="https://code.jquery.com/jquery-1.10.2.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/bootswatch.js"></script>';
}
function insertEndTags()
{
echo '<div class = "footer"> Copyright &copy; EverText Team | MHack Winter 2014 | Georgia Tech
</div>
</body>
</html>';

}
function insertFooter()
{
	insertJavascript();
	insertEndTags();
?>
  <div class="footer">
    <p>&copy; Company 2013</p>
  </div>
    
<?php
}

function navigation() {
  ?>

  </body>
  </html>

    <?php
}

?>