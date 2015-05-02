<?php
require_once('../model/Log.php');
function connectionDB() {
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

// Connection to database
$db = connectionDB();

// Get games
$q = $db->prepare('SELECT * FROM GAME');
$q->execute();
$games = $q->fetchAll();

videoGamesXML($games, $db);


foreach ($games as $game) {

	$q = $db->prepare(
		'SELECT * FROM COMPANY WHERE IDCOMPANY IN ( SELECT IDCOMPANY FROM HAVE_COMPANY WHERE IDGAME=:id )');
	$q->bindValue(':id', $game['IDGAME'], PDO::PARAM_INT);
	$q->execute();
	$companies = $q->fetchAll();

	$q = $db->prepare(
		'SELECT * FROM TYPE WHERE IDTYPE IN ( SELECT IDTYPE FROM HAVE_TYPE WHERE IDGAME=:id )');
	$q->bindValue(':id', $game['IDGAME'], PDO::PARAM_INT);
	$q->execute();
	$genres = $q->fetchAll();

	$q = $db->prepare(
		'SELECT * FROM LINK l
		LEFT JOIN TYPELINK tl ON l.IDTYPELINK = tl.IDTYPELINK
		WHERE IDLINK IN ( SELECT IDLINK FROM HAVE_LINK WHERE IDGAME=:id )');
	$q->bindValue(':id', $game['IDGAME'], PDO::PARAM_INT);
	$q->execute();
	$links = $q->fetchAll();

	$q = $db->prepare(
		'SELECT * FROM MODE gm
		LEFT JOIN HAVE_GAMEMODE hm ON gm.IDGAMEMODE = hm.IDGAMEMODE
		WHERE IDGAME=:id');
	$q->bindValue(':id', $game['IDGAME'], PDO::PARAM_INT);
	$q->execute();
	$modes = $q->fetchAll();

	$q = $db->prepare(
		'SELECT * FROM PLATFORM p
		LEFT JOIN PLATFORMGAME pg ON p.IDPLATFORM = pg.IDPLATFORM
		WHERE IDGAME=:id');
	$q->bindValue(':id', $game['IDGAME'], PDO::PARAM_INT);
	$q->execute();
	$platforms = $q->fetchAll();

	foreach ($platforms as $platform) {
		$q = $db->prepare(
			'SELECT * FROM MEDIA AS m, COMMENT AS c, CONFIGURATION AS cg, POINT AS pt, HAVE_LANGUAGE AS hlg,
							HAVE_SUBTITLE AS hs, TRICK AS tk
			WHERE m.IDPLATFORMGAME=:id
			AND c.IDPLATFORMGAME=:id
			AND cg.IDPLATFORMGAME=:id
			AND pt.IDPLATFORMGAME=:id
			AND hlg.IDPLATFORMGAME=:id
			AND hs.IDPLATFORMGAME=:id
			AND tk.IDPLATFORMGAME=:id');
		$q->bindValue(':id', $platform['IDPLATFORMGAME'], PDO::PARAM_INT);
		$q->execute();
		$platformDatas = $q->fetchAll();

		$q = $db->prepare(
			'SELECT * FROM HAVE_PRICE hp
			LEFT JOIN SELLER se ON hp.IDPRICE = se.IDPRICE
			WHERE IDPLATFORMGAME=:id');
		$q->bindValue(':id', $platform['IDPLATFORMGAME'], PDO::PARAM_INT);
		$q->execute();
		$prices = $q->fetchAll();

		$q = $db->prepare(
			'SELECT * FROM HAVE_NOTE hn
			LEFT JOIN NOTE n ON n.IDNOTE = hn.IDNOTE
			WHERE IDPLATFORMGAME=:id');
		$q->bindValue(':id', $platform['IDPLATFORMGAME'], PDO::PARAM_INT);
		$q->execute();
		$notes = $q->fetchAll();

		$q = $db->prepare(
			'SELECT * FROM HAVE_SIMILARGAME hsg
			LEFT JOIN SIMILARGAME sg ON hsg.IDSIMILARGAME = sg.IDSIMILARGAME
			WHERE IDPLATFORMGAME=:id');
		$q->bindValue(':id', $platform['IDPLATFORMGAME'], PDO::PARAM_INT);
		$q->execute();
		$similargames = $q->fetchAll();

	}

	
}

function videoGamesXML($stmt, $db) {

// Racine Element XML
	$games = new SimpleXMLElement("<jeuxVideo></jeuxVideo>");

	// For each video games ...
	foreach ($stmt as $row) {
	// Get Data
	
	// Create a node game
	    $game = $games->addChild('jeu');
        $game->addAttribute('id', $row['IDGAME']);
	    // Add in game node title element
	    $game->addChild('titre', $row['TITLE']);

	    // Companies database
	    $q = $db->prepare(
			'SELECT * FROM COMPANY WHERE IDCOMPANY IN ( SELECT IDCOMPANY FROM HAVE_COMPANY WHERE IDGAME=:id )');
		$q->bindValue(':id', $row['IDGAME'], PDO::PARAM_INT);
		$q->execute();
		$companiesDB = $q->fetchAll();
	    // Companies element on game node
	    $companies = $game->addChild('societes');
	    // For each company, create a node company with an attribute activite
	    foreach ($companiesDB as $companyDB) {
	    	$company = $companies->addChild('societe', $companyDB['NAMECOMPANY']);
	    	//TODO: Activity.
	    	$company->addAttribute('activite', $companyDB['ACTIVITYCOMPANY']);
	    }

	    // Genres database
	    $q = $db->prepare(
			'SELECT * FROM TYPE WHERE IDTYPE IN ( SELECT IDTYPE FROM HAVE_TYPE WHERE IDGAME=:id )');
		$q->bindValue(':id', $row['IDGAME'], PDO::PARAM_INT);
		$q->execute();
		$genresDB = $q->fetchAll();
		// Genres video games in game node
	    $genres = $game->addChild('genres');
	    foreach ($genresDB as $genreDB) {
	    	$genres->addChild('genre', $genreDB['NAMETYPE']);
	    }
	    
	    // Links Database
	    $q = $db->prepare(
		'SELECT * FROM LINK l
			LEFT JOIN TYPELINK tl ON l.IDTYPELINK = tl.IDTYPELINK
			WHERE IDLINK IN ( SELECT IDLINK FROM HAVE_LINK WHERE IDGAME=:id )');
		$q->bindValue(':id', $row['IDGAME'], PDO::PARAM_INT);
		$q->execute();
		$linksDB = $q->fetchAll();
	    // Links Node in game
	    $links = $game->addChild('liens');
	    foreach ($linksDB as $linkDB) {
	    	$link = $links->addChild('lien', $linkDB['CONTENTLINK']);
	    	$link->addAttribute('type', $linkDB['NAMETYPELINK']);
	    }

	    // Modes database
	    $q = $db->prepare(
		'SELECT * FROM MODE gm
			LEFT JOIN HAVE_GAMEMODE hm ON gm.IDGAMEMODE = hm.IDGAMEMODE
			WHERE IDGAME=:id');
		$q->bindValue(':id', $row['IDGAME'], PDO::PARAM_INT);
		$q->execute();
		$modesDatabase = $q->fetchAll();
	    // Mode Game
	    $modesGames = $game->addChild('modesJeu');
	    foreach ($modesDatabase as $modesDB) {
	    	$modesGames->addChild('modeJeu', $modesDB['NAMEGAMEMODE']);
	    }

	    // Description node in game node
	    $game->addChild('description', $row['DESCRIPTION']); 

	    // Platforms database
	    $q = $db->prepare(
		'SELECT * FROM PLATFORM p
			LEFT JOIN PLATFORMGAME pg ON p.IDPLATFORM = pg.IDPLATFORM
			WHERE IDGAME=:id');
		$q->bindValue(':id', $row['IDGAME'], PDO::PARAM_INT);
		$q->execute();
		$platformsDB = $q->fetchAll();
	    // Plateformes in game node
	    $platforms = $game->addChild('plateformes');
	    foreach ($platformsDB as $platformDB) {

	    	// create platform
	    	$platform = $platforms->addChild('plateforme');
	    	// set attribute "type" to platform
	    	$platform->addAttribute('type', $platformDB['NAMEPLATFORM']);

	    // Create resume node to platform node
	    	$platform->addChild('resume', $platformDB['DESCRIPTION']);
	    // Create Release date node to platform node
	    	$platform->addChild('dateSortie', $platformDB['EXIT_DATE']);

	    // Prices database
		    $q = $db->prepare(
				'SELECT * FROM HAVE_PRICE hp
				LEFT JOIN SELLER se ON hp.IDPRICE = se.IDPRICE
				WHERE IDPLATFORMGAME=:id');
			$q->bindValue(':id', $platformDB['IDPLATFORMGAME'], PDO::PARAM_INT);
			$q->execute();
			$pricesDB = $q->fetchAll();
	    // Create node prices containes multiple price
	    	$prices = $platform->addChild('prices');

	    	foreach ($pricesDB as $priceDB) {
	    		$price = $prices->addChild('price', $priceDB['PRICE']);
	    		$price->addAttribute('vendeur', $priceDB['SELLER']);
	    		$price->addAttribute('type', $priceDB['TYPEMEDIA']);
	    		$price->addAttribute('devise', $priceDB['CURRENCY']);
	    	}

	    // Notes database
		    $q = $db->prepare(
				'SELECT * FROM NOTE n
				LEFT JOIN HAVE_NOTE hn ON n.IDNOTE = hn.IDNOTE
				WHERE IDPLATFORMGAME=:id');
			$q->bindValue(':id', $platformDB['IDPLATFORMGAME'], PDO::PARAM_INT);
			$q->execute();
			$notesDB = $q->fetchAll();
		// Create node notes containes multiple note
	    	$scores = $platform->addChild('notes');
	    	foreach ($notesDB as $scoreDB) {
	    		$score = $scores->addChild('notation', $scoreDB['NOTE']);
	    		$score->addAttribute('source', $scoreDB['SOURCE']);
	    	}

	    // Create pegi node
	    	$platform->addChild('pegi', $platformDB['PEGI']);

	    // Points database
	    	$q = $db->prepare(
				'SELECT * FROM POINT AS pt WHERE pt.IDPLATFORMGAME=:id');
			$q->bindValue(':id', $platformDB['IDPLATFORMGAME'], PDO::PARAM_INT);
			$q->execute();
			$pointsDB = $q->fetchAll();
	    // Create points node
	    	$points = $platform->addChild('points');
	    	foreach ($pointsDB as $pointDB) {
	    		$point = $points->addChild('point', $pointDB['TYPEMEDIA']);
	    		$point->addAttribute('type', $pointDB['POINT']);
	    	}

	    // Medias database
	    	$q = $db->prepare(
				'SELECT * FROM MEDIA AS m WHERE m.IDPLATFORMGAME=:id');
			$q->bindValue(':id', $platformDB['IDPLATFORMGAME'], PDO::PARAM_INT);
			$q->execute();
			$mediasDB = $q->fetchAll();
	    // Create Medias nodes
	    	$medias = $platform->addChild('medias');
	    	foreach ($mediasDB as $mediaDB) {
	    		$media = $medias->addChild('media');
	    		$media->addAttribute('type', $mediaDB['TYPEMEDIA']);
	    		$media->addAttribute('cible', $mediaDB['TARGETMEDIA']);

	    		// Add libele to media node.
	    		$media->addChild('libelle', $mediaDB['LABELMEDIA']);
	    		$media->addChild('url', $mediaDB['URLMEDIA']);
	    		$media->addChild('alt', $mediaDB['ALTMEDIA']);
	    	}

	    // Comments database
	    	$q = $db->prepare(
				'SELECT * FROM COMMENT AS c WHERE c.IDPLATFORMGAME=:id');
			$q->bindValue(':id', $platformDB['IDPLATFORMGAME'], PDO::PARAM_INT);
			$q->execute();
			$commentsDB = $q->fetchAll();
	    // Create Comments nodes
	    	$commentaires = $platform->addChild('commentaires');
	    	foreach ($commentsDB as $commentaireDB) {
	    		$commentaire = $commentaires->addChild('commentaire');

	    		// Add author, date, note and content to comment node.
	    		$commentaire->addChild('auteur', $commentaireDB['AUTHOR']);
	    		$commentaire->addChild('date', $commentaireDB['DATE_COMMENT']);
	    		$commentaire->addChild('note', $commentaireDB['NOTE']);
	    		$commentaire->addChild('contenu', $commentaireDB['CONTENT']);
	    	}

	    // Configurations database
	    	$q = $db->prepare(
				'SELECT * FROM CONFIGURATION AS cg WHERE cg.IDPLATFORMGAME=:id');
			$q->bindValue(':id', $platformDB['IDPLATFORMGAME'], PDO::PARAM_INT);
			$q->execute();
			$configsDB = $q->fetchAll();
	    // Create configurations nodes
	    	$configurations = $platform->addChild('configurationsPc');
	    	foreach ($configsDB as $configDB) {
	    		$config = $configurations->addChild('configurationPC');
	    		$config->addAttribute('type', $configDB['TYPE_CONFIG']);

	    		// Add author, date, note and content to comment node.
	    		$config->addChild('systeme', $configDB['SYSTEM']);
	    		$config->addChild('ram', $configDB['RAM']);
	    		$config->addChild('disqueDur', $configDB['DISK']);
	    		$config->addChild('gpu', $configDB['GPU']);
	    		$config->addChild('connexion', $configDB['CONNECTIONCONFIG']);
	    		$config->addChild('directX', $configDB['DIRECTX']);
	    	}

	    // Languages database
	    	$q = $db->prepare(
				'SELECT * FROM HAVE_LANGUAGE AS hlg WHERE hlg.IDPLATFORMGAME=:id');
			$q->bindValue(':id', $platformDB['IDPLATFORMGAME'], PDO::PARAM_INT);
			$q->execute();
			$langsDB = $q->fetchAll();
	    // Create lang nodes
	    	$languages = $platform->addChild('langues');

            // Audios
            $audios = $languages->addChild('audios');

	    	foreach ($langsDB as $langDB) {
	    		$audios->addChild('audio', $langDB['LABELLANGUAGE']);
	    	}

	    	$q = $db->prepare(
				'SELECT * FROM HAVE_SUBTITLE AS hs WHERE hs.IDPLATFORMGAME=:id');
			$q->bindValue(':id', $platformDB['IDPLATFORMGAME'], PDO::PARAM_INT);
			$q->execute();
			$subtitlesDB = $q->fetchAll();

            // Subtitles
            $subtitles = $languages->addChild('sousTitres');

	    	foreach ($subtitlesDB as $subtitleDB) {

	    		$subtitles->addChild('sousTitre', $subtitleDB['LABELLANGUAGE']);
	    	}

	    	// Languages database
	    	$q = $db->prepare(
				'SELECT * FROM TRICK AS tk WHERE tk.IDPLATFORMGAME=:id');
			$q->bindValue(':id', $platformDB['IDPLATFORMGAME'], PDO::PARAM_INT);
			$q->execute();

			$tricksDB = $q->fetchAll();

	    	// Tips node
	    	$tips = $platform->addChild('astuces');

	    	foreach ($tricksDB as $trickDB) {
	    		$tips->addChild('astuce', $trickDB['LABELMEDIA']);
	    	}

	    	// Similars database
	    	$q = $db->prepare(
				'SELECT * FROM HAVE_SIMILARGAME hsg
				LEFT JOIN SIMILARGAME sg ON hsg.IDSIMILARGAME = sg.IDSIMILARGAME WHERE IDPLATFORMGAME=:id');
			$q->bindValue(':id', $platformDB['IDPLATFORMGAME'], PDO::PARAM_INT);
			$q->execute();

			$similarsDB = $q->fetchAll();
	    	// Similar game node
	    	$similarGames = $platform->addChild('jeuxSimilaires');
	    	foreach ($similarsDB as $similarGameDB) {
                $similarGames = $similarGames->addChild('jeuSimilaire');

                $similarGames->addChild('libelleJeu', $similarGameDB['LABELMEDIA']);
                $similarGames->addChild('urlJeu', $similarGameDB['URLMEDIA']);


	    	}
	    		    	
	    } // End 

	    // and next comming soon. Stay tuned.
	    
	    
	    // CDATA sections are slightly different
	    //$description = $games->createElement('description');
	    //$description->appendChild($games->createCDATASection($row['description']));
	    //$game->appendChild($description);
	    

	}

	// Set the appropriate content-type header and output the XML
	//header('Content-type: application/xml');
	//echo $games->saveXML(); // asXML()
	Header('Content-type: text/xml');
	echo $games->asXML();
}