<?php

class Users {
	public static function isAdmin($options = []) {
		$options = array_replace([
			'url'      => '',
			'check_ip' => true,
			'response' => false
		], $options);

		$access_ip = DB::query("SELECT ip FROM admin_ip WHERE id = 1")::execute()::fetch()->ip;

		if ($options['check_ip'] AND !in_array(Ip::real(), array_map('trim', explode(',', $access_ip)))) {
			Request::location($options);
			exit;
		} else if (Sessions::check('iduser')) {
			if (USER['access'] != 9) {
				Request::location($options);
				exit;
			}
		}
	}

	public static function isAuth($response = false) {
		if (!Sessions::check('iduser')) {
			Request::location([
				'url'      => '/auth',
				'response' => $response
			]);
			exit;
		}
	}

	public static function info($table_name = '*', $params = []) {
		$table_row  = [];
		$bind       = [];

		$table_name = is_array($table_name) ? implode(',', $table_name) : $table_name;

		foreach ($params as $key => $value) {
			array_push($table_row, explode(',', $key)[0] . ' = :' . explode(',', $key)[0]);
			$bind[':' . $key] = $value;
		}

		$table_row = implode(' AND ', $table_row);

		return DB::query("SELECT " . $table_name . " FROM users WHERE {$table_row}")::bind($bind)::fetch();
	}

	public static function list($search = null, $page = 1, $per_page = 15) {
		$query = "SELECT * FROM users";
		$bind = [];

		if ($search) {
			$query .= " WHERE surname LIKE :search OR email LIKE :search";
			$bind[':search,s'] = '%' . urldecode(htmlspecialchars($search)) . '%';
		}

		$count = DB::query($query)::bind($bind)::rowCount();
		$pagination = Pagination::build($page, $count, [true, '#app'], $per_page);

		$bind[':offset,i'] = $pagination['start'];
		$bind[':count,i'] = $per_page;

		$db = DB::query("{$query} ORDER BY access DESC LIMIT :offset, :count")::bind($bind)::fetchAll();

		return [
			'pagination' => $pagination['show'],
			'db'         => $db
		];
	}

	public static function getById($id) {
		return DB::query("SELECT * FROM users WHERE id = :id LIMIT 1")::bind([':id,i' => $id])::fetch();
	}

	public static function checkEmail($email) {
		return DB::query("SELECT id FROM users WHERE email = :email")::bind([
			':email,s' => $email
		])::fetch();
	}

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

		DB::query("INSERT INTO users ({$table_row}) VALUES ({$table_bind})")::bind($bind);
	}

	public static function checkById($id) {
		$db = DB::query("SELECT id FROM users WHERE id = :id LIMIT 1")::bind([
			':id,i' => $id
		])::fetch();

		return $db ?: false;
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

		$bind[':id,i'] = (int)$id;
		$table_bind = implode(', ', $table_bind);

		DB::query("UPDATE users SET {$table_bind} WHERE id = :id LIMIT 1")::bind($bind);
	}

	public static function getByAccessAll($access = 1) {
		$theatres_row = null;
		$theatres_where = null;

		if ($access == 2) {
			$theatres_row = ", theatres.name AS theatres_name, theatres.city, theatres.address, theatres.phone";
			$theatres_where = " LEFT JOIN theatres ON users.theatres_id = theatres.id";
		}

		return DB::query("SELECT users.*{$theatres_row} FROM users{$theatres_where} WHERE users.access = :access")::bind([
			':access,i' => (int)$access
		])::fetchAll();
	}
}