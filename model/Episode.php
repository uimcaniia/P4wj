<?php

	class Episode extends EpisodeManager {



		// CONSTANTES
		const ID    = 'id';          // Nom de la colonne id de la table locale
		const EP    = 'episode'; // texte de l'épisode 
		const TI    = 'title';     // titre de l'épisode 
		const PU    = 'publication';   // date de la publication 
		const CH    = 'change';   // date de la dernière modification 	 
		
		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
		 private $_id;
	  	 private $_episode;
		 private $_title;
	  	 private $_publication;
	 	 private $_dataChange;
	 	 private $_checkIdentite;

		// **************************************************
		// Methode
		// **************************************************

	 	 public function getDataToHydrate($intIdEpisode)
	 	 {
	 	 	if((is_int($intIdEpisode)) && ($intIdEpisode>0)){
	 	 		$aData = parent::get($intIdEpisode);
	 	 		self::hydrate($aData);
	 	 	}else
	 	 	{
	 	 		echo 'le chapitre '.$intIdEpisode.' n\'existe pas'; 
	 	 	}
	 	 }

	 	 public function hydrate($aData)
	 	 {

	 	 	if($aData != false)
	 	 	{
	 	 		$this->setCheckIdentite(true);
		 	 	foreach ($aData[0] as $key => $value)
		 	 	{

		 	 		 // On récupère le nom du setter correspondant à l'attribut en mettant sa première lettre en majuscule. 
		 	 		$method = 'set'.ucfirst($key);

		 	 		if(method_exists($this, $method))
		 	 		{

		 	 			$this->$method($value);
		 	 			
		 	 		}
		 	 	}
		 	}else
		 	{
		 	 	$this->setCheckIdentite(false);
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
		public function getEpisode()
		{
			return $this->_episode;
		}
		
		/** Retourne le titre de l'épisode */
		public function getTitle()
		{
			return $this->_title;
		}
		
		/** Retourne la date de la publication */
		public function getPublication()
		{
			return $this->_publication;
		}
		
		/** Retourne la date de mise à jour */
		public function getDataChange()
		{
			return $this->_dataChange;
		}

		/** Retourne true ou false, si l'épisode existe ou pas */
		public function getCheckIdentite()
		{
			return $this->_checkIdentite;
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
		public function setEpisode($episode)
		{
			$this->_episode = $episode;

		}
		
		/** Assigne le titre de l'épisode */
		public function setTitle($title)
		{
			$this->_title = $title;
		}
		
		/** Assigne la date de la publication */
		public function setPublication($publication)
		{
			$this->_publication = $publication;
		}
		
		/** Assigne la date de mise à jour */
		public function setDataChange($dataChange)
		{
			$this->_dataChange = $dataChange;
		}

		/** Assigne true ou false, si l'épisode existe ou pas */
		public function setCheckIdentite($checkIdentite)
		{
			if(is_bool($checkIdentite)) 
			{
				$this->_checkIdentite = $checkIdentite;
			}
		}
		
	}
	
?>