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

require_once(home_dir . "framework/signal_manager.php");
$signal_manager = new SignalManager();
$signal_manager->register("page_load_start");
$signal_manager->register("page_load_end");

require_once(home_dir . "framework/view_manager.php");
$view_manager = new ViewManager();

require_once(home_dir . "framework/app_loader.php");
load_applications();

require_once(home_dir . "contrib/timer/timer.php");
require_once(home_dir . "framework/request.php");
$request = new Request(Timer::startAt($time));

$signal_manager->fire("page_load_start", $request);

header('Content-type: ' . $request->mimeType);

$view_manager->get($request->page)->render($request);

$signal_manager->fire("page_load_end", $request);
?>
