<?php 

namespace App\core;

class DB{

  private $driver;

  function __Construct(){

  	include APP_DIR.DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'env.php';		
  	include APP_DIR.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.'Drivers'.DIRECTORY_SEPARATOR.$dbConfig['driver'].'.php';

  	$this->driver = new $env['driver']($dbConfig['driver']);
  }

  public function getDriver(){
  	return $this->driver;
  }

  public function insert($table, &$arr){
  	$this->driver->insertQueryBuild($table, $arr);
	
	return $query->driver->execute();
  }
}