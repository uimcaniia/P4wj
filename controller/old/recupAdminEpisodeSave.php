<?php

require_once ('commonConfig.php');

	loadClass("Episode");

	if(isset($_POST['titleNewEp']) && isset($_POST['texteNewEp']) && isset($_POST['IdNewEpClean']))
	{
		$episode = new Episode();
		$aEpisode = $episode->get($_POST['IdNewEpClean']);
		echo ' '.$aEpisode[0]['title'].'`'.$aEpisode[0]['episode'].'`'.$aEpisode[0]['id'].'';
		//return $aEpisode;
	}