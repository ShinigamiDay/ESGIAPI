<?php
require_once('../model/Log.php');
require_once('../model/GameManager.php');
require_once('../model/PlatformManager.php');

Class indexController Extends baseController {
	
    public function index() {
            $this->registry->template->welcome = 'Bienvenue';
            $this->registry->template->show('index');
    }
    
   /*
   public function index() {
   		// Connection to database
		$gameManager = new GameManager();
		$platformManager = new PlatformManager();
		$games = $gameManager->fetchAllGames();

		// Build Xml with all games.
		$this->videoGamesXML($games);
   }
	*/
   private function videoGamesXML($stmt) {

	// Racine Element XML
		$games = new SimpleXMLElement("<jeuxVideo></jeuxVideo>");

		// For each video games ...
		foreach ($stmt as $row) {
		// Get Data
		$idGame = $row['IDGAME'];
		
		// Create a node game
		    $game = $games->addChild('jeu');
	        $game->addAttribute('id', $row['IDGAME']);
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
}