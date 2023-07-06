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

$user = Users::info(['id', 'access, isBlock'], [
	'email,s' => Core::htmlClear($query['email']),
	'password,s' => Core::hashed($query['password'], 256)
]);

if (!$user) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверные данные',
		'element' => '#email'
	]);
}

if ($user->isBlock) {
	Core::answer([
		'status'  => false,
		'text'    => 'Аккаунт заблокирован',
		'element' => '#email'
	]);
}

Sessions::set('iduser', $user->id);

DB::query("UPDATE users SET ip = :ip WHERE id = :id LIMIT 1")::bind([
	':ip,s' => Ip::real(),
	':id,i' => $user->id
]);

if (isset($query['sd']) AND $query['sd'] == 'on') {
	Cookies::set([
		'email'    => $query['email'],
		'password' => $query['password']
	], 86400 * 30 * 12);
}

Core::answer([
	'status' => true,
	'url'    => '/account'
]);