<?php

class Translite {
	/**
	 *
	 * Заменяем русские буквы на латинские
	 *
	 * @access public
	 * @static
	 * @param string $str
	 * @return string
	*/
	public static function set($str) {
		$str = preg_replace('/[~!@#%^-_\$\?\(\)\{\}\[\]]+/', '-', $str);
		$str = str_replace(['\n', '\r'], ' ', $str);
		$str = preg_replace('/\s+/i', ' ', $str);
		$str = str_replace(' ', '-', $str);
		$str = trim($str);

		$rus = ['А', 'Б', 'В', 'Г', 'Д', 'Е', 'Ё', 'Ж', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ч', 'Ш', 'Щ', 'Ъ', 'Ы', 'Ь', 'Э', 'Ю', 'Я', 'а', 'б', 'в', 'г', 'д', 'е', 'ё', 'ж', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ч', 'ш', 'щ', 'ъ', 'ы', 'ь', 'э', 'ю', 'я'];

		$lat = ['A', 'B', 'V', 'G', 'D', 'E', 'E', 'Zh', 'Z', 'I', 'I', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'Kh', 'Ts', 'Ch', 'Sh', 'Shch', '', 'Ie', '', 'E', 'Iu', 'Ia', 'a', 'b', 'v', 'g', 'd', 'e', 'e', 'zh', 'z', 'i', 'i', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'kh', 'ts', 'ch', 'sh', 'shch', '', 'ie', '', 'e', 'iu', 'ia'];

		return str_replace($rus, $lat, $str);
	}
}