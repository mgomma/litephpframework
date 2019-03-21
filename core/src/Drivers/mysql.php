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

	  $values = implode('","', array_values($arr));
      $columns = implode(',', array_keys($arr));

	  $query = 'INSERT INTO '.$table.' ('.$columns.') VALUES ("'.$values.'")';
	  try {

          $this->connection->prepare($query)->execute();
          return $this->connection->insert_id;
	  }catch(\Exception $e){

          //log the message.
          return FALSE;
      }
	}

	public function execute(){
	  $this->query->execute();
      
      if ($this->query->errno) {
	    die('Unable to excute mysql query - ' . $this->query->error);
      }
	}
}