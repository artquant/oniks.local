<?php

if (!isset($query['email'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#email'
	]);
}

if (empty(trim($query['email']))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#email'
	]);
}

if (!isset($query['password'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#password'
	]);
}

if (empty(trim($query['password']))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#password'
	]);
}

$user = Users::info(['id', 'access'], [
	'email,s' => $query['email'],
	'password,s' => Core::hashed($query['password'], 256)
]);

if (!$user) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверные данные',
		'element' => '#email'
	]);
}

if ($user->access != 9) {
	Core::answer([
		'status'  => false,
		'text'    => 'Доступ запрещён',
		'element' => '#email'
	]);
}

Sessions::set('iduser', $user->id);

Core::answer([
	'status' => true,
	'url'    => '/admin'
]);