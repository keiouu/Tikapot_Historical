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
 
ini_set('display_errors', '1');

$home_dir = dirname(__FILE__) . '/';
require_once($home_dir . "config.php");
require_once($home_dir . "contrib/cron.php");
foreach ($apps_list as $app) {
	list($obj, $created) = CronStore::get_or_create(array("app_name" => $app));
	
	// Obtain lock
	if ($obj->locked)
		continue;
	$obj->locked = True;
	$obj->save();
	
	// Search and execute
	foreach ($app_paths as $app_path) {
		$filename = $home_dir . $app_path . "/" . $app . "/cron.php";
		if (file_exists($filename)) {
			@include($filename);
			break;
		}
	}
	
	print $obj->last_run;
	$obj->last_run = date("Y-m-d H:m:s");
	print $obj->last_run;
	
	// Release lock
	$obj->locked = False;
	$obj->save();
}
?>

