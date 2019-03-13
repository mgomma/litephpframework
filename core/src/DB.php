<?php 

namespace App\core;


class DB{

  public $db;

  function __Construct(){
    include APP_DIR.DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'env.php';

  	$this->db = new $GLOBALS['env']['database']['driver']($GLOBALS['env']['database']);
  }

  public function insert($table, &$arr){
  	$this->db->insertQueryBuild($table, $arr);
	
	return $query->db->execute();
  }
}