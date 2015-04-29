/*==============================================================*/
/* DBMS name:      MySQL 5.0                                    */
/* Created on:     17/04/2015 12:43:57                          */
/*==============================================================*/


drop table if exists COMMENT;

drop table if exists COMPANY;

drop table if exists CONFIGURATION;

drop table if exists GAME;

drop table if exists HAVE_COMPANY;

drop table if exists HAVE_GAMEMODE;

drop table if exists HAVE_LANGUAGE;

drop table if exists HAVE_LINK;

drop table if exists HAVE_NOTE;

drop table if exists HAVE_PRICE;

drop table if exists HAVE_SIMILARGAME;

drop table if exists HAVE_SUBTITLE;

drop table if exists HAVE_TYPE;

drop table if exists LANGUAGE;

drop table if exists LINK;

drop table if exists MEDIA;

drop table if exists MODE;

drop table if exists NOTE;

drop table if exists PLATFORM;

drop table if exists PLATFORMGAME;

drop table if exists POINT;

drop table if exists ROLE;

drop table if exists SELLER;

drop table if exists SIMILARGAME;

drop table if exists TRICK;

drop table if exists TYPE;

drop table if exists TYPELINK;

drop table if exists USER;

/*==============================================================*/
/* Table: COMMENT                                               */
/*==============================================================*/
create table COMMENT
(
   IDCOMMENT            bigint not null AUTO_INCREMENT,
   IDPLATFORMGAME       bigint not null,
   AUTHOR               varchar(200) not null,
   NOTE                 decimal(3,1) not null,
   CONTENT              varchar(200) not null,
   DATE_COMMENT         datetime not null,
   primary key (IDCOMMENT)
);

/*==============================================================*/
/* Table: COMPANY                                               */
/*==============================================================*/
create table COMPANY
(
   IDCOMPANY            bigint not null AUTO_INCREMENT,
   NAMECOMPANY          varchar(200) not null,
   ACTIVITYCOMPANY      varchar(150) not null,
   primary key (IDCOMPANY)
);

/*==============================================================*/
/* Table: CONFIGURATION                                         */
/*==============================================================*/
create table CONFIGURATION
(
   IDCONFIGURATION      bigint not null AUTO_INCREMENT,
   IDPLATFORMGAME       bigint not null,
   SYSTEM               varchar(200) not null,
   RAM                  varchar(200) not null,
   DISK                 varchar(200) not null,
   GPU                  varchar(200) not null,
   CONNECTIONCONFIG     longtext not null,
   DIRECTX              varchar(200) not null,
   TYPE_CONFIG          varchar(140) not null,
   primary key (IDCONFIGURATION)
);

/*==============================================================*/
/* Table: GAME                                                  */
/*==============================================================*/
create table GAME
(
   IDGAME               bigint not null AUTO_INCREMENT,
   TITLE                longtext not null,
   DESCRIPTION          text not null,
   primary key (IDGAME)
);

/*==============================================================*/
/* Table: HAVE_COMPANY                                          */
/*==============================================================*/
create table HAVE_COMPANY
(
   IDCOMPANY            bigint not null,
   IDGAME               bigint not null,
   primary key (IDCOMPANY, IDGAME)
);

/*==============================================================*/
/* Table: HAVE_GAMEMODE                                         */
/*==============================================================*/
create table HAVE_GAMEMODE
(
   IDGAMEMODE           bigint not null,
   IDGAME               bigint not null,
   primary key (IDGAMEMODE, IDGAME)
);

/*==============================================================*/
/* Table: HAVE_LANGUAGE                                         */
/*==============================================================*/
create table HAVE_LANGUAGE
(
   LABELLANGUAGE        varchar(100) not null,
   IDPLATFORMGAME       bigint not null,
   primary key (LABELLANGUAGE, IDPLATFORMGAME)
);

/*==============================================================*/
/* Table: HAVE_LINK                                             */
/*==============================================================*/
create table HAVE_LINK
(
   IDLINK               bigint not null,
   IDGAME               bigint not null,
   primary key (IDLINK, IDGAME)
);

/*==============================================================*/
/* Table: HAVE_NOTE                                             */
/*==============================================================*/
create table HAVE_NOTE
(
   IDNOTE               bigint not null,
   IDPLATFORMGAME       bigint not null,
   NOTE                 decimal(3,1),
   primary key (IDNOTE, IDPLATFORMGAME)
);

/*==============================================================*/
/* Table: HAVE_PRICE                                            */
/*==============================================================*/
create table HAVE_PRICE
(
   IDPRICE              bigint not null,
   IDPLATFORMGAME       bigint not null,
   PRICE                float not null,
   CURRENCY             varchar(150) not null,
   primary key (IDPRICE, IDPLATFORMGAME)
);

/*==============================================================*/
/* Table: HAVE_SIMILARGAME                                      */
/*==============================================================*/
create table HAVE_SIMILARGAME
(
   IDSIMILARGAME        bigint not null,
   IDPLATFORMGAME       bigint not null,
   primary key (IDSIMILARGAME, IDPLATFORMGAME)
);

/*==============================================================*/
/* Table: HAVE_SUBTITLE                                         */
/*==============================================================*/
create table HAVE_SUBTITLE
(
   LABELLANGUAGE        varchar(100) not null,
   IDPLATFORMGAME       bigint not null,
   primary key (LABELLANGUAGE, IDPLATFORMGAME)
);

/*==============================================================*/
/* Table: HAVE_TYPE                                             */
/*==============================================================*/
create table HAVE_TYPE
(
   IDTYPE               bigint not null,
   IDGAME               bigint not null,
   primary key (IDTYPE, IDGAME)
);

/*==============================================================*/
/* Table: LANGUAGE                                              */
/*==============================================================*/
create table LANGUAGE
(
   LABELLANGUAGE        varchar(100) not null,
   primary key (LABELLANGUAGE)
);

/*==============================================================*/
/* Table: LINK                                                  */
/*==============================================================*/
create table LINK
(
   IDLINK               bigint not null AUTO_INCREMENT,
   IDTYPELINK           smallint not null,
   CONTENTLINK          longtext not null,
   primary key (IDLINK)
);

/*==============================================================*/
/* Table: MEDIA                                                 */
/*==============================================================*/
create table MEDIA
(
   IDMEDIA              bigint not null AUTO_INCREMENT,
   IDPLATFORMGAME       bigint not null,
   TYPEMEDIA            varchar(100) not null,
   TARGETMEDIA          varchar(200) not null,
   LABELMEDIA           varchar(200) not null,
   URLMEDIA             longtext not null,
   ALTMEDIA             varchar(200) not null,
   primary key (IDMEDIA)
);

/*==============================================================*/
/* Table: MODE                                                  */
/*==============================================================*/
create table MODE
(
   IDGAMEMODE           bigint not null AUTO_INCREMENT,
   NAMEGAMEMODE         varchar(150) not null,
   primary key (IDGAMEMODE)
);

/*==============================================================*/
/* Table: NOTE                                                  */
/*==============================================================*/
create table NOTE
(
   IDNOTE               bigint not null AUTO_INCREMENT,
   SOURCE               longtext not null,
   primary key (IDNOTE)
);

/*==============================================================*/
/* Table: PLATFORM                                              */
/*==============================================================*/
create table PLATFORM
(
   IDPLATFORM           bigint not null AUTO_INCREMENT,
   NAMEPLATFORM         varchar(150) not null,
   primary key (IDPLATFORM)
);

/*==============================================================*/
/* Table: PLATFORMGAME                                          */
/*==============================================================*/
create table PLATFORMGAME
(
   IDPLATFORMGAME       bigint not null AUTO_INCREMENT,
   IDGAME               bigint not null,
   IDPLATFORM           bigint not null,
   DESCRIPTION          text not null,
   EXIT_DATE            date not null,
   PEGI                 varchar(120) not null,
   primary key (IDPLATFORMGAME)
);

/*==============================================================*/
/* Table: POINT                                                 */
/*==============================================================*/
create table POINT
(
   IDPOINT              bigint not null AUTO_INCREMENT,
   IDPLATFORMGAME       bigint not null,
   TYPEMEDIA            varchar(100),
   POINT                varchar(150),
   primary key (IDPOINT)
);

/*==============================================================*/
/* Table: ROLE                                                  */
/*==============================================================*/
create table ROLE
(
   IDROLE               bigint not null AUTO_INCREMENT,
   NAMEROLE             varchar(80) not null,
   primary key (IDROLE)
);

/*==============================================================*/
/* Table: SELLER                                                */
/*==============================================================*/
create table SELLER
(
   IDPRICE              bigint not null AUTO_INCREMENT,
   SELLER               varchar(150) not null,
   TYPEMEDIA            varchar(100) not null,
   primary key (IDPRICE)
);

/*==============================================================*/
/* Table: SIMILARGAME                                           */
/*==============================================================*/
create table SIMILARGAME
(
   IDSIMILARGAME        bigint not null AUTO_INCREMENT,
   LABELMEDIA           varchar(200) not null,
   URLMEDIA             longtext not null,
   primary key (IDSIMILARGAME)
);

/*==============================================================*/
/* Table: TRICK                                                 */
/*==============================================================*/
create table TRICK
(
   IDTRICK              bigint not null AUTO_INCREMENT,
   IDPLATFORMGAME       bigint not null,
   LABELMEDIA           varchar(200) not null,
   primary key (IDTRICK)
);

/*==============================================================*/
/* Table: TYPE                                                  */
/*==============================================================*/
create table TYPE
(
   IDTYPE               bigint not null AUTO_INCREMENT,
   NAMETYPE             varchar(150) not null,
   primary key (IDTYPE)
);

/*==============================================================*/
/* Table: TYPELINK                                              */
/*==============================================================*/
create table TYPELINK
(
   IDTYPELINK           smallint not null AUTO_INCREMENT,
   NAMETYPELINK         varchar(200) not null,
   primary key (IDTYPELINK)
);

/*==============================================================*/
/* Table: USER                                                  */
/*==============================================================*/
create table USER
(
   IDUSER               bigint not null AUTO_INCREMENT,
   IDROLE               bigint not null,
   MAILUSER             longtext not null,
   PUBLICKEY            varchar(130) not null,
   HOST                 varchar(30) not null,
   primary key (IDUSER)
);

alter table COMMENT add constraint FK_HAVE_COMMENT foreign key (IDPLATFORMGAME)
      references PLATFORMGAME (IDPLATFORMGAME) on delete restrict on update restrict;

alter table CONFIGURATION add constraint FK_HAVE_CONFIGURATION foreign key (IDPLATFORMGAME)
      references PLATFORMGAME (IDPLATFORMGAME) on delete restrict on update restrict;

alter table HAVE_COMPANY add constraint FK_HAVE_COMPANY foreign key (IDCOMPANY)
      references COMPANY (IDCOMPANY) on delete restrict on update restrict;

alter table HAVE_COMPANY add constraint FK_HAVE_COMPANY2 foreign key (IDGAME)
      references GAME (IDGAME) on delete restrict on update restrict;

alter table HAVE_GAMEMODE add constraint FK_HAVE_GAMEMODE foreign key (IDGAMEMODE)
      references MODE (IDGAMEMODE) on delete restrict on update restrict;

alter table HAVE_GAMEMODE add constraint FK_HAVE_GAMEMODE2 foreign key (IDGAME)
      references GAME (IDGAME) on delete restrict on update restrict;

alter table HAVE_LANGUAGE add constraint FK_HAVE_LANGUAGE foreign key (LABELLANGUAGE)
      references LANGUAGE (LABELLANGUAGE) on delete restrict on update restrict;

alter table HAVE_LANGUAGE add constraint FK_HAVE_LANGUAGE2 foreign key (IDPLATFORMGAME)
      references PLATFORMGAME (IDPLATFORMGAME) on delete restrict on update restrict;

alter table HAVE_LINK add constraint FK_HAVE_LINK foreign key (IDLINK)
      references LINK (IDLINK) on delete restrict on update restrict;

alter table HAVE_LINK add constraint FK_HAVE_LINK2 foreign key (IDGAME)
      references GAME (IDGAME) on delete restrict on update restrict;

alter table HAVE_NOTE add constraint FK_HAVE_NOTE foreign key (IDNOTE)
      references NOTE (IDNOTE) on delete restrict on update restrict;

alter table HAVE_NOTE add constraint FK_HAVE_NOTE2 foreign key (IDPLATFORMGAME)
      references PLATFORMGAME (IDPLATFORMGAME) on delete restrict on update restrict;

alter table HAVE_PRICE add constraint FK_HAVE_PRICE foreign key (IDPRICE)
      references SELLER (IDPRICE) on delete restrict on update restrict;

alter table HAVE_PRICE add constraint FK_HAVE_PRICE2 foreign key (IDPLATFORMGAME)
      references PLATFORMGAME (IDPLATFORMGAME) on delete restrict on update restrict;

alter table HAVE_SIMILARGAME add constraint FK_HAVE_SIMILARGAME foreign key (IDSIMILARGAME)
      references SIMILARGAME (IDSIMILARGAME) on delete restrict on update restrict;

alter table HAVE_SIMILARGAME add constraint FK_HAVE_SIMILARGAME2 foreign key (IDPLATFORMGAME)
      references PLATFORMGAME (IDPLATFORMGAME) on delete restrict on update restrict;

alter table HAVE_SUBTITLE add constraint FK_HAVE_SUBTITLE foreign key (LABELLANGUAGE)
      references LANGUAGE (LABELLANGUAGE) on delete restrict on update restrict;

alter table HAVE_SUBTITLE add constraint FK_HAVE_SUBTITLE2 foreign key (IDPLATFORMGAME)
      references PLATFORMGAME (IDPLATFORMGAME) on delete restrict on update restrict;

alter table HAVE_TYPE add constraint FK_HAVE_TYPE foreign key (IDTYPE)
      references TYPE (IDTYPE) on delete restrict on update restrict;

alter table HAVE_TYPE add constraint FK_HAVE_TYPE2 foreign key (IDGAME)
      references GAME (IDGAME) on delete restrict on update restrict;

alter table LINK add constraint FK_HAVE_TYPELINK foreign key (IDTYPELINK)
      references TYPELINK (IDTYPELINK) on delete restrict on update restrict;

alter table MEDIA add constraint FK_HAVE_MEDIA foreign key (IDPLATFORMGAME)
      references PLATFORMGAME (IDPLATFORMGAME) on delete restrict on update restrict;

alter table PLATFORMGAME add constraint FK_HAVE_PFGAME_GAME foreign key (IDGAME)
      references GAME (IDGAME) on delete restrict on update restrict;

alter table PLATFORMGAME add constraint FK_HAVE_PFGAME_PF foreign key (IDPLATFORM)
      references PLATFORM (IDPLATFORM) on delete restrict on update restrict;

alter table POINT add constraint FK_HAVE_POINT foreign key (IDPLATFORMGAME)
      references PLATFORMGAME (IDPLATFORMGAME) on delete restrict on update restrict;

alter table TRICK add constraint FK_HAVE_TRICK foreign key (IDPLATFORMGAME)
      references PLATFORMGAME (IDPLATFORMGAME) on delete restrict on update restrict;

alter table USER add constraint FK_HAVE_ROLE foreign key (IDROLE)
      references ROLE (IDROLE) on delete restrict on update restrict;

