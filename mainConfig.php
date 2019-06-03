<?php

//echo "coucou";

define("SERVEUR","localhost");
define("BASE","coan3607_jean_forteroche");
define("MDP","coucou");
define("USER","root");

//repertoire et URLs
define("ACCUEIL", "controller/home.php" );
define("COMMON" , "controller/commonConfig.php" );

define("APP_AUTOLOAD", "../Autoload.php" );

define("APP_VIEW" , "../view" );
define("APP_MODEL", "../model" );

// Eléments graphiques
define("APP_IMG", "../public/img" );
define("APP_JS", "../public/js" );

define("SCRIPTJQUERY", APP_JS."/jquery.js" );
define("SCRIPTANIM"  , APP_JS."/anim.js" );
define("SCRIPTANIMMENU", APP_JS."/animMenu.js");
define("SCRIPTAJAXSIGNAL", APP_JS."/signal.js");
define("SCRIPTAJAXCOMMENT", APP_JS."/comment.js");
define("SCRIPTAJAXACTUALIZE", APP_JS."/actualize.js");
define("SCRIPTEDITEUR", APP_JS."/editeur.js");
define("SCRIPTADMINEPISODE", APP_JS."/adminEpisode.js");
define("SCRIPTADMINCOMMENT", APP_JS."/adminComment.js");
define("SCRIPTADMINMESSAGE", APP_JS."/adminMessage.js");

define ("IMGLOGO"   , APP_IMG."/logo.png");
define ('IMGLOGOALT', "Logo du blog");
define ("IMGSCOTCH" , APP_IMG."/scotch.png");
define ("IMGFLOCON" , APP_IMG."/flocon.png");

define("APP_CSS", "../public/css" );

define("MAINCSS"    ,   APP_CSS."/style.css");
define("TABLETTECSS",   APP_CSS."/tablette.css");
define("MOBILECSS"  ,   APP_CSS."/mobile.css");

//élément du <head>
define("METAVIEWPORT", 'name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui"');
define("FONT", 'href="https://fonts.googleapis.com/css?family=Caveat&display=swap" rel="stylesheet"');
define("METADESCRIPTION", "");
define("HEADICON", "");
define("FONTAWESOME", 'rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"');



