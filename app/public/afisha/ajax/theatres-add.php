<?php

if (!isset($query['afisha_id'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Афиша не найдена',
		'element' => '#time_0'
	]);
}

if (!Afisha::check('id = :id', [':id,i' => $query['afisha_id']])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Афиша не найдена',
		'element' => '#time_0'
	]);
}

if (!isset($query['date'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверная дата',
		'element' => '#time_0'
	]);
}

if (!Date::validateDate($query['date'], 'Y-m-d')) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверная дата',
		'element' => '#time_0'
	]);
}

if ($query['date'] < date('Y-m-d')) {
	Core::answer([
		'status'  => false,
		'text'    => 'Дата меньше текущей',
		'element' => '#time_0'
	]);
}

if (!Afisha::check('id = :id AND date_show = :date', [':id,i' => $query['afisha_id'], ':date,s' => $query['date']])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Афиша на указанную дату не найдена',
		'element' => '#time_0'
	]);
}

if (Theatres::checkDateShow('afisha_id = :afisha_id AND theatres_id = :theatres_id AND date_show = :date_show', [':afisha_id,i' => $query['afisha_id'], ':theatres_id,i' => USER['theatres_id'], ':date_show,s' => $query['date']])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Кинотеатр уже добавлен',
		'element' => '#time_0'
	]);
}

if (!isset($query['time'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#time_0'
	]);
}

foreach ($query['time'] as $key => $time) {
	if (!preg_match('/^\d{2}\:\d{2}$/', $time)) {
		Core::answer([
			'status'  => false,
			'text'    => 'Неверно указано время',
			'element' => '#time_' . $key
		]);
	}
}

if (!isset($query['min_price'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#min_price'
	]);
}

if (!is_numeric($query['min_price'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверная цена',
		'element' => '#min_price'
	]);
}

if (floatval($query['min_price']) <= 0) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверная цена',
		'element' => '#min_price'
	]);
}

Theatres::insertDateShow([
	'afisha_id,i'   => $query['afisha_id'],
	'theatres_id,i' => USER['theatres_id'],
	'date_show,s'   => $query['date'],
	'time_show,s'   => implode(',', $query['time']),
	'min_price,i'   => $query['min_price'],
	'halls,s'       => $query['halls'] ?? null
]);

Core::answer([
	'status' => true,
	'url'    => $_SERVER['HTTP_REFERER']
]);