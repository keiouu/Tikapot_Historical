<?php
/*
 * Tikapot Example App View
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

global $home_dir;
require($home_dir . "framework/view.php");

class IndexView extends View
{
	public function __construct() {
		parent::__construct("/");
	}
	 
	/* Request is a 'Request' object. */
	public function render($request) {
		print "Welcome to the example app!";
	}
}

class TestView extends View
{
	public function __construct() {
		parent::__construct("/test/");
	}
	 
	/* Request is a 'Request' object. */
	public function render($request) {
		global $home_dir;
		include($home_dir . "tests/init.php");
	}
}
?>

