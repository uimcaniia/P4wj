<?php

class Bdd{

/*private $_serveur = "localhost";
private $_base = "coan3607_jean_forteroche";
private $_psw = "T0t0r0";
private $_user = "root";*/

private $_serveur = "localhost";
private $_base = "coan3607_jean_forteroche";
private $_psw = "Ez8BgfPF-8-d";
private $_user = "coan3607";

static protected $bdd = null;

//***********************************************************************************************************************
	static protected function getConnexion()
	{
		try
		{
/*			self::$bdd = new PDO('mysql:host=wave;dbname=coan3607_jean_forteroche;charset=utf8', 'coan3607', 'Ez8BgfPF-8-d', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));*/
			self::$bdd = new PDO('mysql:host=localhost;dbname=coan3607_jean_forteroche;charset=utf8', 'root', 'T0t0r0', array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION));
			return self::$bdd;
		}
		catch (Exception $e)
		{
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
		if(!empty($res)) // on vérifie si un résultat est retournée
		{
			return $res;
		}
		else
		{
			return false;
			$res=array();
		}
		$rep->closeCursor(); // Termine le traitement de la requête
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

//**********************************************************************************************
	// Exécute une requête type (SELECT) préparée et renvoie le resultat ou false si rien 
	// $aParam => array contenant les paramètre de $request sou la forme : array(':id', $value);
	public function reqPrepaExecSEl($request, $aParam)
	{
		//echo $request;
		$res=array();
		$bdd = self::getConnexion();
		$req = $bdd->prepare($request);
		for($i = 0 ; $i < count($aParam) ; $i++)
		{
			if(isset($aParam[$i][2]))
			{
				$req -> bindValue($aParam[$i][0], $aParam[$i][1], $aParam[$i][2]);
			}
			else
			{
				$req -> bindValue($aParam[$i][0], $aParam[$i][1]);
			}			
		}
		$req -> execute();
		
		$res = $req->fetchAll(PDO::FETCH_ASSOC);
		if(!empty($res)) // on vérifie si un résultat est retournée
		{
			return $res;
		}
		else
		{
			return false;
			$res=array();
		}
			    	
		$req->closeCursor(); // Termine le traitement de la requête
	}
//**********************************************************************************************
	// Exécute une requête (INSERT) préparée et renvoie le resultat ou false si rien 
	// $aParam => array contenant les paramètre de $request sou la forme : array(':id', $value);
	public function reqPrepaExec($request, $aParam)
	{
		$res=array();
		$bdd = self::getConnexion();
		$req = $bdd->prepare($request);
		for($i = 0 ; $i < count($aParam) ; $i++)
		{
			$req -> bindValue($aParam[$i][0], $aParam[$i][1]);
		}
		$req -> execute();
				    	
		$req->closeCursor(); // Termine le traitement de la requête

	}
}


