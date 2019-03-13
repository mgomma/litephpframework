<?php

class mysql{

	private $connection;
	private $query;

	function __Construct($dbConfig){
      $this->connection = new mysqli($dbConfig['host'], $dbConfig['user'], $dbConfig['password'], $dbConfig['name']);

	  if ($this->connection->connect_error) {
	 	die('Failed to connect to MySQL - ' . $this->connection->connect_error);
	  }

	  $this->connection->set_charset($dbConfig['charset']);
	}

	function __Destruct(){
	  return $this->connection->close();
	}

	public function insertQueryBuild($table, &$arr){
	  $values = NULL;

	  $counter = count($arr);
	  $count = 0;
	 
	  foreach ($arr as $key => $value) {
	  	++$start;
	 
	  	$values .= "`".$key."` = '".$value."'";
	  	if($count != $counter){

	  	  $values .= ', ';
	  	}
	  }	

	  $query = 'INSERT INTO '.$TABLE.' VALUES('.$values.')';
	  if($this->query = $this->connection->prepare($query)){

	  }else{
	  	die('Error prepare query check mysql syntax - ' . $this->query->error);
	  }
	}

	public function execute(){
	  $this->query->execute();
      
      if ($this->query->errno) {
	    die('Unable to excute mysql query - ' . $this->query->error);
      }
	}
}