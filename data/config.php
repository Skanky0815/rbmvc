<?php 


return array(
    'database' => array(
        'user' => 'root',
        'host' => 'localhost',
        'name' => 'basti_test',
        'pass' => 'root',
    ),
    'view' => array(
        'helper' => array(
            new \RBMVC\View\Helper\Url(),
            new \RBMVC\View\Helper\DateFormater(),
            new \RBMVC\View\Helper\Translate(),
        ),
    ),
    'language' => array(
        'default_language' => 'de',
    ),
);