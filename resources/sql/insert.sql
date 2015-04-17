INSERT INTO `game` (`IDGAME`, `TITLE`, `DESCRIPTION`) VALUES
(1, 'Grand Theft Auto V', 'Grand Theft Auto V possède chaque élément des précédents opus de la série. Il met également en scène trois protagonistes que le joueur peut incarner et incluent Michael, Trevor et Franklin, des criminels dont les événements se lient entre eux lors des missions qui sont effectuées. Pendant les missions, le joueur peut alterner entre les protagonistes tandis qu''ils travaillent en équipe pour accomplir leurs missions'),
(2, 'Candy Crush Saga', 'Le but du jeu est de faire écraser des bonbons colorés en associant des combinaisons d''au moins trois bonbons5, afin de remplir l''objectif du niveau et de marquer un maximum de points. Il existe 905 niveaux dans le « monde réel » ( au 3 avril 2015), plus 575 nouveaux niveaux disponibles dans le « monde des songes ». Leur nombre est augmenté progressivement par l''éditeur'),
(3, 'Mario Kart', 'Le jeu a été favorablement accueilli par la critique, avec une moyenne de 91 % sur le site Metacritic. Les graphismes et le gameplay du jeu ont été appréciés tandis que les critiques ont déploré la qualité du mode un joueur, jugé trop répétitif. Mario Kart DS a reçu plusieurs récompenses, parmi lesquelles le prix des éditeurs de GameSpot et IGN, le prix G-Phoria du meilleur jeu vidéo de poche, et de la part d''IGN le prix du meilleur jeu de course et du meilleur jeu de l''année 2005. Aux États-Unis, Mario Kart DS est le jeu le plus vendu lors des deux premiers mois de sa sortie et est le troisième jeu le plus vendu de la Nintendo DS avec 20,7 millions d''exemplaires vendus en décembre 2010.');

INSERT INTO `company` (`idCompany`,`nameCompany`,`activityCompany`) VALUES (1,"Quis Company","developpeur"),(2,"Dui Inc.","developpeur"),(3,"Integer Inc.","developpeur"),(4,"Proin Vel LLP","developpeur"),(5,"Sociis Natoque Penatibus Corporation","editeur"),(6,"Ridiculus Inc.","editeur"),(7,"Felis Nulla LLC","editeur"),(8,"Vel Faucibus LLC","developpeur"),(9,"Taciti Sociosqu Incorporated","developpeur"),(10,"Dapibus Rutrum Inc.","developpeur");

INSERT INTO `platform` (`ID`, `NAME`) VALUES
(1, 'PS2'),
(2, 'PS3'),
(3, 'PS4'),
(4, 'XBOX'),
(5, 'XBOX 360'),
(6, 'Wii'),
(7, 'Wii U'),
(8, 'Gameboy color'),
(9, 'DS'),
(10, 'DS XXL'),
(11, 'Mobile'),
(12, 'PC'),
(13, 'Sega'),
(14, 'Gamecube'),
(15, 'Nintendo 64');

INSERT INTO `type` (`IDTYPE`, `NAMETYPE`) VALUES
(1, 'Solo'),
(2, 'Multijoueurs'),
(3, 'Arcade'),
(4, 'Simulation'),
(5, 'Campagne');

INSERT INTO `have_company` (`IDCOMPANY`, `IDGAME`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 2),
(7, 3),
(8, 3),
(9, 3),
(10, 2);


INSERT INTO `have_type` (`IDTYPE`, `IDGAME`) VALUES
(1, 1),
(2, 1),
(2, 3),
(3, 1),
(4, 2),
(4, 3),
(5, 2);

INSERT INTO `mode` (`IDMODE`, `NAMEMODE`) VALUES
(1, 'Solo'),
(2, 'Multijoueurs'),
(3, 'Arcade'),
(4, 'Simulation'),
(5, 'Campagne');

INSERT INTO `have_mode` (`IDMODE`, `IDGAME`) VALUES
(1, 1),
(2, 1),
(2, 3),
(3, 1),
(4, 2),
(4, 3),
(5, 2);


INSERT INTO `platformgame` (`IDPLATFORMGAME`, `IDGAME`, `ID`) VALUES
(1, 1, 1),
(2, 2, 2),
(3, 3, 3),
(4, 1, 4),
(5, 1, 5);


INSERT INTO `typelink` (`IDTYPELINK`, `NAMETYPELINK`) VALUES
(1, 'Facebook'),
(2, 'Twitter'),
(3, 'Site officiel'),
(4, 'Site non officiel'),
(5, 'blog');


INSERT INTO `link` (`IDLINK`, `IDTYPELINK`, `CONTENTLINK`, `SOCIAL`) VALUES
(1, 1, 'www.google.fr', 1),
(2, 2, 'www.facebook.fr', 1),
(3, 3, 'www.siteofficiel.fr', 0),
(4, 4, 'www.sitenonofficiel.fr', 0),
(5, 5, 'www.blog.fr', 0);


INSERT INTO `have_link` (`IDLINK`, `IDGAME`) VALUES
(1, 1),
(4, 1),
(2, 2),
(5, 2),
(3, 3);

INSERT INTO `note` (`IDNOTE`, `SOURCE`) VALUES
(1, 'jeuxvideos.com'),
(2, 'gamekult.com');

INSERT INTO `have_note` (`IDNOTE`, `IDPLATFORMGAME`, `NOTE`) VALUES
(1, 1, '16.0'),
(1, 2, '15.0'),
(1, 3, '12.0'),
(2, 1, '17.0'),
(2, 4, '8.0');



INSERT INTO `point` (`IDPOINT`, `IDPLATFORMGAME`, `TYPEMEDIA`, `POINT`) VALUES
(1, 1, 'Gratuit', 'positif'),
(2, 2, 'Multijoueurs', 'positif'),
(3, 3, 'Facile à prendre en main', 'positif'),
(4, 4, 'Options payantes', 'negatif'),
(5, 5, 'Accès uniquement Online', 'negatif');



INSERT INTO `media` (`IDMEDIA`, `IDPLATFORMGAME`, `TYPEMEDIA`, `TARGETMEDIA`, `LABELMEDIA`, `URLMEDIA`, `ALTMEDIA`) VALUES
(1, 1, 'image', 'cover', 'Couverture', 'www.google.fr', 'imageGoogle'),
(2, 2, 'video', 'cover', 'Couverture', 'https://gogole.fr', 'videoDeLaVie');



INSERT INTO `comment` (`IDCOMMENT`, `IDPLATFORMGAME`, `AUTHOR`, `NOTE`, `CONTENT`) VALUES
(1, 1, 'nicolas', '15.0', 'c''est cool'),
(2, 2, 'haithem', '8.5', 'c''est nul'),
(3, 3, 'fabio', '10.0', 'javament bien'),
(4, 4, 'baway', '12.0', 'smoke weed everyday'),
(5, 5, 'groupe', '15.0', 'note de ce projet');


INSERT INTO `configuration` (`IDCONFIGURATION`, `IDPLATFORMGAME`, `SYSTEM`, `RAM`, `DISK`, `GPU`, `CONNECTIONCONFIG`, `DIRECTX`) VALUES
(1, 1, 'windows 8', '4go', '512ko', 'gpu1', 'config de la conentino', '11'),
(2, 5, 'windows 7', '8', '1to', 'gpu2', 'connection configuration', '10');



INSERT INTO `similargame` (`IDSIMILARGAME`, `LABELMEDIA`, `URLMEDIA`) VALUES
(1, 'gta 4', 'www.gta4.fr'),
(2, 'candy crush noel', 'www.candycrushnoel.com'),
(3, 'league of legends', 'www.leagueoflegend.fr'),
(4, 'sim city', 'www.simcity.fr'),
(5, 'watchdogs', 'www.watchdogs.fr');



INSERT INTO `language` (`LABELLANGUAGE`) VALUES
('anglais'),
('chinois'),
('espagnol'),
('francais'),
('italien');


INSERT INTO `have_similargame` (`IDSIMILARGAME`, `IDPLATFORMGAME`) VALUES
(1, 1),
(2, 1),
(3, 1),
(2, 2),
(4, 3);


INSERT INTO `have_subtitle` (`LABELLANGUAGE`, `IDPLATFORMGAME`) VALUES
('chinois', 1),
('francais', 1),
('espagnol', 2),
('italien', 4),
('francais', 5);



INSERT INTO `have_language` (`LABELLANGUAGE`, `IDPLATFORMGAME`) VALUES
('anglais', 1),
('italien', 2),
('francais', 3),
('italien', 4),
('chinois', 5);

