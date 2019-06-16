<?php

	class Author extends AuthorManager {


		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
		 private $_id;
	  	 private $_text;


		// **************************************************
		// Methode
		// **************************************************

	 	 public function getDataToHydrate($intIdEpisode)
	 	 {
	 	 	if((is_int($intIdEpisode)) && ($intIdEpisode>0)){
	 	 		$aData = parent::get($intIdEpisode);
	 	 		self::hydrate($aData);
	 	 	}
	 	 	else
	 	 	{
	 	 		throw new Exception('le chapitre '.$intIdEpisode.' n\'existe pas'); 
	 	 	}
	 	 }

	 	 public function hydrate($aData)
	 	 {
	 	 	if($aData != false)
	 	 	{
		 	 	foreach ($aData as $key => $value)
		 	 	{
		 	 		 // On récupère le nom du setter correspondant à l'attribut en mettant sa première lettre en majuscule. 
		 	 		$method = 'set'.ucfirst($key);
		 	 		if(method_exists($this, $method))
		 	 		{
		 	 			$this->$method($value);
		 	 		}
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
		
		/** Retourne le texte de la biographie */
		public function getText()
		{
			return $this->_text;
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
		
		/** Assigne le texte de la biographie  */
		public function setText($text)
		{
			if (is_string($text))
    		{
    			htmlspecialchars($text);
				$this->_text = $text;
			}
		}
		

		
	}
	
