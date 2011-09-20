<?php
/*
 * Tikapot Auth App
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

global $signal_manager;

function check_user() {
	if(!session_id())
		@session_start();
	
	if (isset($_SESSION['user'])) {
		require_once(home_dir . "contrib/auth/models.php");
		UserSession::login_session($_SESSION['user']['userid'], $_SESSION['user']['keycode']);
	}
}

$signal_manager->hook("page_setup", "check_user");
?>

