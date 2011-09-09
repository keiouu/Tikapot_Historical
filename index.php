<?php
/*
 * Tikapot
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */
 
ini_set('display_errors', '1');

$home_dir = dirname(__FILE__) . '/';
require_once($home_dir . "config.php");
require_once($home_dir . "framework/view_manager.php");
require_once($home_dir . "framework/app_loader.php");
require_once($home_dir . "framework/request.php");

$view_manager = new ViewManager();
load_applications();
$request = new Request();
$view_manager->get($request->page)->render($request);
?>

