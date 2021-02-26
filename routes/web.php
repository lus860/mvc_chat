<?php

return [

    '' => [
        'controller' => DEFAULT_CONTROLLER,
        'action' => DEFAULT_ACTION,
    ],

    // AccountController
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

    // ProfileController
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

    // MessageController

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

    // AlbumController
//    'album/create' => [
//        'controller' => 'profile',
//        'action' => 'albumCreate',
//    ],
//
//    'album' => [
//        'controller' => 'profile',
//        'action' => 'album',
//    ],
//
//    'album/add' => [
//        'controller' => 'profile',
//        'action' => 'albumAdd',
//    ],
//
//    'albumUser' => [
//        'controller' => 'profile',
//        'action' => 'albumUser',
//    ],
//
//    'albumImage/delete' => [
//        'controller' => 'profile',
//        'action' => 'imageDelete',
//    ],

    'album/create' => [
        'controller' => 'album',
        'action' => 'albumCreate',
    ],

    'album' => [
        'controller' => 'album',
        'action' => 'album',
    ],

    'album/add' => [
        'controller' => 'album',
        'action' => 'albumAdd',
    ],

    'albumUser' => [
        'controller' => 'album',
        'action' => 'albumUser',
    ],

    'albumImage/delete' => [
        'controller' => 'album',
        'action' => 'imageDelete',
    ],

    // MaliController
    'mali/send' => [
        'controller' => 'profile',
        'action' => 'sendMail',
    ],


];