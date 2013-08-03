<?php 

return array(
    'database' => array(
        'user'      => 'root',
        'host'      => 'localhost',
        'name'      => 'basti_test',
        'pass'      => 'root',
        'driver'    => 'mysql',
        'pdo_options' => array(
            PDO::ATTR_PERSISTENT => true,
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ),
    ),
    'language' => array(
        'default_language' => 'de',
    ),
);