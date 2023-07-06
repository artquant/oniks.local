<?php

class CalendarAfisha {
	/**
	 *
	 * URL без Get запросов
	 *
	 * @var string
	 */
	private static $path;

	/**
	 *
	 * Get запросы
	 *
	 * @var array
	 */
	private static $query;

	/**
	 *
	 * Поная информация о днях
	 *
	 * @var array
	 */
	private static $day_info = [];

	/**
	 *
	 * Краткие имена недель
	 *
	 * @var array
	 */
	private static $week_name = [
		1 => 'Пн',
		2 => 'Вт',
		3 => 'Ср',
		4 => 'Чт',
		5 => 'Пт',
		6 => 'Сб',
		0 => 'Вс'
	];

	/**
	 *
	 * Полные имена месяцев
	 *
	 * @var array
	 */
	private static $month_name = [
		'январь',
		'февраль',
		'март',
		'апрель',
		'май',
		'июнь',
		'июль',
		'август',
		'сентябрь',
		'октябрь',
		'ноябрь',
		'декабрь'
	];

	/**
	 *
	 * Разбиваем Url на путь и запросы
	 *
	 * @access  private
	 * @static
	 * @return void
	 */
	private static function getUrl() {
		$url = parse_url($_SERVER['REQUEST_URI']);

		parse_str($url['query'] ?? '', $query);

		self::$path = $url['path'];
		self::$query = $query;
	}

	/**
	 *
	 * Собираем Url
	 *
	 * @access private
	 * @static
	 * @param int $page
	 * @return string
	 */
	private static function setUrl($date) {
		self::$query['date'] = $date;

		return self::$path . '?' . http_build_query(self::$query);
	}

	/**
	 *
	 * Собираем в массив всю информацию
	 *
	 * @access private
	 * @static
	 * @param int $next_day - кол-во дней
	 * @return array
	 */
	private static function buildDays($prev_day = null, $next_day = 7) {
		if ($prev_day) {
			for ($i = $prev_day; $i > 0; $i--) {
				self::$day_info[self::$month_name[(int)date('m', strtotime('-' . $i . ' days')) - 1]][] = [
					'd'     => date('d', strtotime('-' . $i . ' days')),
					'm'     => date('m', strtotime('-' . $i . ' days')),
					'y'     => date('Y', strtotime('-' . $i . ' days')),
					'w'     => self::$week_name[(int)date('w', strtotime('-' . $i . ' days'))],
					'w_num' => (int)(date('w', strtotime('-' . $i . ' days')))
				];
			}
		}

		for ($i = 0; $i < $next_day; $i++) {
			self::$day_info[self::$month_name[(int)date('m', strtotime('+' . $i . ' days')) - 1]][] = [
				'd'     => date('d', strtotime('+' . $i . ' days')),
				'm'     => date('m', strtotime('+' . $i . ' days')),
				'y'     => date('Y', strtotime('+' . $i . ' days')),
				'w'     => self::$week_name[(int)date('w', strtotime('+' . $i . ' days'))],
				'w_num' => (int)(date('w', strtotime('+' . $i . ' days')))
			];
		}

		return self::$day_info;
	}

	/**
	 *
	 * Формируем HTML код для вывода на страницу
	 *
	 * @access public
	 * @static
	 * @param string $date - формат (Y-m-d)
	 * @param int $next_day
	 */
	public static function html($date, $prev_day = 7, $next_day = 7) {
		self::getUrl();

		$all_days_info = self::buildDays($prev_day, $next_day);
		$html = '';

		foreach ($all_days_info as $month => $day_info) {
			$html .= '<div class="calendar-afisha-month-info">';
			$html .= '<div class="calendar-afisha-month-name">' . $month . '</div>';
			$html .= '<div class="calendar-afisha-day-info">';

			foreach ($day_info as $info) {
				$class_active = ($date == $info['y'] . '-' . $info['m'] . '-' . $info['d']) ? ' active' : '';
				$class_weekend = ($info['w_num'] == 0 OR $info['w_num'] == 6) ? ' weekend' : '';

				$html .= '<div class="calendar-afisha-day">';
				$html .= Ajax::url(self::setUrl($info['y'] . '-' . $info['m'] . '-' . $info['d']), '<div class="calendar-afisha-day-num">' . (int)$info['d'] . '</div><div class="calendar-afisha-week-name">' . $info['w'] . '</div>', ['class' => 'afisha-link' . $class_active . $class_weekend]);
				$html .= '</div>';
			}

			$html .= '</div>';
			$html .= '</div>';
		}

		return $html;
	}
}