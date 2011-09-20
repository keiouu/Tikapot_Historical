<?php
/*
 * Tikapot Example App Registration Page
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

require_once(home_dir . "contrib/auth/models.php");

$title = "Register | Tikapot";

$showForm = True;
$message = "";
if (isset($_POST['username'])){
	if ($_POST['password'] == $_POST['password2']) {
		try {
			User::create_user($_POST['username'], $_POST['password'], $_POST['email']);
			$showForm = False;
			$message = "<h3>Thankyou..</h3>";
		}
		catch (AuthException $e) {
			$message = "<h2>Error, please try again. It is likely that username exists.</h2>";
		}
	} else {
		$message = "<h2>Oops! The passwords didnt match!</h2>";
	}
}

include("header.php");
$username = isset($_POST['username']) ? $_POST['username']: "";
$email = isset($_POST['email']) ? $_POST['email']: "";
?>

<h1>Registration</h1>
<ul>
<li><a href="/">Home</a></li>
</ul>

<?php
if ($showForm) {
?>

<form method="POST" action="#">
	<table>
		<tr><td>Username:</td><td><input type="text" name="username" placeholder="Please type a username" value="<?php echo $username; ?>" /></td></tr>
		<tr><td>Password:</td><td><input type="password" name="password" /></td></tr>
		<tr><td>Password (again):</td><td><input type="password" name="password2" /></td></tr>
		<tr><td>Email Address:</td><td><input type="email" name="email" value="<?php echo $email; ?>"  /></td></tr>
		<tr><td colspan="2"><input type="submit" /></td></tr>
	</table>
</form>

<?php
} else { print $message; }
include("footer.php");
?>
