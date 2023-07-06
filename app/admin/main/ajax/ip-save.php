<?php

if (empty(Core::htmlClear($query['access_ip']))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Введите IP адрес',
		'element' => '#access_ip'
	]);
}

$array_access_ip = array_map('trim', explode(',', $access_ip));

foreach ($array_access_ip as $ip) {
	if (!filter_var($ip, FILTER_VALIDATE_IP)) {
		Core::answer([
			'status'  => false,
			'text'    => 'Неверный IP адрес',
			'element' => '#access_ip'
		]);
	}
}

DB::query("UPDATE admin_ip SET ip = :ip WHERE id = 1 LIMIT 1")::bind([
	':ip,s' => $query['access_ip']
]);

Core::answer([
	'status' => true,
	'url'    => '/admin'
]);