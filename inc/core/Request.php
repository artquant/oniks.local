<?php

class Request {
	/**
	 *
	 * Возвращаем протокол
	 *
	 * @access public
	 * @static
	 * @return string
	*/
	public static function protocol() {
		return isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off' || 443 == $_SERVER['SERVER_PORT'] ? 'https' : 'http';
	}

	/**
	 *
	 * Проверка Ajax запроса
	 *
	 * @access public
	 * @static
	 * @return bool
	*/
	public static function isAjax() {
		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) &&
					!empty($_SERVER['HTTP_X_REQUESTED_WITH']) &&
					strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			return true;
		}

		return false;
	}

	/**
	 *
	 * Перенаправление страницы
	 *
	 * @access public
	 * @static
	 * @param array $options [url, response]
	 * @return void
	*/
	public static function location($options = []) {
		$options = array_replace([
			'url'      => '',
			'response' => false
		], $options);

		if ($options['response']) {
			print_r(json_encode([
				'status' => false,
				'url'    => $options['url']
			]));
		} else {
			if (self::isAjax()) {
				echo '<script>window.location.replace(\'' . $options['url'] . '\')</script>';
			} else {
				header('Location: ' . $options['url']);
			}
		}

		exit;
	}
}