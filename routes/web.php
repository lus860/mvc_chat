<?php

return [

    '' => [
        'controller' => DEFAULT_CONTROLLER,
        'action' => DEFAULT_ACTION,
    ],

    'account/login' => [
        'controller' => 'account',
        'action' => 'login',
    ],

    'account/register' => [
        'controller' => 'account',
        'action' => 'register',
    ],

    'account/logout' => [
        'controller' => 'account',
        'action' => 'logout',
    ],

    'profile' => [
        'controller' => 'profile',
        'action' => 'index',
    ],

    'profile/edit' => [
        'controller' => 'profile',
        'action' => 'edit',
    ],

    'message' => [
        'controller' => 'message',
        'action' => 'index',
    ],

];