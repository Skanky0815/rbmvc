<?php 
define('ROOT_DIR', '../');
define('APPLICATION_DIR', ROOT_DIR . 'Application/');

set_include_path(ROOT_DIR);
spl_autoload_extensions('.php');
spl_autoload_register();

use RBMVC\Bootstrap;

$bootstrap = new Bootstrap();
echo $bootstrap->run(include APPLICATION_DIR . 'data/config.php');