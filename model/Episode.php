<?php

	class Episode extends EpisodeManager {

		// **************************************************
		// Constances de l'objet
		// **************************************************

		const EXTRACT = 430; // nbr de lettre à conserver pour un extrait d'épisode

		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
		 private $_id;
	  	 private $_episode;
		 private $_title;
	  	 private $_publication;
	 	 private $_dataChange;
	 	 private $_showEpisode;

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

	 	 //*********************************************
	 	 //récupère un épisode suivant son id
	 	 public function getOneEpisode($idEpisode)
	 	 {
	 	 	if(is_int($idEpisode)){
	 	 		$aData = parent::get($idEpisode);
	 	 	}
	 	 	else
	 	 	{
	 	 		throw new Exception('l\'identifiant n\'est pas un nombre'); 
	 	 	}
	 	 	return $aData;
	 	 }
	 	 //*********************************************
	 	 //récupère un certain nombre d'épisodes
	 	 public function getSomeEpisode($nbr)
	 	 {
	 	 	if(is_int($nbr)){
	 	 		$aData = parent::getChoiseNbr($nbr);
	 	 	}
	 	 	else
	 	 	{
	 	 		throw new Exception('La quantité n\'est pas un nombre'); 
	 	 	}
	 	 	return $aData;
	 	 }
	 	 //*********************************************
	 	 //récupère tous les épisodes
	 	 public function getAllEpisode()
	 	 {
	 	 	$aData = parent::getAllEpisode();
	 	 	return $aData;
	 	 }

	 	 //*********************************************
	 	 //génère un extrait du texte des épisodes
	 	 public function makeExtractEpisode($aData)
	 	 {
	 	 	for ($i = 0 ; $i < count($aData) ; $i++)
			{
				foreach ($aData[$i] as $key => $value)
				{
					if($key == 'episode')// on conserve un extrait du texte de l'épisode
					{
						$valueExtract = substr($value, 0, self::EXTRACT);  // on conserve que les premières lettres
						$aData[$i]['episode'] = $valueExtract;
						$aData[$i]['episode'] .= '...'; // on ajoute "..." à la fin de l'extrait
					}
				}
			}
			return $aData;
	 	 }
	 	 //*********************************************
	 	 //trouve l'identifiant du chpitre précédent à partir de l'id de l'épisode en cour
	 	 public function getPrevIdEpisode($id)
	 	 {
	 	 	if(is_int($id))
	 	 	{
	 	 		$minNum = parent::getFirstEpisode();
	 	 		$idFirstEpisode = $minNum[0]['MIN(id)'];
	 	 		//print_r($idFirstEpisode);

	 	 		if ($id != $idFirstEpisode) // si ce n'est pas le premier episode
				{
					$idPrev = $id - 1;
					for($idPrev ; $idPrev > 0 ; $idPrev--) // on cherche l'entrée avant (bouble)
					{
						$aChapitrePrev = self::getOneEpisode($idPrev); // on tente de charger l'épisode d'avant
						if($aChapitrePrev != false) //si on a un retour
						{
							$linkEpisodePrev = $idPrev;
							break;
						}
					}
					return $linkEpisodePrev;
				}
				
				else
				{
					return $linkEpisodeNext='';
				}
	 	 	}
	 	 	else
	 	 	{
	 	 		throw new Exception('L\'identifiant pour le lien précédent n\'est pas un nombre'); 
	 	 	}
	 	 }

	 	 //*********************************************
	 	 //trouve l'identifiant du chpitre suivant à partir de l'id de l'épisode en cour
	 	 public function getNextIdEpisode($id)
	 	 {
	 	 	if(is_int($id))
	 	 	{
	 	 		$maxNum = parent::getLastEpisode();
	 	 		$idLastEpisode = $maxNum[0]['MAX(id)'];
	 	 		//$nbrEpisode = $nbrEpisode +1;
	 	 		if ($id != $idLastEpisode) // si ce n'est pas le dernier episode
				{
					$idNext = $id + 1;
					for($idNext ; $idNext > 0 ; $idNext++) // on cherche l'entrée après (bouble)
					{
						$aChapitrePrev = self::getOneEpisode($idNext); // on tente de charger l'épisode d'après
						if($aChapitrePrev != false) //si on a un retour
						{
							$linkEpisodeNext = $idNext;
							break;
						}
					}
					return $linkEpisodeNext;
				}
				else
				{
					return $linkEpisodeNext='';
				}
				
	 	 	}
	 	 	else
	 	 	{
	 	 		throw new Exception('L\'identifiant pour le lien suivant n\'est pas un nombre'); 
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
			return strftime('%d-%m-%Y',strtotime($this->_publication));
		}
		
		/** Retourne la date de mise à jour */
		public function getDataChange()
		{
			return strftime('%d-%m-%Y',strtotime($this->_dataChange));
		}
			/** Retourne l'affiche (1) ou non (0) sur le site' */
		public function getShowEpisode()
		{
			return $this->_showEpisode;
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
			if (is_string($episode))
    		{
    			htmlspecialchars($episode);
				$this->_episode = $episode;
			}
		}
		
		/** Assigne le titre de l'épisode */
		public function setTitle($title)
		{
			if (is_string($title))
    		{
    			htmlspecialchars($title);
				$this->_title = $title;
			}
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
		/** Retourne l'affiche (1) ou non (0) sur le site' */
		public function setShowEpisode($showEpisode)
		{
			$showEpisode = (int) $showEpisode;
			$this->_showEpisode;
		}
		
	}
	
