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
	 	 private $_admin; // autorisation de celui qui envoie:0= utilisateur ; 1 = admin 	


		// **************************************************
		// Methode
		// **************************************************

	 	 public function hydrate($aData){
	 	 	//print_r($aData);
	 	 	foreach ($aData as $key => $value){
	 	 		 // On récupère le nom du setter correspondant à l'attribut en mettant sa première lettre en majuscule. 
	 	 		$method = 'set'.ucfirst($key);
	 	 		if(method_exists($this, $method)){
	 	 			$this->$method($value);
	 	 		}
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
		/** retourne son rang en tant qu'utilisateur(0) ou admin(1)*/
		public function getAdmin() {
			return $this->_admin;
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
			$send = (int) $send;
			$this->_send = $send;
		}
		
		/** Assigne id de celui qui reçoit  */
		public function setReceive($receive) {
			$receive = (int) $receive;
				$this->_receive = $receive;
		}
		/** Assigne  sujet du message  */
		public function setSubject($subject) {
				$this->_subject = $subject;
		}
		/** Assigne  message  */
		public function setText($text) {
				$this->_text = $text;
		}
		
		/** Assigne date d'envoie */
		public function setDate($date) {
				$this->_date = $date;
		}
		
		/** Assigne son rang en tant qu'utilisateur(0) ou admin(1)*/
		public function setAdmin($admin) {
			$admin = (int) $admin;
			$this->_admin = $admin;
		}

	}
	
