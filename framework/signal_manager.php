<?php
/*
 * Tikapot Signal Manager
 *
 * Copyright 2011, AUTHORS.txt
 * Licensed under the GNU General Public License version 3.
 * See LICENSE.txt
 */

class SignalException extends Exception {}

class SignalManager
{
	private $signals;
	
	public function __construct() {
		$this->signals = array();
	}
	
	public function register($signal) {
		if (isset($this->signals[$signal]))
			throw new SignalException("Signal already registered! " . $signal);
		$this->signals[$signal] = array();
	}
	
	public function hook($signal, $function, $obj = Null) {
		if (!isset($this->signals[$signal]))
			throw new SignalException("Signal isnt registered! " . $signal);
		$this->signals[$signal][$function] = $obj;
	}
	
	public function fire($signal, $obj = Null) {
		if (!isset($this->signals[$signal]))
			throw new SignalException("Signal isnt registered! " . $signal);
		foreach ($this->signals[$signal] as $function => $object) {
			if ($object)
				if(method_exists($object, $function))
					call_user_func_array(array($object, $function), array($obj));
				else
					throw new SignalException("Method doesnt exist in object! " . $function);
			else
				$function($obj);
		}
	}
}

?>

