<?php
    require_once("../model/Log.php");

    $db = connection();

    /* ------------------------- INSERTION DU JEU -------------------------------------- */
    $titleGame = "Watch Dogs";
    $descriptionGame = "Watch Dogs est un jeu d'action à la troisième personne sur PS4.
    Dans un univers moderne et ouvert où tout est connecté à un système de contrôle central appartenant à des sociétés privées,
    le joueur incarne un groupe de hackeurs et d'assassins capables de manipuler et de pirater les systèmes électroniques.";

    $_request = $db->prepare('   INSERT INTO GAME
                                        SET TITLE = :title_game,
                                        DESCRIPTION = :description_game ');

    $_request->bindValue(':title_game', $titleGame, PDO::PARAM_STR);
    $_request->bindValue(':description_game', $descriptionGame, PDO::PARAM_STR);

    $_request->execute();
    /* ------------------------------------------------------------------------------------- */

    /* ----------------- Récupération de l'identifiant DU JEU ------------------------------ */
    $requestID = $db->query('SELECT MAX(IDGAME) as "IDGAME" FROM GAME');
    $resultID = $requestID->fetch(PDO::FETCH_ASSOC);
    /* ------------------------------------------------------------------------------------- */

    /* ----------------- Insertion des compagnies ------------------------------ */
    $companyUbisoft = array(
        'NAMECOMPANY' => 'Ubisoft',
        'ACTIVITYCOMPANY' => 'Développeur'
    );

    $companyAtari = array(
        'NAMECOMPANY' => 'Atari',
        'ACTIVITYCOMPANY' => 'Editeur'
    );

    $requestCompany = $db->prepare('   INSERT INTO COMPANY (NAMECOMPANY,ACTIVITYCOMPANY)
                                              VALUES(:name_company1,:activity_company1),
                                                    (:name_company2,:activity_company2) ');

    $requestCompany->bindValue(':name_company1', $companyUbisoft['NAMECOMPANY'], PDO::PARAM_STR);
    $requestCompany->bindValue(':activity_company1', $companyUbisoft['ACTIVITYCOMPANY'], PDO::PARAM_STR);
    $requestCompany->bindValue(':name_company2', $companyAtari['NAMECOMPANY'], PDO::PARAM_STR);
    $requestCompany->bindValue(':activity_company2', $companyAtari['ACTIVITYCOMPANY'], PDO::PARAM_STR);

    $requestCompany->execute();
    /* -------------------------------------------------------------------------- */

    /* ----------------- Récupération des identifiants des compagnies ------------------------------ */
    $requestCompaniesID = $db->query('SELECT IDCOMPANY FROM COMPANY');
    $resultCompaniesID = $requestCompaniesID->fetchAll(PDO::FETCH_ASSOC);
    /* ------------------------------------------------------------------------------------- */

    /* ----------------- Insertion des platforms ------------------------------ */
    $platforms = array ('PS2', 'PS3', 'PS4', 'Xbox', 'Xbox 360', 'Wii', 'Wii U', 'Gameboy Color', 'DS', 'DS XXL', 'Mobile', 'PC', 'Sega', 'GameCube', 'Nintendo 64');

    $requestPlatforms = $db->prepare('   INSERT INTO PLATFORM (NAMEPLATFORM)
                                                VALUES(:platform1),
                                                (:platform2),
                                                (:platform3),
                                                (:platform4),
                                                (:platform5),
                                                (:platform6),
                                                (:platform7),
                                                (:platform8),
                                                (:platform9),
                                                (:platform10),
                                                (:platform11),
                                                (:platform12),
                                                (:platform13),
                                                (:platform14),
                                                (:platform15)');

    $requestPlatforms->bindValue(':platform1', $platforms[0], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform2', $platforms[1], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform3', $platforms[2], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform4', $platforms[3], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform5', $platforms[4], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform6', $platforms[5], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform7', $platforms[6], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform8', $platforms[7], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform9', $platforms[8], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform10', $platforms[9], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform11', $platforms[10], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform12', $platforms[11], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform13', $platforms[12], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform14', $platforms[13], PDO::PARAM_STR);
    $requestPlatforms->bindValue(':platform15', $platforms[14], PDO::PARAM_STR);

    $requestPlatforms->execute();
    /* ------------------------------------------------------------------------- */

    /* ----------------- Récupération des identifiants des platforms ----------------------- */
    $requestPlatformsID = $db->query('SELECT IDPLATFORM FROM PLATFORM');
    $resultPlatformsID = $requestPlatformsID->fetchAll(PDO::FETCH_ASSOC);
    /* ------------------------------------------------------------------------------------- */

    /* ----------------- Insertion des types de jeu ------------------------------ */
    $typesGame = array ('MOBA', 'RPG', 'Fantasy', 'FTS', 'FPS');

    $requestTypesGames = $db->prepare('   INSERT INTO TYPE (NAMETYPE)
                                                VALUES(:type1),
                                                (:type2),
                                                (:type3),
                                                (:type4),
                                                (:type5)');

    $requestTypesGames->bindValue(':type1', $typesGame[0], PDO::PARAM_STR);
    $requestTypesGames->bindValue(':type2', $typesGame[1], PDO::PARAM_STR);
    $requestTypesGames->bindValue(':type3', $typesGame[2], PDO::PARAM_STR);
    $requestTypesGames->bindValue(':type4', $typesGame[3], PDO::PARAM_STR);
    $requestTypesGames->bindValue(':type5', $typesGame[4], PDO::PARAM_STR);

    $requestTypesGames->execute();
    /* --------------------------------------------------------------------------- */

    /* ----------------- Récupération des identifiants des types ----------------------- */
    $requestTypesID = $db->query('SELECT IDTYPE FROM TYPE');
    $resultTypesID = $requestTypesID->fetchAll(PDO::FETCH_ASSOC);
    /* ------------------------------------------------------------------------------------- */

    /* ------------ Table HAVE COMPANY - Liaisons entre le jeu vidéo et les compagnies --------------- */
    $requestHaveCompany = $db->prepare('   INSERT INTO HAVE_COMPANY (IDCOMPANY,IDGAME)
                                                VALUES(:company1,:game1),
                                                (:company2,:game1)');

    $requestHaveCompany->bindValue(':game1', $resultID['IDGAME'], PDO::PARAM_INT);
    $requestHaveCompany->bindValue(':company2', $resultPlatformsID[0]['IDPLATFORM'], PDO::PARAM_INT);
    $requestHaveCompany->bindValue(':company1', $resultPlatformsID[1]['IDPLATFORM'], PDO::PARAM_INT);

    $requestHaveCompany->execute();
    /* ----------------------------------------------------------------------------------------------- */

    /* ------------ Table HAVE TYPE - Liaisons entre le jeu vidéo et les types --------------- */
    $requestHaveType = $db->prepare('   INSERT INTO HAVE_TYPE (IDTYPE,IDGAME)
                                                VALUES(:type1,:game1),
                                                (:type2,:game1),
                                                (:type3,:game1),
                                                (:type4,:game1)');

    $requestHaveType->bindValue(':game1', $resultID['IDGAME'], PDO::PARAM_INT);
    $requestHaveType->bindValue(':type1', $resultTypesID[0]['IDTYPE'], PDO::PARAM_INT);
    $requestHaveType->bindValue(':type2', $resultTypesID[1]['IDTYPE'], PDO::PARAM_INT);
    $requestHaveType->bindValue(':type3', $resultTypesID[2]['IDTYPE'], PDO::PARAM_INT);
    $requestHaveType->bindValue(':type4', $resultTypesID[3]['IDTYPE'], PDO::PARAM_INT);

    $requestHaveType->execute();
    /* --------------------------------------------------------------------------------------- */

    /* ----------------- Insertion des modes de jeu ------------------------------ */
    $modesGame = array ('Solo', 'Multijoueurs', 'Arcade', 'Simulation', 'Campagne');

    $requestModesGames = $db->prepare('   INSERT INTO MODE (NAMEGAMEMODE)
                                                VALUES(:mode1),
                                                (:mode2),
                                                (:mode3),
                                                (:mode4),
                                                (:mode5)');

    $requestModesGames->bindValue(':mode1', $modesGame[0], PDO::PARAM_STR);
    $requestModesGames->bindValue(':mode2', $modesGame[1], PDO::PARAM_STR);
    $requestModesGames->bindValue(':mode3', $modesGame[2], PDO::PARAM_STR);
    $requestModesGames->bindValue(':mode4', $modesGame[3], PDO::PARAM_STR);
    $requestModesGames->bindValue(':mode5', $modesGame[4], PDO::PARAM_STR);

    $requestModesGames->execute();
    /* --------------------------------------------------------------------------- */

    /* ----------------- Récupération des identifiants des modes ----------------------- */
    $requestModesID = $db->query('SELECT IDGAMEMODE FROM MODE');
    $resultModeID = $requestModesID->fetchAll(PDO::FETCH_ASSOC);
    /* ------------------------------------------------------------------------------------- */

    /* ------------ Table HAVE GAME MODE - Liaisons entre le jeu vidéo et les modes ---------- */
    $requestHaveGameMode = $db->prepare('   INSERT INTO HAVE_GAMEMODE (IDGAMEMODE,IDGAME)
                                                VALUES(:mode1,:game1),
                                                (:mode2,:game1),
                                                (:mode3,:game1),
                                                (:mode4,:game1)');

    $requestHaveGameMode->bindValue(':game1', $resultID['IDGAME'], PDO::PARAM_INT);
    $requestHaveGameMode->bindValue(':mode1', $resultModeID[0]['IDGAMEMODE'], PDO::PARAM_INT);
    $requestHaveGameMode->bindValue(':mode2', $resultModeID[1]['IDGAMEMODE'], PDO::PARAM_INT);
    $requestHaveGameMode->bindValue(':mode3', $resultModeID[2]['IDGAMEMODE'], PDO::PARAM_INT);
    $requestHaveGameMode->bindValue(':mode4', $resultModeID[3]['IDGAMEMODE'], PDO::PARAM_INT);

    $requestHaveGameMode->execute();
    /* --------------------------------------------------------------------------------------- */

    /* ------------ Table PLATFORMGAME - Liaisons entre le jeu vidéo et les supports ----------- */
    $listDescription = array('description1','description2','description3');
    $listDate = array('2012-02-23','2013-05-12','2014-11-13');
    $listPEGI = array('18','16','12');

    $requestPlatFormGame = $db->prepare('   INSERT INTO PLATFORMGAME (IDGAME,IDPLATFORM,DESCRIPTION,EXIT_DATE,PEGI)
                                                VALUES(:game1,:platform1,:description1,:date1,:pegi1),
                                                      (:game1,:platform2,:description2,:date2,:pegi2),
                                                      (:game1,:platform3,:description3,:date3,:pegi3)');

    $requestPlatFormGame->bindValue(':game1', $resultID['IDGAME'], PDO::PARAM_INT);
    $requestPlatFormGame->bindValue(':platform1', $resultPlatformsID[0]['IDPLATFORM'], PDO::PARAM_INT);
    $requestPlatFormGame->bindValue(':platform2', $resultPlatformsID[1]['IDPLATFORM'], PDO::PARAM_INT);
    $requestPlatFormGame->bindValue(':platform3', $resultPlatformsID[2]['IDPLATFORM'], PDO::PARAM_INT);
    $requestPlatFormGame->bindValue(':description1', $listDescription[0], PDO::PARAM_STR);
    $requestPlatFormGame->bindValue(':description2', $listDescription[1], PDO::PARAM_STR);
    $requestPlatFormGame->bindValue(':description3', $listDescription[2], PDO::PARAM_STR);
    $requestPlatFormGame->bindValue(':date1', $listDate[0], PDO::PARAM_STR);
    $requestPlatFormGame->bindValue(':date2', $listDate[1], PDO::PARAM_STR);
    $requestPlatFormGame->bindValue(':date3', $listDate[2], PDO::PARAM_STR);
    $requestPlatFormGame->bindValue(':pegi1', $listPEGI[0], PDO::PARAM_STR);
    $requestPlatFormGame->bindValue(':pegi2', $listPEGI[1], PDO::PARAM_STR);
    $requestPlatFormGame->bindValue(':pegi3', $listPEGI[2], PDO::PARAM_STR);

    $requestPlatFormGame->execute();
    /* ----------------------------------------------------------------------------------------- */

    /* ----------------- Récupération des IDPLATFORMGAME qui viennent d'être générés ----------------------- */
    $requestPlatFormGameID = $db->query('SELECT IDPLATFORMGAME FROM PLATFORMGAME');
    $resultPlatFormGameID = $requestPlatFormGameID->fetchAll(PDO::FETCH_ASSOC);
    /* ----------------------------------------------------------------------------------------------------- */

    /* ----------------------------- Insertion des types de liens ---------------------------- */
    $linksType = array ('Facebook', 'Twitter', 'Site officiel', 'Site non officiel', 'Blog');

    $requestLinksType = $db->prepare('   INSERT INTO TYPELINK (NAMETYPELINK)
                                                VALUES(:type1),
                                                (:type2),
                                                (:type3),
                                                (:type4),
                                                (:type5)');

    $requestLinksType->bindValue(':type1', $linksType[0], PDO::PARAM_STR);
    $requestLinksType->bindValue(':type2', $linksType[1], PDO::PARAM_STR);
    $requestLinksType->bindValue(':type3', $linksType[2], PDO::PARAM_STR);
    $requestLinksType->bindValue(':type4', $linksType[3], PDO::PARAM_STR);
    $requestLinksType->bindValue(':type5', $linksType[4], PDO::PARAM_STR);

    $requestLinksType->execute();
    /* --------------------------------------------------------------------------------------- */

    /* ----------------- Récupération des types de liens pour un jeu ----------------------- */
    $requestTypeLinkID = $db->query('SELECT IDTYPELINK FROM TYPELINK');
    $resultTypeLinkID = $requestTypeLinkID->fetchAll(PDO::FETCH_ASSOC);
    /* ------------------------------------------------------------------------------------- */

    /* ----------------------------- Insertion des liens pour un jeu ---------------------------- */
    $links = array ('www.facebook.com', 'www.twitter.com', 'www.siteofficiel.fr', 'www.sitenonofficiel.fr', 'www.blog.fr');

    $requestLinks = $db->prepare('   INSERT INTO LINK (IDTYPELINK,CONTENTLINK)
                                                    VALUES(:type1,:content1),
                                                    (:type2,:content2),
                                                    (:type3,:content3),
                                                    (:type4,:content4),
                                                    (:type5,:content5)');
    $requestLinks->bindValue(':type1', $resultTypeLinkID[0]['IDTYPELINK'], PDO::PARAM_STR);
    $requestLinks->bindValue(':type2', $resultTypeLinkID[1]['IDTYPELINK'], PDO::PARAM_STR);
    $requestLinks->bindValue(':type3', $resultTypeLinkID[2]['IDTYPELINK'], PDO::PARAM_STR);
    $requestLinks->bindValue(':type4', $resultTypeLinkID[3]['IDTYPELINK'], PDO::PARAM_STR);
    $requestLinks->bindValue(':type5', $resultTypeLinkID[4]['IDTYPELINK'], PDO::PARAM_STR);
    $requestLinks->bindValue(':content1', $links[0], PDO::PARAM_STR);
    $requestLinks->bindValue(':content2', $links[1], PDO::PARAM_STR);
    $requestLinks->bindValue(':content3', $links[2], PDO::PARAM_STR);
    $requestLinks->bindValue(':content4', $links[3], PDO::PARAM_STR);
    $requestLinks->bindValue(':content5', $links[4], PDO::PARAM_STR);

    $requestLinks->execute();
    /* ------------------------------------------------------------------------------------------ */

    /* ----------------- Récupération des liens pour un jeu ----------------------- */
    $requestLinkID = $db->query('SELECT IDLINK FROM LINK');
    $resultLinkID = $requestLinkID->fetchAll(PDO::FETCH_ASSOC);
    /* ---------------------------------------------------------------------------- */

    /* ------------ Table HAVE_LINK - Liaisons entre le jeu vidéo et les liens ----------- */
    $requestHaveLink = $db->prepare('   INSERT INTO HAVE_LINK (IDLINK,IDGAME)
                                                    VALUES(:link1,:game1),
                                                    (:link2,:game1),
                                                    (:link3,:game1),
                                                    (:link4,:game1)');

    $requestHaveLink->bindValue(':game1', $resultID['IDGAME'], PDO::PARAM_INT);
    $requestHaveLink->bindValue(':link1', $resultLinkID[0]['IDLINK'], PDO::PARAM_INT);
    $requestHaveLink->bindValue(':link2', $resultLinkID[1]['IDLINK'], PDO::PARAM_INT);
    $requestHaveLink->bindValue(':link3', $resultLinkID[2]['IDLINK'], PDO::PARAM_INT);
    $requestHaveLink->bindValue(':link4', $resultLinkID[3]['IDLINK'], PDO::PARAM_INT);

    $requestHaveLink->execute();
    /* -------------------------------------------------------------------------------------- */

    /* ----------------------------- Insertion des notes ---------------------------- */
    $notes = array('www.jeuxvideos.com','www.gamekult.com');

    $requestNotes = $db->prepare('   INSERT INTO NOTE (SOURCE)
                                                    VALUES(:source1),
                                                    (:source2)');

    $requestNotes->bindValue(':source1', $notes[0], PDO::PARAM_STR);
    $requestNotes->bindValue(':source2', $notes[1], PDO::PARAM_STR);

    $requestNotes->execute();
    /* ------------------------------------------------------------------------------ */

    /* --------------- Récupération des personnes qui notent les jeux ------------------ */
    $requestNoteID = $db->query('SELECT IDNOTE FROM NOTE');
    $resultNoteID = $requestNoteID->fetchAll(PDO::FETCH_ASSOC);
    /* --------------------------------------------------------------------------------- */

    /* ------------ Table HAVE_NOTE - Liaisons entre le IDPLATFORM et les notes ----------- */
    $listNotes = array('15.0','16.5','14.5','15.5');

    $requestHaveNote = $db->prepare('   INSERT INTO HAVE_NOTE (IDNOTE,IDPLATFORMGAME,NOTE)
                                                        VALUES(:idnote1,:platformgame1,:n1),
                                                        (:idnote2,:platformgame2,:n2),
                                                        (:idnote3,:platformgame3,:n3),
                                                        (:idnote4,:platformgame3,:n4)');

    $requestHaveNote->bindValue(':n1', $listNotes[0], PDO::PARAM_STR);
    $requestHaveNote->bindValue(':n2', $listNotes[1], PDO::PARAM_STR);
    $requestHaveNote->bindValue(':n3', $listNotes[2], PDO::PARAM_STR);
    $requestHaveNote->bindValue(':n4', $listNotes[3], PDO::PARAM_STR);
    $requestHaveNote->bindValue(':idnote1', $resultNoteID[0]['IDNOTE'], PDO::PARAM_INT);
    $requestHaveNote->bindValue(':idnote2', $resultNoteID[1]['IDNOTE'], PDO::PARAM_INT);
    $requestHaveNote->bindValue(':idnote3', $resultNoteID[0]['IDNOTE'], PDO::PARAM_INT);
    $requestHaveNote->bindValue(':idnote4', $resultNoteID[1]['IDNOTE'], PDO::PARAM_INT);
    $requestHaveNote->bindValue(':platformgame1', $resultPlatFormGameID[0]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestHaveNote->bindValue(':platformgame2', $resultPlatFormGameID[1]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestHaveNote->bindValue(':platformgame3', $resultPlatFormGameID[2]['IDPLATFORMGAME'], PDO::PARAM_INT);

    $requestHaveNote->execute();
    /* ------------------------------------------------------------------------------------ */

    /* ----------------------------- Insertion des points positifs et négatifs ---------------------------- */
    $avis = array('positif','negatif');
    $points = array('Gratuit','Multijoueurs','Facile à prendre ne main','Options payantes','Accès uniquement en ligne');

    $requestPoints = $db->prepare('   INSERT INTO POINT (IDPLATFORMGAME,TYPEMEDIA,POINT)
                                                            VALUES(:platformgame1,:point1,:avis1),
                                                            (:platformgame2,:point2,:avis2),
                                                            (:platformgame3,:point3,:avis1),
                                                            (:platformgame1,:point2,:avis2),
                                                            (:platformgame2,:point4,:avis1),
                                                            (:platformgame3,:point1,:avis2),
                                                            (:platformgame1,:point5,:avis2)');
    $requestPoints->bindValue(':platformgame1', $resultPlatFormGameID[0]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestPoints->bindValue(':platformgame2', $resultPlatFormGameID[1]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestPoints->bindValue(':platformgame3', $resultPlatFormGameID[2]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestPoints->bindValue(':point1', $points[0], PDO::PARAM_STR);
    $requestPoints->bindValue(':point2', $points[1], PDO::PARAM_STR);
    $requestPoints->bindValue(':point3', $points[2], PDO::PARAM_STR);
    $requestPoints->bindValue(':point4', $points[3], PDO::PARAM_STR);
    $requestPoints->bindValue(':point5', $points[4], PDO::PARAM_STR);
    $requestPoints->bindValue(':avis1', $avis[0], PDO::PARAM_STR);
    $requestPoints->bindValue(':avis2', $avis[1], PDO::PARAM_STR);

    $requestPoints->execute();
    /* ---------------------------------------------------------------------------------------------------- */

    /* ----------------------------- Insertion des médias ---------------------------- */
    $media1 = array(
        'TYPEMEDIA' => 'image',
        'TARGETMEDIA' => 'cover',
        'LABELMEDIA' => 'Couverture',
        'URLMEDIA' => 'https://www.google.fr',
        'ALTMEDIA' => 'imageDuMedia1'
    );

    $media2 = array(
        'TYPEMEDIA' => 'video',
        'TARGETMEDIA' => 'cover',
        'LABELMEDIA' => 'Couverture',
        'URLMEDIA' => 'https://www.media.com',
        'ALTMEDIA' => 'videoDuMedia2'
    );

    $requestMedia = $db->prepare('   INSERT INTO MEDIA (IDPLATFORMGAME,TYPEMEDIA,TARGETMEDIA,LABELMEDIA,URLMEDIA,ALTMEDIA)
                                                                VALUES(:platformgame1,:typemedia1,:targetmedia1,:labelmedia1,:urlmedia1,:altmedia1),
                                                                (:platformgame2,:typemedia2,:targetmedia2,:labelmedia2,:urlmedia2,:altmedia2)');
    $requestMedia->bindValue(':platformgame1', $resultPlatFormGameID[0]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestMedia->bindValue(':platformgame2', $resultPlatFormGameID[1]['IDPLATFORMGAME'], PDO::PARAM_INT);

    $requestMedia->bindValue(':typemedia1', $media1['TYPEMEDIA'], PDO::PARAM_STR);
    $requestMedia->bindValue(':targetmedia1', $media1['TARGETMEDIA'], PDO::PARAM_STR);
    $requestMedia->bindValue(':labelmedia1', $media1['LABELMEDIA'], PDO::PARAM_STR);
    $requestMedia->bindValue(':urlmedia1', $media1['URLMEDIA'], PDO::PARAM_STR);
    $requestMedia->bindValue(':altmedia1', $media1['ALTMEDIA'], PDO::PARAM_STR);

    $requestMedia->bindValue(':typemedia2', $media2['TYPEMEDIA'], PDO::PARAM_STR);
    $requestMedia->bindValue(':targetmedia2', $media2['TARGETMEDIA'], PDO::PARAM_STR);
    $requestMedia->bindValue(':labelmedia2', $media2['LABELMEDIA'], PDO::PARAM_STR);
    $requestMedia->bindValue(':urlmedia2', $media2['URLMEDIA'], PDO::PARAM_STR);
    $requestMedia->bindValue(':altmedia2', $media2['ALTMEDIA'], PDO::PARAM_STR);

    $requestMedia->execute();
    /* ---------------------------------------------------------------------------------------------------- */

    /* ----------------------------- Insertion des commentaires ---------------------------- */
    $comment1 = array(
        'AUTHOR' => 'nicolas',
        'NOTE' => '15.5',
        'CONTENT' => 'c\'est plutôt bien réussi !',
        'DATE_COMMENT' => '2015-03-01'
    );

    $comment2 = array(
        'AUTHOR' => 'fabio',
        'NOTE' => '11',
        'CONTENT' => 'Javament pas terrible',
        'DATE_COMMENT' => '2015-03-02'
    );

    $comment3 = array(
        'AUTHOR' => 'baway',
        'NOTE' => '14',
        'CONTENT' => 'Nice baway !',
        'DATE_COMMENT' => '2015-04-03'
    );

    $comment4 = array(
        'AUTHOR' => 'haithem',
        'NOTE' => '5.5',
        'CONTENT' => 'Nul, archi nul ...',
        'DATE_COMMENT' => '2015-05-04'
    );

    $comment5 = array(
        'AUTHOR' => 'equipe',
        'NOTE' => '12',
        'CONTENT' => 'on s\'attendait à mieux',
        'DATE_COMMENT' => '2015-06-10'
    );

    $requestComment = $db->prepare('   INSERT INTO COMMENT (IDPLATFORMGAME,AUTHOR,NOTE,CONTENT,DATE_COMMENT)
                                        VALUES(:platformgame1,:author1,:note1,:content1,:datecomment1),
                                        (:platformgame2,:author2,:note2,:content2,:datecomment2),
                                        (:platformgame3,:author3,:note3,:content3,:datecomment3),
                                        (:platformgame1,:author4,:note4,:content4,:datecomment4),
                                        (:platformgame2,:author5,:note5,:content5,:datecomment5)');
    $requestComment->bindValue(':platformgame1', $resultPlatFormGameID[0]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestComment->bindValue(':platformgame2', $resultPlatFormGameID[1]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestComment->bindValue(':platformgame3', $resultPlatFormGameID[2]['IDPLATFORMGAME'], PDO::PARAM_INT);

    $requestComment->bindValue(':author1', $comment1['AUTHOR'], PDO::PARAM_STR);
    $requestComment->bindValue(':note1', $comment1['NOTE'], PDO::PARAM_STR);
    $requestComment->bindValue(':content1', $comment1['CONTENT'], PDO::PARAM_STR);
    $requestComment->bindValue(':datecomment1', $comment1['DATE_COMMENT'], PDO::PARAM_STR);

    $requestComment->bindValue(':author2', $comment2['AUTHOR'], PDO::PARAM_STR);
    $requestComment->bindValue(':note2', $comment2['NOTE'], PDO::PARAM_STR);
    $requestComment->bindValue(':content2', $comment2['CONTENT'], PDO::PARAM_STR);
    $requestComment->bindValue(':datecomment2', $comment2['DATE_COMMENT'], PDO::PARAM_STR);

    $requestComment->bindValue(':author3', $comment3['AUTHOR'], PDO::PARAM_STR);
    $requestComment->bindValue(':note3', $comment3['NOTE'], PDO::PARAM_STR);
    $requestComment->bindValue(':content3', $comment3['CONTENT'], PDO::PARAM_STR);
    $requestComment->bindValue(':datecomment3', $comment3['DATE_COMMENT'], PDO::PARAM_STR);

    $requestComment->bindValue(':author4', $comment4['AUTHOR'], PDO::PARAM_STR);
    $requestComment->bindValue(':note4', $comment4['NOTE'], PDO::PARAM_STR);
    $requestComment->bindValue(':content4', $comment4['CONTENT'], PDO::PARAM_STR);
    $requestComment->bindValue(':datecomment4', $comment4['DATE_COMMENT'], PDO::PARAM_STR);

    $requestComment->bindValue(':author5', $comment5['AUTHOR'], PDO::PARAM_STR);
    $requestComment->bindValue(':note5', $comment5['NOTE'], PDO::PARAM_STR);
    $requestComment->bindValue(':content5', $comment5['CONTENT'], PDO::PARAM_STR);
    $requestComment->bindValue(':datecomment5', $comment5['DATE_COMMENT'], PDO::PARAM_STR);


    $requestComment->execute();
    /* ---------------------------------------------------------------------------------------------------- */

    /* ----------------------------- Insertion des configurations ---------------------------- */
    $configuration1 = array(
        'SYSTEM' => 'Windows 7',
        'RAM' => '4GO',
        'DISK' => '512MO',
        'GPU' => 'GeForce GTX 980',
        'CONNECTIONCONFIG' => 'Configuration1',
        'DIRECTX' => '10',
        'TYPE_CONFIG' => 'Minimum'
    );

    $configuration2 = array(
        'SYSTEM' => 'Windows 8',
        'RAM' => '8GO',
        'DISK' => '1TO',
        'GPU' => 'Quadro K6000',
        'CONNECTIONCONFIG' => 'Configuration2',
        'DIRECTX' => '11',
        'TYPE_CONFIG' => 'Conseillé'
    );

    $requestConfiguration = $db->prepare('   INSERT INTO CONFIGURATION (IDPLATFORMGAME,SYSTEM,RAM,DISK,GPU,CONNECTIONCONFIG,DIRECTX,TYPE_CONFIG)
                                            VALUES(:platformgame1,:system1,:ram1,:disk1,:gpu1,:connectionconfig1,:direct1,:type1),
                                                  (:platformgame2,:system2,:ram2,:disk2,:gpu2,:connectionconfig2,:direct2,:type2)');

    $requestConfiguration->bindValue(':platformgame1', $resultPlatFormGameID[0]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestConfiguration->bindValue(':platformgame2', $resultPlatFormGameID[1]['IDPLATFORMGAME'], PDO::PARAM_INT);

    $requestConfiguration->bindValue(':system1', $configuration1['SYSTEM'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':ram1', $configuration1['RAM'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':disk1', $configuration1['DISK'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':gpu1', $configuration1['GPU'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':connectionconfig1', $configuration1['CONNECTIONCONFIG'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':direct1', $configuration1['DIRECTX'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':type1', $configuration1['TYPE_CONFIG'], PDO::PARAM_STR);

    $requestConfiguration->bindValue(':system2', $configuration2['SYSTEM'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':ram2', $configuration2['RAM'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':gpu2', $configuration2['GPU'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':disk2', $configuration2['DISK'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':connectionconfig2', $configuration2['CONNECTIONCONFIG'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':direct2', $configuration2['DIRECTX'], PDO::PARAM_STR);
    $requestConfiguration->bindValue(':type2', $configuration2['TYPE_CONFIG'], PDO::PARAM_STR);

    $requestConfiguration->execute();
    /* --------------------------------------------------------------------------------------- */

    /* ----------------------------- Insertion des jeux similaires  ---------------------------- */
    $listGames = array('GTA III','League of legends','Counter Strike');
    $listURLS = array('www.gtaIII.fr','www.leagueoflegends.com','www.cs.fr');

    $requestSimilarGame = $db->prepare('   INSERT INTO SIMILARGAME (LABELMEDIA,URLMEDIA)
                                            VALUES(:labelmedia1,:urlmedia1),
                                            (:labelmedia2,:urlmedia2),
                                            (:labelmedia3,:urlmedia3)');

    $requestSimilarGame->bindValue(':labelmedia1', $listGames[0], PDO::PARAM_STR);
    $requestSimilarGame->bindValue(':labelmedia2', $listGames[1], PDO::PARAM_STR);
    $requestSimilarGame->bindValue(':labelmedia3', $listGames[2], PDO::PARAM_STR);
    $requestSimilarGame->bindValue(':urlmedia1', $listURLS[0], PDO::PARAM_STR);
    $requestSimilarGame->bindValue(':urlmedia2', $listURLS[1], PDO::PARAM_STR);
    $requestSimilarGame->bindValue(':urlmedia3', $listURLS[2], PDO::PARAM_STR);

    $requestSimilarGame->execute();
    /* ----------------------------------------------------------------------------------------- */

    /* --------------- Récupération des identifiants des jeux similaires ------------------ */
    $requestSimilarGameID = $db->query('SELECT IDSIMILARGAME FROM SIMILARGAME');
    $resultSimilarGameID = $requestSimilarGameID->fetchAll(PDO::FETCH_ASSOC);
    /* ------------------------------------------------------------------------------------ */

    /* ------------ Table HAVE_SIMILARGAME - Liaisons entre le IDPLATFORM et les jeux similaires ----------- */
    $requestHaveSimilarGame = $db->prepare('   INSERT INTO HAVE_SIMILARGAME (IDSIMILARGAME,IDPLATFORMGAME)
                                                            VALUES(:idsimilar1,:platformgame1),
                                                            (:idsimilar2,:platformgame2),
                                                            (:idsimilar1,:platformgame3)');

    $requestHaveSimilarGame->bindValue(':idsimilar1', $resultSimilarGameID[0]['IDSIMILARGAME'], PDO::PARAM_INT);
    $requestHaveSimilarGame->bindValue(':idsimilar2', $resultSimilarGameID[1]['IDSIMILARGAME'], PDO::PARAM_INT);
    $requestHaveSimilarGame->bindValue(':idsimilar3', $resultSimilarGameID[2]['IDSIMILARGAME'], PDO::PARAM_INT);
    $requestHaveSimilarGame->bindValue(':platformgame1', $resultPlatFormGameID[0]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestHaveSimilarGame->bindValue(':platformgame2', $resultPlatFormGameID[1]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestHaveSimilarGame->bindValue(':platformgame3', $resultPlatFormGameID[2]['IDPLATFORMGAME'], PDO::PARAM_INT);

    $requestHaveSimilarGame->execute();
    /* ------------------------------------------------------------------------------------ */

    /* ----------------------------- Insertion des langues ---------------------------------- */
    $languages = array('Francais','Anglais','Chinois','Russe','Vietnamien');

    $requestLanguages = $db->prepare('   INSERT INTO LANGUAGE (LABELLANGUAGE)
                                                                VALUES(:language1),
                                                                        (:language2),
                                                                        (:language3),
                                                                        (:language4),
                                                                        (:language5)');

    $requestLanguages->bindValue(':language1', $languages[0], PDO::PARAM_STR);
    $requestLanguages->bindValue(':language2', $languages[1], PDO::PARAM_STR);
    $requestLanguages->bindValue(':language3', $languages[2], PDO::PARAM_STR);
    $requestLanguages->bindValue(':language4', $languages[3], PDO::PARAM_STR);
    $requestLanguages->bindValue(':language5', $languages[4], PDO::PARAM_STR);

    $requestLanguages->execute();
    /* -------------------------------------------------------------------------------------- */

    /* --------------- Récupération des langues ------------------ */
    $requestLanguagesID = $db->query('SELECT LABELLANGUAGE FROM LANGUAGE');
    $resultLanguagesID = $requestLanguagesID->fetchAll(PDO::FETCH_ASSOC);
    /* ----------------------------------------------------------- */

    /* ------------ Table HAVE_SUBTITLE - Liaisons entre les sous titres et le jeu ----------- */
    $requestHaveSubtitle = $db->prepare('   INSERT INTO HAVE_SUBTITLE (LABELLANGUAGE,IDPLATFORMGAME)
                                                                VALUES(:language1,:platformgame1),
                                                                      (:language2,:platformgame1),
                                                                      (:language4,:platformgame1),
                                                                      (:language5,:platformgame1),
                                                                      (:language1,:platformgame2),
                                                                      (:language2,:platformgame2),
                                                                      (:language1,:platformgame3),
                                                                      (:language3,:platformgame3),
                                                                      (:language5,:platformgame3)');

    $requestHaveSubtitle->bindValue(':language1', $resultLanguagesID[0]['LABELLANGUAGE'], PDO::PARAM_STR);
    $requestHaveSubtitle->bindValue(':language2', $resultLanguagesID[1]['LABELLANGUAGE'], PDO::PARAM_STR);
    $requestHaveSubtitle->bindValue(':language3', $resultLanguagesID[2]['LABELLANGUAGE'], PDO::PARAM_STR);
    $requestHaveSubtitle->bindValue(':language4', $resultLanguagesID[3]['LABELLANGUAGE'], PDO::PARAM_STR);
    $requestHaveSubtitle->bindValue(':language5', $resultLanguagesID[4]['LABELLANGUAGE'], PDO::PARAM_STR);
    $requestHaveSubtitle->bindValue(':platformgame1', $resultPlatFormGameID[0]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestHaveSubtitle->bindValue(':platformgame2', $resultPlatFormGameID[1]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestHaveSubtitle->bindValue(':platformgame3', $resultPlatFormGameID[2]['IDPLATFORMGAME'], PDO::PARAM_INT);

    $requestHaveSubtitle->execute();
    /* ------------------------------------------------------------------------------------ */

    /* ------------ Table HAVE_LANGUAGE - Liaisons entre les langues audio et le jeu ----------- */
    $requestHaveLanguage = $db->prepare('   INSERT INTO HAVE_LANGUAGE (LABELLANGUAGE,IDPLATFORMGAME)
                                                                    VALUES(:language1,:platformgame1),
                                                                          (:language2,:platformgame1),
                                                                          (:language4,:platformgame1),
                                                                          (:language5,:platformgame1),
                                                                          (:language1,:platformgame2),
                                                                          (:language2,:platformgame2),
                                                                          (:language1,:platformgame3),
                                                                          (:language3,:platformgame3),
                                                                          (:language5,:platformgame3)');

    $requestHaveLanguage->bindValue(':language1', $resultLanguagesID[0]['LABELLANGUAGE'], PDO::PARAM_STR);
    $requestHaveLanguage->bindValue(':language2', $resultLanguagesID[1]['LABELLANGUAGE'], PDO::PARAM_STR);
    $requestHaveLanguage->bindValue(':language3', $resultLanguagesID[2]['LABELLANGUAGE'], PDO::PARAM_STR);
    $requestHaveLanguage->bindValue(':language4', $resultLanguagesID[3]['LABELLANGUAGE'], PDO::PARAM_STR);
    $requestHaveLanguage->bindValue(':language5', $resultLanguagesID[4]['LABELLANGUAGE'], PDO::PARAM_STR);
    $requestHaveLanguage->bindValue(':platformgame1', $resultPlatFormGameID[0]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestHaveLanguage->bindValue(':platformgame2', $resultPlatFormGameID[1]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestHaveLanguage->bindValue(':platformgame3', $resultPlatFormGameID[2]['IDPLATFORMGAME'], PDO::PARAM_INT);

    $requestHaveLanguage->execute();
    /* ------------------------------------------------------------------------------------ */

    /* ----------------------------- Insertion des vendeurs ---------------------------------- */
    $sellers = array('nicolas','clement','fabio','guillaume','haithem');
    $stateGame = array('neuf','occasion');

    $requestSellers = $db->prepare('   INSERT INTO SELLER (SELLER,TYPEMEDIA)
                                                                    VALUES(:seller1,:state1),
                                                                            (:seller2,:state2),
                                                                            (:seller3,:state1),
                                                                            (:seller4,:state2),
                                                                            (:seller5,:state1)');

    $requestSellers->bindValue(':state1', $stateGame[0], PDO::PARAM_STR);
    $requestSellers->bindValue(':state2', $stateGame[1], PDO::PARAM_STR);
    $requestSellers->bindValue(':seller1', $sellers[0], PDO::PARAM_STR);
    $requestSellers->bindValue(':seller2', $sellers[1], PDO::PARAM_STR);
    $requestSellers->bindValue(':seller3', $sellers[2], PDO::PARAM_STR);
    $requestSellers->bindValue(':seller4', $sellers[3], PDO::PARAM_STR);
    $requestSellers->bindValue(':seller5', $sellers[4], PDO::PARAM_STR);

    $requestSellers->execute();
    /* -------------------------------------------------------------------------------------- */

    /* --------------- Récupération des identifiants des sellers ------------------ */
    $requestSellerID = $db->query('SELECT IDPRICE FROM SELLER');
    $resultSellerID = $requestSellerID->fetchAll(PDO::FETCH_ASSOC);
    /* ----------------------------------------------------------- */

    /* ------------ Table HAVE_PRICE - Liaisons entre les vendeurs et le PLATFORMGAMEID ----------- */
    $listPrices = array('20','30','40','50','60');
    $tabCurrency = array('euros','dollars','livres');

    $requestHavePrice = $db->prepare('   INSERT INTO HAVE_PRICE (IDPRICE,IDPLATFORMGAME,PRICE,CURRENCY)
                                                                        VALUES(:idprice1,:platformgame1,:price1,:currency1),
                                                                              (:idprice2,:platformgame1,:price2,:currency1),
                                                                              (:idprice4,:platformgame1,:price4,:currency1),
                                                                              (:idprice5,:platformgame1,:price5,:currency1),
                                                                              (:idprice1,:platformgame2,:price1,:currency2),
                                                                              (:idprice2,:platformgame2,:price2,:currency2),
                                                                              (:idprice1,:platformgame3,:price1,:currency3),
                                                                              (:idprice3,:platformgame3,:price3,:currency3),
                                                                              (:idprice5,:platformgame3,:price5,:currency3) ');

    $requestHavePrice->bindValue(':idprice1', $resultSellerID[0]['IDPRICE'], PDO::PARAM_INT);
    $requestHavePrice->bindValue(':idprice2', $resultSellerID[1]['IDPRICE'], PDO::PARAM_INT);
    $requestHavePrice->bindValue(':idprice3', $resultSellerID[2]['IDPRICE'], PDO::PARAM_INT);
    $requestHavePrice->bindValue(':idprice4', $resultSellerID[3]['IDPRICE'], PDO::PARAM_INT);
    $requestHavePrice->bindValue(':idprice5', $resultSellerID[4]['IDPRICE'], PDO::PARAM_INT);
    $requestHavePrice->bindValue(':platformgame1', $resultPlatFormGameID[0]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestHavePrice->bindValue(':platformgame2', $resultPlatFormGameID[1]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestHavePrice->bindValue(':platformgame3', $resultPlatFormGameID[2]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestHavePrice->bindValue(':price1', $listPrices[0], PDO::PARAM_STR);
    $requestHavePrice->bindValue(':price2', $listPrices[1], PDO::PARAM_STR);
    $requestHavePrice->bindValue(':price3', $listPrices[2], PDO::PARAM_STR);
    $requestHavePrice->bindValue(':price4', $listPrices[3], PDO::PARAM_STR);
    $requestHavePrice->bindValue(':price5', $listPrices[4], PDO::PARAM_STR);
    $requestHavePrice->bindValue(':currency1', $tabCurrency[0], PDO::PARAM_STR);
    $requestHavePrice->bindValue(':currency2', $tabCurrency[1], PDO::PARAM_STR);
    $requestHavePrice->bindValue(':currency3', $tabCurrency[2], PDO::PARAM_STR);

    $requestHavePrice->execute();
    /* ------------------------------------------------------------------------------------ */

    /* ------------ Table Tricks - Liaisons entre les astuces et le PLATFORMGAMEID ----------- */
    $tabTricks = array('astuce1','astuce2','astuce3','astuce4','astuce5','astuce6');

    $requestTricks = $db->prepare('   INSERT INTO TRICK (IDPLATFORMGAME, LABELMEDIA)
                                    VALUES(:platformgame1,:trick1),
                                          (:platformgame1,:trick2),
                                          (:platformgame2,:trick3),
                                          (:platformgame2,:trick4),
                                          (:platformgame3,:trick5),
                                          (:platformgame3,:trick6)');

    $requestTricks->bindValue(':trick1', $tabTricks[0], PDO::PARAM_STR);
    $requestTricks->bindValue(':trick2', $tabTricks[1], PDO::PARAM_STR);
    $requestTricks->bindValue(':trick3', $tabTricks[2], PDO::PARAM_STR);
    $requestTricks->bindValue(':trick4', $tabTricks[3], PDO::PARAM_STR);
    $requestTricks->bindValue(':trick5', $tabTricks[4], PDO::PARAM_STR);
    $requestTricks->bindValue(':trick6', $tabTricks[5], PDO::PARAM_STR);
    $requestTricks->bindValue(':platformgame1', $resultPlatFormGameID[0]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestTricks->bindValue(':platformgame2', $resultPlatFormGameID[1]['IDPLATFORMGAME'], PDO::PARAM_INT);
    $requestTricks->bindValue(':platformgame3', $resultPlatFormGameID[2]['IDPLATFORMGAME'], PDO::PARAM_INT);

    $requestTricks->execute();
    /* ------------------------------------------------------------------------------------ */

    /* ----------------------------- Insertion des rôles ---------------------------------- */
    $roles = array('Adminstrateur','Abonné');

    $requestRoles = $db->prepare('   INSERT INTO ROLE (NAMEROLE)
                                        VALUES(:role1),
                                                (:role2)');

    $requestRoles->bindValue(':role1', $roles[0], PDO::PARAM_STR);
    $requestRoles->bindValue(':role2', $roles[1], PDO::PARAM_STR);

    $requestRoles->execute();
    /* -------------------------------------------------------------------------------------- */

    /* --------------- Récupération des roles ------------------ */
    $requestRolesID = $db->query('SELECT IDROLE FROM ROLE');
    $resultRoleID = $requestRolesID->fetchAll(PDO::FETCH_ASSOC);
    /* ----------------------------------------------------------- */

    /* ----------------------------- Insertion des users ---------------------------------- */
    $user1 = array(
        'MAILUSER' => 'nicolas.framery@gmail.com',
        'PUBLICKEY' => 'cle1',
        'HOST' => 'host1'
    );

    $user2 = array(
        'MAILUSER' => 'nicolas.framery22222@gmail.com',
        'PUBLICKEY' => 'cle2',
        'HOST' => 'host2'
    );

    $requestUsers = $db->prepare('   INSERT INTO USER (IDROLE,MAILUSER,PUBLICKEY,HOST)
                                    VALUES(:role1,:mail1,:key1,:host1),
                                          (:role2,:mail2,:key2,:host2)');

    $requestUsers->bindValue(':role1', $resultRoleID[0]['IDROLE'], PDO::PARAM_INT);
    $requestUsers->bindValue(':role2', $resultRoleID[1]['IDROLE'], PDO::PARAM_INT);
    $requestUsers->bindValue(':mail1', $user1['MAILUSER'], PDO::PARAM_STR);
    $requestUsers->bindValue(':mail2', $user2['MAILUSER'], PDO::PARAM_STR);
    $requestUsers->bindValue(':key1',  $user1['PUBLICKEY'], PDO::PARAM_STR);
    $requestUsers->bindValue(':key2', $user2['PUBLICKEY'], PDO::PARAM_STR);
    $requestUsers->bindValue(':host1', $user1['HOST'], PDO::PARAM_STR);
    $requestUsers->bindValue(':host2', $user2['HOST'], PDO::PARAM_STR);

    $requestUsers->execute();
    /* -------------------------------------------------------------------------------------- */

    /*$request = $db->query('SELECT * FROM GAME');
    $result = $request->fetchAll(PDO::FETCH_ASSOC);

    var_dump($result);*/
    /*$_request = $db->prepare($sql);
    $_request->execute();*/

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