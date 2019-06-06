<?php

require_once ('commonConfig.php');

	loadClass("Episode");


		$episode = new Episode();
		$aEpisode = $episode->getAllEpisode();
		$lastEpisode = count($aEpisode)-1;

		echo $aEpisode[$lastEpisode]['id'];
		//return $aEpisode;
	