<?php
/*
 * Tikapot
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

$database_type = "psql";      // mysql or psql
$database_host = "localhost";
$database_name = "tikapot";
$database_username = "tikapot";
$database_password = "tikapot";

$app_paths = array("apps", "contrib", "tests");
$apps_list = array("session", "auth", "example");

date_default_timezone_set("Europe/London");

// Contrib Config
$config_session_timeout = 3600; // 1 Hour
?>

