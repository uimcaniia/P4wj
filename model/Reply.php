<?php

	class Reply extends ReplyManager {

		// CONSTANTES
		const ID    = 'id';          
		const RE    = 'reply';  //  	texte de la réponse
		const DA    = 'dateReply';     //  	date de la réponse
		const CO    = 'idcomment_reply';   // id du commentaire recevant la réponse
		const IR    = 'iduser_reply';   // id de l'utilisateur qui a répondut 
		const RP    = 'reporting_reply';      //  	réponse signalé (1) ou non (0)  
		
		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
		 private $_id;// Nom de la colonne id de la table locale
	  	 private $_reply;//  	texte de la réponse
		 private $_dateReply; //  	date de la réponse
	  	 private $_idcomment_reply;// id du commentaire recevant la réponse
	 	 private $_iduser_reply;// id de l'utilisateur qui a répondut 
	 	 private $_reporting_reply; //  	réponse signalé (1) ou non (0) 
	 	 private $_id_episode; //  id de l'épisode qui a le commentaire ayant reçut réponse

		// **************************************************
		// Methode
		// **************************************************

	 	 public function getDataToHydrate($intComment)
	 	 {
	 	 	if((is_int($intComment)) && ($intComment>0)){
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
		 	}else
		 	{
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
		
		/** Retourne texte de la réponse */
		public function getReply()
		{
			return $this->_reply;
		}
		
		/** Retourne date de la réponse  */
		public function getDateReply()
		{
			return strftime('%d-%m-%Y',strtotime($this->_dateReply));
		}
		
		/** Retourne id du commentaire recevant la réponse */
		public function getIdcomment_reply()
		{
			return $this->_idcomment_reply;
		}
		
		/** Retourne id de l'utilisateur qui a répondut */
		public function getIduser_reply()
		{
			return $this->_iduser_reply;
		}

		/** Retourne réponse signalé (1) ou non (0) */
		public function getReporting_reply()
		{
			return $this->_reporting_reply;
		}
		/** Retourne l'id de l'épisode concerné */
		public function getId_episode()
		{
			return $this->_id_episode;
		}
		

		// **************************************************
		// SETTERS
		// **************************************************

		/** Assigne l'ID' de l'item */
		public function setId($id)
		{
			$id = (int)$id;
			$this->_id = $id;
		}
		
		/** Assigne texte de la réponse  */
		public function setReply($reply)
		{
			if(is_string($reply)) {
				htmlspecialchars($reply);
				$this->_reply = $reply;
			}
		}
		
		/** Assigne date de la réponse */
		public function setDate($dateReply)
		{
			$this->_dateReply = $dateReply;
		}
		
		/** Assigne id du commentaire recevant la réponse */
		public function setIdcomment_reply($idcomment_reply)
		{
			$idcomment_replyInt = (int)$idcomment_reply;
			$this->_idcomment_reply = $idcomment_replyInt;
		}
		
		/** Assigne id de l'utilisateur qui a répondut */
		public function setIduser_reply($iduser_reply)
		{
			$iduser_replyInt = (int)$iduser_reply;
			$this->_iduser_reply = $iduser_replyInt;
		}

		/** Assigne réponse signalé (1) ou non (0) */
		public function set_Reporting_reply($reporting_reply)
		{
			$reporting_reply = (int)$reporting_reply;
			$this->_reporting_reply = $reporting_reply;
		}
		/** Assigne l'id de l'épisode concerné */
		public function setId_episode($id_episode)
		{
			$id_episodeInt = (int)$id_episode;
			$this->_id_episode = $id_episodeInt;
		}
		
	}
	