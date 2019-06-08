<?php

	class Message extends MessageManager {

		
		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
		 private $_id; // Nom de la colonne id de la table locale
	  	 private $_send; // id de celui qui envoie
		 private $_receive;  //  id de celui qui reçoit
		 private $_subject; //Sujet du message 
	  	 private $_text; // message
	 	 private $_date;// date d'envoie 

		// **************************************************
		// Methode
		// **************************************************

	 	 public function hydrate($aData){
	 	 	print_r($aData);
	 	 	if(is_array($aData))
	 	 	{
		 	 	foreach ($aData as $key => $value){
		 	 		 // On récupère le nom du setter correspondant à l'attribut en mettant sa première lettre en majuscule. 
		 	 		$method = 'set'.ucfirst($key);
		 	 		if(method_exists($this, $method)){
		 	 			$this->$method($value);
		 	 		}
		 	 	}
		 	 }
		 	 else{
		 	 	throw new Exception('les valeurs du message ne sont pas complète'); 
		 	 }
	 	 }

		// **************************************************
		// GETTERS
		// **************************************************
		
		/** Retourne id du message */
		public function getId() {
			return $this->_id;
		}
		
		/** Retourne id de celui qui envoie */
		public function getSend() {
			return $this->_send;
		}
		
		/** Retourne id de celui qui reçoit */
		public function getReceive() {
			return $this->_receive;
		}
		
		/** Retourne sujet du message */
		public function getSubject() {
			return $this->_subject;
		}

		/** Retourne message */
		public function getText() {
			return $this->_text;
		}
		
		/** Retourne date d'envoie*/
		public function getDate() {
			return strftime('%d-%m-%Y',strtotime($this->_date));
		}

		// **************************************************
		// SETTERS
		// **************************************************

		/** Assigne id du message  */
		public function setId($id) {
			$id = (int) $id;
			$this->_id = $id;
		}
		
		/** Assigne id de celui qui envoie */
		public function setSend($send) {
			//intval($send);
			$send = intval($send);
			$this->_send = $send;
		}
		
		/** Assigne id de celui qui reçoit  */
		public function setReceive($receive) {
			$receive = intval($receive);
			$this->_receive = $receive;
		}
		/** Assigne  sujet du message  */
		public function setSubject($subject) {
			$sujetTrim = trim($subject); // on supprime les espace blanc en début et fin de chaine
			$sujetClean = htmlspecialchars($sujetTrim);
			$this->_subject = $sujetClean;
		}
		/** Assigne  message  */
		public function setText($text) {
			$textTrim = trim($text); // on supprime les espace blanc en début et fin de chaine
			$textClean = htmlspecialchars($textTrim);
			$this->_text = $textClean;
		}
		
		/** Assigne date d'envoie */
		public function setDate($date) {
			$this->_date = $date;
		}

	}
	
