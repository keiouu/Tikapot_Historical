<?php
/*
 * Tikapot Application Loader
 * v1.0
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */
 
function load_applications() {
	global $apps_list, $home_dir;
	foreach ($apps_list as $app) {
		include($home_dir . "apps/" . $app . "/init.php");
	}
}
?>
