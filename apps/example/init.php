<?php
/*
 * Tikapot Example App Init
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */
 
global $home_dir;
require($home_dir . "apps/example/models.php");
require($home_dir . "apps/example/views.php");

// Load views
new IndexView();
?>

