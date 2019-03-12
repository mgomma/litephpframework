<?php

namespace App\core\Controller;

use App\core\Request;

class BaseFrontController{

	protected $request;
	protected $data;

	function __Construct(){
		$this->request = new Request();
	}

	public function view($template){
	  $templatePath = $this->getTemplatePath();
      
	  $content = $templatePath.$template;
	  $data = $this->data;

	  require APP_DIR.DIRECTORY_SEPARATOR.THEME_DIR.DIRECTORY_SEPARATOR.FRONT_THEME.DIRECTORY_SEPARATOR.'index.php';	  
	}

	function renderPage(){

	}

	function getTemplatePath(){
		return $this->getModuleTemplatesPath($this->getCallingClassModule());
	}

	function getCallingClassModule(){
	  $arr = explode('\\', get_called_class());

	  return $arr[1];
	}

	function getModuleTemplatesPath($module){
		return APP_DIR.DIRECTORY_SEPARATOR.MODULES_DIR.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.'templates'.DIRECTORY_SEPARATOR;
	}
}
