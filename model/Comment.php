<?php

	class Comment extends CommentManager {
 
		
		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
		 private $_id;
	  	 private $_commentTime;
		 private $_comment;
	  	 private $_idEpisode;
	 	 private $_reporting;
	 	 private $_idUser;

		// **************************************************
		// Methode
		// **************************************************

	 	 public function getDataToHydrate($intComment)
	 	 {
	 	 	if((is_int($intComment)) && ($intComment>0))
	 	 	{
	 	 		$aData = parent::get($intComment);
	 	 		self::hydrate($aData);
	 	 	}else
	 	 	{
	 	 		echo 'les commentaire de l\'épisode '.$intComment.' n\'existe pas'; 
	 	 	}
	 	 }

	 	 public function hydrate($aData)
	 	 {
	 	 	if($aData != false)
	 	 	{
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
	 	 }



		// **************************************************
		// GETTERS
		// **************************************************
		
		/** Retourne l'ID' de l'item */
		public function getId()
		{
			return $this->_id;
		}
		
		/** Retourne la date du commentaire */
		public function getCommentTime()
		{
			return strftime('%d-%m-%Y',strtotime($this->_commentTime));
		}
		
		/** Retourne le texte du commentaire  */
		public function getComment()
		{
			return $this->_comment;
		}
		
		/** Retourne id de l'épisode concerné par le commentaire */
		public function getIdEpisode()
		{
			return $this->_idEpisode;
		}
		
		/** Retourne commentaire signalé (1) ou non (0) */
		public function getReporting()
		{
			return $this->_reporting;
		}

		/** Retourne id de l'utilisateur responsable du commentaire */
		public function getIdUser()
		{
			return $this->_idUser;
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
		
		/** Assigne la date du commentaire  */
		public function setCommentTime($commentTime)
		{
			$this->_commentTime = $commentTime;
		}
		
		/** Assigne le texte du commentaire */
		public function setComment($comment)
		{
			if(is_string($comment))
			{
				htmlspecialchars($comment);
				$this->_comment = $comment;
			}
		}
		
		/** Assigne id de l'épisode concerné par le commentaire */
		public function setIdEpisode($idEpisode)
		{
			$id = (int) $idEpisode;
			$this->_idEpisode = $idEpisode;
		}
		
		/** Assigne commentaire signalé (1) ou non (0) */
		public function setReporting($reporting)
		{
			$id = (int) $reporting;
			$this->_reporting = $reporting;
		}

		/** Assigne id de l'utilisateur responsable du commentaire */
		public function setIdUser($idUser)
		{
			$id = (int) $idUser;
			$this->_idUser = $idUser;
		}
		
	}
	
?>