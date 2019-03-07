<?php 

namespace App\core;

class Loader{

    function __Construct(){
	
	}

	public function loadFilesByPrefix($folder, $prefix, &$arr = NULL){
	  $dir = new \DirectoryIterator($folder);

      foreach ($dir as $fileinfo) {
        if (!$fileinfo->isDot() && $fileinfo->isDir()){

          $filePath = $fileinfo->getPathname().DIRECTORY_SEPARATOR.$prefix;
          $this->loadFile($filePath, $arr);

        }
      } 
	}

	public function loadEnabledModulesClasses(&$modules){	  
	  foreach ($modules as $key => $module) {

	    foreach (MODULES_CLASS_DIRS as $key => $dir) {	
		  $path = $module.DIRECTORY_SEPARATOR.'src'.DIRECTORY_SEPARATOR.$dir.DIRECTORY_SEPARATOR;
          
          if(!file_exists($path)){
          	continue;

          }
		  foreach (glob($path."*Interface.php") as $file) {

            require $file;
          }
          $files = new \DirectoryIterator($path);
          foreach ($files as $fileinfo) {

            if ($fileinfo->isDot() || $fileinfo->isDir()){

            	continue;
            }
            if(strpos($fileinfo->getFilename(), 'Interface') !== FALSE || $fileinfo->getExtension() != 'php'){

            	continue;
            }

           $this->loadFile($fileinfo->getPathname());
          }
        }
	  }
	}

	public function loadFile($filePath, &$arr = NULL){
	  if(!file_exists($filePath)){

	    return;
	  }

	  if(is_array($arr)){

        array_push($arr, include $filePath);
      }else{

        require $filePath;
      }
	}
}