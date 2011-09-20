<?php
/*
 * Tikapot Auth App
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

global $signal_manager;

require_once(home_dir . "contrib/auth/models.php");

function check_user($request) {
	if(!session_id())
		@session_start();
	
	if (isset($_SESSION['user'])) {
		if(UserSession::login_session($_SESSION['user']['userid'], $_SESSION['user']['keycode']))
			$request->user = User::get($_SESSION['user']['userid']);
		else
			$request->user = new User();
	}
	else
		$request->user = new User();
}

$signal_manager->hook("page_setup", "check_user");
?>

