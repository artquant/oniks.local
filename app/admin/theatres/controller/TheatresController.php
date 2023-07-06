<?php

/**
 * TheatresController
 *
 * Кинотеатры
 */
class TheatresController extends App {
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

		$this->setMeta(['title' => 'Админка | Кинотеатры']);

		$search = $query['search'] ?? null;
		$page = $query['page'] ?? 1;

		$db = Theatres::list($search, $page);

		$this->set([
			'search'      => $search,
			'theatres'    => $db['db'],
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

		$this->setMeta(['title' => 'Админка | Добавление Кинотеатра']);

		$this->set([
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

		$this->setMeta(['title' => 'Админка | Редактирование Кинотеатра']);

		$cinema_id = (int)$query['id'] ?? null;
		$cinema_db = Theatres::getById($cinema_id);

		$this->set([
			'cinema'    => $cinema_db,
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

		$db = Theatres::getById((int)$query['id'], 'id');

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

		Theatres::del($query['id']);

		Core::answer([
			'url' => $query['url']
		]);
	}
}