<?php

class AccountController extends App {
	function actionIndex() {
		Users::isAuth();

		$this->setMeta(['title' => SITENAME . ' | Аккаунт']);

		$this->set([
			'user' => USER
		]);
	}

	function actionTheatres() {
		Users::isAuth();

		$this->setMeta(['title' => SITENAME . ' | Управление кинотеатром']);

		$is_theatres = (USER['access'] == 2 AND USER['theatres_id'] > 0) ? true : false;
		$theatres = Theatres::getById(USER['theatres_id']);

		$this->set([
			'is_theatres' => $is_theatres,
			'theatres'    => $theatres
		]);
	}

	function actionTheatresSave($query = []) {
		$this->ajax = true;

		sleep(1);

		Users::isAuth(true);

		$this->set([
			'query' => $query
		]);
	}

	function actionAfisha($query = []) {
		Users::isAuth();

		$this->setMeta(['title' => SITENAME . ' | Афиши кинотеатра']);

		$is_theatres = (USER['access'] == 2 AND USER['theatres_id'] > 0) ? true : false;
		$date = $query['date'] ?? date('Y-m-d');
		$afisha_calendar = CalendarAfisha::html($date, 6, 15);
		$db = Afisha::getAllByDate($date);
		$theatres_info = Afisha::theatresInfo($date, USER['theatres_id']);

		$this->set([
			'is_theatres'     => $is_theatres,
			'date'            => $date,
			'afisha_calendar' => $afisha_calendar,
			'db'              => $db,
			'theatres_info'   => $theatres_info
		]);
	}
}