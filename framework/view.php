<?php
/*
 * Tikapot View System
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

class View
{	
	/* 
	 * What is a view?
	 * A view links a URL to a php function
	 * This php function renders a page
	 */
	public $url = "";
	public function __construct($url) {
		$this->url = $url;
		
		global $view_manager;
		$view_manager->add($this);
	}
	 
	/* Request is a 'Request' object. */
	public function render($request) {
	}
}

?>

