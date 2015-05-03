<?php

require_once('Log.php');

/**
* Get datas from games
*/
class DatasGames
{

	private $db;
	
	function __construct()
	{
		$db = Log::connectionDB();
	}

	/**
	 * Fetch information about company from one game for 1 game.
	 * @param  Integer $id Identifier game from database.
	 * @return Array companies     Companies information
	 */
	public static function fetchCompanies($id) {
		// Companies database
	    $q = $db->prepare(
			'SELECT * FROM COMPANY WHERE IDCOMPANY IN ( SELECT IDCOMPANY FROM HAVE_COMPANY WHERE IDGAME=:id )');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$companiesDB = $q->fetchAll();
	}

	/**
	 * Fetch all Genres information from database for 1 game.
	 * @param  Integer $id Identifier game from database.
	 * @return Array genres     Genres information
	 */
	public static function fetchGenres($id) {
		// genres database
		$q = $db->prepare(
			'SELECT * FROM TYPE WHERE IDTYPE IN ( SELECT IDTYPE FROM HAVE_TYPE WHERE IDGAME=:id )');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$genresDB = $q->fetchAll();
	}

	/**
	 * Fetch all links from database for 1 game.
	 * @param  Integer $id Identifier game from database.
	 * @return Array links     Links informations
	 */
	public static function fetchLinks($id) {
		// Links Database
	    $q = $db->prepare(
		'SELECT * FROM LINK l
			LEFT JOIN TYPELINK tl ON l.IDTYPELINK = tl.IDTYPELINK
			WHERE IDLINK IN ( SELECT IDLINK FROM HAVE_LINK WHERE IDGAME=:id )');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$linksDB = $q->fetchAll();
	}

	/**
	 * Fetch all modes from database for 1 game.
	 * @param  Integer $id Identifier game from database.
	 * @return Array Modes     Modes information.
	 */
	public static function fetchModes($id) {
		// Modes database
		$q = $db->prepare(
		'SELECT * FROM MODE gm
			LEFT JOIN HAVE_GAMEMODE hm ON gm.IDGAMEMODE = hm.IDGAMEMODE
			WHERE IDGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$modesDatabase = $q->fetchAll();
	}

	/**
	 * Fetch all platforms from database for 1 game.
	 * @param  Ineteger $id Identifier game from database.
	 * @return Array platforms     Platforms information.
	 */
	public static function fetchPlatforms($id) {
		// Platforms database
	    $q = $db->prepare(
		'SELECT * FROM PLATFORM p
			LEFT JOIN PLATFORMGAME pg ON p.IDPLATFORM = pg.IDPLATFORM
			WHERE IDGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$platformsDB = $q->fetchAll();
	}
}