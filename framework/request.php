<?php
/*
 * Tikapot Request Class
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

/* Basically looks prettier than full caps arrays everywhere, utility functions can be put here */
class Request
{	 
	public $method, $get, $post, $cookies;
	
	public function __construct() {
		// Constructs a Request object out of what we know
		$this->method = "GET";
		if (count($_POST) > 0)
			$this->method = "POST";
		$this->get = $_GET;
		$this->post = $_POST;
		$this->cookies = $_COOKIE;
	}
}

?>

