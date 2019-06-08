<?php

class MessageManager extends bdd{

	// CONSTANTES

		const TAB_MESS = 'message'; // nom de la table

//******************************************************************************************************************
	 	 //ajoute un message
	 	 public function add(Message $message)
	 	 {
	 	 	$param1 = $message->getSend();
		    $param2 = $message->getReceive();
		    $param3 = $message->getSubject();
		    $param4 = $message->getText();

	 	 	$request = 'INSERT INTO '. self::TAB_MESS.'(send, receive, subject, text, date) VALUES ('.$param1.', '.$param2.', '.$param3.' , '.$param4.', NOW())';
	 	 	echo $request;
	 	 	parent::addRequest($request);
	 	 }

 //*****************************************************************************************************************
	 	 //recupère les entrée de la table 
	 	 public function get($col, $val)
	 	 { 
	 	 	$request = 'SELECT * FROM '. self::TAB_MESS.' WHERE '.$col.' = '.$val.' ORDER BY id';
	 	 	//echo $request;
	 	 	$aRes = parent::addRequestSelect($request);
	 	 	return $aRes;
	 	 }
 //*****************************************************************************************************************
	 	 //recupère le derniers messages postés
	 	 public function getLastMessage()
	 	 { 
	 	 	$request = 'SELECT LAST_INSERT_ID(id) FROM '. self::TAB_MESS.'';
	 	 	//echo $request;
	 	 	$aRes = parent::addRequestSelect($request);
	 	 	return $aRes;
	 	 }

//******************************************************************************************************************
	 	 //supprime un message
	 	 public function delete($id)
	 	 {
	 	 	$request = 'DELETE FROM '. self::TAB_MESS.' WHERE id = '.$id.'';
	 	 	parent::addRequest($request);
	 	 }

//******************************************************************************************************************
	 	 //compte le nombre d'entrée dans la table
	 	 public function countEntries()
	 	 {
	 	 	$request = 'SELECT COUNT(id) FROM '. self::TAB_MESS.'';
	 	 	$res = parent::countEntrie($request);
	 	 	return $res;
	 	 }


		


	}



?>