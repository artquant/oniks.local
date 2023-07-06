<?php

/**
 * UsersController
 *
 * Пользователи
 */
class UsersController extends App {
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

		$this->setMeta(['title' => 'Админка | Пользователи']);

		$page = $query['page'] ?? 1;
		$search = $query['search'] ?? null;
		$db = Users::list($search, (int)$page);

		$checked_is_block = (isset($query['isBlock'])) ? ' checked' : '';

		$this->set([
			'search'      => $search,
			'list_users'  => $db['db'],
			'pagination'  => $db['pagination'],
			'checked_is_block' => $checked_is_block,
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
	 * Создание нового пользователя
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

		$this->setMeta(['title' => 'Админка | Создание пользователя']);

		$theatres = Theatres::getAll();
		$user_access = USER_ACCESS;

		$this->set([
			'theatres'    => $theatres,
			'user_access' => $user_access,
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

		$this->setMeta(['title' => 'Админка | Редактирование пользователя']);

		$user = Users::getById((int)($query['id'] ?? 0));
		$theatres = Theatres::getAll();
		$user_access = USER_ACCESS;

		$this->set([
			'user'        => $user,
			'theatres'    => $theatres,
			'user_access' => $user_access,
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

		$this->set([
			'query' => $query
		]);
	}
}