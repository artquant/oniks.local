<?php

class Captcha {
	/**
	 * Путь к шрифту
	 *
	 * @var string
	*/
	private static $path_fonts = null;

	/**
	 * Выводимые символы
	 *
	 * @var string
	*/
	private static $letter = 's';

	/**
	 * Длина каптчи
	 *
	 * @var int
	*/
	private static $len = 5;

	/**
	 * Ширина картинки
	 *
	 * @var int
	*/
	private static $width = 80;

	/**
	 * Высота картинки
	 *
	 * @var int
	*/
	private static $height = 34;

	/**
	 * Размер шрифта
	 *
	 * @var int
	*/
	private static $font_size = 12;

	/**
	 * Прозрачность картинки
	 *
	 * @var array
	*/
	private static $background_alpha = [0, 0, 0, 127];

	/**
	 *
	 * Устанавливаем параметры для изображения
	 *
	 * @access private
	 * @static
	 * @param array $params [path_fonts => null, letter = 's', len => 5, width => 80, height => 34, font_size => 12, background_alpha => [0, 0, 0, 127]]
	 * @return void
	*/
	private static function setParam($params = []) {
		self::$path_fonts       = $params['path_fonts'];
		self::$letter           = self::letters($params['letter']);
		self::$len              = $params['len'];
		self::$width            = $params['width'];
		self::$height           = $params['height'];
		self::$font_size        = $params['font_size'];
		self::$background_alpha = $params['background_alpha'];
	}

	/**
	 *
	 * Возвращаем символы
	 *
	 * @access private
	 * @static
	 * @param string $param
	 * @return string
	*/
	private static function letters($param = 's') {
		$result = null;

		switch ($param) {
			case 'm' :
				$result = 'ABCDEFGKIJKLMNOPQRSTUVWXYZ0123456789';
			break;
			case 's' :
				$result = 'ABCDEFGKIJKLMNOPQRSTUVWXYZ';
			break;
			case 'n' :
				$result = '0123456789';
			break;
		}

		return $result;
	}

	/**
	 *
	 * Создаём изображение
	 *
	 * @access private
	 * @static
	 * @return string
	*/
	private static function createImage() {
		$captcha = '';
		$im = imagecreatetruecolor(self::$width, self::$height);

		imagesavealpha($im, true);

		$bg = imagecolorallocatealpha($im, self::$background_alpha[0], self::$background_alpha[1], self::$background_alpha[2], self::$background_alpha[3]);

		imagefill($im, 0, 0, $bg);

		for ($i = 0; $i < self::$len; $i++) {
			$captcha .= self::$letter[rand(0, strlen(self::$letter) - 1)];

			$x = (self::$width - 20) / self::$len * $i + 10;
			$x = rand($x, $x + 4);
			$y = self::$height - ((self::$height - self::$font_size) / 2);

			$curcolor = imagecolorallocate($im, rand(0, 100), rand(0, 100), rand(0, 100));
			$angle = rand(-25, 25);

			imagettftext($im, self::$font_size, $angle, $x, $y, $curcolor, self::$path_fonts, $captcha[$i]);
		}

		$_SESSION['captcha'] = $captcha;

		ob_start();
		imagepng($im);
		$img64 = base64_encode(ob_get_clean());
		imagedestroy($im);

		return '<img src="data:image/png;base64,' . $img64 . '" class="image-captcha" id="image_captcha">';
	}

	/**
	 *
	 * Выводим изображение
	 *
	 * @access public
	 * @static
	 * @param array $params [path_fonts => null, letter = 'm,s,n', len => 5, width => 80, height => 34, font_size => 12, background_alpha => [0, 0, 0, 127]]
	 * @return string
	*/
	public static function show($params = []) {
		$params = array_replace([
			'path_fonts'       => $_SERVER['DOCUMENT_ROOT'] . DIRECTORY_SEPARATOR . 'web' . DIRECTORY_SEPARATOR . 'fonts' . DIRECTORY_SEPARATOR . 'captcha' . DIRECTORY_SEPARATOR . 'campton.otf',
			'letter'           => 's',
			'len'              => 5,
			'width'            => 80,
			'height'           => 34,
			'font_size'        => 12,
			'background_alpha' => [0, 0, 0, 127]
		], $params);

		self::setParam($params);

		return self::createImage();
	}
}