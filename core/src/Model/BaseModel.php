<?php

namespace App\core\Model;

use App\core\Model\BaseModelInterface;
use App\core\DB;


class BaseModel implements BaseModelInterface{

	private $db;
	protected $driver;

	function __Construct(){		
		$this->db = new DB();

		$this->driver = $this->db->getDriver();
	}

	public function getFields(){

	}

}