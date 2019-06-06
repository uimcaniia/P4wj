<?php

# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');
$alertActualize='';

loadClass("comment");
loadClass("Admin");
loadClass("Episode");
loadClass("User");
loadClass("Input");
loadClass("Message");

$titleH1 = 'Espace Administration';
$containSpace = '';


if(isset($_SESSION['idUser']) && isset($_SESSION['pseudo']) && isset($_SESSION['admin']))
{

	$admin = new Admin();
	$getInfosAdmin = $admin->get('id', $_SESSION['idUser']);
	$admin-> hydrate($getInfosAdmin[0]);

	$input = new Input();
	$inputPseudo = $input->get(10); // array contenant les attribut du champs input pseudo

	$inputNewPassword = $input->get(14);// array contenant les attribut du champs input password
	$inputRepeatPassword = $input->get(15);
	array_push($inputNewPassword, $inputRepeatPassword[0]); // assemblage des 2 array

	$icon->getDataToHydrate(7); // icone check
	$iconCheck = $icon->getClasse();

	$icon->getDataToHydrate(11); // icone pen
	$iconPen = $icon->getClasse();

	$icon->getDataToHydrate(8); // icone annuler
	$iconAnnul = $icon->getClasse();

	$icon->getDataToHydrate(19); // icone save
	$iconSave = $icon->getClasse();

	$icon->getDataToHydrate(13); // icone enveloppe
	$iconSend = $icon->getClasse();

	$user = new User();
	$aUser = $user->getAllUser();

	$comment = new Comment; 	
	$aCommentSignal = $comment->getAllCommentSignal();

	$episode = new Episode; 
	$aEpisode = $episode->getAllEpisode();

	$message = new Message; 
	$aMessageSend = $message->get('send', $_SESSION['idUser']);
	$aMessageReceive = $message->get('receive', $_SESSION['idUser']);

	
	for($i = 0 ; $i < count($aMessageSend) ; $i++)
	{
		foreach ($aMessageSend[$i] as $key => $value)
		{
			if($key =='receive')
			{
				$user = new User; 
				$aPseudo = $user-> get('id', $value);
				$aMessageSend[$i]['pseudo'] = $aPseudo[0]['pseudo'];
			}
			if($key =='date')
			{
				$aMessageSend[$i]['date'] = strftime('%d-%m-%Y',strtotime($aMessageSend[$i]['date'])); 
			}
		}
	}

	for($i = 0 ; $i < count($aMessageReceive) ; $i++)
	{
		foreach ($aMessageReceive[$i] as $key => $value)
		{
			if($key =='send')
			{
				$user = new User; 
				$aPseudo = $user-> get('id', $value);
				$aMessageReceive[$i]['pseudo'] = $aPseudo[0]['pseudo'];
			}
			if($key =='date')
			{
				$aMessageReceive[$i]['date'] = strftime('%d-%m-%Y',strtotime($aMessageReceive[$i]['date'])); 
			}
		}
	}
/*	echo '<pre>';
	print_r($aMessageSend);
	echo '</pre>';*/

	$aUserSignal = array();  
	$aEpisodeSignal = array();

	for($i = 0 ; $i < count($aUser) ; $i++) // on récupère tous les utilisateur signalés
	{
		foreach ($aUser[$i] as $key => $value)
		{
			if($key =='reporting')
			{
				if($value != 0)
				array_push($aUserSignal, $aUser[$i]);
			}
		}
	}

	 // on récupère tous les épisodes ayant reçut uncommentaire signalés
$akeyDoble = array(); // array qui contiendra les id des episode déjà chargé pour éviter les doublons

	for($i = 0 ; $i < count($aCommentSignal) ; $i++)
	{
		foreach ($aCommentSignal[$i] as $key => $value)
		{
			if($key =='idEpisode')
			{
				if(!in_array($value, $akeyDoble))
				{
					$episode = new Episode; 
					$aEpisode2 = $episode-> get($value);
					array_push($aEpisodeSignal, $aEpisode2[0]);
					array_push($akeyDoble, $value);
				}
			}
		}
	}



	$containAdminMessage = $admin->buildAdminMessage($iconSend, $iconAnnul);
	$containAdminEpisode = $admin->buildAdminEpisode($aEpisode, $iconCheck, $iconAnnul);
	$containAdminComment = $admin->buildAdminComment($aEpisode, $aUser, $aUserSignal, $aEpisodeSignal, $iconCheck, $iconAnnul);
	$containAdminMessagePlace = $admin->buildAdminMessagePlace($aMessageSend, $aMessageReceive, $iconAnnul, $iconPen);
	$containSpace = $admin->buildSpace($iconPen, $iconCheck, $iconAnnul, $inputPseudo, $inputNewPassword);



$containSpace .= <<<EOT
			</div>
	 	 </div>
	 </div>
EOT;
}

$headTitle     = 'Bienvenue dans votre espace';
$metaDescription = "";
include ($pgHead);  // <head> de la page   
include ($pgHeader); // <header> de la page
include ("../view/admin.php");
include ($pgFooter); // <footer> de la page

