<?php
/*
 * Tikapot Core Framework
 *
 * The purpose of this file is to setup the framework,
 * as well as signals,
 * perhaps error views could be added here too
 * but for now that is not the responsibility
 * of this project
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

$time = microtime(True);

/* Start up the signal manager, register some signals */
require_once(home_dir . "framework/signal_manager.php");
$signal_manager = new SignalManager();
$signal_manager->register("page_load_start");
$signal_manager->register("page_load_end");

/* Start up the view manager */
require_once(home_dir . "framework/view_manager.php");
$view_manager = new ViewManager();

/* Load the apps */
require_once(home_dir . "framework/app_loader.php");
load_applications();

/* Create the request */
require_once(home_dir . "contrib/timer/timer.php");
require_once(home_dir . "framework/request.php");
$request = new Request(Timer::startAt($time));

/* Fire page start event */
$signal_manager->fire("page_load_start", $request);

header('Content-type: ' . $request->mimeType);

/* Render the page */
$view_manager->get($request->page)->render($request);

/* Fire page end event */
$signal_manager->fire("page_load_end", $request);
?>
