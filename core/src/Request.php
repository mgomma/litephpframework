<?php


namespace App\core;

class Request{

	private $method;
	private $uri;

	function __Construct(){

	  $this->url = $this->parseUrl();
	}

	public function getUrl(){
	  $url = $this->url['path'];	

	  if(defined('SUB_DIR')){
	  	$url = str_replace(SUB_DIR, NULL, $this->url['path']);
	  }	
	  return $url;
	}

	public function httpMethod(){
		return $_SERVER['REQUEST_METHOD'];
	}

	public function isPost(){
	  return $_SERVER['REQUEST_METHOD'] == 'POST' ? TRUE : FALSE;
	}

	public function post(){
	  return $_POST;	
	}

	public function parseUrl(){
	  return parse_url($_SERVER['REQUEST_URI']);
	}

}