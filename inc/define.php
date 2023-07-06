<?php

define('TIME_EXIT', 31536000);
/*
 * HASH - меняем до запуска сайта
 * используется для шифрования пароля
 */
define('HASH', 'a201xk2017');
define('SITENAME', 'ONIKS');

define('USER_ACCESS', [
	'1' => 'Пользователь',
	'2' => 'Киномодератор',
	'9' => 'Администратор'
]);

define ('DBCONFIG', [
	'host'    => '127.0.0.1',
	'user'    => 'root',
	'pass'    => 'root',
	'name'    => 'oniks',
	'port'    => 3306,
	'socket'  => NULL,
	'charset' => 'utf8'
]);

define('MONEY_SYMBOL', [
	'ru' => '&#8381;',
	'en' => '&#36;'
]);

define('CORE', ROOT . D_S . 'inc' . D_S . 'core' . D_S);
define('MODELS', ROOT . D_S . 'inc' . D_S . 'models' . D_S);
define('LIBS', ROOT . D_S . 'inc' . D_S . 'libs' . D_S);
define('LAYOUTS', ROOT . D_S . 'inc' . D_S . 'layouts' . D_S);

define('CSS', '/web/css/');
define('FONTS', '/web/fonts/');
define('IMG', '/web/img/');
define('JS', '/web/js/');
define('SVG', '/web/svg/');
define('AVATAR', '/web/uploads/avatars/');
define('AFISHA', '/web/uploads/afisha/');
define('PREMIERES', '/web/uploads/premieres/');