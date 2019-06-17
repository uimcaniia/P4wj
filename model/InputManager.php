<?php

class InputManager extends Bdd{

	// CONSTANTES

		const TAB_INP = 'input'; // nom de la table

 //*****************************************************************************************************************
	 	 //recupère les entrée de la table input suivant l'id
	 	 public function get($input)
	 	 { 
	 	 	$request = 'SELECT * FROM '. self::TAB_INP.' WHERE id  = :input ';
	 	 	$arr=array(
	 	 		array(":input"  , $input));
	 	 	$aRes = parent::reqPrepaExecSEl($request, $arr);
	 	 	return $aRes; 	 	
	 	 }
	}
