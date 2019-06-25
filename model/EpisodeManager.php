<?php

class EpisodeManager extends Bdd{

	// CONSTANTES
		const TAB_EPI = 'episode'; // nom de la table
//******************************************************************************************************************
	 	 //ajoute un episode
	 	 public function add(Episode $episode)
	 	 {
	 	 	$param1 = $episode->getEpisode();
		    $param2 = $episode->getTitle();

	 	 	$request = 'INSERT INTO '. self::TAB_EPI.'(publication, episode, title) VALUES (NOW(), :idEpisode, :title)';
	 	 	$arr=array(
	 	 		array(":idEpisode"  , $param1),
	 	 		array(":title", $param2));
	 	 	parent::reqPrepaExec($request,$arr);
	 	 }

//*****************************************************************************************************************
	 	 //recupère les entrée de la table episode suivant l'épisode
	 	 public function get($episode)
	 	 { 
	 	 	$request = 'SELECT * FROM '. self::TAB_EPI.' WHERE id  = :idep AND showEpisode = 1';
	 	 	$arr=array(
	 	 		array(":idep"  , $episode));
	 	 	$aRes = parent::reqPrepaExecSEl($request, $arr);
	 	 	return $aRes;
	 	 }
//*****************************************************************************************************************
	 	 //recupère les entrée de la table episode suivant l'épisode
	 	 public function getForModif($episode)
	 	 { 
	 	 	$request = 'SELECT * FROM '. self::TAB_EPI.' WHERE id  = :idep';
	 	 	$arr=array(
	 	 		array(":idep"  , $episode));
	 	 	$aRes = parent::reqPrepaExecSEl($request, $arr);
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
	 	 // récupère le dernier épisode publié
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
		 	$request = 'SELECT * FROM '. self::TAB_EPI.' WHERE showEpisode = 1 ORDER BY id DESC LIMIT 0, :nbr ';
		 	$arr=array(
	 	 		array(":nbr"  , $nbr, PDO::PARAM_INT));
		 	$aRes = parent::reqPrepaExecSEl($request, $arr);
		 	return $aRes;
	 	 }

//******************************************************************************************************************
	 	//actualise un épisode
	 	 public function update(Episode $episode)
	 	 {
	 	 	$param1 = $episode->getEpisode();
		    $param2 = $episode->getTitle();
		    $param3 = $episode->getId();

	 	 	$request = 'UPDATE '. self::TAB_EPI.' SET title = :title, episode = :episode, dataChange = NOW() WHERE id = :idEpisode';
		 	$arr=array(
		 		array(":episode" , $param1),
		 		array(":title" , $param2),
	 	 		array(":idEpisode" , $param3));
	 	 	$aRes = parent::reqPrepaExec($request, $arr);
	 	 }
//******************************************************************************************************************
	 	//actualise un épisode
	 	 public function updatePublish($idEpisode)
	 	 {
	 	 	$request = 'UPDATE '. self::TAB_EPI.' SET showEpisode = 1 , dataChange = NOW() WHERE id = :idEpisode';
		 	$arr=array(
	 	 		array(":idEpisode" , $idEpisode));
	 	 	$aRes = parent::reqPrepaExec($request, $arr);
	 	 }


//******************************************************************************************************************
	 	 //supprime un episode (quand l'admin est pas content)
	 	 public function delete($param)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_EPI.' WHERE id = :param';
	 	 	$arr=array(
	 	 		array(":param" , $param));
	 	 	$aRes = parent::reqPrepaExec($request, $arr);
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