<?php

class Ajax {
	/**
	 *
	 * Создаём ajax ссылку
	 *
	 * @access public
	 * @static
	 * @param string $href
	 * @param string $text
	 * @param array $options [class, id, другие параметры]
	 * @param array $params ['eventstate' => 'true', 'top' => 'true', 'container' => '#app', 'href' => '/main']
	 * @return void
	 */
	public static function url($href, $text, $options = [], $params = []) {
		$set_params = [];
		$set_options = [];
		$params = array_replace([
			'container' => '#app'
		], $params);

		foreach ($options as $k => $v) {
			$set_options[] = $k . '=' . '"' . $v . '"';
		}

		foreach ($params as $k => $v) {
			$set_params[] = $k . ': ' . '\'' . $v . '\'';
		}

		$set_options = implode(' ', $set_options) ?: '';
		$set_params = implode(',', $set_params);

		return '<a href="' . $href . '"' . $set_options . ' onclick="ajax.Url({href: this.href,' . $set_params . '}); return false;">' . $text . '</a>';
	}
}