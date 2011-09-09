<?php
/*
 * Tikapot Cron Manager
 *
 * This file should be run once every minute
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */


$home_dir = dirname(__FILE__) . '/';
require_once($home_dir . "config.php");
require_once($home_dir . "framework/core_models.php");

foreach ($apps_list as $app) {
	//$app = CronStore::get_or_create(); // TODO
	foreach ($app_paths as $app_path) {
		$filename = $home_dir . $app_path . "/" . $app . "/cron.php";
		if (file_exists($filename)) {
			@include($filename);
			break;
		}
	}
}
?>

