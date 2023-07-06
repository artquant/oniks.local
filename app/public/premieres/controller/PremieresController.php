<?php

class PremieresController extends App {
	function actionMore($query = []) {
		$this->ajax = true;

		sleep(1);

		$premier = Premieres::getById($query['id'] ?? null);

		$this->set([
			'premier' => $premier
		]);
	}
}