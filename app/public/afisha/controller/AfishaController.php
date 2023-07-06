<?php

class AfishaController extends App {
	public $layout = 'afisha';

	function actionIndex($query = []) {
		if (isset($query['date']) AND
			!Date::validateDate($query['date'], 'Y-m-d')) {
				Request::location([
					'url' => '/404'
				]);
		}

		$this->setMeta([
			'title' => 'Кино в ДНР | ' . SITENAME . ' Афиша',
			'des'   => 'Кино в ДНР'
		]);

		$date = $query['date'] ?? date('Y-m-d');
		$db = Afisha::getAllByDate($date);
		$theatres_info = Afisha::theatresInfo($date);

		$this->set([
			'date'          => $date,
			'db'            => $db,
			'theatres_info' => $theatres_info
		]);
	}

	function actionNew($query = []) {
		if (isset($query['date']) AND
			!Date::validateDate($query['date'], 'Y-m-d')) {
				Request::location([
					'url' => '/404'
				]);
		}

		$this->layout = 'public';

		Users::isAuth();

		$this->setMeta(['title' => SITENAME . ' | Добавление афиши']);

		$is_theatres = (USER['access'] == 2 AND USER['theatres_id'] > 0) ? true : false;
		$premieres = Premieres::getAll('id, title');
		$date = $query['date'];

		$this->set([
			'is_theatres' => $is_theatres,
			'premieres'   => $premieres,
			'date'        => $date
		]);
	}

	function actionAdd($query = []) {
		$this->ajax = true;

		sleep(1);

		Users::isAuth(true);

		if (USER['access'] != 2) {
			Request::location([
				'url'      => '/404',
				'response' => true
			]);
		}

		$this->set(['query' => $query]);
	}

	function actionTheatresNew($query = []) {
		$this->ajax = true;

		sleep(1);

		Users::isAuth(true);

		if (USER['access'] != 2) {
			Request::location([
				'url'      => '/404',
				'response' => true
			]);
		}

		$theatres_halls = Theatres::getById(USER['theatres_id'])->halls_name;

		$this->set([
			'query'          => $query,
			'theatres_halls' => $theatres_halls
		]);
	}

	function actionTheatresAdd($query = []) {
		$this->ajax = true;

		sleep(1);

		Users::isAuth(true);

		if (USER['access'] != 2) {
			Request::location([
				'url'      => '/404',
				'response' => true
			]);
		}

		$this->set(['query' => $query]);
	}

	function actionTheatresEdit($query = []) {
		$this->ajax = true;

		sleep(1);

		Users::isAuth();

		if (USER['access'] != 2) {
			Request::location([
				'url' => '/404'
			]);
		}

		$time_show_id = $query['id'] ?? 0;

		$theatres_date_show = Theatres::dateShowGetById('*', $time_show_id);
		$theatres_halls = Theatres::getById(USER['theatres_id'])->halls_name;

		$this->set([
			'theatres_date_show' => $theatres_date_show,
			'time_show'          => explode(',', $theatres_date_show->time_show),
			'theatres_halls'     => $theatres_halls
		]);
	}

	function actionTheatresSave($query = []) {
		$this->ajax = true;

		sleep(1);

		Users::isAuth(true);

		if (USER['access'] != 2) {
			Request::location([
				'url'      => '/404',
				'response' => true
			]);
		}

		$this->set(['query' => $query]);
	}

	function actionTheatresDel($query = []) {
		$this->ajax = true;
		$this->is_view = false;

		sleep(1);

		Users::isAuth(true);

		if (USER['access'] != 2) {
			Request::location([
				'url'      => '/404',
				'response' => true
			]);
		}

		Theatres::delDateShow($query['id'], USER['theatres_id']);

		Core::answer([
			'status' => true,
			'url'    => $query['url']
		]);
	}
}