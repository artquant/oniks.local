<?php

class Afisha {
	public static function insert($params = []) {
		$table_row  = [];
		$table_bind = [];
		$bind       = [];

		foreach ($params as $key => $value) {
			array_push($table_row, explode(',', $key)[0]);
			array_push($table_bind, explode(',', ':' . $key)[0]);
			$bind[':' . $key] = $value;
		}

		$table_row = implode(', ', $table_row);
		$table_bind = implode(', ', $table_bind);

		DB::query("INSERT INTO afisha ({$table_row}) VALUES ({$table_bind})")::bind($bind);
	}

	public static function getAllByDate($date) {
		return DB::query("SELECT afisha.id, afisha.premieres_id AS premieres_id, premieres.title, premieres.poster, premieres.genre_id, premieres.age_restrictions FROM afisha LEFT JOIN premieres ON premieres.id = afisha.premieres_id WHERE afisha.date_show = :date")::bind([
			':date,s' => $date
		])::fetchAll();
	}

	public static function theatresInfo($date, $user_theatres_id = null) {
		$result = [];
		$select = null;
		$bind = [
			'date,s' => $date
		];

		if ($user_theatres_id) {
			$select = " AND theatres.id = :user_theatres_id";
			$bind[':user_theatres_id,i'] = $user_theatres_id;
		}

		$db = DB::query("SELECT theatres_date_show.id AS theatres_date_show_id, theatres_date_show.afisha_id, theatres_date_show.theatres_id, theatres_date_show.date_show, theatres_date_show.time_show, theatres_date_show.min_price, theatres_date_show.halls, theatres.* FROM theatres_date_show LEFT JOIN theatres ON theatres.id = theatres_date_show.theatres_id WHERE theatres_date_show.date_show = :date{$select}")::bind($bind)::fetchAll();

		foreach ($db as $value) {
			if (array_key_exists($value->afisha_id, $result)) {
				$result[$value->afisha_id][] = [
					'theatres_date_show_id' => $value->theatres_date_show_id,
					'name'                  => $value->name,
					'city'                  => $value->city,
					'address'               => $value->address,
					'phone'                 => $value->phone,
					'time_show'             => $value->time_show,
					'min_price'             => $value->min_price,
					'halls'                 => $value->halls
				];
			} else {
				$result[$value->afisha_id][0] = [
					'theatres_date_show_id' => $value->theatres_date_show_id,
					'name'                  => $value->name,
					'city'                  => $value->city,
					'address'               => $value->address,
					'phone'                 => $value->phone,
					'time_show'             => $value->time_show,
					'min_price'             => $value->min_price,
					'halls'                 => $value->halls
				];
			}
		}

		return $result;
	}

	public static function check($where, $bind = []) {
		return DB::query("SELECT id FROM afisha WHERE {$where} LIMIT 1")::bind($bind)::fetch();
	}
}