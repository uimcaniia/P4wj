<?php

class AdminManager extends bdd{

	// CONSTANTES

		const TAB_USER = 'user'; // nom de la table

//******************************************************************************************************************
	 	 //ajoute un utilisateur
	 	 public function add(User $user){

		    $param2 = $user->getEmail();
		    $param3 = $user->getPseudo();
		    $param4 = $user->getPsw();
		    $param5 = $user->getAdmin();

	 	 	$request = 'INSERT INTO '. self::TAB_USER.'(inscription, email, pseudo, psw, admin) VALUES (NOW(), '.$param2.', '.$param3.', '.$param4.', '.$param5.')';

	 	 	parent::addRequest($request);

	 	 }

 //*****************************************************************************************************************
	 	 //lit une entrée de la table user en comparant un paramètre et une valeur
	 	 public function get($param, $value)
	 	 { 

		 	 $request = 'SELECT * FROM '. self::TAB_USER.' WHERE '.$param.'  = "'.$value.'" ';
		 	 $aRes = parent::addRequestSelect($request);
		 	 if($aRes == NULL)
		 	 {
		 	 	return false;
		 	 }else
		 	 {
		 	 	return $aRes;
		 	 }
	 	 	
	 	 }

//******************************************************************************************************************
	 	//actualise une infos d'un utilisateur
	 	 public function update($col, $data, $idUser){

	 	 	$request = 'UPDATE '. self::TAB_USER.' SET '.$col.' = "'.$data.'" WHERE id = '.$idUser.'';
//echo $request;
	 	 	parent::addRequest($request);
	 	 }


//******************************************************************************************************************
	 	 //supprime un utilisateur (quand l'admin est pas content)
	 	 public function delete(User $user){

	 	 	$param = $user->getId();
	 	 	
	 	 	$request = 'DELETE FROM '. self::TAB_USER.' WHERE id = '.$param.'';

	 	 	parent::addRequest($request);
	 	 }


		


	}



?>