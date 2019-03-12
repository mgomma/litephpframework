<?php

define ('MODULES_DIR', 'modules');
define ('ETC_DIR', 'etc');

define ('TEST_DIR', 'test');

define ('THEME_DIR', 'theme');
define ('FRONT_THEME', 'main');

define('MODULES_CLASS_DIRS', ['Controller', 'Model', 'Form']);
//define ('SUB_DIR', '/project');
define ('BASE_URL', 'http://litephp.docker.localhost:7000');


$envFilePath =  APP_DIR.DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'env.php';
if(file_exists($envFilePath)){
    include $envFilePath;
}else{
    exit('Set env file to start testing');
}

$dir = new DirectoryIterator(APP_DIR.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'src');
foreach ($dir as $fileinfo) {

  if (!$fileinfo->isDot() && !$fileinfo->isDir() && $fileinfo->getExtension() == 'php'){

    include $fileinfo->getPathname();
  }
}

$autoloaders = [
];

foreach ($autoloaders as $fileName) {
  require $fileName;
} 
