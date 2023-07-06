<?php

/**
 * MainController
 *
 * Админка
 */
class MainController extends App {
	/**
	 * actionIndex
	 *
	 * Главная страница
	 *
	 * @return void
	 */
	function actionIndex() {
		Users::isAdmin([
			'url' => '/404'
		]);

		if (!Sessions::check('iduser')) {
			Request::location([
				'url' => '/admin/auth'
			]);
		}

		$this->setMeta([
			'title' => 'Админка | Главная'
		]);

		$access_ip = DB::query("SELECT ip FROM admin_ip WHERE id = 1")::execute()::fetch();
		$admin_users = Users::getByAccessAll(9);
		$cinema_users = Users::getByAccessAll(2);

		$this->set([
			'access_ip'    => $access_ip,
			'admin_users'  => $admin_users,
			'cinema_users' => $cinema_users,
			'req_content'  => [
				'file'    => 'left_content',
				'modules' => 'main',
				'path'    => 'admin'
			]
		]);
	}

	/**
	 * actionIpSave
	 *
	 * Сохранение списка IP адресов
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionIpSave($query = []) {
		$this->ajax = true;

		sleep(1);

		Users::isAdmin([
			'url'      => '/404',
			'response' => true
		]);

		if (!Sessions::check('iduser')) {
			Request::location([
				'url'      => '/admin/auth',
				'response' => true
			]);
		}

		$this->set(['query' => $query]);
	}
}