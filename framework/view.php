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
	protected $url = "";
	public function __construct($url) {
		$this->set_url($url);
		global $view_manager;
		$view_manager->add($this);
	}
	
	private function ensure_slash() {
		// Ensure the url has a trailing slash
		if ($this->url[strlen($this->url)-1] !== '/')
			$this->url .= '/';
	}
	
	public function set_url($url) {
		$this->url = $url;
		$this->ensure_slash();
	}
	public function get_url() {
		return $this->url;
	}
	 
	/* Request is a 'Request' object. */
	public function render($request) {
	}
}

?>

