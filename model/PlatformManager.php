<?php
require_once('Log.php');

/**
* Get platforms.
*/
class PlatformManager
{

	private $db;
	
	function __construct()
	{
		$this->db = Log::connectionDB();
	}

	/**
	 * Fetch all prices form database for 1 game.
	 * @param  Integer $id Identifier Platform from database.
	 * @return Array prices     Prices information.
	 */
	public function fetchPrices($id) {
		// Prices database
	    $q = $this->db->prepare(
			'SELECT * FROM HAVE_PRICE hp
			LEFT JOIN SELLER se ON hp.IDPRICE = se.IDPRICE
			WHERE IDPLATFORMGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$pricesDB = $q->fetchAll();

		return $pricesDB;
	}

	/**
	 * Fetch all notes from database for 1 platform.
	 * @param  Integer $id Identifier Platform from database.
	 * @return Array notes     Notes information.
	 */
	public function fetchNotes($id) {
		$q = $this->db->prepare(
				'SELECT * FROM NOTE n
				LEFT JOIN HAVE_NOTE hn ON n.IDNOTE = hn.IDNOTE
				WHERE IDPLATFORMGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$notesDB = $q->fetchAll();

		return $notesDB;
	}

	/**
	 * Fetch all points from database for 1 platform.
	 * @param  Integer $id Identifier Platform from database.
	 * @return Array points     Points information.
	 */
	public function fetchPoints($id) {
		$q = $this->db->prepare(
				'SELECT * FROM POINT AS pt WHERE pt.IDPLATFORMGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$pointsDB = $q->fetchAll();

		return $pointsDB;
	}

	/**
	 * Fetch all medias from database for 1 platform.
	 * @param  Integer $id Identifier Platform from database.
	 * @return Array medias     Medias Information.
	 */
	public function fetchMedias($id) {
		$q = $this->db->prepare(
				'SELECT * FROM MEDIA AS m WHERE m.IDPLATFORMGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$mediasDB = $q->fetchAll();

		return $mediasDB;
	}

	/**
	 * Fetch all comments from database for 1 platform.
	 * @param  Inetegr $id Identifier Platform from database.
	 * @return Array comments     Comments Information.
	 */
	public function fetchComments($id) {
		$q = $this->db->prepare(
				'SELECT * FROM COMMENT AS c WHERE c.IDPLATFORMGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$commentsDB = $q->fetchAll();

		return $commentsDB;
	}

	/**
	 * Fetch all configurations from database for 1 platform.
	 * @param  Integer $id Identifier Platform from database.
	 * @return Array Confirgurations     Configurations Information.
	 */
	public function fetchConfigurations($id) {
		$q = $this->db->prepare(
				'SELECT * FROM CONFIGURATION AS cg WHERE cg.IDPLATFORMGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$configsDB = $q->fetchAll();

		return $configsDB;
	}

	/**
	 * Fetch all languages from database for 1 platform.
	 * @param  Integer $id Identifier Platform from database.
	 * @return Array Languages     Languages Information.
	 */
	public function fetchLanguages($id) {
		$q = $this->db->prepare(
				'SELECT * FROM HAVE_LANGUAGE AS hlg WHERE hlg.IDPLATFORMGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$langsDB = $q->fetchAll();

		return $langsDB;
	}

	/**
	 * Fetch all subtitles from database for 1 platform
	 * @param  Integer $id Identifier Platform from database.
	 * @return Array subtitles     Subtitles Information.
	 */
	public function fetchSubtitles($id) {
		$q = $this->db->prepare(
				'SELECT * FROM HAVE_SUBTITLE AS hs WHERE hs.IDPLATFORMGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();
		$subtitles = $q->fetchAll();

		return $subtitles;
	}

	/**
	 * Fetch all tips from database for 1 platform.
	 * @param  Integer $id Identifier Platform from database.
	 * @return Array tricks     Tricks Information.
	 */
	public function fetchTricks($id) {
		$q = $this->db->prepare(
				'SELECT * FROM TRICK AS tk WHERE tk.IDPLATFORMGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();

		$tricksDB = $q->fetchAll();

		return $tricksDB;
	}

	/**
	 * Fetch all Similar games from database for 1 platform.
	 * @param  Integer $id Identifier Platform from database.
	 * @return Array similar games     Similar games information.
	 */
	public function fetchSimilarGames($id) {
		$q = $this->db->prepare(
				'SELECT * FROM HAVE_SIMILARGAME hsg
				LEFT JOIN SIMILARGAME sg ON hsg.IDSIMILARGAME = sg.IDSIMILARGAME WHERE IDPLATFORMGAME=:id');
		$q->bindValue(':id', $id, PDO::PARAM_INT);
		$q->execute();

		$similarsDB = $q->fetchAll();

		return $similarsDB;
	}
}