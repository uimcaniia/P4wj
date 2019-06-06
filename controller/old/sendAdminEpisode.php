<?php
# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');

	loadClass("Comment");
	loadClass("Episode");
	loadClass("Reply");
	loadClass("User");


// récupère un épisode sélectionné
	if(isset($_POST['valEpModif']))
	{
		$episode = new Episode();
		$aEpisode = $episode->get($_POST['valEpModif']);
		if(!is_array($aEpisode))
		{
			echo 'un problème est survenue';
		}
	}
//********************************************************************	
	//vérifie si un épisode existe déjà
	if(isset($_POST['IdNewEpClean']))
	{
		$episode = new Episode();
		$aEpisode = $episode->get($_POST['IdNewEpClean']);
		if((!is_array($aEpisode)) || (empty($aEpisode)))
		{
			echo "existe déjà";
		}
	}
//********************************************************************
// insère un nouvel épisode
	//echo $_POST['titleNewEp'];
	if(isset($_POST['titleNewEp']) && isset($_POST['texteNewEp']))
	{
		$title = htmlspecialchars($_POST['titleNewEp']);
		$txt = htmlspecialchars($_POST['texteNewEp']);

		$aDataEpisode=array(
			array("title" => "'$title'",
			"episode" => "'$txt'"));

		$episode = new Episode();
		$aEpisode = $episode->hydrate($aDataEpisode);
		$episode->add($episode);
		
	}

	//********************************************************************
// update l'édition d'un épisode créer
	if(isset($_POST['updateTitleNewEp']) && isset($_POST['updateTexteNewEp']) && isset($_POST['idNewEpClean']))
	{
		$title = htmlspecialchars($_POST['updateTitleNewEp']);
		$txt = htmlspecialchars($_POST['updateTexteNewEp']);
		$id = (int)$_POST['idNewEpClean'];

		$episode = new Episode();
		$aEpisode = $episode->update($title, $txt, $id);
		
	}

//********************************************************************
// update les modification d'un épisode
	if(isset($_POST['updateTitleModifEp']) && isset($_POST['updateTexteModifEp']) && isset($_POST['idModifEpClean']))
	{
		$title = htmlspecialchars($_POST['updateTitleModifEp']);
		$txt = htmlspecialchars($_POST['updateTexteModifEp']);
		$id = (int)$_POST['idModifEpClean'];

		$episode = new Episode();
		$aEpisode = $episode->update($title, $txt, $id);
		
	}


//******************************************************
	//supprime un épisode sélectionné

	if(isset($_POST['valEpDel']))
	{
		$episode = new Episode();
		$aEpisode = $episode->delete($_POST['valEpDel']);
		echo $aEpisode;
	}





	