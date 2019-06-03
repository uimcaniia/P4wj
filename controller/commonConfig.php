<?php

session_start();
#
# Fichier de configuration commun
#
# Lecture du fichier de configuration général
$dir =  __DIR__ ;
require_once ("$dir/../mainConfig.php");

include APP_AUTOLOAD;
loadClass("Icon");
$icon = new Icon();
$icon->getDataToHydrate(10);
//print_r($icon);
$iconEpisode = $icon->getClasse();

$icon->getDataToHydrate(1); // icone accueil
$iconHome = $icon->getClasse();

$icon->getDataToHydrate(2); // icone episode
$iconBook = $icon->getClasse();

if(isset($_SESSION['idUser']) && isset($_SESSION['pseudo']) && isset($_SESSION['admin']))
{
	$icon->getDataToHydrate(15); // icone deconnexion
	$iconConnexion = $icon->getClasse();
	$pConnect = 'disconnect.php';
	$pseudoHome = $_SESSION['pseudo'];
}
else
{
	$icon->getDataToHydrate(5); // icone connexion
	$iconConnexion = $icon->getClasse();
	$pConnect = 'login.php#titlePage';
	$pseudoHome = '';
}

$icon->getDataToHydrate(16); // icone descendre
$iconDown = $icon->getClasse();

$headFont    =FONT;
$headFontAwesome = FONTAWESOME;
$headIcon    =HEADICON;
$metaViewport=METAVIEWPORT;

$css = MAINCSS;
$headStyleCssTablette=TABLETTECSS;
$headStyleCssMobile  =MOBILECSS;

$jquery = SCRIPTJQUERY;
$anim   = SCRIPTANIM;
$animMenu = SCRIPTANIMMENU;
$ajaxSignal = SCRIPTAJAXSIGNAL;
$ajaxComment = SCRIPTAJAXCOMMENT;
$ajaxActualize = SCRIPTAJAXACTUALIZE;
$editeur = SCRIPTEDITEUR;
$adminCtrlEpisode = SCRIPTADMINEPISODE;
$adminCtrlComment = SCRIPTADMINCOMMENT;
$adminCtrlMessage = SCRIPTADMINMESSAGE;

$imgTitle = IMGFLOCON;

$biographie = 'biographie.php';
$pHome    = 'home.php';
$pEpisode = 'episodeExtrait.php';

/** Scripts constitutifs d'une page construite */
$pgHead    = "../view/pgHead.php";       
$pgHeader  = "../view/pgHeader.php";     //header
$pgFooter  = "../view/pgFooter.php";     // Pied de page


