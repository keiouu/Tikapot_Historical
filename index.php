<?php
/*
 * Tikapot
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */
 
ini_set('display_errors', '1');

$home_dir = dirname(__FILE__) . '/';
include("tests/init.php");

include("apps/example/models.php");
$example = new ExampleModel();
?>

<html>
	<head>
		<title>Welcome to Tikapot!</title>
	</head>
	<body>
		<h1>Welcome to Tikapot!</h1>
	</body>
</html>
