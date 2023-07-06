<?php

if (!isset($query['time'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#time'
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

Theatres::updateDateShow([
	'time_show,s' => implode(',', $query['time']),
	'min_price,i' => floatval($query['min_price']),
	'halls,s'     => $query['halls'] ?? null
], $query['theatres_date_show_id']);

Core::answer([
	'status' => true,
	'url'    => $_SERVER['HTTP_REFERER']
]);