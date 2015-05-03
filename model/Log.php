<?php 
class Log
{		

	public function logBdd () {

		$dbname = "db_esgiapi";
		$username = "root";
		$password = "root";
		$host = "localhost";

		$tabLog = array(
						'dbname' => $dbname,
						'username' => $username, 
						'password' => $password,
						'host' => $host,
		);

		return $tabLog;

	}

	public static function connectionDB() {
		try {
			$api = new Log;
			$tabLog = $api->logBdd();
			$dbname = $tabLog["dbname"];
			$username = $tabLog["username"];
			$password = $tabLog["password"];
			$host = $tabLog["host"];
		    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
		    $pdo_options[PDO::ATTR_DEFAULT_FETCH_MODE] = PDO::FETCH_ASSOC;
		    $var = 'mysql:host='.$host.';dbname='.$dbname . ";charset=utf8";
			return new PDO($var, $username, $password, $pdo_options);
		} catch (PDOException $e) {
			echo $e->getMessage();
			exit();
		}
	}
}
