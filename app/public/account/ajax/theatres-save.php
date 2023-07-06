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

if (!isset($query['city'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#city'
	]);
}

if (empty(trim(Core::htmlClear($query['city'], true)))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#city'
	]);
}

if (!isset($query['address'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#address'
	]);
}

if (empty(trim(Core::htmlClear($query['address'], true)))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#address'
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

if (!isset($query['halls_name'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#halls_name'
	]);
}

if (empty(trim(Core::htmlClear($query['halls_name'], true)))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#halls_name'
	]);
}

$bind = [
	'name,s'       => Core::htmlClear($query['name'], true),
	'city'         => Core::htmlClear($query['city'], true),
	'address'      => Core::htmlClear($query['address'], true),
	'phone,s'      => $query['phone'],
	'halls_name,s' => Core::htmlClear($query['halls_name'], true)
];

Theatres::update($bind, USER['theatres_id']);

Core::answer([
	'status' => true,
	'url'    => '/account/theatres'
]);