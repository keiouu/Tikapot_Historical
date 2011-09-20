<!doctype html> 
<html lang="en">
<head> 
  <meta charset="utf-8">
 
  <title><?php print $title; ?></title> 
  <meta name="description" content="Tikapot"> 
  <meta name="author" content="Tikapot">
  <style type="text/css">
	* {color: #444;}
	a:hover {color: #000;}
  </style>
  <?php if(isset($extra_head)) print $extra_head; ?> 
</head> 
 
<body>
<?php
$login_message = ($request->user->logged_in()) ? "" : "not";
$login_links = ($request->user->logged_in()) ? "<a href=\"/logout/\">Logout</a>" : "<a href=\"/login/\">Login</a> <a href=\"/register/\">Register</a>";
?>
<div class="bar">You are <?php echo $login_message; ?> logged in! <?php echo $login_links; ?></div>
  
