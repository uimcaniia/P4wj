<?php

class CommentManager extends bdd{

	// CONSTANTES

		const TAB_COM = 'comment'; // nom de la table

//******************************************************************************************************************
	 	 //ajoute un comment
	 	 public function add(Comment $comment)
	 	 {
		    $param2 = $comment->getComment();
		    $param3 = $comment->getIdEpisode();
		    $param5 = $comment->getIdUser();

	 	 	$request = 'INSERT INTO '. self::TAB_COM.'(commentTime, comment, idEpisode, reporting, idUser) VALUES (NOW(), '.$param2.', '.$param3.' , 0, '.$param5.')';

	 	 	parent::addRequest($request);
	 	 }


	 	 //******************************************************************************************************************
	 	 //recupère tous commentaires en function de l'épisode dans un ordre définit
	 	 public function getAllCommentOrder($idEpisode, $ordre)
	 	 {
	 	 	$request = 'SELECT * FROM '. self::TAB_COM.' WHERE idEpisode = '.$idEpisode.' ORDER BY '.$ordre.'';
	 	 	$aRes = parent::addRequestSelect($request);
	 	 	return $aRes;
	 	 }

	 	  //******************************************************************************************************************
	 	 //recupère tous commentaires en function de l'épisode dans un ordre définit avec jointure vers autre table
	 	 public function getAllCommentOrderJoin($idEpisode, $ordre, $tableJoin, $col, $colJoin, $colRecup)
	 	 {
	 	 	$request ='SELECT a.*, b.'. $colRecup.' 
	 	 			   FROM '.self::TAB_COM.' AS a 
	 	 			   INNER JOIN '.$tableJoin.' AS b 
	 	 			   ON b.'.$colJoin.' = a.'.$col.' 
	 	 			   WHERE a.idEpisode = '.$idEpisode.' 
	 	 			   ORDER BY '.$ordre.'';
	 	 	//echo $request;
	 	 	$aRes = parent::addRequestSelect($request);
	 	 	return $aRes;
	 	 }













//******************************************************************************************************************
	 	 //recupère tous commentaires en function d'une valeur et dans un ordre prédéfinit
	 	 public function getAllCommentSelect($col, $val)
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_COM.' WHERE '.$col.' = '.$val.' ORDER BY commentTime';
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }

 //******************************************************************************************************************
	 	 //recupère tous commentaires signalé et dans un ordre prédéfinit
	 	 public function getAllCommentSignal()
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_COM.' WHERE reporting = 1 ORDER BY CAST(idEpisode AS unsigned)';
		 	 	//echo $request;
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }
	 	  //******************************************************************************************************************
	 	 //recupère tous commentaires signalé en function d'une valeur 
	 	 public function getAllCommentSignalSelect($col, $val)
	 	 {
		 	 	$request = 'SELECT * FROM '. self::TAB_COM.' WHERE reporting = 1  AND '.$col.' = '.$val.' ORDER BY CAST(idEpisode AS unsigned)';
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	return $aRes;
	 	 }



//******************************************************************************************************************
	 	//actualise le signalement d'un commentaire
	 	 public function update($idComment){

	 	 	$request = 'UPDATE '. self::TAB_COM.' SET reporting = 1 WHERE id = '.$idComment.'';
//echo $request;
	 	 	parent::addRequest($request);
	 	 }

//******************************************************************************************************************
	 	 //supprime un comment (quand l'admin est pas content)
	 	 public function delete(Comment $comment)
	 	 {

	 	 	$param = $comment->getId();

	 	 	$request = 'DELETE FROM '. self::TAB_COM.' WHERE id = '.$param.'';

	 	 	parent::addRequest($request);
	 	 }

//******************************************************************************************************************
	 	 //compte le nombre d'entrée dans la table
	 	 public function countEntries()
	 	 {
	 	 	$request = 'SELECT COUNT(id) FROM '. self::TAB_COM.'';
	 	 	$res = parent::countEntrie($request);
	 	 	return $res;
	 	 }


		


	}



?>