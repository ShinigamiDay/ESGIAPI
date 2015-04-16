<?php 

public static $user = "test@gmail.com";
public static $api = "MAAODMFP01RORIR4949DK3SMEPEP12";
public static $secret = "01PQE93JD83DH381HS7HSJPXBC82NC";
public static $id = "14";
public static $host = "localhost";

public static function verify() {
	$signHTTP = $_SERVER['HTTP_SIGN'];
	$userHTTP = $_SERVER['HTTP_HEADERUSER'];
	$hostHTTP = $_SERVER['HTTP_HOST'];

	$sig = hash_hmac("sha256", self::$user.self::$id.time().self::$secret, self::$api);

	echo "<br>";
	print_r($_SERVER);

	if (self::$user == $userHTTP && $hostHTTP == self::$host && $signHTTP == $sig) {

		header('HTTP/1.0 200 OK');
		// afficher le fichier xml ou json.
		die();
	} else {
		 header('HTTP/1. 403 OK');	
	}
}