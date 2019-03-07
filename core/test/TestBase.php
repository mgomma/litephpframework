<?php

namespace App\core\test;

use  App\core\test\TestBaseInterface;

class TestBase implements TestBaseInterface{

	public function assert($field, $value){

	}

	public function runTest(){

	  $allTestClasses = get_declared_classes();

	  foreach ($allTestClasses as $class) {
	  	if(is_subclass_of($class, get_class($this))){
          
          $obj = new $class();
          $obj->runTest();
        }
	  }
	}
}