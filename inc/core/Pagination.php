<?php

class Pagination {
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
	 * Текущая страница
	 *
	 * @var int
	 */
	private static $current_page = 1;

	/**
	 * 
	 * Всего страниц
	 *
	 * @var int
	 */
	private static $count_pages = 0;

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
	private static function setUrl($page) {
		self::$query['page'] = $page;

		return self::$path . '?' . http_build_query(self::$query);
	}

	/**
	 *
	 * Вычисляем количество страниц
	 *
	 * @access private
	 * @static
	 * @param int $per_page количество записей на страницу
	 * @param int $total количество записей
	 * @return void
	 */
	private static function getCountPages($per_page, $total) {
		self::$count_pages = ceil($total / $per_page) ?: 1;
	}

	/**
	 *
	 * Текущая страница
	 *
	 * @access private
	 * @static
	 * @param int $page
	 * @return void
	 */
	private static function getCurrentPage($page) {
		if (!$page OR (int)$page < 1) {
			self::$current_page = 1;
		} else if ($page > self::$count_pages) {
			self::$current_page = self::$count_pages;
		} else {
			self::$current_page = (int)$page;
		}
	}

	/**
	 *
	 * Формируем HTML код для навигации
	 *
	 * @access private
	 * @static
	 * @param array $ajax [true, имя контейнера]
	 * @param int $per_page
	 * @param int $total
	 * @return string
	 */
	private static function htmlBuild($ajax, $per_page, $total) {
		$active_page  = null;
		$back         = null;
		$forward      = null;
		$start_page   = null;
		$end_page     = null;
		$page_1_left  = null;
		$page_2_left  = null;
		$page_3_left  = null;
		$page_1_right = null;
		$page_2_right = null;
		$page_3_right = null;

		$ajax_param = ($ajax[0]) ? ' onclick="ajax.Url({href:this.href, container: \'' . $ajax[1] . '\'});return false"' : null;

		if ($total > $per_page) {
			$active_page = '<div class="aq-nav-link active">' . self::$current_page . '</div>';
		}

		if (self::$current_page > 1) {
			$back = '<a class="aq-nav-link" href="' . self::setUrl(self::$current_page - 1) . '"' . $ajax_param . '>&lsaquo;</a>';
		}

		if (self::$current_page < self::$count_pages) {
			$forward = '<a class="aq-nav-link" href="' . self::setUrl(self::$current_page + 1) . '"' . $ajax_param . '>&rsaquo;</a>';
		}

		if (self::$current_page > 3) {
			$start_page = '<a class="aq-nav-link" href="' . self::setUrl(1) . '"' . $ajax_param . '>&laquo;</a>';
		}

		if (self::$current_page < self::$count_pages - 2) {
			$end_page = '<a class="aq-nav-link" href="' . self::setUrl(self::$count_pages) . '"' . $ajax_param . '>&raquo;</a>';
		}

		if (self::$current_page - 3 > 0) {
			$page_3_left = '<a class="aq-nav-link" href="' . self::setUrl(self::$current_page - 3) . '"' . $ajax_param . '>' . (self::$current_page - 3) . '</a>';
		}

		if (self::$current_page - 2 > 0) {
			$page_2_left = '<a class="aq-nav-link" href="' . self::setUrl(self::$current_page - 2) . '"' . $ajax_param . '>' . (self::$current_page - 2) . '</a>';
		}

		if (self::$current_page - 1 > 0) {
			$page_1_left = '<a class="aq-nav-link" href="' . self::setUrl(self::$current_page - 1) . '"' . $ajax_param . '>' . (self::$current_page - 1) . '</a>';
		}

		if (self::$current_page + 1 <= self::$count_pages) {
			$page_1_right = '<a class="aq-nav-link" href="' . self::setUrl(self::$current_page + 1) . '"' . $ajax_param . '>' . (self::$current_page + 1) . '</a>';
		}

		if (self::$current_page + 2 <= self::$count_pages) {
			$page_2_right = '<a class="aq-nav-link" href="' . self::setUrl(self::$current_page + 2) . '"' . $ajax_param . '>' . (self::$current_page + 2) . '</a>';
		}

		if (self::$current_page + 3 <= self::$count_pages) {
			$page_3_right = '<a class="aq-nav-link" href="' . self::setUrl(self::$current_page + 3) . '"' . $ajax_param . '>' . (self::$current_page + 3) . '</a>';
		}

		return '<div class="aq-pagination"><div class="aq-pagination-pages">' . $start_page . $back . $page_3_left . $page_2_left . $page_1_left . $active_page . $page_1_right . $page_2_right . $page_3_right . $forward . $end_page . '</div></div>';
	}

	/**
	 *
	 * Формируем Пагинацию
	 *
	 * @access public
	 * @static
	 * @param int $page текущая страница
	 * @param int $total всего записей
	 * @param array $ajax [true, container]
	 * @param int $per_page количество записей на страницу
	 * @return array ['start' => начальная позиция для DB, 'show' => HTML код, для вывода пагинации на страницу]
	 */
	public static function build($page, $total, $ajax = [true, '#app'], $per_page = 10) {
		self::getUrl();
		self::getCountPages($per_page, $total);
		self::getCurrentPage($page);

		return [
			'start' => (self::$current_page - 1) * $per_page,
			'show'  => ($total > 1) ? self::htmlBuild($ajax, $per_page, $total) : null
		];
	}
}