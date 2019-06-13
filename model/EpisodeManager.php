<?php

class EpisodeManager extends bdd{

	// CONSTANTES

		const TAB_EPI = 'episode'; // nom de la table

//******************************************************************************************************************
	 	 //ajoute un episode
	 	 public function add(Episode $episode)
	 	 {
	 	 	$param1 = $episode->getEpisode();
		    $param2 = $episode->getTitle();

	 	 	$request = 'INSERT INTO '. self::TAB_EPI.'(publication, episode, title) VALUES (NOW(),'.$param1.', '.$param2.')';
	 	 	//echo $request;
	 	 	parent::addRequest($request);
	 	 	//return $request;
	 	 }

 //*****************************************************************************************************************
	 	 //recupère les entrée de la table episode suivant l'épisode
	 	 public function get($episode)
	 	 { 
	 	 	$request = 'SELECT * FROM '. self::TAB_EPI.' WHERE id  = '.$episode.' AND showEpisode = 1';
	 	 	//echo $request;
	 	 	$aRes = parent::addRequestSelect($request);
	 	 	return $aRes;

	 	 }

//******************************************************************************************************************
	 	 //recupère tous épisodes
	 	 public function getAllEpisode()
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_EPI.' ORDER BY id';
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }
//******************************************************************************************************************
	 	 //recupère tous épisodes publié
	 	 public function getAllEpisodePublish()
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_EPI.' WHERE showEpisode = 1 ORDER BY id';
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }

//******************************************************************************************************************
	 	 		
	 	 public function getLastEpisode()
	 	 {
	 	 	$request = 'SELECT MAX(id) FROM '. self::TAB_EPI.' WHERE showEpisode = 1';
	 	 	$id = parent::addRequestSelect($request);

	 	 	return $id;
	 	 }
//******************************************************************************************************************
	 	 		
	 	 public function getLastEpisodeNoShow()
	 	 {
	 	 	$request = 'SELECT MAX(id) FROM '. self::TAB_EPI.'';
	 	 	$id = parent::addRequestSelect($request);

	 	 	return $id;
	 	 }
//*************************************************************************
	 	 public function getFirstEpisode()
	 	 {
	 	 	$request = 'SELECT MIN(id) FROM '. self::TAB_EPI.' WHERE showEpisode = 1';
	 	 	$id = parent::addRequestSelect($request);

	 	 	return $id;
	 	 }

 //*****************************************************************************************************************
	 	 //recupère les $nbr dernier épisode ajoutés
	 	 public function getChoiseNbr($nbr)
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_EPI.' WHERE showEpisode = 1 ORDER BY id DESC LIMIT 0,'.$nbr.' ';
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }

//******************************************************************************************************************
	 	//actualise un épisode
	 	 public function update(Episode $episode)
	 	 {
	 	 	$param1 = $episode->getEpisode();
		    $param2 = $episode->getTitle();
		    $param3 = $episode->getId();

	 	 	$request = 'UPDATE '. self::TAB_EPI.' SET title = '.$param2.', episode = '.$param1.', dataChange = NOW() WHERE id = '.$param3.'';
//echo $request;
	 	 	parent::addRequest($request);
	 	 }
//******************************************************************************************************************
	 	//actualise un épisode
	 	 public function updatePublish($idEpisode)
	 	 {
	 	 	$request = 'UPDATE '. self::TAB_EPI.' SET showEpisode = 1 , dataChange = NOW() WHERE id = '.$idEpisode.'';
//echo $request;
	 	 	parent::addRequest($request);
	 	 }


//******************************************************************************************************************
	 	 //supprime un episode (quand l'admin est pas content)
	 	 public function delete($param)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_EPI.' WHERE id = '.$param.'';
//echo $request;
	 	 	parent::addRequest($request);
	 	 }

//******************************************************************************************************************
	 	 //compte le nombre d'entrée dans la table
	 	 public function countEntries()
	 	 {
	 	 	$request = 'SELECT COUNT(id) FROM '. self::TAB_EPI.'';
	 	 	$res = parent::countEntrie($request);
	 	 	return $res;
	 	 }


		


	}



?>