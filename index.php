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

require("config.php");
include("framework/view_manager.php");
require("framework/app_loader.php");
include("framework/request.php");

$view_manager = new ViewManager();
load_applications();
$view_manager->get("/")->render(new Request());
?>

