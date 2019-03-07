<?php

namespace App\core;

use \App\core\Loader;

class Module{

	private $loader;
	private $modulesArrFromConfig;
	private $enabledModules;

	function __Construct(){
	  $this->loader = new Loader();

	  $this->findmodulesArrFromConfig();
	  $this->enabledModules = $this->findEnabledModules();
	}

	public function findmodulesArrFromConfig(){
	  $this->modulesArrFromConfig = include APP_DIR.DIRECTORY_SEPARATOR.ETC_DIR.DIRECTORY_SEPARATOR.'config.php';
	}

    public function getEnabledModules(){
      return $this->enabledModules;
    }

    public function getEnabledModulesPath(){
      $enabledModulesPath = [APP_DIR.DIRECTORY_SEPARATOR.'core'];
      
      $this->findEnabledModules();
      foreach ($this->enabledModules as $key => $value) {

      	$enabledModulesPath []= APP_DIR.DIRECTORY_SEPARATOR.MODULES_DIR.DIRECTORY_SEPARATOR.$value;
      }

      return $enabledModulesPath;
    }

    public function findEnabledModules(){
      $this->enabledModules = [];

      foreach ($this->modulesArrFromConfig as $key => $value) {
      	if($value == '1'){

      	  $this->enabledModules []= $key;
      	}
      }       
    }

	public function getAllModules(){
	  $modules_dir = APP_DIR.DIRECTORY_SEPARATOR.MODULES_DIR;

	  $modules = [];
	  $this->loader->loadFilesByPrefix($modules_dir, 'module.php', $modules);

	  return $modules;
	}

}