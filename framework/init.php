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

require_once(home_dir . "framework/signal_manager.php");
require_once(home_dir . "framework/view_manager.php");
require_once(home_dir . "framework/app_loader.php");
require_once(home_dir . "framework/request.php");
require_once(home_dir . "contrib/timer/timer.php");

$signal_manager = new SignalManager();
$signal_manager->register("");

$view_manager = new ViewManager();
load_applications();
$request = new Request(Timer::startAt($time));

header('Content-type: ' . $request->mimeType);

$view_manager->get($request->page)->render($request);

?>
