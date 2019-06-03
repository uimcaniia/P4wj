<?php

	class Icon extends Bdd {



		// CONSTANTES
		const TAB_ICO = 'icon'; // nom de la table

		const ID = 'id';     // Nom de la colonne id de la table locale
		const CL = 'classe'; // texte de l'épisode 
		const NA = 'name';   // titre de l'épisode 
	 
		
		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
		 private $_id;
	  	 private $_classe;
		 private $_name;


		// **************************************************
		// Methode
		// **************************************************

	 	 public function getDataToHydrate($idIcon)
	 	 {
	 	 	if(is_int($idIcon)){
		 	 	$request = 'SELECT * FROM '. self::TAB_ICO.' WHERE id  = '.$idIcon.' ';
		 	 	$aRes = parent::addRequestSelect($request);
		 	 	self::hydrate($aRes);
	 	 	}
	 	 }

	 	 public function hydrate($aData)
	 	 {
	 	 	//print_r($aData);
	 	 	foreach ($aData[0] as $key => $value)
	 	 	{
	 	 		 // On récupère le nom du setter correspondant à l'attribut en mettant sa première lettre en majuscule. 
	 	 		$method = 'set'.ucfirst($key);
	 	 		if(method_exists($this, $method))
	 	 		{
	 	 			$this->$method($value);
	 	 		}
	 	 	}
	 	 }


		// **************************************************
		// GETTERS
		// **************************************************
		
		/** Retourne l'ID' de l'item */
		public function getId()
		{
			return $this->_id;
		}
		
		/** Retourne le texte de l'épisode */
		public function getClasse()
		{
			return $this->_classe;
		}
		
		/** Retourne le titre de l'épisode */
		public function getName()
		{
			return $this->_name;
		}
				
		// **************************************************
		// SETTERS
		// **************************************************

		/** Assigne l'ID' de l'item */
		public function setId($id)
		{
			$id = (int) $id;
			$this->_id = $id;
		}
		
		/** Assigne le texte de l'épisode */
		public function setClasse($classe)
		{
			if(is_string($classe)) {
				htmlspecialchars($classe);
				$this->_classe = $classe;
			}
		}
		
		/** Assigne le titre de l'épisode */
		public function setName($name)
		{
			if(is_string($name)) {
				htmlspecialchars($name);
				$this->_name = $name;
			}
		}
		
	}
	
?>