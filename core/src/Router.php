<?php

namespace App\core;

use \App\core\Loader;
use \App\core\Request;

class Router{

	private $request;
	private $loader;

	function __Construct(){
	  $this->request = new Request();
	  $this->loader = new Loader();
	}

	public function loadRoutes(&$arr){
	  $routes = [];

      foreach ($arr as $key => $value) {
      	$filepath = $value.DIRECTORY_SEPARATOR.'routes.php';

	    $this->loader->loadFile($filepath, $routes);
      }

	  return $routes;
	}
}