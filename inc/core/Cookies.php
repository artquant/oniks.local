<?php

class Cookies {
	/**
	 *
	 * Устанавливаем cookie
	 *
	 * @access public
	 * @static
	 * @param array $name
	 * @param int $time
	 * @param string $path
	 * @return void
	 */
	public static function set($name = [], $time = 86400, $path = '/', $http_only = false) {
		foreach ($name as $key => $value) {
			setcookie($key, $value, time() + $time, $path, '', false, $http_only);
		}
	}

	/**
	 *
	 * Удаляем cookie
	 *
	 * @access public
	 * @static
	 * @param array $name
	 * @param string $path
	 * @return void
	 */
	public static function del($name = [], $path = '/') {
		foreach ($name as $key) {
			setcookie($key, '', time() - 1, $path);
		}
	}

	/**
	 *
	 * Проверяем cookie
	 *
	 * @access public
	 * @static
	 * @param string $cookie
	 * @return bool
	 */
	public static function check($cookie) {
		return isset($_COOKIE[$cookie]) ? true : false;
	}

	/**
	 *
	 * Возвращаем cookie
	 *
	 * @access public
	 * @static
	 * @param string $name
	 * @return string
	 */
	public static function get($name) {
		return (self::check($name)) ? $_COOKIE[$name] : '';
	}
}