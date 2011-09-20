<?php
/*
 * Tikapot Example App Init Script
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

require_once(home_dir . "apps/example/views.php");
require_once(home_dir . "framework/view.php");

// Load views
new View("/", home_dir . "apps/example/templates/index.php");
new View("/test/", home_dir . "apps/example/templates/tests.php");
new View("/login/", home_dir . "apps/example/templates/login.php");
new View("/register/", home_dir . "apps/example/templates/register.php");
new ExampleView();
?>

