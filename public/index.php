<?php 
define('APPLICATION_DIR', '../');

set_include_path(APPLICATION_DIR);
spl_autoload_extensions('.php');
spl_autoload_register();

$bootstrap = RBMVC\Bootstrap::getInstance();
$bootstrap->initApplication(include '../data/config.php');