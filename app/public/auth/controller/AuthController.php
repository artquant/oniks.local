<?php

class AuthController extends App {

	/**
	 * actionIndex
	 *
	 * Форма авторизации пользователя
	 *
	 * @return void
	 */
	function actionIndex() {
		if (Sessions::check('iduser')) {
			Request::location([
				'url'  => '/'
			]);
		}

		$this->setMeta(['title' => SITENAME . ' | Авторизация']);

		$email = Cookies::get('email') ?? null;
		$pass = Cookies::get('pass') ?? null;
		$sd = ($email OR $pass) ? ' checked' : null;

		$this->set([
			'email' => $email,
			'pass'  => $pass,
			'sd'    => $sd
		]);
	}

	/**
	 * actionSend
	 *
	 * Проверка авторизации Ajax запрос
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionSend($query = []) {
		$this->ajax = true;

		sleep(1);

		if (Sessions::check('iduser')) {
			Request::location([
				'url'      => '/',
				'response' => true
			]);
		}

		$this->set([
			'query' => $query
		]);
	}
}