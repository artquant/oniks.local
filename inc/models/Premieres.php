<?php

class Premieres {
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

		DB::query("INSERT INTO premieres ({$table_row}) VALUES ({$table_bind})")::bind($bind);

		return DB::lastID();
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

		DB::query("UPDATE premieres SET {$table_bind} WHERE id = :id LIMIT 1")::bind($bind);
	}

	public static function list($search = null, $page = 1, $per_page = 15) {
		$query = "SELECT * FROM premieres";
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
		return DB::query("SELECT {$rows} FROM premieres WHERE id = :id LIMIT 1")::bind([
			':id,i' => (int)$id
		])::fetch();
	}

	public static function checkById($id) {
		$db = DB::query("SELECT id FROM premieres WHERE id = :id LIMIT 1")::bind([
			':id,i' => (int)$id
		])::fetch();

		return $db ?: false;
	}

	public static function del($id) {
		DB::query("DELETE FROM premieres WHERE id = :id LIMIT 1")::bind([
			':id,i' => (int)$id
		]);
	}

	public static function getAll($rows = '*') {
		return DB::query("SELECT {$rows} FROM premieres")::execute()::fetchAll();
	}
}