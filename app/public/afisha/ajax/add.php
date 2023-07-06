<?php

if (!isset($query['date'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#date'
	]);
}

foreach ($query['date'] as $key => $date) {
	if (!Date::validateDate($date, 'Y-m-d')) {
		Core::answer([
			'status'  => false,
			'text'    => 'Неверная дата',
			'element' => '#date_' . $key
		]);
	}

	if ($date < date('Y-m-d')) {
		Core::answer([
			'status'  => false,
			'text'    => 'Дата меньше текущей',
			'element' => '#date_' . $key
		]);
	}
}

if (!isset($query['premieres'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#premieres .aq-select-container'
	]);
}

if (!Premieres::checkById($query['premieres'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Премьера не найдена',
		'element' => '#premieres'
	]);
}

foreach ($query['date'] as $date) {
	if (!Afisha::check('premieres_id = :premieres_id AND date_show = :date_show', [':premieres_id,i' => (int)$query['premieres'], ':date_show,s' => $date])) {
		Afisha::insert([
			'premieres_id,i' => (int)$query['premieres'],
			'date_show,s'    => $date
		]);
	}
}

Core::answer([
	'status' => true,
	'url'    => '/account/afisha?date=' . $query['date'][0]
]);