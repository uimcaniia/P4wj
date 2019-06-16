<?php

class AuthorManager extends bdd{

	// CONSTANTES

		const TAB_AUT = 'Author'; // nom de la table


 //*****************************************************************************************************************
	 	 //recupère la biographie
	 	 public function get()
	 	 { 
	 	 	$request = 'SELECT * FROM '. self::TAB_AUT.' WHERE id  = 1';
	 	 	$aRes = parent::addRequestSelect($request);
	 	 	return $aRes;

	 	 }


//******************************************************************************************************************
	 	//actualise la biographie
	 	 public function update(Author $author)
	 	 {
	 	 	$param = $author->getText();

	 	 	$request = 'UPDATE '. self::TAB_AUT.' SET text = :param WHERE id = 1';
	 	 	$arr=array(
	 	 		array(":param", $param));
	 	 	$aRes = parent::reqPrepaExec($request, $arr);
	 	 }
}