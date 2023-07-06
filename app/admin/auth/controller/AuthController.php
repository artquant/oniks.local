<?php

class AuthController extends App {
	function actionIndex() {
		Users::isAdmin([
			'url'  => '/404'
		]);

		if (Sessions::check('iduser')) {
			Request::location([
				'url' => '/admin'
			]);
		}

		$this->setMeta(['title' => 'Админка | Авторизация']);
	}

	function actionSend($query = []) {
		$this->ajax = true;

		sleep(1);

		Users::isAdmin([
			'url'  => '/404'
		]);

		$this->set(['query' => $query]);
	}
}