<?php
/*
 * Tikapot
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GPL Version 3 license.
 * http://www.gnu.org/licenses/gpl-3.0.txt
 */

require_once($home_dir . "lib/simpletest/autorun.php");

class AllTests extends TestSuite {
    function AllTests() {
    	global $home_dir;
        $this->TestSuite('All tests');
        $this->addFile($home_dir . 'tests/session_test.php');
        $this->addFile($home_dir . 'tests/database_test.php');
        $this->addFile($home_dir . 'tests/timer_test.php');
    }
}
?>

