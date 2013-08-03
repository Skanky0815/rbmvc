<?php
return array(
    'main' => array(
        'home' => array(
            'label' => 'home',
            'controller' => 'index',
            'action' => 'index',
        ),
        'entry' => array(
            'label' => 'entries',
            'controller' => 'entry',
            'action' => 'index',
        ),
        'administration' => array(
            'label' => 'administration',
            'controller' => 'user',
            'action' => 'index',
            'pages' => array(
                'user' => array(
                    'label' => 'user',
                    'controller' => 'user',
                    'action' => 'index',
                ),
                'user_groups' => array(
                    'label' => 'user_groups',
                    'controller' => 'user-groups',
                    'action' => 'index',
                ),
                'grants' => array(
                    'label' => 'grant',
                    'controller' => 'grant',
                    'action' => 'index',
                ),
            ),
        ),
    ),
);