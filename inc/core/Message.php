<?php

class Message {
	public static function nothingFound($text = 'По вашему запросы ничего не найдено', $link = true) {
		$link = ($link) ? '<a href="javascript: history.go(-1)">Вернуться назад</a>' : '';

		return '<div class="message-nothing-found"><span>' . $text . '</span>' . $link . '</div>';
	}
}