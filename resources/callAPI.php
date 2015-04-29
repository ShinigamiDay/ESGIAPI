<?php 

public static $user = "test@gmail.com";
public static $api = "MAAODMFP01RORIR4949DK3SMEPEP12";
public static $secret = "01PQE93JD83DH381HS7HSJPXBC82NC";
public static $id = "14";
public static $host = "localhost";

static function verify() {
	$signHTTP = $_SERVER['HTTP_SIGN'];
	$userHTTP = $_SERVER['HTTP_HEADERUSER'];
	$hostHTTP = $_SERVER['HTTP_HOST'];

	$sig = hash_hmac("sha256", self::$user.self::$id.time().self::$secret, self::$api);

	echo "<br>";
	print_r($_SERVER);

	if (self::$user == $userHTTP && $hostHTTP == self::$host && $signHTTP == $sig) {

		header('HTTP/1.0 200 OK');
		// afficher le fichier xml ou json.
		// 
		die();
	} else {
		 header('HTTP/1. 403 OK');	
	}
}

function connection() {
	$api = new Log;
	$tabLog = $api->logBdd();
	$dbname = $tabLog["dbname"];
	$username = $tabLog["username"];
	$password = $tabLog["password"];
	$host = $tabLog["host"];
    $pdo_options[PDO::ATTR_ERRMODE] = PDO::ERRMODE_EXCEPTION;
    $var = 'mysql:host='.$host.';dbname='.$dbname;
	return new PDO($var, $username, $password, $pdo_options);
}

$db = connection();

$q = $db->query('SELECT g.TITLE AS game,
						g.DESCRIPTION,
						g.IDGAME,
						c.NAMECOMPANY,
						t.NAMETYPE,
						l.CONTENTLINK,
						l.IDTYPELINK,
						tl.NAMETYPELINK,
						gm.NAMEGAMEMODE,
						pg.IDPLATFORMGAME,
						pg.IDPLATFORM,
						pg.DESCRIPTION,
						pg.PEGI,
						pg.EXIT_DATE,
						p.NAMEPLATFORM,
						hp.PRICE,
						hp.CURRENCY,
						se.SELLER,
						se.TYPEMEDIA,
						hn.NOTE,
						n.SOURCE,
						pt.TYPEMEDIA,
						pt.POINT,
						m.TYPEMEDIA,
						m.TARGETMEDIA,
						m.LABELMEDIA,
						m.URLMEDIA,
						m.ALTMEDIA,
						cm.AUTHOR,
						cm.NOTE,
						cm.CONTENT,
						cg.SYSTEM,
						cg.RAM,
						cg.DISK,
						cg.GPU,
						cg.CONNECTIONCONFIG,
						cg.DIRECTX,
						hlg.LABELLANGUAGE,
						hs.LABELLANGUAGE,
						tk.LABELMEDIA,
						sg.LABELMEDIA,
						sg.URLMEDIA

				FROM GAME g -- Table de référence
				LEFT JOIN HAVE_COMPANY hc ON g.IDGAME = hc.IDGAME -- Jointure entre les tables HAVE_COMPANY et GAME
				LEFT JOIN COMPANY c ON hc.IDCOMPANY = c.IDCOMPANY
				LEFT JOIN HAVE_TYPE ht ON g.IDGAME = ht.IDGAME -- TYPE
				LEFT JOIN TYPE t ON ht.IDTYPE = t.IDTYPE
				LEFT JOIN HAVE_LINK hl ON g.IDGAME = hl.IDGAME -- LINK
				LEFT JOIN LINK l ON hl.IDLINK = l.IDLINK
				LEFT JOIN TYPELINK tl ON l.IDTYPELINK = tl.IDTYPELINK -- TYPELINK
				LEFT JOIN HAVE_GAMEMODE hm ON g.IDGAME = hm.IDGAME -- GAME MODE
				LEFT JOIN MODE gm ON hm.IDGAMEMODE = gm.IDGAMEMODE
				LEFT JOIN PLATFORMGAME pg ON g.IDGAME = pg.IDGAME -- GAME PLATFORM
				LEFT JOIN PLATFORM p ON pg.IDPLATFORM = pg.IDPLATFORM
				LEFT JOIN HAVE_PRICE hp ON pg.IDPLATFORMGAME = hp.IDPLATFORMGAME -- GAME PRICE
				LEFT JOIN SELLER se ON hp.IDPRICE = se.IDPRICE
				LEFT JOIN HAVE_NOTE hn ON pg.IDPLATFORMGAME = hn.IDPLATFORMGAME -- GAME NOTE
				LEFT JOIN NOTE n ON hn.IDNOTE = hn.IDNOTE
				LEFT JOIN POINT pt ON pg.IDPLATFORMGAME = pt.IDPLATFORMGAME -- GAME point
				LEFT JOIN MEDIA m ON pg.IDPLATFORMGAME = m.IDPLATFORMGAME -- GAME MEDIA
				LEFT JOIN COMMENT cm ON pg.IDPLATFORMGAME = cm.IDPLATFORMGAME -- GAME COMMENT
				LEFT JOIN CONFIGURATION cg ON pg.IDPLATFORMGAME = cg.IDPLATFORMGAME -- GAME CONFIG
				LEFT JOIN HAVE_LANGUAGE hlg ON pg.IDPLATFORMGAME = hlg.IDPLATFORMGAME -- GAME LANGUAGES AUDIO
				LEFT JOIN HAVE_SUBTITLE hs ON pg.IDPLATFORMGAME = hs.IDPLATFORMGAME -- GAME LANGUE SUBTITLE
				LEFT JOIN TRICK tk ON pg.IDPLATFORMGAME = tk.IDPLATFORMGAME -- GAME TRICK
				LEFT JOIN HAVE_SIMILARGAME hsg ON pg.IDPLATFORMGAME = hsg.IDPLATFORMGAME -- GAME SIMILAR
				LEFT JOIN SIMILARGAME sg ON hsg.IDSIMILARGAME = sg.IDSIMILARGAME
				ORDER BY g.IDGAME');
die();
$stmt = $q->fetch(PDO::FETCH_ASSOC);

var_dump($stmt);
/*
public function videoGamesXML($stmt) {

// Racine Element XML
	$games = new SimpleXMLElement("<jeuxVideo></jeuxVideo>");

	// For each video games ...
	foreach ($stmt as $row) {
	// Create a node game
	    $game = $games->addChild('jeu');
	    // Add in game node title element
	    $game->addChild('titre', $row['title']);

	    // Companies element on game node
	    $companies = $game->addChild('societes');
	    // For each company, create a node company with an attribute activite
	    foreach ($row['company'] as $companyDB) {
	    	$company = $companies->addChild('societe', $companyDB);
	    	//TODO: Activity.
	    	$company->setAttribute('activite', $companyDB['activity']);
	    }

		// Genres video games in game node
	    $genres = $game->addChild('genres');
	    foreach ($row['genre'] as $genreDB) {
	    	$genres->addChild('genre', $genreDB);
	    }
	    
	    // Links Node in game
	    $links = $game->addChild('liens');
	    foreach ($row['link'] as $linkDB) {
	    	$link = $links->addChild('lien', $linkDB['link']);
	    	$link->setAttribute('type', $linkDB['type']);
	    }

	    // Mode Game
	    $modesGames = $game->addChild('modesJeu');
	    foreach ($row['modeGames'] as $modesDB) {
	    	$modesGames->addChild('modeJeu', $modesDB);
	    }

	    // Description node in game node
	    $game->addChild('description', $row['description']); 

	    // Plateformes in game node
	    $platforms = $game->addChild('plateformes');
	    foreach ($row['platforms'] as $platformDB) {
	    	// create platform
	    	$platform = $platforms->addChild('plateforme');
	    	// set attribute "type" to platform
	    	$platform->setAttribute('type', $platformDB['type']);

	    // Create resume node to platform node
	    	$platform->addChild('resume', $platformDB['resume']);
	    // Create Release date node to platform node
	    	$platform->addChild('dateSortie', $platformDB['releaseDate']);
	    // Create node prices containes multiple price
	    	$prices = $platform->addChild('prix');
	    	foreach ($platformDB['prices'] as $priceDB) {
	    		$price = $prices->addChild('price', $priceDB['price']);
	    		$price->setAttribute('vendeur', $priceDB['seller']);
	    		$price->setAttribute('type', $priceDB['type']);
	    		$price->setAttribute('devise', $priceDB['currency']);
	    	}

		// Create node notes containes multiple note
	    	$scores = $platform->addChild('notes');
	    	foreach ($platformDB['scores'] as $scoreDB) {
	    		$score = $scores->addChild('score', $scoreDB['score']);
	    		$score->setAttribute('source', $priceDB['source']);
	    	}

	    // Create pegi node
	    	$platform->addChild('pegi', $platformDB['pegi']);

	    // Create points node
	    	$points = $platform->addChild('points');
	    	foreach ($platformDB['points'] as $pointDB) {
	    		$point = $points->addChild('point', $pointDB['point']);
	    		$point->setAttribute('type', $pointDB['type']);
	    	}

	    // Create Medias nodes
	    	$medias = $platform->addChild('medias');
	    	foreach ($platformDB['medias'] as $mediaDB) {
	    		$media = $medias->addChild('media');
	    		$media->setAttribute('type', $mediaDB['type']);
	    		$media->setAttribute('cible', $mediaDB['target']);

	    		// Add libele to media node.
	    		$media->addChild('libelle', $mediaDB['libelle']);
	    		$media->addChild('url', $mediaDB['url']);
	    		$media->addChild('alt', $mediaDB['alt']);
	    	}

	    // Create Comments nodes
	    	$commentaires = $platform->addChild('commentaires');
	    	foreach ($platformDB['commentaires'] as $commentaireDB) {
	    		$commentaire = $commentaires->addChild('commentaire');

	    		// Add author, date, note and content to comment node.
	    		$commentaire->addChild('auteur', $commentaireDB['author']);
	    		$commentaire->addChild('date', $commentaireDB['date']);
	    		$commentaire->addChild('note', $commentaireDB['note']);
	    		$commentaire->addChild('contenu', $commentaireDB['content']);
	    	}

	    // Create configurations nodes
	    	$configurations = $platform->addChild('configurationsPc');
	    	foreach ($platformDB['configurations'] as $configDB) {
	    		$config = $configurations->addChild('configurationPC');
	    		$config->setAttribute('type', $configDB['type']);

	    		// Add author, date, note and content to comment node.
	    		$config->addChild('systeme', $configDB['system']);
	    		$config->addChild('ram', $configDB['ram']);
	    		$config->addChild('disqueDur', $configDB['disk']);
	    		$config->addChild('cpu', $configDB['cpu']);
	    		$config->addChild('gpu', $configDB['gpu']);
	    		$config->addChild('connexion', $configDB['connection']);
	    		$config->addChild('directX', $configDB['directX']);
	    	}

	    // Create lang nodes
	    	$languages = $platform->addChild('langues');
	    	foreach ($platformDB['languages'] as $langDB) {

	    		// Audios
	    		$audios = $languages->addChild('audios');
	    		foreach ($langDB['audios'] as $audioDB) {
	    			$audios->addChild('audio', $audioDB);
	    		}
	    		
	    		// Subtitles
	    		$subtitles = $languages->addChild('sousTitres');
	    		foreach ($langDB['subtitles'] as $subtitleDB) {
	    			$audios->addChild('sousTitre', $subtitleDB['LABELLANGUAGE']);
	    		}
	    	}

	    	// Tips node
	    	$tips = $platform->addChild('astuces');
	    	foreach ($platform['tricks'] as $trickDB) {
	    		$tips->addChild('astuce', $trickDB['LABELMEDIA']);
	    	}

	    	// Similar game node
	    	$similarGames = $platform->addChild('jeuxSimilaires');
	    	foreach ($platform['similarGame'] as $similarGameDB) {
	    		$tip = $tips->addChild('jeuSimilaire', $similarGameDB['LABELMEDIA']);

	    		$tip->addChild('libelleJeu', $similarGameDB['LABELMEDIA']);
	    		$tip->addChild('urlJeu', $similarGameDB['LABELMEDIA']);


	    	}

	    	$socialLinks = $game->addChild('socialLinks');
	    	foreach ($row['social'] as $socialDB) {
	    		$social = $socialLinks->addChild('socialLink');
	    		$social->setAttribute('type', $socialDB);
	    	}
	    		    	
	    }

	    // and next comming soon. Stay tuned.
	    
	    
	    // CDATA sections are slightly different
	    //$description = $games->createElement('description');
	    //$description->appendChild($games->createCDATASection($row['description']));
	    //$game->appendChild($description);
	    

	}

	// Set the appropriate content-type header and output the XML
	header('Content-type: application/xml');
	//echo $games->saveXML(); // asXML()
	$games->asXML();
}*/