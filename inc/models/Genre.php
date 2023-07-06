<?php

class Genre {
	public static function list() {
		return DB::query("SELECT id, name FROM genre")::bind()::fetchAll();
	}

	public static function getNameByIn($ids) {
		$ids = explode(',', $ids);
		$in_keys = array_map(function($key) {return ':var_' . $key;}, array_keys($ids));
		$bind_param = [];
		$result = [];

		foreach ($ids as $key => $value) {
			$bind_param[':var_' . $key . ',i'] = (int)$value;
		}

		$db = DB::query("SELECT name FROM genre WHERE id IN (" . implode(',', $in_keys) . ")")::bind($bind_param)::fetchAll();

		foreach ($db as $genre) {
			$result[] = $genre->name;
		}

		return $result;
	}
}