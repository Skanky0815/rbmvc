<?php

namespace Application;

use PDO;

return array(
    'database'    => array(
        'user'        => 'root',
        'host'        => 'localhost',
        'name'        => 'basti_test',
        'pass'        => 'root',
        'driver'      => 'mysql',
        'pdo_options' => array(
            PDO::ATTR_PERSISTENT         => true,
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ),
    ),
    'language'    => array(
        'default_language' => 'de',
    ),
    'class_paths' => array(
        'controller'         => __NAMESPACE__ . '\\Controller\\',
        'action_helper'      => __NAMESPACE__ . '\\Lib\\Controller\\Helper\\',
        'controller_plugins' => __NAMESPACE__ . '\\Lib\\Controller\\Plugins\\',
        'view_helper'        => __NAMESPACE__ . '\\Lib\\ViewHelper\\',
    ),
    'settings'    => array(
        'limit'                 => 10,
        'controller_plugin_dir' => APPLICATION_DIR . 'Lib/Controller/Plugins',
    ),
    'cache'       => array(
        'javascript' => false,
    ),
);