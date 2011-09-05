<?php
/*
 * Tikapot View System
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

global $home_dir;
require_once($home_dir . "framework/request.php");

class View
{
	/* 
	 * What is a view?
	 * A view links a URL to a php function
	 * This php function renders a page
	 */
	 
	public $url = "";
	public function __construct($url) { $this->url = $url; }
	 
	/* Request is a 'Request' object. */
	public function render($request) {
	}
}

?>

