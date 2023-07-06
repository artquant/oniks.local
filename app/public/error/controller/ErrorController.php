<?php

class ErrorController extends App {
	function action404() {
		$this->layout = '404';
		$this->setMeta(['title' => 'Ошибка 404']);
	}
}