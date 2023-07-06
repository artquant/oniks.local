<?php

error_reporting(-1);
session_start();

define('ROOT', dirname(__FILE__));
define('D_S', DIRECTORY_SEPARATOR);

require_once ROOT . D_S . 'inc' . D_S . 'autoload.php';
require_once ROOT . D_S . 'inc' . D_S . 'define.php';

// Данные пользователя
if (Sessions::check('iduser')) {
	define('USER', get_object_vars(Users::info('*', ['id,i' => Sessions::get('iduser')])));
} else {
	define('USER', []);
}

Router::build($_SERVER['REQUEST_URI']);