<?php

class Core {
	/**
	 *
	 * Генерация случайных значений
	 *
	 * @access  public
	 * @static
	 * @param int $num - кол-во генерируемых символов
	 * @param string $type (f - буквы и цифры, n - цифры, s - буквы)
	 * @return string
	 */
	public static function generate($num, $type = 'f') {
		$array_abc = [];
		$result    = null;

		switch ($type) {
			case 'f' :
				$array_abc = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z', '1', '2', '3', '4', '5', '6', '7', '8', '9', '0'];
			break;
			case 'n' :
				$array_abc = [1 ,2 , 3, 4, 5, 6, 7, 8, 9, 0];
			break;
			case 's' :
				$array_abc = ['a', 'b', 'c', 'd', 'e', 'f', 'g', 'h', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'q', 'r', 's', 't', 'u', 'v', 'w', 'x', 'y', 'z', 'A', 'B', 'C', 'D', 'E', 'F', 'G', 'H', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'Q', 'R', 'S', 'T', 'U', 'V', 'W', 'X', 'Y', 'Z'];
			break;
		}

		for ($i = 0; $i < $num; $i++) {
			$result .= $array_abc[rand(0, count($array_abc) - 1)];
		}

		return $result;
	}

	/**
	 *
	 * Формирования ответа
	 *
	 * @access  public
	 * @static
	 * @param array $params
	 * @param bool $return - возвращать или выводить
	 * @param bool $exit - запрещать дальнейшие дествия
	 * @return mixed
	 */
	public static function answer($params = [], $return = false, $exit = true) {
		if ($return) {
			return json_encode($params);

			if ($exit) exit;
		} else {
			print_r(json_encode($params));

			if ($exit) exit;
		}
	}

	/**
	 *
	 * Хеширование
	 *
	 * @access public
	 * @static
	 * @param string $text
	 * @param int $type (default : 5 - md5) - [1 = sha1, 256 = sha256, 512 = sha512, 5 = md5]
	 * @return string
	*/
	public static function hashed($text, $type = 5) {
		if ($type == 5) {
			return md5($text . HASH);
		} else {
			return hash("sha{$type}", $text . HASH);
		}
	}

	/**
	 *
	 * Возвращает число, со своим округлением
	 *
	 * @access public
	 * @static
	 * @param float|int $number
	 * @param int $length (default : 0)
	 * @return int|float
	*/
	public static function rounding($number, $length = 0) {
		if (!is_numeric($number)) {
			return 0;
		} else if (strpos($number, '.')) {
			return floatval(explode('.', $number)[0] . '.' . substr(explode('.', $number)[1], 0, $length));
		} else {
			return $number;
		}
	}

	/**
	 *
	 * Склонение слов
	 *
	 * @access public
	 * @static
	 * @param int $number
	 * @param array $suffix - 1 = просмотр, 2 = просмотра, 0 = просмотров ['просмотр', 'просмотра', 'просмотров']
	*/
	public static function decWords($number, $suffix) {
		$keys = array(2, 0, 1, 1, 1, 2);
		$mod = $number % 100;

		$suffix_key = ($mod > 7 AND $mod < 20) ? 2 : $keys[min($mod % 10, 5)];

		return $suffix[$suffix_key];
	}

	/**
	 *
	 * Очистка текста
	 *
	 * @access public
	 * @static
	 * @param string $text
	 * @param bool $strip
	 * @param bool $double_space - разрешать 2 и более пробелов
	 * @return string
	*/
	public static function htmlClear($text, $strip = false, $double_space = false) {
		if ($strip) $text = strip_tags($text);

		$text = htmlspecialchars(trim($text), ENT_QUOTES);

		if (!$double_space) $text = preg_replace('/\s\s+/i', ' ', $text);

		return $text;
	}

	/**
	 *
	 * Форматирование телефонного номера
	 *
	 * @access public
	 * @static
	 * @param int $phone
	 * @return string
	 */
	public static function phoneСorrect($phone) {
		if ($phone) {
			$res = preg_replace(
				array(
					'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{3})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
					'/[\+]?([7|8])[-|\s]?(\d{3})[-|\s]?(\d{3})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
					'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
					'/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{2})[-|\s]?(\d{2})[-|\s]?(\d{2})/',
					'/[\+]?([7|8])[-|\s]?\([-|\s]?(\d{4})[-|\s]?\)[-|\s]?(\d{3})[-|\s]?(\d{3})/',
					'/[\+]?([7|8])[-|\s]?(\d{4})[-|\s]?(\d{3})[-|\s]?(\d{3})/',
				),
				array(
					'+7 ($2) $3-$4-$5',
					'+7 ($2) $3-$4-$5',
					'+7 ($2) $3-$4-$5',
					'+7 ($2) $3-$4-$5',
					'+7 ($2) $3-$4',
					'+7 ($2) $3-$4',
				),
				$phone
			);
		} else {
			$res = null;
		}

		return $res;
	}
}