<?php

class Date {
	private static $month_name = [
		'янв',
		'фев',
		'мар',
		'апр',
		'май',
		'июн',
		'июл',
		'авг',
		'сен',
		'окт',
		'ноя',
		'дек'
	];

	/**
	 *
	 * Проверка даты по шаблону
	 *
	 * @access public
	 * @static
	 * @param string $date
	 * @param string $format
	 * @return bool
	 */
	public static function validateDate($date, $format = 'Y-m-d H:i:s') {
		$d = DateTime::createFromFormat($format, $date);

		return $d && $d->format($format) == $date;
	}

	public static function dateFormat($date, $format = 'Y-m-d') {
		if (self::validateDate($date, $format)) {
			$d = new DateTime($date);
		} else {
			$d = new DateTime(date('Y-m-d'));
		}

		return $d->format('d') . ' ' . self::$month_name[(int)$d->format('m') - 1] . ' ' . $d->format('Y');
	}

	public static function showDateString($date) {
		$month = [
			'янв', 'фев', 'мар', 'апр', 'май', 'июн',
			'июл', 'авг', 'сен', 'окт', 'ноя', 'дек'
		];

		$exp_date = explode('-', $date);

		return $exp_date['2'] . ' ' . $month[(int)$exp_date[1] - 1] . ' ' . $exp_date[0];
	}
}