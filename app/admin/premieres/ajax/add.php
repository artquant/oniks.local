<?php

if (!isset($_FILES['poster'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Постер не выбран',
		'element' => '#poster'
	]);
}

if (Upload::emptyFile($_FILES['poster'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Постер не выбран',
		'element' => '#poster'
	]);
}

if (!Upload::isFileType($_FILES['poster'], ['image/jpg', 'image/jpeg'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверный формат изображения',
		'element' => '#poster'
	]);
}

if (!isset($query['title'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#title'
	]);
}

if (empty(trim(Core::htmlClear($query['title'], true)))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#title'
	]);
}

if (!isset($query['release'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#release'
	]);
}

if (!preg_match('/^\d{4}$/', $query['release'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверно указан год',
		'element' => '#release'
	]);
}

if ($query['release'] < 2000) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверно указан год',
		'element' => '#release'
	]);
}

if (!isset($query['country'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '.country'
	]);
}

foreach (Country::list() as $country) {
	$country_list[] = $country->id;
}

if (!empty(array_diff($query['country'], $country_list))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверно выбрана страна',
		'element' => '.country'
	]);
}

if (!isset($query['genre'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '.genre'
	]);
}

foreach (Genre::list() as $genre) {
	$genre_list[] = $genre->id;
}

if (!empty(array_diff($query['genre'], $genre_list))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверно выбран жанр',
		'element' => '.genre'
	]);
}

if (!isset($query['actors'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#actors'
	]);
}

if (empty(trim(Core::htmlClear($query['actors'], true)))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#actors'
	]);
}

if (!preg_match( '/^([а-яА-ЯЁёa-zA-Z\s,\-\'\.]+)$/u', $query['actors'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Недопустимые символы',
		'element' => '#actors'
	]);
}

if (!isset($query['age_restrictions'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#age_restrictions'
	]);
}

if (empty(trim(Core::htmlClear($query['age_restrictions'], true)))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#age_restrictions'
	]);
}

if (!preg_match('/^\d{1,2}$/', $query['age_restrictions'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Неверно указаны данные',
		'element' => '#age_restrictions'
	]);
}

if (!isset($query['director'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#director'
	]);
}

if (empty(trim(Core::htmlClear($query['director'], true)))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#director'
	]);
}

if (!preg_match( '/^([а-яА-ЯЁёa-zA-Z\s,\-]+)$/u', $query['director'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Недопустимые символы',
		'element' => '#director'
	]);
}

if (!isset($query['description'])) {
	Core::answer([
		'status'  => false,
		'text'    => 'Обязательное поле',
		'element' => '#description'
	]);
}

if (empty(trim(Core::htmlClear($query['description'], true)))) {
	Core::answer([
		'status'  => false,
		'text'    => 'Поле не может быть пустым',
		'element' => '#description'
	]);
}

$time = time();
$ext_file = pathinfo($_FILES['poster']['name']);
$new_name = $time . '.' . $ext_file['extension'];
$path = $_SERVER['DOCUMENT_ROOT'] . D_S . 'web' . D_S . 'uploads' . D_S . 'premieres';

$premieres_id = Premieres::insert([
	'title,s'            => Core::htmlClear($query['title']),
	'poster,s'           => $new_name,
	'year_release,s'     => (int)$query['release'],
	'country_id,s'       => implode(',', $query['country']),
	'genre_id,s'         => implode(',', $query['genre']),
	'actors,s'           => Core::htmlClear($query['actors']),
	'age_restrictions,i' => (int)$query['age_restrictions'],
	'director,s'         => Core::htmlClear($query['director']),
	'description,s'      => Core::htmlClear($query['description'])
]);

$folder_premier = $path . D_S . $premieres_id;

if (!is_dir($folder_premier)) mkdir($folder_premier, 0777, true);

Upload::send($_FILES, $folder_premier . D_S, null, null, $time, false);

Core::answer([
	'status' => true,
	'url'    => '/admin/premieres'
]);