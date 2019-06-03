<?php

class Bdd{

private $_serveur = SERVEUR;
private $_base = BASE;
private $_psw = MDP;
private $_user = USER;

static protected $bdd = null;

//***********************************************************************************************************************
	static protected function getConnexion()
	{
			try	{
			self::$bdd = new PDO('mysql:host=localhost;dbname=coan3607_jean_forteroche;charset=utf8', 'root', 'T0t0r0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			return self::$bdd;
		}
		catch (Exception $e) {
			die('erreur : '.$e->getMessage());
			return false;
		}
	}

//******************************************************************************************************************
	//Exécute une requête (INSERT INTO, UPDATE, DELETE)
	 public function addRequest($request)
	 {
		$bdd = self::getConnexion();

		$rep = $bdd->query($request);
		$rep->closeCursor(); // Termine le traitement de la requête
		return $rep;
	}

//**************************************************************************************************************
	//Exécute une requête et renvoie le resultat (SELECT)
	public function addRequestSelect($request)
	{
		$bdd = self::getConnexion();

		$rep = $bdd->query($request);
		$res = $rep->fetchALL(PDO::FETCH_ASSOC); //array qui contient champ par champ les valeurs 
		$rep->closeCursor(); // Termine le traitement de la requête
		return $res;
	}

//**********************************************************************************************************
	//Exécute une requête préparée (UPDATE)
	public function addRequestUpdate($request)
	{
		$bdd = self::getConnexion();

		$rep = $bdd->query($request);
		$rep->closeCursor(); // Termine le traitement de la requête
		
	}

//**************************************************************************************************************
	//Exécute une requête (INSERT INTO, UPDATE, DELETE)
	 public function countEntrie($request)
	 {
		$bdd = self::getConnexion();
		$rep = $bdd->query($request);
		$res = $rep->fetch();
		$rep->closeCursor(); // Termine le traitement de la requête
		return $res;
	}

}




