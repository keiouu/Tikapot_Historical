<?php
/*
 * Tikapot Example App Tests Page
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

$title = "Test Page | Tikapot";
include("header.php");
?>

<h1>Welcome to the Tikapot test suite!</h1>
<a href="/">Back</a>
<div style="width: 100%; height: 40px; border-bottom: 1px #555 dotted;"></div>

<?php
global $home_dir;
include($home_dir . "tests/init.php");
include("footer.php");
?>

