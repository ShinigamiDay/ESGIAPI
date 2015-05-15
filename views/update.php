<?php
    require_once("../model/Log.php");

    $db = connection();

    //Identifiant du jeu
    $idGame = 1;

    $tabGame = array(
        'title' => 'Oui Oui au pays des jouets',
        'description' => 'Oui Oui est un personnage de dessin animé'
    );

    $_request = $db->prepare('    UPDATE GAME
                                  SET TITLE = :title_game,
                                  DESCRIPTION = :description_game ');

    $_request->bindValue(':title_game', $tabGame['title'], PDO::PARAM_STR);
    $_request->bindValue(':description_game', $tabGame['description'], PDO::PARAM_STR);

    $_request->execute();



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