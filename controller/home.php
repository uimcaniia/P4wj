<?php

require('Episode.php');

listPost($nbr);

$headTitle       = "Bienvenue!"; // titre de la page
$metaDescription = "";

$titleH1         = 'Les derniers épisodes parut.';
$retrouver       = "Retouver également tous les épisodes ici!";

loadClass("Episode");
$episodes = new EpisodeManager;
$aEpisode = $episodes->getChoiseNbr(4);// on récupère les 4 derniers épisode

/*echo '<pre';
print_r($aEpisode);
echo '</pre>';*/

for ($i = 0 ; $i < count($aEpisode) ; $i++)
{
	foreach ($aEpisode[$i] as $key => $value)
	{
		if($key == 'episode')// on conserve un exxtrait du texte de l'épisode
		{
			$valueExtract = substr($value, 0, 430);  // on conserve les 550 première lettres
			$aEpisode[$i]['episode'] = $valueExtract;
			$aEpisode[$i]['extractEpisode'] = $aEpisode[$i]['episode']; // on change le nom de la clé mais on garde la valeur de l'ancienne
			$aEpisode[$i]['extractEpisode'] .= '...'; // on ajoute "..." à la fin de l'extrait
			unset($aEpisode[$i]['episode']); // on supprime l'ancienne clé
		}
		if($key =='publication')
		{
			$aEpisode[$i]['publication'] = strftime('%d-%m-%Y',strtotime($aEpisode[$i]['publication'])); // convertion date US en FR
		}
	}
}
			

$icon->getDataToHydrate(10); // icone punaise
$iconEpisode = $icon->getClasse();

loadClass("BuildDivEpisode");

$divEpisodes='';
for ($i = 0 ; $i < count($aEpisode) ; $i++)
{
	$div = new BuildDivEpisode($aEpisode[$i]);
	$divEpisode = $div->buildThumbnail($iconEpisode, IMGSCOTCH, 'episode.php?id='.$aEpisode[$i]["id"].'');
	$divEpisodes .= $divEpisode;
}


include ($pgHead);  // <head> de la page   
include ($pgHeader); // <header> de la page
include ("../view/home.php");
include ($pgFooter); // <footer> de la page
