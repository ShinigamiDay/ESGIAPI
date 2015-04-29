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
	}

?>