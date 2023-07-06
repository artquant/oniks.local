<?php

class Ip {
	/**
	 * IP адресс
	 *
	 * @var string|int
	*/
	private static $ip = null;

	/**
	 *
	 * Возвращаем настоящий IP адрес
	 *
	 * @access public
	 * @static
	 * @return string
	*/
	public static function real() {
		if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
			self::$ip = $_SERVER['HTTP_CLIENT_IP'];
		} elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
			self::$ip = $_SERVER['HTTP_X_FORWARDED_FOR'];
		} else {
			self::$ip = $_SERVER['REMOTE_ADDR'];
		}

		/* проверяем на прокси-сервер */
		if (strpos(self::$ip, ',')) {
			$proxyIP = explode(',', self::$ip);

			if (!preg_match('/^\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}$/' , $proxyIP[0])) {
				self::$ip = $_SERVER['REMOTE_ADDR'];
			} else {
				self::$ip = (!preg_match( "/^(10|172\.16|192\.168)\./", $proxyIP[0])) ? $proxyIP[0] : $_SERVER['REMOTE_ADDR'];
			}
		}

		return self::$ip;
	}
}