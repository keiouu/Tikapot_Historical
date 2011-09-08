<?php
/*
 * Tikapot Admin App Init Script
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */
 
global $home_dir;
include_once($home_dir . "contrib/admin/models.php");
require_once($home_dir . "contrib/admin/views.php");
require_once($home_dir . "framework/view.php");

// Load views
new View("/admin/", $home_dir . "contrib/admin/templates/index.php");
?>
