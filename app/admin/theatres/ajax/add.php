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

if (!preg_match('/\+\d{1}\s\(\d{3}\)\s\d{3}-\d{2}-\d{2}/', $query['phone'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверный номер телефона',
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

$phone = preg_replace('/\+(\d{1})\s\((\d{3})\)\s(\d{3})-(\d{2})-(\d{2})/', '$1$2$3$4$5', $query['phone']);

Theatres::insert([
	'name,s'       => Core::htmlClear($query['name'], true),
	'city'         => Core::htmlClear($query['city'], true),
	'address'      => Core::htmlClear($query['address'], true),
	'phone,s'      => $phone,
	'halls_name,s' => Core::htmlClear($query['halls_name'], true)
]);

Core::answer([
	'status' => true,
	'url'    => '/admin/theatres'
]);