<?php 
	class Log
	{		

		public function logBdd () {

			$dbname = "db_api";
			$username = "root";
			$password = "";
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