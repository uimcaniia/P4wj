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
	 	 	echo $request;
	 	 	parent::addRequest($request);
	 	 	//return $request;
	 	 }

 //*****************************************************************************************************************
	 	 //recupère les entrée de la table episode suivant l'épisode
	 	 public function get($episode)
	 	 { 
	 	 	$request = 'SELECT * FROM '. self::TAB_EPI.' WHERE id  = '.$episode.' ';
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

 //*****************************************************************************************************************
	 	 //recupère les $nbr dernier épisode ajoutés
	 	 public function getChoiseNbr($nbr)
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_EPI.' ORDER BY id DESC LIMIT 0,'.$nbr.' ';
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }

//******************************************************************************************************************
	 	//actualise un épisode
	 	 public function update($title, $txt, $idEpisode){

	 	 	$request = 'UPDATE '. self::TAB_EPI.' SET title = "'.$title.'", episode = "'.$txt.'", dataChange = NOW() WHERE id = '.$idEpisode.'';
echo $request;
	 	 	parent::addRequest($request);
	 	 }

//******************************************************************************************************************
	 	 //supprime un episode (quand l'admin est pas content)
	 	 public function delete($param)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_EPI.' WHERE id = '.$param.'';
echo $request;
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