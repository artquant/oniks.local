<?php

class DB {
	private static $stmt   = NULL;
	private static $db     = NULL;

	/**
	 *
	 * Подключение к БД
	 *
	 * @access private
	 * @static
	 * @return void
	*/
	private static function connect() {
		$con = DBCONFIG;

		try {
			$dsn = 'mysql:host=' . $con['host'] . ';dbname=' . $con['name'] . ';charset=' . $con['charset'];
			self::$stmt = new PDO( $dsn, $con['user'], $con['pass'] );
			self::$stmt->setAttribute( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
		} catch (PDOException $e) {
			exit($e->getMessage());
		}
	}

	/**
	 *
	 * Выполняет SQL-запрос
	 *
	 * @access public
	 * @static
	 * @param string $query
	 * @return void
	*/
	public static function query($query) {
		self::connect();

		self::$db = self::$stmt->prepare($query);

		return new self();
	}

	/**
	 *
	 * Подставляем значения под запросы и запускаем подготовленный запрос
	 *
	 * @access public
	 * @static
	 * @param array $param (default : PDO::PARAM_STR, [':limit,i' => $limit])
	 * @param bool $execute (default : true)
	 * @return void
	*/
	public static function bind($param = [], $execute = true) {
		if ($param) {
			foreach ($param as $name => $value) {
				$n = explode(',', $name);
				self::$db->bindValue($n[0], $value, self::paramBind(trim($n[1] ?? '')));
			}
		}

		if ($execute)
			self::$db->execute();

		return new self();
	}

	/**
	 *
	 * Запускаем подготовленный запрос
	 *
	 * @access public
	 * @static
	 * @param array $param
	 * @return void
	*/
	public static function execute($param = []) {
		self::$db->execute($param);

		return new self();
	}

	private static function paramBind($param) {
		if ($param == 'i') {
			return PDO::PARAM_INT;
		} else if ($param == 'b') {
			return PDO::PARAM_BOOL;
		} else if ($param == 'n') {
			return PDO::PARAM_NULL;
		} else if ($param == 'l') {
			return PDO::PARAM_LOB;
		} else if ($param == 's') {
			return PDO::PARAM_STR;
		} else {
			return PDO::PARAM_STR;
		}

	}

	private static function fetchStyle($param) {
		if ($param == 'ASSOC') {
			return PDO::FETCH_ASSOC;
		} else if ($param == 'BOTH') {
			return PDO::FETCH_BOTH;
		} else if ($param == 'INTO') {
			return PDO::FETCH_INTO;
		} else if ($param == 'LAZY') {
			return PDO::FETCH_LAZY;
		} else if ($param == 'NAMED') {
			return PDO::FETCH_NAMED;
		} else if ($param == 'NUM') {
			return PDO::FETCH_NUM;
		} else if ($param == 'OBJ') {
			return PDO::FETCH_OBJ;
		}
	}

	/**
	 *
	 * Выполняем запрос
	 *
	 * @access public
	 * @static
	 * @param string $fetch_style (default : OBJ, [ASSOC, BOTH, INTO, LAZY, NAMED, NUM])
	 * @return mixed
	*/
	public static function fetch($fetch_style = 'OBJ') {
		return self::$db->fetch(self::fetchStyle($fetch_style));
	}

	/**
	 *
	 * Возвращаем данные одного столбца
	 *
	 * @access public
	 * @static
	 * @param int $column_number
	 * @return mixed
	*/
	public static function fetchColumn($column_number = null) {
		return self::$db->fetchColumn($column_number);
	}

	/**
	 *
	 * Возвращаем массив, содержащий все оставшиеся строки результирующего набора
	 *
	 * @access public
	 * @static
	 * @param mixed $fetch_style
	 * @param mixed $fetch_argument
	 * @return mixed
	*/
	public static function fetchAll($fetch_style = PDO::FETCH_OBJ, $fetch_argument = null) {
		if ($fetch_style == PDO::FETCH_COLUMN AND preg_match( '/^[0-9]+$/', $fetch_argument)) {
			return self::$db->fetchAll($fetch_style, $fetch_argument);
		} else if ($fetch_style == PDO::FETCH_COLUMN AND $fetch_argument == PDO::FETCH_GROUP) {
			return self::$db->fetchAll($fetch_style|$fetch_argument);
		} else if ($fetch_style == PDO::FETCH_CLASS OR $fetch_style == PDO::FETCH_FUNC) {
			return self::$db->fetchAll($fetch_style, '"' . $fetch_argument . '"');
		} else {
			return self::$db->fetchAll($fetch_style);
		}
	}

	/**
	 *
	 * Колличество строк
	 *
	 * @access public
	 * @static
	 * @return int
	*/
	public static function rowCount() {
		return self::$db->rowCount();
	}

	/**
	 *
	 * Возвращает генерируемый ID, используя последний запрос
	 *
	 * @access public
	 * @static
	 * @return int
	*/
	public static function lastID() {
		return self::$stmt->lastInsertId();
	}
}