<?php
/*
 * Tikapot Example App Login Page
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

require_once(home_dir . "contrib/auth/models.php");

$title = "Login | Tikapot";

$showForm = True;
if (isset($_POST['username']))
	$showForm = !User::login($_POST['username'], $_POST['password']);

include("header.php");
?>

<h1>Login</h1>
<ul>
<li><a href="/">Home</a></li>
</ul>

<?php
if ($showForm) {
?>
<form method="POST" action="#">
	<table>
		<tr><td>Username:</td><td><input type="text" name="username" placeholder="Please type a username" /></td></tr>
		<tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
		<tr><td colspan="2"><input type="submit" /></td></tr>
	</table>
</form>
<?php
} else {
	print "Logged in!";
}
include("footer.php");
?>
