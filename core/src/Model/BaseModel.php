<?php

namespace App\core\Model;

use App\core\Model\BaseModelInterface;
use App\core\DB;


class BaseModel extends DB implements BaseModelInterface{


	function __Construct(){
	  parent::__Construct();
	}

	public function getFields(){

	}

}