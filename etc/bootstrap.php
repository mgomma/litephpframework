<?php

define ('MODULES_DIR', 'modules');
define ('ETC_DIR', 'etc');

define ('TEST_DIR', 'test');

define ('THEME_DIR', 'theme');
define ('FRONT_THEME', 'main');

define('MODULES_CLASS_DIRS', ['Controller', 'Model', 'Form']);
define ('SUB_DIR', '/project');
define ('BASE_URL', 'http://localhost/project');

$dir = new DirectoryIterator(APP_DIR.DIRECTORY_SEPARATOR.'core'.DIRECTORY_SEPARATOR.'src');
foreach ($dir as $fileinfo) {

  if (!$fileinfo->isDot() && !$fileinfo->isDir() && $fileinfo->getExtension() == 'php'){

    require $fileinfo->getPathname();
  }
}

$autoloaders = [
];

foreach ($autoloaders as $fileName) {
  require $fileName;
} 
