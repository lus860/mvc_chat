<?php
//Database params
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '111111');
define('DB_NAME', 'mvc_chat');

//Mail params
define('MAIL_HOST', 'smtp.mailtrap.io');
define('MAIL_USER', '459a14a65995bf');
define('MAIL_PASS', '174fe44ee2b3f4');
define('MAIL_CHARSET', 'utf-8');
define('MAIL_SMTPSECURE', 'tls');
define('MAIL_SMTPAuth', true);
define('MAIL_PORT', 587);
define('MAIL_ADMIN', 'lusine.hovhannisyan@esterox.am');
define('MAIL_ISHtml', true);

//
define('URL_ROOT', 'http://chat.loc');

define("BASE_URL",dirname(__DIR__));
define("CONFIGS",BASE_URL.DIRECTORY_SEPARATOR."configs".DIRECTORY_SEPARATOR);
define("CONTROLLERS",BASE_URL.DIRECTORY_SEPARATOR."application".DIRECTORY_SEPARATOR."controllers".DIRECTORY_SEPARATOR);
define("VIEWS",BASE_URL.DIRECTORY_SEPARATOR."application".DIRECTORY_SEPARATOR."views".DIRECTORY_SEPARATOR);
define("MODELS",BASE_URL.DIRECTORY_SEPARATOR."application".DIRECTORY_SEPARATOR."models".DIRECTORY_SEPARATOR);
define("PUB",BASE_URL.DIRECTORY_SEPARATOR."public".DIRECTORY_SEPARATOR);
define("CSS",PUB."css".DIRECTORY_SEPARATOR);
define("JS",PUB."js".DIRECTORY_SEPARATOR);
define("IMAGES",PUB."images".DIRECTORY_SEPARATOR);
define("VENDOR",BASE_URL.DIRECTORY_SEPARATOR."vendor".DIRECTORY_SEPARATOR);
define("CORE",VENDOR."core".DIRECTORY_SEPARATOR);
define("LIB",VENDOR."lib".DIRECTORY_SEPARATOR);
define("LAYOUTS",VIEWS."layouts".DIRECTORY_SEPARATOR);
define("ERRORS",VIEWS."errors".DIRECTORY_SEPARATOR);
define("ROUTES",BASE_URL.DIRECTORY_SEPARATOR."routes".DIRECTORY_SEPARATOR);

//
define("DEFAULT_CONTROLLER","home");
define("DEFAULT_ACTION","index");

//
define("DEFAULT_LAYOUT","default");

