<?php
require_once('Log.php');

/**
* Get games.
*/
class GameManager
{

	private $db;
	
	function __construct()
	{
		$this->db = Log::connectionDB();
	}

	public function fetchAllGames() {
		$q = $this->db->prepare('SELECT * FROM GAME');
		$q->execute();
		$games = $q->fetchAll();

		return $games;
	}

	/**
	 * Fetch information about company from one game for 1 game.
	 * @param  Integer $id Identifier game from database.
	 * @return Array companies     Companies information
	 */
	public function fetchCompanies($id) {
		// Companies database
	    $q = $this->db->prepare(
			'SELECT * FROM COMPANY WHERE IDCOMPANY IN ( SELECT IDCOMPANY FROM HAVE_COMPANY WHERE IDGAME=:id )');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$companiesDB = $q->fetchAll();

		return $companiesDB;
	}

	/**
	 * Fetch all Genres information from database for 1 game.
	 * @param  Integer $id Identifier game from database.
	 * @return Array genres     Genres information
	 */
	public function fetchGenres($id) {
		// genres database
		$q = $this->db->prepare(
			'SELECT * FROM TYPE WHERE IDTYPE IN ( SELECT IDTYPE FROM HAVE_TYPE WHERE IDGAME=:id )');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$genresDB = $q->fetchAll();

		return $genresDB;
	}

	/**
	 * Fetch all links from database for 1 game.
	 * @param  Integer $id Identifier game from database.
	 * @return Array links     Links informations
	 */
	public function fetchLinks($id) {
		// Links Database
	    $q = $this->db->prepare(
		'SELECT * FROM LINK l
			LEFT JOIN TYPELINK tl ON l.IDTYPELINK = tl.IDTYPELINK
			WHERE IDLINK IN ( SELECT IDLINK FROM HAVE_LINK WHERE IDGAME=:id )');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$linksDB = $q->fetchAll();

		return $linksDB;
	}

	/**
	 * Fetch all modes from database for 1 game.
	 * @param  Integer $id Identifier game from database.
	 * @return Array Modes     Modes information.
	 */
	public function fetchModes($id) {
		// Modes database
		$q = $this->db->prepare(
		'SELECT * FROM MODE gm
			LEFT JOIN HAVE_GAMEMODE hm ON gm.IDGAMEMODE = hm.IDGAMEMODE
			WHERE IDGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$modesDatabase = $q->fetchAll();

		return $modesDatabase;
	}

	/**
	 * Fetch all platforms from database for 1 game.
	 * @param  Ineteger $id Identifier game from database.
	 * @return Array platforms     Platforms information.
	 */
	public function fetchPlatforms($id) {
		// Platforms database
	    $q = $this->db->prepare(
		'SELECT * FROM PLATFORM p
			LEFT JOIN PLATFORMGAME pg ON p.IDPLATFORM = pg.IDPLATFORM
			WHERE IDGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$platformsDB = $q->fetchAll();

		return $platformsDB;
	}
}