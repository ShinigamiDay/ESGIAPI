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
		// 
		die();
	} else {
		 header('HTTP/1. 403 OK');	
	}
}

public function videoGamesXML($stmt) {

// Racine Element XML
	$games = $doc = new SimpleXMLElement("<jeuxVideo></jeuxVideo>");
	
	// For each video games ...
	foreach ($stmt as $row) {
	// Create a node game
	    $game = $doc->createElement('jeu');
	    // Add in game node title element
	    $game->appendChild($doc->createElement('titre', $row['title']));

	    // Companies element on game node
	    $companies = $doc->createElement('societes');
	    // For each company, create a node company with an attribute activite
	    foreach ($row['company'] as $companyDB) {
	    	$company = $doc->createElement('societe', $companyDB);
	    	//TODO: Activity.
	    	$company->setAttribute('activite', $companyDB['activity']);
	    	$companies->appendChild($company);
	    }
	    // Add companies in game node
	    $game->appendChild($companies);

		// Genres video games in game node
	    $genres = $doc->createElement('genres');
	    foreach ($row['genre'] as $genreDB) {
	    	$genres->appendChild($doc->createElement('genre', $genreDB));
	    }
	    // Add genres to node game
	    $game->appendChild($genres);
	    
	    // Links Node in game
	    $links = $doc->createElement('liens');
	    foreach ($row['link'] as $linkDB) {
	    	$link = $doc->createElement('lien', $linkDB);
	    	$link->setAttribute('type', $linkDB['type']);
	    	$links->appendChild($link);
	    }
	    // Add links to game node
	    $game->appendChild($links);

	    // Mode Game
	    $modesGames = $doc->createElement('modesJeu');
	    foreach ($row['modeGames'] as $modesDB) {
	    	$modesGames->appendChild($doc->createElement('modeJeu', $modesDB));
	    }
	    // Add mode game to game node
	    $game->appendChild($modesGames);

	    // Description node in game node
	    $game->appendChild($doc->createElement('description', $row['description'])); 

	    // Plateformes in game node
	    $platforms = $doc->createElement('plateformes');
	    foreach ($row['platforms'] as $platformDB) {
	    	// create platform
	    	$platform = $doc->createElement('plateforme');
	    	// set attribute "type" to platform
	    	$platform->setAttribute('type', $platformDB['type']);

	    // Create resume node to platform node
	    	$platform->appendChild($doc->createElement('resume', $platformDB['resume']));
	    // Create Release date node to platform node
	    	$platform->appendChild($doc->createElement('dateSortie', $platformDB['releaseDate']));
	    // Create node prices containes multiple price
	    	$prices = $doc->createElement('prix');
	    	foreach ($platformDB['prices'] as $priceDB) {
	    		$price = $doc->createElement('price', $priceDB['price']);
	    		$price->setAttribute('vendeur', $priceDB['seller']);
	    		$price->setAttribute('type', $priceDB['type']);
	    		$price->setAttribute('devise', $priceDB['currency']);

	    		// add price to prices node
	    		$prices->appendChild($price);
	    	}
	    	// add prices to platform node
	    	$platform->appendChild($price);

		// Create node notes containes multiple note
	    	$scores = $doc->createElement('notes');
	    	foreach ($platformDB['scores'] as $scoreDB) {
	    		$score = $doc->createElement('score', $scoreDB['score']);
	    		$score->setAttribute('source', $priceDB['source']);

	    		// add score to scores node
	    		$scores->appendChild($score);
	    	}
	    	// add scores to platform node
	    	$platform->appendChild($scores);

	    // Create pegi node
	    	$platform->appendChild($doc->createElement('pegi', $platformDB['pegi']));

	    // Create points node
	    	$points = $doc->createElement('points');
	    	foreach ($platformDB['points'] as $pointDB) {
	    		$point = $doc->createElement('point', $pointDB['point']);
	    		$point->setAttribute('type', $pointDB['type']);

	    		// add point to points node
	    		$points->appendChild($point);
	    	}
	    	// add points to platform node
	    	$platform->appendChild($points);	    	


	    	// add platform to platforms node
	    	$platforms->appendChild($platform);
	    }
	    // Add platforms to game node
	    $game->appendChild($platforms);

	    // and next comming soon. Stay tuned.
	    
	    /*
	    // CDATA sections are slightly different
	    $description = $doc->createElement('description');
	    $description->appendChild($doc->createCDATASection($row['description']));
	    $game->appendChild($description);
	    */

	    $games->appendChild($game);
	}

	$doc->appendChild($games);

	// Set the appropriate content-type header and output the XML
	header('Content-type: application/xml');
	echo $doc->saveXML(); // asXML()
}