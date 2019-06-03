<?php

require_once ('commonConfig.php');

	loadClass("Comment");
	loadClass("Episode");

	if(isset($_POST['valEpModif']))
	{
		$episode = new Episode();
		$aEpisode = $episode->get($_POST['valEpModif']);
		echo ' '.$aEpisode[0]['title'].'`'.$aEpisode[0]['episode'].'`'.$aEpisode[0]['id'].'';
		//return $aEpisode;
	}