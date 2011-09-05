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

include("framework/view_manager.php");
$view_manager = new ViewManager();

require("config.php");
include("tests/init.php");

// TODO - app loader
include("apps/example/init.php");
include("framework/request.php");
$view_manager->get("/")->render(new Request());
?>

