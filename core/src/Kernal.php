<?php

namespace App\core;


use App\core\Module;
use App\core\Router;
use App\core\Request;
use App\core\loader;


class Kernal{

	private $module;
	private $router;
	private $loader;
	private $request;

	private $enabledModulesPath;

	function __Construct(){
		$this->module = new Module();

		$this->router = new Router();
		$this->loader = new loader();

		$this->request = new Request();
		$this->enabledModulesPath = $this->module->getEnabledModulesPath();

	}

	public function run(){
	  $notFoundRoute = TRUE;

	  $this->loadenabledModules($this->enabledModulesPath);
	  $routes = $this->router->loadRoutes($this->enabledModulesPath);
	  
	  foreach ($routes as $key => $value) {
	  	foreach ($value as $k => $v) {

	  	  if($k == $this->request->getUrl()){
	  	  	$method = isset($v['method']) ? $v['method'] : 'index';
	  	  	
	  	  	$contrller = new $v['Controller']();
	  	  	$contrller->$method();
	  	  	
	  	  	$notFoundRoute = FALSE;
	  	  	break(2);
	  	  }
	  	}
	  }
	  if($notFoundRoute){
	    $this->notFound();
	  }
	}

	public function loadenabledModules(){            
	  $this->loader->loadEnabledModulesClasses($this->enabledModulesPath);
	}

	public function notFound(){
		echo 'Not found';
	}
}
