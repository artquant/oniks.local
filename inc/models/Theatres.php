<?php

class Theatres {
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

		DB::query("INSERT INTO theatres ({$table_row}) VALUES ({$table_bind})")::bind($bind);
	}

	public static function update($params = [], $id = null) {
		$table_bind = [];
		$bind       = [];

		foreach ($params as $key => $value) {
			if (explode(',', $key)[0] != 0) {
				array_push($table_bind, explode(',', $key)[0] . ' = :' . explode(',', $key)[0]);
				$bind[':' . $key] = $value;
			}
		}

		$bind[':id,i'] = $id;
		$table_bind = implode(', ', $table_bind);

		DB::query("UPDATE theatres SET {$table_bind} WHERE id = :id LIMIT 1")::bind($bind);
	}

	public static function list($search = null, $page = 1, $per_page = 10) {
		$query = "SELECT * FROM theatres";
		$bind = [];

		if ($search) {
			$query .= " WHERE title LIKE :search";
			$bind[':search,s'] = '%' . urldecode(htmlspecialchars($search)) . '%';
		}

		$count = DB::query($query)::bind($bind)::rowCount();
		$pagination = Pagination::build($page, $count, [true, '#app'], $per_page);

		$bind[':offset,i'] = $pagination['start'];
		$bind[':count,i'] = $per_page;

		$db = DB::query("{$query} ORDER BY id DESC LIMIT :offset, :count")::bind($bind)::fetchAll();

		return [
			'pagination' => $pagination['show'],
			'db'         => $db
		];
	}

	public static function getById($id, $rows = '*') {
		return DB::query("SELECT {$rows} FROM theatres WHERE id = :id LIMIT 1")::bind([
			':id,i' => $id
		])::fetch();
	}

	public static function checkById($id) {
		$db = DB::query("SELECT id FROM theatres WHERE id = :id LIMIT 1")::bind([
			':id,i' => $id
		])::fetch();

		return $db ?: false;
	}

	public static function del($id) {
		DB::query("DELETE FROM theatres WHERE id = :id LIMIT 1")::bind([
			':id,i' => (int)$id
		]);
	}

	public static function getAll($rows = '*') {
		return DB::query("SELECT {$rows} FROM theatres")::execute()::fetchAll();
	}

	public static function dateShowGetById($rows, $id) {
		return DB::query("SELECT {$rows} FROM theatres_date_show WHERE id = :id LIMIT 1")::bind([
			':id,i' => (int)$id
		])::fetch();
	}

	public static function updateDateShow($params = [], $id = null) {
		$table_bind = [];
		$bind       = [];

		foreach ($params as $key => $value) {
			if (explode(',', $key)[0] != 0) {
				array_push($table_bind, explode(',', $key)[0] . ' = :' . explode(',', $key)[0]);
				$bind[':' . $key] = $value;
			}
		}

		$bind[':id,i'] = (int)$id;
		$table_bind = implode(', ', $table_bind);

		DB::query("UPDATE theatres_date_show SET {$table_bind} WHERE id = :id LIMIT 1")::bind($bind);
	}

	public static function insertDateShow($params = []) {
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

		DB::query("INSERT INTO theatres_date_show ({$table_row}) VALUES ({$table_bind})")::bind($bind);
	}

	public static function checkDateShow($where, $bind = []) {
		$db = DB::query("SELECT id FROM theatres_date_show WHERE {$where} LIMIT 1")::bind($bind)::fetch();

		return $db ?: false;
	}

	public static function delDateShow($id, $theatres_id = null) {
		$where = "id = :id";
		$bind = [':id,i' => (int)$id];

		if ($theatres_id) {
			$where .= " AND theatres_id = :theatres_id";
			$bind[':theatres_id,i'] = (int)$theatres_id;
		}


		DB::query("DELETE FROM theatres_date_show WHERE {$where} LIMIT 1")::bind($bind);
	}
}