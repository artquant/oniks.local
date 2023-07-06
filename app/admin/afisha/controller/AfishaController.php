<?php

/**
 * AfishaController
 *
 * Киноафиши
 */
class AfishaController extends App {
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

		$this->setMeta(['title' => 'Админка | Афиша']);

		$date = $query['date'] ?? date('Y-m-d');
		$afisha_calendar = CalendarAfisha::html($date, 6, 15);
		$db = Afisha::getAllByDate($date);
		$theatres_info = Afisha::theatresInfo($date);

		$this->set([
			'date'            => $date,
			'db'              => $db,
			'theatres_info'   => $theatres_info,
			'afisha_calendar' => $afisha_calendar,
			'req_content'     => [
				'file'    => 'left_content',
				'modules' => 'main',
				'path'    => 'admin'
			]
		]);
	}

	/**
	 * actionNew
	 *
	 * Страница создания
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionNew($query = []) {
		Users::isAdmin([
			'url' => '/404'
		]);

		if (!Sessions::check('iduser')) {
			Request::location([
				'url' => '/admin/auth'
			]);
		}

		$this->setMeta(['title' => 'Админка | Добавление афиши']);

		$date = $query['date'] ?? date('Y-m-d');
		$premieres = Premieres::getAll('id, title');

		$this->set([
			'date'        => $date,
			'premieres'   => $premieres,
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
	 * actionTheatresNew
	 *
	 * Страница создание кинотеатра
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionTheatresNew($query = []) {
		$this->ajax = true;

		sleep(1);

		Users::isAdmin([
			'url' => '/404'
		]);

		if (!Sessions::check('iduser')) {
			Request::location([
				'url' => '/admin/auth'
			]);
		}

		$theatres = Theatres::getAll('id, name');

		$this->set([
			'date'     => $query['date'],
			'theatres' => $theatres,
			'query'    => $query
		]);
	}

	/**
	 * actionTheatresAdd
	 *
	 * Добавление кинотеатра в базу данных
	 * используется AJAX запрос
	 *
	 * @param  mixed $query
	 * @return void
	 */
	function actionTheatresAdd($query = []) {
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

	/**
	 * actionTheatresEdit
	 *
	 * Страница редактирования кинотеатра
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionTheatresEdit($query = []) {
		$this->ajax = true;

		sleep(1);

		Users::isAdmin([
			'url' => '/404'
		]);

		if (!Sessions::check('iduser')) {
			Request::location([
				'url' => '/admin/auth'
			]);
		}

		$theatres_date_show = Theatres::dateShowGetById('time_show, min_price', $query['id']);

		$this->set([
			'time_show' => explode(',', $theatres_date_show->time_show),
			'min_price' => $theatres_date_show->min_price,
			'query'     => $query
		]);
	}

	/**
	 * actionTheatresSave
	 *
	 * Сохрание изменений кионотеатра
	 * используется AJAX запрос
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionTheatresSave($query = []) {
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

	/**
	 * actionTheatresDel
	 *
	 * Удаление кинотеатра
	 *
	 * @param  array $query
	 * @return void
	 */
	function actionTheatresDel($query = []) {
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

		Theatres::delDateShow($query['id']);

		Core::answer([
			'url' => $query['url']
		]);
	}
}