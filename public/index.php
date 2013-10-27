<?php
namespace RBMVC;

define('ROOT_DIR', '../');
define('APPLICATION_DIR', ROOT_DIR . 'Application/');

require_once(ROOT_DIR . 'RBMVC/Core/ClassLoader.php');

$classLoader = new Core\ClassLoader();
$bootstrap   = new Bootstrap($classLoader);
echo $bootstrap->run(include APPLICATION_DIR . 'data/config.php');