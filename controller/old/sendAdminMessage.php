<?php
# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');

	loadClass("Message");

// récupère un épisode sélectionné
	if(isset($_POST['sujet']) && isset($_POST['txt']) && isset($_POST['id']))
	{
		$sujet = trim($_POST['sujet']); // on supprime les espace blanc en début et fin de chaine
		$sujetClean = htmlspecialchars($sujet); // on sécurise le text
		$txt = trim($_POST['txt']); // on supprime les espace blanc en début et fin de chaine
		$txtClean = htmlspecialchars($txt); // on sécurise le text

		$idIntUser = intval($_POST['id']); 

		$aDataMessage=array(
			"send"    => $_SESSION['idUser'],
			"subject" => "'$sujetClean'",
			"receive" => "'$idIntUser'",
			"text"    => "'$txtClean'",
			"admin"   => $_SESSION['admin']);

		$message = new Message();
		$hydrateMess = $message->hydrate($aDataMessage);
		$message->add($message);
	}
	else
	{
		echo 'Vous devez compléter tous les champs';
	}