<?php

if(!isset($_REQUEST['module'])){
  die('Set the module to test');
}
$module = trim($_REQUEST['module']);

define('APP_DIR', dirname(dirname(__FILE__)));//document root dir

$envFilePath =  APP_DIR.DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'env.php';
if(file_exists($envFilePath)){
    include $envFilePath;
}else{
    exit('Set env file to start testing');
}


require APP_DIR.DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'bootstrap.php';

$kernal = new App\Core\Kernal();
$kernal->loadenabledModules();

require APP_DIR.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.TEST_DIR.DIRECTORY_SEPARATOR.'TestBaseInterface.php';
require APP_DIR.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.TEST_DIR.DIRECTORY_SEPARATOR.'TestBase.php';

$moduleTestFolder = APP_DIR.DIRECTORY_SEPARATOR.MODULES_DIR.DIRECTORY_SEPARATOR.$module.DIRECTORY_SEPARATOR.TEST_DIR;

if(!file_exists($moduleTestFolder)){
  die('Wrong module name');
}

$dir = new DirectoryIterator($moduleTestFolder);
foreach ($dir as $fileinfo) {

  if (!$fileinfo->isDot() && !$fileinfo->isDir() && $fileinfo->getExtension() == 'php'){
    require $fileinfo->getPathname();
  }
}

use App\core\test\TestBase;
$test = new TestBase();
$test->runTest(); 