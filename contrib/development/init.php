<?php
/*
 * Tikapot Developer Portal Init Script
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */
 
global $home_dir;
include_once($home_dir . "contrib/development/models.php");
require_once($home_dir . "contrib/development/views.php");
require_once($home_dir . "framework/view.php");

// Load views
new View("/dev/", $home_dir . "contrib/development/templates/index.php");
?>
