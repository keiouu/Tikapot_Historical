<?php
require("config.php");
require("lib/timer.php");

/*
	This is where our page should go
 */



/**
 Examples: Timer
 **/
$uid = Timer::start();
for ($i=0; $i<=100000; $i++){
}
$time = Timer::end($uid);

print("Time for 100,000 iterations: $time seconds");
?>

