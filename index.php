<?php

define('APP_DIR', getcwd());//document root dir
require APP_DIR.DIRECTORY_SEPARATOR.'etc'.DIRECTORY_SEPARATOR.'bootstrap.php';


$kernal = new App\Core\Kernal();
$kernal->run();