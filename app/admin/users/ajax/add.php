<?php

if (!isset($query['name'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#name'
	]);
}

if (empty(trim(Core::htmlClear($query['name'], true)))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#name'
	]);
}

if (!preg_match('/^[a-zA-Zа-яА-ЯёЁ]{3,}[a-zA-Zа-яА-ЯёЁ\-]{1,27}$/u', $query['name'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Недопустимые симолы',
		'element' => '#name'
	]);
}
if (!isset($query['surname'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#surname'
	]);
}

if (empty(trim(Core::htmlClear($query['surname'], true)))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#surname'
	]);
}

if (!preg_match('/^[a-zA-Zа-яА-ЯёЁ]{3,}[a-zA-Zа-яА-ЯёЁ\-]{1,27}$/u', $query['surname'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Недопустимые симолы',
		'element' => '#surname'
	]);
}

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

if (!filter_var($query['email'], FILTER_VALIDATE_EMAIL)) {
	Core::answer([
		'status'  => false,
		'text'    => 'Недопустимый адрес электронной почты',
		'element' => '#email'
	]);
}

if (Users::checkEmail($query['email'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Электронная почта уже используется',
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

if (!isset($query['replay_password'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#replay_password'
	]);
}

if ($query['replay_password'] != $query['password']) {
	Core::answer([
		'status'  => false,
		'text'    => 'Пароли не совпадают',
		'element' => '#password'
	]);
}

if (!isset($query['phone'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#phone'
	]);
}

if (!preg_match('/^[0-9]{11}$/', $query['phone'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверно указан телефон',
		'element' => '#phone'
	]);
}

if (!isset($query['theatres'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#theatres'
	]);
}

if (!Theatres::checkById($query['theatres']) AND $query['theatres'] != 0) {
	Core::answer([
		'status'  => false,
		'text'    => 'Кинотеатр не найден',
		'element' => '#theatres'
	]);
}

Users::insert([
	'name,s'        => Core::htmlClear($query['name']),
	'surname,s'     => Core::htmlClear($query['surname']),
	'email,s'       => $query['email'],
	'password,s'    => Core::hashed($query['password'], 256),
	'phone,s'       => $query['phone'],
	'theatres_id,i' => (int)$query['theatres'],
	'access,i'      => (int)$query['access'],
	'dateReg,s'     => date('Y-m-d')
]);

Core::answer([
	'status' => true,
	'url'    => '/admin/users'
]);