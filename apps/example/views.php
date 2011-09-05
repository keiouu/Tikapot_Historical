<?php
/*
 * Tikapot Example App View
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

global $home_dir;
require_once($home_dir . "framework/view.php");

class ExampleView extends View
{
	public function __construct() {
		parent::__construct("/example/");
	}
	 
	/* Request is a 'Request' object. */
	public function render($request) {
		print "Welcome to the example app!";
	}
}
?>

