<?php

abstract class App {
	/**
	 * Маршрутизатор
	 *
	 * target - путь к папке
	 * controller - имя контроллера
	 * action - имя функции
	 *
	 * @var array
	*/
	public $route = [];

	/**
	 * Полный путь к папке контроллера
	 *
	 * @var string
	*/
	public $controller_dir = null;

	/**
	 * Шаблон страницы
	 *
	 * @var string
	*/
	public $layout = null;

	/**
	 * Проверка на подключения файла функции (action)
	 *
	 * @var bool
	*/
	public $is_view = true;

	/**
	 * Переменные, передаваемые в контент
	 *
	 * @var array
	*/
	public $vars = [];

	/**
	 * Ajax запрос
	 *
	 * @var bool
	*/
	public $ajax = false;

	/**
	 * Вывод заголовков в главном шаблоне
	 *
	 * @var array
	*/
	public $meta = ['title' => '', 'des' => '', 'key' => ''];

	/**
	 *
	 * @access public
	 * @param array $route
	 * @param string $controller_dir
	 * @return void
	*/
	public function __construct ($route, $controller_dir) {
		$this->session();
		$this->route = $route;
		$this->controller_dir = $controller_dir;
		$this->layout = (is_null($this->layout)) ? $route['target'] : $this->layout;
	}

	/**
	 *
	 * Устанавливаем заголовки
	 *
	 * @access public
	*/
	public function setMeta($options = []) {
		$options = array_replace([
			'title' => '',
			'des'   => '',
			'key'   => ''
		], $options);

		$this->meta = $options;
	}

	/**
	 *
	 * Вывод заголовки при AJAX запросе
	 *
	 * @access private
	 * @return void
	*/
	private function ajaxMeta() {
		echo '<script type="text/javascript">setMeta(\'' . $this->meta['title'] . '\', \'' . $this->meta['des'] . '\', \'' . $this->meta['key'] . '\')</script>';
	}

	/**
	 *
	 * Проверяем время жизни сессии, если время превысило, удаляем
	 * (TIME_EXIT - inc/define.php)
	 *
	 * @access private
	 * @return void
	*/
	private function session() {
		if (isset($_SESSION['iduser'])) {
			if (isset($_SESSION['loginTime']) AND $_SESSION['loginTime'] < time() - TIME_EXIT) {
				session_unset();
			} else {
				$_SESSION['loginTime'] = time();
			}
		}
	}

	/**
	 *
	 * Обфускация (пробелы, переносы)
	 *
	 * @access protected
	 * @param string $buffer
	 * @return string
	*/
	protected function compressPage($buffer) {
		$search = [
			'/\>[^\S ]+/s',
			'/[^\S ]+\</s',
			'/(\s)+/s',
			'/<!--(.|\s)*?-->/',
			'/\{\s+/',
			'/\s+\}/'
		];

		$replace = [
			'>',
			'<',
			'\\1',
			'',
			'{',
			'}'
		];

		return preg_replace($search, $replace, $buffer);
	}

	/**
	 *
	 * Передаем переменные для основного контента
	 *
	 * @access public
	 * @param array $vars (['text' => $text])
	 * @return void
	*/
	public function set($vars = []) {
		$this->vars = $vars;
	}

	/**
	 *
	 * Выводим дополнительный контент в основной шаблон
	 *
	 * @access public
	 * @param array $options [file => name, modules => name, path => public|admin]
	 * @return void
	*/
	public function reqContent($options = []) {
		$vars = $this->vars;

		if (is_array($vars)) {
			extract($vars);
		}

		$options = array_replace([
			'file'    => null,
			'modules' => null,
			'path'    => 'public'
		], $options);

		ob_start();

		require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . $options['path'] . DIRECTORY_SEPARATOR . $options['modules'] . DIRECTORY_SEPARATOR . 'view' . DIRECTORY_SEPARATOR . $options['file'] . '.php';

		return ob_get_clean();
	}

	/**
	 *
	 * Выводим основной шаблон
	 *
	 * @access public
	 * @return void
	*/
	public function render() {
		$prefix_dir = ($this->ajax) ? 'ajax' : 'view';
		$file = $this->controller_dir . DIRECTORY_SEPARATOR . $prefix_dir . DIRECTORY_SEPARATOR . $this->route['action'] . '.php';

		extract($this->vars);

		if (isset($_POST['ajax']) AND $_POST['ajax'] === 'yes') {
			$this->ajaxMeta();

			require_once $file;
		} else if ($this->ajax) {
			if ($this->is_view) {
				require_once $file;
			}
		} else {
			$title = $this->meta['title'];
			$des = $this->meta['des'];
			$key = $this->meta['key'];

			ob_start([$this, 'compressPage']);
			{
				require_once $file;

				$content = ob_get_contents();
				ob_clean();
			}

			require_once $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'inc' . DIRECTORY_SEPARATOR . 'layouts' . DIRECTORY_SEPARATOR . $this->layout . '.php';
		}
	}
}