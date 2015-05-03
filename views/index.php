<?php
require_once('../model/Log.php');
require_once('../model/GameManager.php');
require_once('../model/PlatformManager.php');

// Connection to database
$gameManager = new GameManager();
$games = $gameManager->fetchAllGames();

// Build Xml with all games.
videoGamesXML($games, $gameManager);
// Build JSON with all games.
videoGamesJSON($games, $gameManager);

function videoGamesXML($stmt, $gameManager) {

// Racine Element XML
	$games = new SimpleXMLElement("<jeuxVideo></jeuxVideo>");
	$platformManager = new PlatformManager();

	// For each video games ...
	foreach ($stmt as $row) {
	// Get Data
		$idGame = $row['IDGAME'];
	
	// Create a node game
	    $game = $games->addChild('jeu');
        $game->addAttribute('id', $idGame);
	    // Add in game node title element
	    $game->addChild('titre', $row['TITLE']);

	    // Companies database
		$companiesDB = $gameManager->fetchCompanies($idGame);
	    // Companies element on game node
	    $companies = $game->addChild('societes');
	    // For each company, create a node company with an attribute activite
	    foreach ($companiesDB as $companyDB) {
	    	$company = $companies->addChild('societe', $companyDB['NAMECOMPANY']);
	    	//TODO: Activity.
	    	$company->addAttribute('activite', $companyDB['ACTIVITYCOMPANY']);
	    }

	    // Genres database
		$genresDB = $gameManager->fetchGenres($idGame);
		// Genres video games in game node
	    $genres = $game->addChild('genres');
	    foreach ($genresDB as $genreDB) {
	    	$genres->addChild('genre', $genreDB['NAMETYPE']);
	    }
	    
	    // Links Database
		$linksDB = $gameManager->fetchLinks($idGame);
	    // Links Node in game
	    $links = $game->addChild('liens');
	    foreach ($linksDB as $linkDB) {
	    	$link = $links->addChild('lien', $linkDB['CONTENTLINK']);
	    	$link->addAttribute('type', $linkDB['NAMETYPELINK']);
	    }

	    // Modes database
		$modesDatabase = $gameManager->fetchModes($idGame);
	    // Mode Game
	    $modesGames = $game->addChild('modesJeu');
	    foreach ($modesDatabase as $modesDB) {
	    	$modesGames->addChild('modeJeu', $modesDB['NAMEGAMEMODE']);
	    }

	    // Description node in game node
	    $game->addChild('description', $row['DESCRIPTION']); 

	    // Platforms database
		$platformsDB = $gameManager->fetchPlatforms($idGame);
	    // Plateformes in game node
	    $platforms = $game->addChild('plateformes');
	    foreach ($platformsDB as $platformDB) {
	    	// Id platform.
	    	$idPlatform = $platformDB['IDPLATFORMGAME'];

	    	// create platform
	    	$platform = $platforms->addChild('plateforme');
	    	// set attribute "type" to platform
	    	$platform->addAttribute('type', $platformDB['NAMEPLATFORM']);

	    // Create resume node to platform node
	    	$platform->addChild('resume', $platformDB['DESCRIPTION']);
	    // Create Release date node to platform node
	    	$platform->addChild('dateSortie', $platformDB['EXIT_DATE']);

	    // Prices database
			$pricesDB = $platformManager->fetchPrices($idPlatform);
	    // Create node prices containes multiple price
	    	$prices = $platform->addChild('prices');

	    	foreach ($pricesDB as $priceDB) {
	    		$price = $prices->addChild('price', $priceDB['PRICE']);
	    		$price->addAttribute('vendeur', $priceDB['SELLER']);
	    		$price->addAttribute('type', $priceDB['TYPEMEDIA']);
	    		$price->addAttribute('devise', $priceDB['CURRENCY']);
	    	}

	    // Notes database
			$notesDB = $platformManager->fetchNotes($idPlatform);
		// Create node notes containes multiple note
	    	$scores = $platform->addChild('notes');
	    	foreach ($notesDB as $scoreDB) {
	    		$score = $scores->addChild('notation', $scoreDB['NOTE']);
	    		$score->addAttribute('source', $scoreDB['SOURCE']);
	    	}

	    // Create pegi node
	    	$platform->addChild('pegi', $platformDB['PEGI']);

	    // Points database
			$pointsDB = $platformManager->fetchPoints($idPlatform);
	    // Create points node
	    	$points = $platform->addChild('points');
	    	foreach ($pointsDB as $pointDB) {
	    		$point = $points->addChild('point', $pointDB['TYPEMEDIA']);
	    		$point->addAttribute('type', $pointDB['POINT']);
	    	}

	    // Medias database
			$mediasDB = $platformManager->fetchMedias($idPlatform);
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
			$commentsDB = $platformManager->fetchComments($idPlatform);
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
			$configsDB = $platformManager->fetchConfigurations($idPlatform);
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
			$langsDB = $platformManager->fetchLanguages($idPlatform);
	    // Create lang nodes
	    	$languages = $platform->addChild('langues');
            // Audios
            $audios = $languages->addChild('audios');
	    	foreach ($langsDB as $langDB) {
	    		$audios->addChild('audio', $langDB['LABELLANGUAGE']);
	    	}

	    	// Subtitles Database.
			$subtitlesDB = $platformManager->fetchSubtitles($idPlatform);
            // Subtitles
            $subtitles = $languages->addChild('sousTitres');
	    	foreach ($subtitlesDB as $subtitleDB) {
	    		$subtitles->addChild('sousTitre', $subtitleDB['LABELLANGUAGE']);
	    	}

	    	// Trick database
			$tricksDB = $platformManager->fetchTricks($idPlatform);
	    	// Tips node
	    	$tips = $platform->addChild('astuces');
	    	foreach ($tricksDB as $trickDB) {
	    		$tips->addChild('astuce', $trickDB['LABELMEDIA']);
	    	}

	    	// Similars database
			$similarsDB = $platformManager->fetchSimilarGames($idPlatform);
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
	//echo $games->saveXML(); // asXML()
	Header('Content-type: text/xml');
	echo $games->asXML();
}

// --------------------- JSON ------------------
function videoGamesJSON($stmt, $gameManager) {

// Racine Element XML
	$platformManager = new PlatformManager();
	
	// For each video games ...
	foreach ($stmt as $row) {
	// Get Data
		$idGame = $row['IDGAME'];
	
	// Create a node game
	    $game[] = [
	    	'id' => $idGame,
	    	'titre', $row['TITLE']
	    ];

	    // Companies database
		$companiesDB = $gameManager->fetchCompanies($idGame);
	    // For each company, create a node company with an attribute activite
	    $companiesArr = array();
	    foreach ($companiesDB as $companyDB) {
	    	$companiesArr[] = [
	    		'societe' => $companyDB['NAMECOMPANY'],
	    		'activite' => $companyDB['ACTIVITYCOMPANY']
	    	];
	    }

	    $companies = ['societes' => $companiesArr];
	    array_push($game, $companies);

	    // Genres database
		$genresDB = $gameManager->fetchGenres($idGame);
	    $genreArr = array();
	    foreach ($genresDB as $genreDB) {
	    	$genreArr[] = ['genre' => $genreDB['NAMETYPE']];
	    }
	    $genres = ['genres' => $genreArr];
	    array_push($game, $genres);
	    
	    // Links Database
		$linksDB = $gameManager->fetchLinks($idGame);
	    $linkArr = array();
	    foreach ($linksDB as $linkDB) {
	    	$linkArr[] = [
	    		'lien' => $linkDB['CONTENTLINK'],
	    		'type' => $linkDB['NAMETYPELINK']
	    	];
	    }
	    $links = ['liens' => $linkArr];
	    array_push($game, $links);

	    // Modes database
		$modesDatabase = $gameManager->fetchModes($idGame);
	    $modeArr = array();
	    foreach ($modesDatabase as $modesDB) {
	    	$modeArr[] = ['modeJeu' => $modesDB['NAMEGAMEMODE']];
	    }
	    $modes = ['modesJeu' => $modeArr];
	    array_push($game, $modes);

	    // Description node in game node
	    $game[] = ['description' => $row['DESCRIPTION']]; 

	    // Platforms database
		$platformsDB = $gameManager->fetchPlatforms($idGame);
		$platformArr = array();
	    // Plateformes in game node
	    foreach ($platformsDB as $platformDB) {
	    	// Id platform.
	    	$idPlatform = $platformDB['IDPLATFORMGAME'];

	    	$platformArr[] = [
	    		'type' => $platformDB['NAMEPLATFORM'],
	    		'resume' => $platformDB['DESCRIPTION'],
	    		'dateSortie' => $platformDB['EXIT_DATE']
	    	];

	    // Prices database
			$pricesDB = $platformManager->fetchPrices($idPlatform);
	    	$priceArr = array();
	    	foreach ($pricesDB as $priceDB) {
	    		$priceArr[] = [
		    		'price' =>
		    			[
		    				'price' => $priceDB['PRICE'],
			    			'vendeur' => $priceDB['SELLER'],
			    			'type' => $priceDB['TYPEMEDIA'],
			    			'devise' => $priceDB['CURRENCY']
		    			]
	    		];
	    	}
	    	$prices = ['prices' => $priceArr];
	    	array_push($platformArr, $prices);

	    // Notes database
			$notesDB = $platformManager->fetchNotes($idPlatform);
		// Create node notes containes multiple note
	    	$scoreArr = array();
	    	foreach ($notesDB as $scoreDB) {
	    		$scoreArr[] = [
		    		'notation' => $scoreDB['NOTE'],
			    	'source', $scoreDB['SOURCE']
	    		];
	    	}
	    	$notes = ['notes' => $scoreArr];
	    	array_push($platformArr, $notes);

	    // Create pegi node
	    	$platformArr[] = ['pegi' => $platformDB['PEGI']];

	    // Points database
			$pointsDB = $platformManager->fetchPoints($idPlatform);
	    // Create points node
	    	$pointArr = array();
	    	foreach ($pointsDB as $pointDB) {
	    		$pointArr[] = [
	    			'point' => $pointDB['TYPEMEDIA'],
	    			'type' => $pointDB['POINT']
	    		];
	    	}
	    	$points = ['points' => $pointArr];
	    	array_push($platformArr, $points);

	    // Medias database
			$mediasDB = $platformManager->fetchMedias($idPlatform);
	    // Create Medias nodes
	    	$mediaArr = array();
	    	foreach ($mediasDB as $mediaDB) {
	    		$mediaArr[] = [
	    			'type' => $mediaDB['TYPEMEDIA'],
	    			'cible' => $mediaDB['TARGETMEDIA'],
	    			'libelle' => $mediaDB['LABELMEDIA'],
	    			'url' => $mediaDB['URLMEDIA'],
	    			'alt' => $mediaDB['ALTMEDIA']
	    		];
	    	}
	    	$medias = ['medias' => $mediaArr];
	    	array_push($platformArr, $medias);

	    // Comments database
			$commentsDB = $platformManager->fetchComments($idPlatform);
	    // Create Comments nodes
	    	$commentArr = array();
	    	foreach ($commentsDB as $commentaireDB) {
	    		$commentArr[] = [
	    			'auteur' => $commentaireDB['AUTHOR'],
	    			'date' => $commentaireDB['DATE_COMMENT'],
					'note' => $commentaireDB['NOTE'],
					'contenu' => $commentaireDB['CONTENT']
	    		];
	    	}
	    	$commentaires = ['commentaires' => $commentArr];
	    	array_push($platformArr, $commentaires);

	    // Configurations database
			$configsDB = $platformManager->fetchConfigurations($idPlatform);
	    	$configArr = array();
	    	foreach ($configsDB as $configDB) {
	    		$configArr[] = [
	    			'type', $configDB['TYPE_CONFIG'],
	    			'systeme', $configDB['SYSTEM'],
					'ram', $configDB['RAM'],
					'disqueDur', $configDB['DISK'],
					'gpu', $configDB['GPU'],
					'connexion', $configDB['CONNECTIONCONFIG'],
					'directX', $configDB['DIRECTX']
	    		];
	    	}
	    	$config = ['configurationsPc' => $configArr];
	    	array_push($platformArr, $config);

	    // Languages database
			$langsDB = $platformManager->fetchLanguages($idPlatform);
	    // Create lang nodes
	    	$langArr = array();
            // Audios
            $audioArr = array();
	    	foreach ($langsDB as $langDB) {
	    		$audioArr[] = ['audio' => $langDB['LABELLANGUAGE']];
	    	}
	    	$audios = ['audios' => $audioArr];
	    	array_push($langArr, $audios);

	    	// Subtitles Database.
			$subtitlesDB = $platformManager->fetchSubtitles($idPlatform);
            // Subtitles
            $subtitleArr = array();
	    	foreach ($subtitlesDB as $subtitleDB) {
	    		$subtitleArr[] = ['sousTitre' => $subtitleDB['LABELLANGUAGE']];
	    	}
	    	$subtitles = ['sousTitres' => $subtitleArr];
	    	array_push($langArr, $subtitles);

	    	array_push($platformArr, ['langues' => $langArr]);

	    	// Trick database
			$tricksDB = $platformManager->fetchTricks($idPlatform);
	    	// Tips node
	    	$tipArr = array();
	    	foreach ($tricksDB as $trickDB) {
	    		$tipArr[] = ['astuce' => $trickDB['LABELMEDIA']];
	    	}
	    	$tips = ['astuces' => $tipArr];
	    	array_push($platformArr, $tips);

	    	// Similars database
			$similarsDB = $platformManager->fetchSimilarGames($idPlatform);
	    	$similarGamesArr = array();
	    	foreach ($similarsDB as $similarGameDB) {
                $similarGamesArr[] = [
                	'libelleJeu' => $similarGameDB['LABELMEDIA'],
					'urlJeu' => $similarGameDB['URLMEDIA']
                ];
	    	}
	    	$similarGames = ['jeuxSimilaires' => $similarGamesArr];
	    	array_push($platformArr, $similarGames);
	    		    	
	    } // End 

	    array_push($game, $platformArr);

	}

	$games = ["jeuxVideo" => $game];

	echo json_encode($games);
}