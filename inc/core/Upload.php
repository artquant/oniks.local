<?php

class Upload {
	/**
	 * Ответ в формате json
	 *
	 * @var array
	*/
	private static $answer = [];

	/**
	 * Файлы, после перебора self::reArrayFiles();
	 *
	 * @var array
	*/
	private static $files = [];

	/**
	 *
	 * Размер файла
	 *
	 * @access public
	 * @static
	 * @param mixed $file
	 * @return int
	*/
	public static function fileSize($file) {
		return $file['size'];
	}

	/**
	 *
	 * Проверка размера файла
	 *
	 * @access public
	 * @static
	 * @param mixed $file
	 * @param int $size (bytes)
	 * @return bool
	*/
	public static function isFileSize($file, $size) {
		return (self::fileSize($file) > $size) ? true : false;
	}

	/**
	 *
	 * Проверка расширения файла
	 *
	 * @access public
	 * @static
	 * @param mixed $file
	 * @param string|array $mime (default : null)
	 * @return bool
	*/
	public static function isFileType($file, $mime = null) {
		if (is_array($mime)) {
			return (in_array($file['type'], $mime)) ? true : false;
		} else if (is_null($mime)) {
			return true;
		} else {
			return ($file['type'] == $mime) ? true : false;
		}
	}

	/**
	 *
	 * Проверка существования файла
	 *
	 * @access public
	 * @static
	 * @param mixed $file
	 * @return bool
	*/
	public static function emptyFile($file) {
		return (empty($file)) ? true : false;
	}

	/**
	 *
	 * Пересобираем файлы в новый понятный массив
	 *
	 * @access private
	 * @static
	 * @param mixed $files
	 * @return array
	*/
	private static function reArrayFiles($files) {
		foreach ($files as $key => $file) {
			foreach ($file as $name => $value) {
				self::$files[$name][$key] = $value;
			}
		}

		return self::$files;
	}

	/**
	 *
	 * Отправка файлов на сервер
	 *
	 * @access public
	 * @static
	 * @param mixed $files
	 * @param string $path
	 * @param int $size (bytes)
	 * @param null|string|array $mime (img/jpeg)
	 * @param string $rename
	 * @param bool $return
	 * @return void|array
	*/
	public static function send($files, $path, $size = null, $mime = null, $rename = null, $return = false) {
		//$files = self::reArrayFiles($file);

		foreach ($files as $file) {
			if ($file['error'] == 4) {
				self::$answer = [
					'status' => false,
					'text'   => 'Файл не найден'
				];
			} else {
				$ext_file = pathinfo($file['name']);
				$file_name = $ext_file['filename'] . '.' . $ext_file['extension'];
				$new_name = (is_null($rename)) ? basename($file_name) : $rename . '.' . $ext_file['extension'];

				if (!empty($file['error']) || empty($file['tmp_name'])) {
					self::$answer = [
						'status' => false,
						'text'   => 'Ошибка сервера'
					];
				} else if ($file['tmp_name'] == 'none' || !is_uploaded_file($file['tmp_name'])) {
					self::$answer = [
						'status' => false,
						'text'   => 'Не удалось загрузить файл'
					];
				} else {
					if (!is_null($size) AND !self::isFileSize($file, $size)) {
						self::$answer = [
							'status' => false,
							'text'   => $file['name'] . ': слишком большой'
						];
					} else if (!is_null($mime) AND !self::isFileType($file['type'], $mime)) {
						self::$answer = [
							'status' => false,
							'text'   => $file['name'] . ': неверный формат файла'
						];
					} else if (empty($ext_file['extension'])) {
						self::$answer = [
							'status' => false,
							'text'   => 'Недопустимый тип файла'
						];
					} else {
						if (move_uploaded_file($file['tmp_name'], $path . $new_name)) {
							self::$answer = [
								'status' => true,
								'text'   => 'Все файлы успешно загружены'
							];
						} else {
							self::$answer = [
								'status' => false,
								'text'   => $new_name . ': не загружен'
							];
						}
					}
				}
			}
		}

		if ($return) return json_encode(self::$answer);
	}

	/**
	 *
	 * Удаление папки в содержимым
	 *
	 * @access public
	 * @static
	 * @param string $path
	 * @return bool
	*/
	public static function deleteDir($path) {
		if (is_dir($path)) {
			$files = array_diff(scandir($path), array('.', '..'));

			foreach ($files as $file) {
				self::deleteDir(realpath($path) . '/' . $file);
			}

			return rmdir($path);
		} else if (is_file($path)) {
			return unlink($path);
		}

		return false;
	}
}