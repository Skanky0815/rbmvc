<?php 
define('APPLICATION_DIR', '../');

set_include_path(APPLICATION_DIR);
spl_autoload_extensions('.php');
spl_autoload_register();

use RBMVC\Bootstrap;

$bootstrap = new Bootstrap();
echo $bootstrap->run(include APPLICATION_DIR . 'data/config.php');