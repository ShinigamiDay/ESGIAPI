<?php 
	class Log
	{		

		public function logBdd () {

			$dbname = "dp_api";
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