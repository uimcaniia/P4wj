<?php

class ReplyManager extends Bdd{

	// CONSTANTES

		const TAB_REP = 'reply'; // nom de la table

//******************************************************************************************************************
	 	 //ajoute un reply
	 	 public function add(Reply $reply)
	 	 {
	 	 	$param1 = $reply->getReply();
		    $param3 = $reply->getIdcomment_reply();
		    $param4 = $reply->getId_episode();
		    $param5 = $reply->getIduser_reply();

	 	 	$request = 'INSERT INTO '. self::TAB_REP.'(reply, dateReply, idcomment_reply, id_episode, iduser_reply, reporting_reply) VALUES (:reply, NOW(), :idcomreply , :idEpisode, :idUser, 0)';
	 	 	$arr=array(
	 	 		array(":reply"  , $param1),
	 	 		array(":idcomreply"  , $param3),
	 	 		array(":idEpisode"  , $param4),
	 	 		array(":idUser", $param5));
	 	 	parent::reqPrepaExec($request,$arr);
	 	 }

	//*************************************************************************
	 	 public function getLastReply()
	 	 {
	 	 	$request = 'SELECT MAX(id) FROM '. self::TAB_REP.'';
	 	 	$id = parent::addRequestSelect($request);

	 	 	$request2 ='SELECT a.*, b.pseudo 
	 	 			   FROM '.self::TAB_REP.' AS a 
	 	 			   INNER JOIN user AS b 
	 	 			   ON b.id = a.iduser_reply 
	 	 			   WHERE a.id = '.$id[0]['MAX(id)'].'';
//echo $request2;
	 	 	$aRes = parent::addRequestSelect($request2);
	 	 	return $aRes;
	 	 }

 //*****************************************************************************************************************
	 	 //recupère les entrée de la table reply suivant l'id'
	 	 public function get($reply)
	 	 { 
	 	 	$request = 'SELECT * FROM '. self::TAB_REP.' WHERE id  = :idep';
	 	 	$arr=array(
	 	 		array(":idep", $reply, PDO::PARAM_INT));
	 	 	$aRes = parent::reqPrepaExecSEl($request, $arr);
	 	 	return $aRes;

	 	 }
//******************************************************************************************************************
	 	 //recupère tous reply de la table
	 	 public function getAllReply()
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_REP.' ORDER BY dateReply';
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }

//************************************************************************
	 	 //recupère tous commentaires en function de l'épisode dans un ordre définit avec jointure vers autre table
	 	 public function getAllReplyOrderJoin($colSelect, $idSelect, $ordre, $tableJoin, $col, $colJoin, $colRecup)
	 	 {
	 	 	$request ='SELECT a.*, b.'. $colRecup.' 
	 	 			   FROM '.self::TAB_REP.' AS a 
	 	 			   INNER JOIN '.$tableJoin.' AS b 
	 	 			   ON b.'.$colJoin.' = a.'.$col.' 
	 	 			   WHERE a.'.$colSelect.' = :idSelect 
	 	 			   ORDER BY '.$ordre.'';
	 	 	$arr=array(
	 	 		array(":idSelect", $idSelect));
	 	 	$aRes = parent::reqPrepaExecSEl($request, $arr);
	 	 	return $aRes;
	 	 }


//******************************************************************************************************************
	 	 //recupère toutes les réponses signalées en function d'une sélection avec jointure
	 	 public function getAllReplySignalSelectJoin($colSelect, $idSelect, $tableJoin, $col, $colJoin, $colRecup)
	 	 {
		 	$request ='SELECT a.*, b.'. $colRecup.' 
				   FROM '.self::TAB_REP.' AS a 
				   INNER JOIN '.$tableJoin.' AS b 
				   ON b.'.$colJoin.' = a.'.$col.' 
				   WHERE a.'.$colSelect.' = :idSelect AND a.reporting_reply = 1';

		 	 $arr=array(
		 	 	array(":idSelect" , $idSelect),
	 	 		array(":idSelect" , $idSelect));
		 	 $aRes = parent::reqPrepaExecSEl($request, $arr);
		 	 return $aRes;
	 	 }

		//******************************************************************************************************************
	 	 //recupère tous reply signalé et dans un ordre prédéfinit
	 	 public function getAllReplySignal()
	 	 {
	 	 	$request = 'SELECT * FROM '. self::TAB_REP.' WHERE reporting_reply = 1 ORDER BY CAST(idcomment_reply AS unsigned)';
	 	 	$aRes = parent::addRequestSelect($request);
	 	 	return $aRes;
	 	 }
		//******************************************************************************************************************
	 	 //supprime un reply (quand l'admin est pas content)
	 	 public function delete($idReply)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_REP.' WHERE id = :idReply';
	 	 	$arr=array(
	 	 		array(":idReply" , $idReply));
	 	 	$aRes = parent::reqPrepaExec($request, $arr);
	 	 }
	 	 //******************************************************************************************************************
	 	 //supprime les réponse d'un commentaire supprimé (quand l'admin est super pas content)
	 	 public function deleteByComment($idComment)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_REP.' WHERE idcomment_reply = :idComment';
	 	 	$arr=array(
	 	 		array(":idComment" , $idComment));
	 	 	$aRes = parent::reqPrepaExec($request, $arr);
	 	 }
	 	 //******************************************************************************************************************
	 	 //supprime les réponse d'un commentaire supprimé (quand l'admin est super pas content)
	 	 public function deleteByEpisode($idEpisode)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_REP.' WHERE id_episode = :idEpisode';
	 	 	$arr=array(
	 	 		array(":idEpisode" , $idEpisode));
	 	 	$aRes = parent::reqPrepaExec($request, $arr);
	 	 }

 //******************************************************************************************************************
	 	 //recupère tous reply signalé en function d'une valeur 
	 	 public function getAllReplySelect($col, $val)
	 	 {
		 	 $request = 'SELECT * FROM '. self::TAB_REP.' WHERE '.$col.' = :val';
		 	 $arr=array(
	 	 		array(":val" , $val));
		 	 $aRes = parent::reqPrepaExecSEl($request, $arr);
		 	 return $aRes;
	 	 }

//******************************************************************************************************************
	 	 //recupère tous reply d'un commentaire
	 	 public function getAllReplyComment($reply)
	 	 {
		 	 $request = 'SELECT * FROM '. self::TAB_REP.' WHERE idcomment_reply = :reply ORDER BY dateReply';
		 	 $arr=array(
	 	 		array(":reply" , $reply));
		 	 $aRes = parent::reqPrepaExecSEl($request, $arr);
		 	 return $aRes;
	 	 }

	 	  //******************************************************************************************************************
	 	 //recupère tous reply signalé en function d'une valeur 
	 	 public function getAllReplySignalSelect($col, $val)
	 	 {
	 	 	$request = 'SELECT * FROM '. self::TAB_REP.' WHERE reporting_reply = 1  AND '.$col.' = :val';
	 	 	$arr=array(
 	 			array(":val" , $val));
	 		$aRes = parent::reqPrepaExecSEl($request, $arr);
	 	 	return $aRes;
	 	 }

//******************************************************************************************************************
	 	 //compte le nombre d'entrée dans la table
	 	 public function countEntries()
	 	 {
	 	 	$request = 'SELECT COUNT(id) FROM '. self::TAB_REP.'';
	 	 	$res = parent::countEntrie($request);
	 	 	return $res;
	 	 }

//******************************************************************************************************************
	 	//actualise le signalement d'un reply
	 	 public function update($reply, $report){

	 	 	$request = 'UPDATE '. self::TAB_REP.' SET reporting_reply = :report WHERE id = :reply';
	 	 	$arr=array(
	 	 		array(":reply" , $reply),
	 	 		array(":report" , $report));
	 	 	$aRes = parent::reqPrepaExec($request, $arr);
	 	 }

	}
