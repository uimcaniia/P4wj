<?php

class ReplyManager extends bdd{

	// CONSTANTES

		const TAB_REP = 'reply'; // nom de la table

//******************************************************************************************************************
	 	 //ajoute un reply
	 	 public function add(Reply $reply)
	 	 {
	 	 	$param1 = $reply->getReply();
		    $param2 = $reply->getDateReply();
		    $param3 = $reply->getIdComment_reply();
		    $param4 = $reply->getIduser_reply();
		    $param5 = $reply->getReporting_reply();
		    $param6 = $reply->getId_episode();

	 	 	$request = 'INSERT INTO '. self::TAB_REP.'(reply , dateReply, idcomment_reply, id_episode, iduser_reply, reporting_reply) VALUES ('.$param1.', '.$param2.', '.$param3.' , '.$param4.', , '.$param5.')';

	 	 	parent::addRequest($request);
	 	 }

 //*****************************************************************************************************************
	 	 //recupère les entrée de la table reply suivant l'id'
	 	 public function get($reply)
	 	 { 
		 	 	$request = 'SELECT * FROM '. self::TAB_REP.' WHERE id  = '.$reply.' ';
		 	 	$aRes = parent::addRequestSelect($request);
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
	 	 			   WHERE a.'.$colSelect.' = '.$idSelect.' 
	 	 			   ORDER BY '.$ordre.'';
	 	 	//echo $request;
	 	 	$aRes = parent::addRequestSelect($request);
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
				   WHERE a.'.$colSelect.' = '.$idSelect.' AND a.reporting_reply = 1';

		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }

		//******************************************************************************************************************
	 	 //recupère tous reply signalé et dans un ordre prédéfinit
	 	 public function getAllReplySignal()
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_REP.' WHERE reporting_reply = 1 ORDER BY CAST(idcomment_reply AS unsigned)';
		 	 	//echo $request;
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }
		//******************************************************************************************************************
	 	 //supprime un reply (quand l'admin est pas content)
	 	 public function delete($idReply)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_REP.' WHERE id = '.$idReply.'';
	 	 	parent::addRequest($request);
	 	 }
	 	 //******************************************************************************************************************
	 	 //supprime les réponse d'un commentaire supprimé (quand l'admin est super pas content)
	 	 public function deleteByComment($idComment)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_REP.' WHERE idcomment_reply = '.$idComment.'';
	 	 	parent::addRequest($request);
	 	 }
	 	 //******************************************************************************************************************
	 	 //supprime les réponse d'un commentaire supprimé (quand l'admin est super pas content)
	 	 public function deleteByEpisode($idEpisode)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_REP.' WHERE id_episode = '.$idEpisode.'';
	 	 	parent::addRequest($request);
	 	 }

 //******************************************************************************************************************
	 	 //recupère tous reply signalé en function d'une valeur 
	 	 public function getAllReplySelect($col, $val)
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_REP.' WHERE '.$col.' = '.$val.'';
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }















//******************************************************************************************************************
	 	 //recupère tous reply d'un commentaire
	 	 public function getAllReplyComment($reply)
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_REP.' WHERE idcomment_reply = '.$reply.' ORDER BY dateReply';
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }



	 	  //******************************************************************************************************************
	 	 //recupère tous reply signalé en function d'une valeur 
	 	 public function getAllReplySignalSelect($col, $val)
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_REP.' WHERE reporting_reply = 1  AND '.$col.' = '.$val.'';
		 	 	$aRes = parent::addRequestSelect($request);
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
	 	 public function update($reply){

	 	 	$request = 'UPDATE '. self::TAB_REP.' SET reporting_reply = 1 WHERE id = '.$reply.'';
//echo $request;
	 	 	parent::addRequest($request);
	 	 }

	}
