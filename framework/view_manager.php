<?php
/*
 * Tikapot View Manager
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

require_once(home_dir . "framework/view.php");

class Default404 extends View {
	public function __construct() { parent::__construct("/404.php"); }
	public function render($request) {
		print "Error: That page does not exist!";
	}
}

class ViewException extends Exception {}

class ViewManager
{
	private $views;
	
	public function __construct() {
		$this->views = array();
	}
	
	public function add($view) {
		if (isset($this->views[$view->get_url()]))
			throw new ViewException("View exists!");
		$this->views[$view->get_url()] = $view;
	}
	
	public function get($url) {
		if (isset($this->views[$url]))
			return $this->views[$url];
		if (file_exists(home_dir . $url))
			return new View($url, home_dir . $url);
		if ($url == "/404.php")
			return new Default404();
		return $this->get("/404.php");
	}
}

?>

