<?php

class Router {
	/**
	 * Маршрутизатор
	 *
	 * target - путь к папке
	 * controller - имя контроллера
	 * action - имя функции
	 *
	 * @var array
	*/
	private static $route = [];

	/**
	 * Карта маршрутизатора
	 *
	 * @var array
	*/
	private static $map_routes = [];

	/**
	 *
	 * Заглавная буква
	 *
	 * @access private
	 * @static
	 * @param string $name
	 * @return string
	*/
	private static function upperCamelCase($name) {
		return str_replace(' ', '', ucwords(str_replace('-', ' ', $name)));
	}

	/**
	 *
	 * Обрезаем пробелы в запросах
	 *
	 * @access public
	 * @static
	 * @param array $request
	 * @return array
	*/
	private static function trim($request = []) {
		if ($request) {
			foreach ($request as $key => $value) {
				if (is_array($value)) {
					for ($i = 0; $i < count($value); $i++) {
						$request[$key][$i] = trim($request[$key][$i]);
					}
				} else {
					$request[$key] = trim($request[$key]);
				}
			}
		}

		return $request;
	}

	/**
	 *
	 * Устанавливаем реферер контроллера (для ajax запросов)
	 *
	 * @access private
	 * @static
	 * @param array $route
	 * @return void
	*/

	/**
	 *
	 * Обрезаем и парсим URL
	 *
	 * @access private
	 * @static
	 * @param string $url
	 * @return string
	*/
	private static function parseUrl($url) {
		return trim(parse_url($url, PHP_URL_PATH), '/');
	}

	/**
	 *
	 * Формируем мартшрутизатор
	 *
	 * @access private
	 * @static
	 * @param string $url
	 * @return void
	*/
	private static function buildRoute($url) {
		$url = self::parseUrl($url);

		/* подключаем маршруты */
		self::$map_routes = require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'routes.php';

		foreach (self::$map_routes as $pattern => $path) {
			if (preg_match("~$pattern~", $url)) {
				$replace_routes = preg_replace("~$pattern~", $path, $url);

				return self::setRoute(explode('/', $replace_routes));
			}
		}

		self::setRoute(explode('/', $url));
	}

	/**
	 *
	 * В зависимости от контроллера, устанавливаем путь к папке
	 *
	 * @access private
	 * @static
	 * @param array $url
	 * @return void
	*/
	private static function setRoute($url) {
		if (isset($url[0]) AND $url[0] == 'admin') {
			self::$route['target'] = array_shift($url);
		} else {
			self::$route['target'] = 'public';
		}

		self::$route['controller'] = (empty($url[0])) ? 'main' : array_shift($url);
		self::$route['action'] = (empty($url[0])) ? 'index' : array_shift($url);
	}

	/**
	 *
	 * Подключаем класс и метод маршрутизатора, путь к папке с именем контроллера
	 *
	 * @access public
	 * @static
	 * @param string $url
	 * @return void
	*/
	public static function build($url) {
		self::buildRoute($url);

		$controller_name = self::upperCamelCase(self::$route['controller']) . 'Controller';
		$action_name = 'action' . self::upperCamelCase(self::$route['action']);
		$controller_dir = $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . self::$route['target'] . DIRECTORY_SEPARATOR . self::$route['controller'];

		if (is_dir($controller_dir)) {
			$controller_file = $controller_dir . DIRECTORY_SEPARATOR . 'controller' . DIRECTORY_SEPARATOR . $controller_name . '.php';

			if (file_exists($controller_file)) {
				/* подключаем файл контроллера */
				require_once $controller_file;

				/* проверяем класс контроллера */
				if (class_exists($controller_name)) {
					$controller_class = new $controller_name(self::$route, $controller_dir);

					/* проверяем метод контроллера */
					if (method_exists($controller_class, $action_name)) {
						call_user_func_array([$controller_class, $action_name], [self::trim($_REQUEST)]);
						$controller_class->render();
					} else {
						exit('Метод:: <b>' . $action_name . '</b> не создан');
					}
				} else {
					exit('Контроллер:: <b>' . $controller_name . '</b> не создан');
				}
			} else {
				exit('Файл контроллера не создан');
			}
		} else {
			self::ErrorPage404();
		}

	}

	/**
	 *
	 * Страница ошибки 404
	 *
	 * @access public
	 * @static
	 * @return void
	*/
	public static function ErrorPage404() {
		$protocol = isset($_SERVER['HTTPS']) AND $_SERVER['HTTPS'] != 'off' OR 443 == $_SERVER['SERVER_PORT'] ? 'https' : 'http';
		$host = $protocol . '://' . $_SERVER['HTTP_HOST'] . '/';

		if (isset($_SERVER['HTTP_X_REQUESTED_WITH']) AND !empty($_SERVER['HTTP_X_REQUESTED_WITH']) AND strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
			echo '<script>window.location.replace(' . $host . '404)</script>';
		} else {
			http_response_code(404);

			header('HTTP/1.1 404 Not Found');
			header('Location: ' . $host . '404');
		}

		exit;
	}
}