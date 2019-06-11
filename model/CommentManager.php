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

		//*************************************************************************
	 	 public function getLastComment()
	 	 {
	 	 	$request = 'SELECT MAX(id) FROM '. self::TAB_COM.'';
	 	 	$id = parent::addRequestSelect($request);

	 	 	//$request2 = 'SELECT * FROM '. self::TAB_COM.' WHERE id = '.$id.'';
	 	 	$request2 ='SELECT a.*, b.pseudo 
	 	 			   FROM '.self::TAB_COM.' AS a 
	 	 			   INNER JOIN user AS b 
	 	 			   ON b.id = a.idUser 
	 	 			   WHERE a.id = '.$id[0]['MAX(id)'].'';
//echo $request2;
	 	 	$aRes = parent::addRequestSelect($request2);
	 	 	return $aRes;
	 	 }
	 	 //******************************************************************************************************************
	 	 //recupère tous commentaires en function de l'épisode dans un ordre définit
	 	 public function getAllCommentOrder($idEpisode, $ordre)
	 	 {
	 	 	$request = 'SELECT * FROM '. self::TAB_COM.' WHERE idEpisode = '.$idEpisode.' ORDER BY '.$ordre.'';
	 	 	echo $request;
	 	 	$aRes = parent::addRequestSelect($request);
	 	 	return $aRes;
	 	 }

	 	//******************************************************************************************************************
	 	 //recupère tous commentaires 
	 	 public function getAllComment()
	 	 {
	 	 	$request = 'SELECT * FROM '. self::TAB_COM.'';
	 	 	$aRes = parent::addRequestSelect($request);
	 	 	return $aRes;
	 	 }

	 	  //******************************************************************************************************************
	 	 //recupère tous commentaires en function d'une selection dans un ordre définit avec jointure vers autre table
	 	 public function getAllCommentOrderJoin($colSelect, $idSelect, $ordre, $tableJoin, $col, $colJoin, $colRecup)
	 	 {
	 	 	$request ='SELECT a.*, b.'. $colRecup.' 
	 	 			   FROM '.self::TAB_COM.' AS a 
	 	 			   INNER JOIN '.$tableJoin.' AS b 
	 	 			   ON b.'.$colJoin.' = a.'.$col.' 
	 	 			   WHERE a.'.$colSelect.' = '.$idSelect.' 
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
	 	 //recupère tous commentaires signalé en function d'une sélection avec jointure dans un ordre
	 	 public function getAllCommentSignalSelectJoin($colSelect, $idSelect, $tableJoin, $col, $colJoin, $colRecup)
	 	 {
		 	$request ='SELECT a.*, b.'. $colRecup.' 
				   FROM '.self::TAB_COM.' AS a 
				   INNER JOIN '.$tableJoin.' AS b 
				   ON b.'.$colJoin.' = a.'.$col.' 
				   WHERE a.'.$colSelect.' = '.$idSelect.' AND a.reporting = 1 
				   ORDER BY CAST(idEpisode AS unsigned)';

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
	 	 //supprime un comment (quand l'admin est pas content)
	 	 public function delete($idComment)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_COM.' WHERE id = '.$idComment.'';
	 	 	parent::addRequest($request);
	 	 }
	 	 //******************************************************************************************************************
	 	 //supprime les commentaires en fonction de l'épisode (quand celui-ci se fait supprimer)
	 	 public function deleteByEpisode($idEpisode)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_COM.' WHERE idEpisode = '.$idEpisode.'';
	 	 	parent::addRequest($request);
	 	 }

	 	 //******************************************************************************************************************
	 	//actualise le signalement d'un commentaire
	 	 public function update($idComment, $report){

	 	 	$request = 'UPDATE '. self::TAB_COM.' SET reporting = '.$report.' WHERE id = '.$idComment.'';
		echo $request;
	 	 	parent::addRequest($request);
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
	 	 //compte le nombre d'entrée dans la table
	 	 public function countEntries()
	 	 {
	 	 	$request = 'SELECT COUNT(id) FROM '. self::TAB_COM.'';
	 	 	$res = parent::countEntrie($request);
	 	 	return $res;
	 	 }


		


	}



?>