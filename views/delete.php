<?php
    require_once("../model/Log.php");

    $db = connection();

    //Identifiant du jeu
    $idGame = 1;

    //Suppression des références du jeu - HAVE_COMPANY
    $_requestCompany = $db->prepare('   DELETE FROM HAVE_COMPANY
                                        WHERE IDGAME = :idgame ');
    $_requestCompany->bindValue(':idgame', $idGame, PDO::PARAM_INT);
    $_requestCompany->execute();

    //Suppression des références du jeu - HAVE_GAMEMODE
    $_requestGameMode= $db->prepare('   DELETE FROM HAVE_GAMEMODE
                                        WHERE IDGAME = :idgame ');
    $_requestGameMode->bindValue(':idgame', $idGame, PDO::PARAM_INT);
    $_requestGameMode->execute();

    //Suppression des références du jeu - HAVE_LINK
    $_requestLink= $db->prepare('   DELETE FROM HAVE_LINK
                                    WHERE IDGAME = :idgame ');
    $_requestLink->bindValue(':idgame', $idGame, PDO::PARAM_INT);
    $_requestLink->execute();

    //Suppression des références du jeu - HAVE_TYPE
    $_requestType= $db->prepare('   DELETE FROM HAVE_TYPE
                                     WHERE IDGAME = :idgame ');
    $_requestType->bindValue(':idgame', $idGame, PDO::PARAM_INT);
    $_requestType->execute();

    /* On récupère toutes les IDPLATFORMGAME concernant notre jeu */
    $requestAllPlatFormGame = $db->query('SELECT IDPLATFORMGAME FROM PLATFORMGAME WHERE IDGAME = '.$idGame);
    $resultAllPlatFormGame = $requestAllPlatFormGame->fetchAll(PDO::FETCH_ASSOC);

    //Pour chaque IDPLATFORMGAME, on parcourt les tables et on supprime les références
    foreach ($resultAllPlatFormGame as $row) {
        //On récupère le idplatformgame
        $idPlatFormGame = $row['IDPLATFORMGAME'];

        //Suppression des références de la platforme - COMMENT
        $_requestComment= $db->prepare('   DELETE FROM COMMENT
                                            WHERE IDPLATFORMGAME = :idPlatFormGame ');
        $_requestComment->bindValue(':idPlatFormGame', $idPlatFormGame, PDO::PARAM_INT);
        $_requestComment->execute();

        //Suppression des références de la platforme - CONFIGURATION
        $_requestConfiguration= $db->prepare('   DELETE FROM CONFIGURATION
                                                  WHERE IDPLATFORMGAME = :idPlatFormGame ');
        $_requestConfiguration->bindValue(':idPlatFormGame', $idPlatFormGame, PDO::PARAM_INT);
        $_requestConfiguration->execute();

        //Suppression des références de la idPlatFormGame - HAVE_LANGUAGE
        $_requestHaveLanguage= $db->prepare('   DELETE FROM HAVE_LANGUAGE
                                                  WHERE IDPLATFORMGAME = :idPlatFormGame ');
        $_requestHaveLanguage->bindValue(':idPlatFormGame', $idPlatFormGame, PDO::PARAM_INT);
        $_requestHaveLanguage->execute();

        //Suppression des références de la platforme - HAVE_NOTE
        $_requestHaveNote= $db->prepare('   DELETE FROM HAVE_NOTE
                                                  WHERE IDPLATFORMGAME = :idPlatFormGame ');
        $_requestHaveNote->bindValue(':idPlatFormGame', $idPlatFormGame, PDO::PARAM_INT);
        $_requestHaveNote->execute();

        //Suppression des références de la platforme - HAVE_PRICE
        $_requestHavePrice= $db->prepare('   DELETE FROM HAVE_PRICE
                                                  WHERE IDPLATFORMGAME = :idPlatFormGame ');
        $_requestHavePrice->bindValue(':idPlatFormGame', $idPlatFormGame, PDO::PARAM_INT);
        $_requestHavePrice->execute();

        //Suppression des références de la platforme - HAVE_SIMILARGAME
        $_requestHaveSimilarGame= $db->prepare('   DELETE FROM HAVE_SIMILARGAME
                                                  WHERE IDPLATFORMGAME = :idPlatFormGame ');
        $_requestHaveSimilarGame->bindValue(':idPlatFormGame', $idPlatFormGame, PDO::PARAM_INT);
        $_requestHaveSimilarGame->execute();

        //Suppression des références de la platforme - HAVE_SUBTITLE
        $_requestHaveSubtitle= $db->prepare('   DELETE FROM HAVE_SUBTITLE
                                                  WHERE IDPLATFORMGAME = :idPlatFormGame ');
        $_requestHaveSubtitle->bindValue(':idPlatFormGame', $idPlatFormGame, PDO::PARAM_INT);
        $_requestHaveSubtitle->execute();

        //Suppression des références de la platforme - MEDIA
        $_requestMedia= $db->prepare('   DELETE FROM MEDIA
                                         WHERE IDPLATFORMGAME = :idPlatFormGame ');
        $_requestMedia->bindValue(':idPlatFormGame', $idPlatFormGame, PDO::PARAM_INT);
        $_requestMedia->execute();

        //Suppression des références de la platforme - POINT
        $_requestPoint= $db->prepare('   DELETE FROM POINT
                                          WHERE IDPLATFORMGAME = :idPlatFormGame ');
        $_requestPoint->bindValue(':idPlatFormGame', $idPlatFormGame, PDO::PARAM_INT);
        $_requestPoint->execute();

        //Suppression des références de la platforme - TRICK
        $_requestTrick= $db->prepare('   DELETE FROM TRICK
                                         WHERE IDPLATFORMGAME = :idPlatFormGame ');
        $_requestTrick->bindValue(':idPlatFormGame', $idPlatFormGame, PDO::PARAM_INT);
        $_requestTrick->execute();
    }

    //Suppression des références dans la table PLATFORMGAME
    $_requestPlatFormGame= $db->prepare('   DELETE FROM PLATFORMGAME
                                            WHERE IDGAME = :idgame ');
    $_requestPlatFormGame->bindValue(':idgame', $idGame, PDO::PARAM_INT);
    $_requestPlatFormGame->execute();

    //Suppression du jeu - GAME
    $_requestGameFinal= $db->prepare('   DELETE FROM GAME
                                        WHERE IDGAME = :idgame ');
    $_requestGameFinal->bindValue(':idgame', $idGame, PDO::PARAM_INT);
    $_requestGameFinal->execute();

/* Fonction pour se connecter à la BD */
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