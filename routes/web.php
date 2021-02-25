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

    'profile/album' => [
        'controller' => 'profile',
        'action' => 'album',
    ],

    'message' => [
        'controller' => 'message',
        'action' => 'index',
    ],

    'message/create' => [
        'controller' => 'message',
        'action' => 'createChat',
    ],

    'message/notification' => [
        'controller' => 'message',
        'action' => 'notification',
    ],

    'album/create' => [
        'controller' => 'profile',
        'action' => 'albumCreate',
    ],

    'album' => [
        'controller' => 'profile',
        'action' => 'album',
    ],

    'album/add' => [
        'controller' => 'profile',
        'action' => 'albumAdd',
    ],

    'image/delete' => [
        'controller' => 'profile',
        'action' => 'imageDelete',
    ],

    'mali/send' => [
        'controller' => 'profile',
        'action' => 'sendMail',
    ],


];