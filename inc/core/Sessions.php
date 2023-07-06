<?php

class Sessions {
	/**
	 *
	 * Устанавливаем сессию
	 *
	 * @access public
	 * @static
	 * @param string $name
	 * @param string $type
	 * @return void
	 */
	public static function set($name, $type) {
		$_SESSION[$name] = $type;
	}

	/**
	 *
	 * Проверяем сессию
	 *
	 * @access public
	 * @static
	 * @param string $name
	 * @return bool
	 */
	public static function check($name) {
		return (isset($_SESSION[$name])) ? true : false;
	}

	/**
	 *
	 * Удаляем сессию
	 *
	 * @access public
	 * @static
	 * @param array $name
	 * @return void
	 */
	public static function del($name = []) {
		foreach ($name as $key) {
			if (self::check($key)) {
				unset($_SESSION[$key]);
			}
		}
	}

	/**
	 *
	 * Возвращаем сессию
	 *
	 * @access public
	 * @static
	 * @param string $name
	 * @return string
	 */
	public static function get($name) {
		return (self::check($name)) ? $_SESSION[$name] : '';
	}
}