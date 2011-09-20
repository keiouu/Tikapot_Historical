<?php
/*
 * Tikapot
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

require_once(home_dir . "lib/simpletest/autorun.php");

class AllTests extends TestSuite {
    function AllTests() {
    	global $home_dir;
        $this->TestSuite('All tests');
        $this->addFile($home_dir . 'tests/session_test.php');
        $this->addFile($home_dir . 'tests/database_test.php');
        $this->addFile($home_dir . 'tests/timer_test.php');
        $this->addFile($home_dir . 'tests/model_test.php');
        $this->addFile($home_dir . 'tests/model_table_test.php');
        $this->addFile($home_dir . 'tests/modelquery_test.php');
        $this->addFile($home_dir . 'tests/model_field_tests.php');
        $this->addFile($home_dir . 'tests/signal_test.php');
        $this->addFile($home_dir . 'tests/auth_test.php');
    }
}
?>

