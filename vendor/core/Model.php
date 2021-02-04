<?php

namespace vendor\core;

use vendor\lib\Db;

abstract class Model {

	public $db;
	
	public function __construct() {
		$this->db = new Db;
	}

}