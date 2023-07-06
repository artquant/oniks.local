<?php

/**
 * PremieresController
 *
 * Премьеры
 */
class PremieresController extends App {
	/**
	 * actionIndex
	 *
	 * Главная страница
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionIndex($query = []) {
		Users::isAdmin([
			'url' => '/404'
		]);

		if (!Sessions::check('iduser')) {
			Request::location([
				'url' => '/admin/auth'
			]);
		}

		$this->setMeta(['title' => 'Админка | Премьеры']);

		$search = $query['search'] ?? null;
		$page = $query['page'] ?? 1;

		$db = Premieres::list($search, (int)$page);

		$this->set([
			'search'      => $search,
			'premieres'   => $db['db'],
			'pagination'  => $db['pagination'],
			'req_content' => [
				'file'    => 'left_content',
				'modules' => 'main',
				'path'    => 'admin'
			]
		]);
	}

	/**
	 * actionNew
	 *
	 * Страница создание
	 *
	 * @return void
	 */
	function actionNew() {
		Users::isAdmin([
			'url' => '/404'
		]);

		if (!Sessions::check('iduser')) {
			Request::location([
				'url' => '/admin/auth'
			]);
		}

		$this->setMeta(['title' => 'Админка | Добавление Премьеры']);

		$this->set([
			'countries'   => Country::list(),
			'genres'      => Genre::list(),
			'req_content' => [
				'file'    => 'left_content',
				'modules' => 'main',
				'path'    => 'admin'
			]
		]);
	}

	/**
	 * actionAdd
	 *
	 * Добавление в базу данных
	 * используется AJAX запрос
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionAdd($query = []) {
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

	/**
	 * actionEdit
	 *
	 * Страница редактирование
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionEdit($query = []) {
		Users::isAdmin([
			'url' => '/404'
		]);

		if (!Sessions::check('iduser')) {
			Request::location([
				'url' => '/admin/auth'
			]);
		}

		$this->setMeta(['title' => 'Админка | Редактирование Премьеры']);

		$premier_id = (int)$query['id'] ?? null;
		$premier_db = Premieres::getById($premier_id);

		$this->set([
			'premier'    => $premier_db,
			'countries'   => Country::list(),
			'genres'      => Genre::list(),
			'req_content' => [
				'file'    => 'left_content',
				'modules' => 'main',
				'path'    => 'admin'
			]
		]);
	}

	/**
	 * actionSave
	 *
	 * Сохранение изменений в базу данных
	 * используется AJAX запрос
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionSave($query = []) {
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

		$db = Premieres::getById((int)$query['id'], 'poster');

		$this->set([
			'db'    => $db,
			'query' => $query
		]);
	}

	/**
	 * actionDel
	 *
	 * Удаление
	 * используется AJAX запрос
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionDel($query = []) {
		$this->ajax = true;
		$this->is_view = false;

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

		$file = Upload::deleteDir(ROOT . D_S . 'web' . D_S . 'uploads' . D_S . 'premieres' . D_S . $query['id']);

		if ($file) {
			Premieres::del($query['id']);

			Core::answer([
				'url' => $query['url']
			]);
		}
	}
}