<?php

class InputManager extends bdd{

	// CONSTANTES

		const TAB_INP = 'input'; // nom de la table


 //*****************************************************************************************************************
	 	 //recupère les entrée de la table input suivant l'id
	 	 public function get($input)
	 	 { 
	 	 	$request = 'SELECT * FROM '. self::TAB_INP.' WHERE id  = '.$input.' ';
	 	 	$aRes = parent::addRequestSelect($request);
	 	 	return $aRes; 	 	
	 	 }
	}
