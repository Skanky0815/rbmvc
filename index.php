<?php 

define('CLASS_DIR', str_replace('index.php', '', __FILE__));
set_include_path(CLASS_DIR);
spl_autoload_extensions('.php');
spl_autoload_register();

use core\rbmvc\Dispatcher;

$dispatcher = Dispatcher::getInstance();
$dispatcher->init();
?>