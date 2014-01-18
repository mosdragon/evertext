<?php
// html functions
require "config/config.php";
function insertHeader($pageTitle, $pageID)
{
echo '<!DOCTYPE html>
<html>
  <head>
    <title>'.$pageTitle.'</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <link rel="apple-touch-icon-precomposed" href="apple-touch-icon-precomposed.png">
    <link rel="apple-touch-icon" href="apple-touch-icon-precomposed.png">
    <!-- Bootstrap -->
<link href="http://fonts.googleapis.com/css?family=Lato:100,300,400,700,400italic" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css">
    <link href="//netdna.bootstrapcdn.com/font-awesome/4.0.0/css/font-awesome.css" rel="stylesheet">
    <link rel = "stylesheet" href = "css/all.css">
    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="../../assets/js/html5shiv.js"></script>
      <script src="../../assets/js/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class = "'.$pageID.'">';

}
function insertJavascript()
{
	
}
function insertEndTags()
{
echo '
<div class = "footer">
</body>
</html>';

}
function insertFooter()
{
	insertJavascript();
	insertEndTags();
}
?>