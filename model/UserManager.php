<?php

class UserManager extends Bdd{

	// CONSTANTES
		const TAB_USER = 'user'; // nom de la table

//******************************************************************************************************************
	 	 //ajoute un utilisateur
	 	 public function add(User $user)
	 	 {
		    $param2 = $user->getEmail();
		    $param3 = $user->getPseudo();
		    $param4 = $user->getPsw();
		    $param5 = $user->getAdmin();

	 	 	$request = 'INSERT INTO '. self::TAB_USER.'(inscription, email, pseudo, psw, admin) VALUES (NOW(), :mail, :pseudo, :psw, :admin)';
	 	 	$arr=array(
	 	 		array(":mail"  , $param2),
	 	 		array(":pseudo"  , $param3),
	 	 		array(":psw"  , $param4),
	 	 		array(":admin", $param5));
	 	 	parent::reqPrepaExec($request,$arr);
	 	 }

 //*****************************************************************************************************************
	 	 //lit une entrée de la table user en comparant un paramètre et une valeur
	 	 public function get($param, $value)
	 	 { 
		 	$request = 'SELECT * FROM '. self::TAB_USER.' WHERE '.$param.'  = :value ';
		 	$arr=array(
	 	 		array(":value" , $value));
		 	$aRes = parent::reqPrepaExecSEl($request, $arr);
		 	return $aRes;
	 	 }


//******************************************************************************************************************
	 	 //recupère tous utilisateur sauf l'admin
	 	 public function getAllUser()
	 	 {
		 	 $request = 'SELECT * FROM '. self::TAB_USER.' WHERE admin = 0 ORDER BY id';
		 	 $arr=array(
	 	 		array(":val" , $val));
		 	 $aRes = parent::reqPrepaExecSEl($request, $arr);
		 	 	return $aRes;
	 	 }
//******************************************************************************************************************
	 	 //recupère tous utilisateur sauf l'admin et les compte supprimé
	 	 public function getAllUserExist()
	 	 {
		 	$request = 'SELECT * FROM '. self::TAB_USER.' WHERE admin = 0 AND deleteUser = 0 ORDER BY id';
		 	$aRes = parent::addRequestSelect($request);
		 	return $aRes; 
	 	 }

//******************************************************************************************************************
	 	//actualise une infos d'un utilisateur
	 	 public function update($col, $data, $idUser)
	 	 {
	 	 	$request = 'UPDATE '. self::TAB_USER.' SET '.$col.' = :data WHERE id = :idUser';
	 	 	$arr=array(
	 	 		array(":data" , $data),
	 	 		array(":idUser" , $idUser));
	 	 	$aRes = parent::reqPrepaExec($request, $arr);
	 	 }


//******************************************************************************************************************
	 	 //supprime un utilisateur (quand l'admin est pas content)
	 	 public function delete(User $user)
	 	 {
	 	 	$param = $user->getId();
	 	 	$request = 'DELETE FROM '. self::TAB_USER.' WHERE id = :param';
	 	 	$arr=array(
	 	 		array(":param" , $param));
	 	 	$aRes = parent::reqPrepaExec($request, $arr);
	 	 }

	}

