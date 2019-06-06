<?php
# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');

$aEpisode=array();
if(isset($_GET['id'])) // on test si les variable existe
{
	$idIntEpisode = intval($_GET['id']); // on transforme la string en int

	loadClass("Episode");
	$episode       = new Episode;
	$aChapitre     = $episode->getDataToHydrate($idIntEpisode); // on appelle l'épisode concerné'

	$titleH1       = $episode->getTitle();
	$headTitle     = $episode->getTitle();
	$txtEpisode    = $episode->getEpisode();
	$dateEpisodeFr = strftime('%d-%m-%Y',strtotime($episode->getPublication())); // convertion date US en FR

	$nbrEpisode = $episode->countEntries(); // on compte le nbr d'entrée dans la table
	$linkEpisodeNext = ''; // initialisation des liens vers les épisode suivant et précédent
	$linkEpisodePrev = '';

	if ($idIntEpisode > 1) // si ce n'est pas le premier episode
	{
		$iPrev = $idIntEpisode - 1; // on assigne un id inférieur de 1
		$episodePrev   = new Episode;
		$aChapitrePrev = $episodePrev->getDataToHydrate($iPrev);
		$validChapitrePrev = $episodePrev->getCheckIdentite();

		if($validChapitrePrev == 1) // on vérifie si l'épisode existe (1 ok, 0 rien)
		{
			$linkEpisodePrev = $iPrev; // si oui, lien vers l'épisode précédent
		}else
		{
			for($iPrev ; $iPrev > 0 ; $iPrev--) // si non, on cherche l'entrée encore avant (bouble)
			{
				$episodePrev   = new Episode;
				$aChapitrePrev = $episodePrev->getDataToHydrate($i);
				$validChapitrePrev = $episodePrev->getCheckIdentite(); 
				if($validChapitrePrev == 1)// Si elle existe
				{
					$linkEpisodePrev = $iPrev;
					break;
				}
				else{
					echo 'rien  ';
				}
			}
		}
	}

	if ($idIntEpisode < $nbrEpisode[0]) // si ce n'est pas le dernier episode
	{
		$idNext = $idIntEpisode + 1; // on assigne un id supérieur de 1
		$episodeNext   = new Episode;
		$aChapitreNext = $episodeNext->getDataToHydrate($idNext);
		$validChapitreNext = $episodeNext->getCheckIdentite();

		if($validChapitreNext == 1) // on vérifie si l'épisode existe (1 ok, 0 rien)
		{
			$linkEpisodeNext = $idNext; // si oui, lien vers l'épisode d'après
		}else
		{
			for($idNext ; $idNext < $nbrEpisode[0] ; $idNext++) // si non, on cherche l'entrée encore après (bouble)
			{
				$episodeNext   = new Episode;
				$aChapitreNext = $episodeNext->getDataToHydrate($idNext);
				$validChapitreNext = $episodeNext->getCheckIdentite(); 
				if($validChapitreNext == 1)// Si elle existe
				{
					$linkEpisodeNext = $idNext;
					break;
				}
				else{
					echo 'rien  ';
				}
			}
		}
	}
	$aEpisode = array(
		'episode'         => $txtEpisode,
		'publication'     => $dateEpisodeFr,
		'linkEpisodePrev' => $linkEpisodePrev,
		'linkEpisodeNext' => $linkEpisodeNext);

	loadClass("BuildDivEpisode");
	$buidep = new BuildDivEpisode($aEpisode);
	$chapitre = $buidep->build($iconEpisode, IMGSCOTCH);

}else
{
	echo 'aucun épisode n\'existe! ' ;
}

$comments= '';
	
$metaDescription = "";
include ($pgHead);  // <head> de la page   
include ($pgHeader); // <header> de la page
include ("../view/episode.php");
include ("comment.php");
include ($pgFooter); // <footer> de la page