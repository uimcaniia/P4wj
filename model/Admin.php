<?php

	class Admin extends AdminManager {

		
		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
		 private $_id; // Nom de la colonne id de la table locale
	  	 private $_inscription; // date d'inscription (datetime)
		 private $_email;  //  email de l'utilisateur 
	  	 private $_pseudo; // pseudo de l'utilisateur
	 	 private $_psw;// mot de pass de l'utilisateur
	 	 private $_comment;//  nbr de commentaire laissé 
	 	 private $_reporting;// nbr de signal reçut
	 	 private $_admin;// autorisation admin (0=utilisateur ; 1=admin

		// **************************************************
		// Methode
		// **************************************************


	 	 public function getDataToHydrate($mail, $psw){

	 	 		$aData = parent::get($mail, $psw);
	 	 		self::hydrate($aData);
	 	 }

	 	 public function hydrate($aData){
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
		
		/** Retourne l'ID' de l'item */
		public function getId() {
			return $this->_id;
		}
		
		/** Retourne la date d'inscription */
		public function getInscription() {
			return $this->_inscription;
		}
		
		/** Retourne l'adresse mail de l'utilisateur */
		public function getEmail() {
			return $this->_email;
		}
		
		/** Retourne son pseudo */
		public function getPseudo() {
			return $this->_pseudo;
		}
		
		/** Retourne son mot de passe*/
		public function getPsw() {
			return $this->_psw;
		}
		
		/** Retourne les commentaires*/
		public function getComment() {
			return $this->_comment;
		}

		/** Retourne le nbr de signalement de ses commentaires*/
		public function getReporting() {
			return $this->_reporting;
		}

		/** Retourne son rang en tant qu'utilisateur(0) ou admin(1)*/
		public function getAdmin() {
			return $this->_admin;
		}

		// **************************************************
		// SETTERS
		// **************************************************

		/** Assigne l'ID' de l'item */
		public function setId($id) {
			$id = (int) $id;
			$this->_id = $id;
		}
		
		/** Assigne la date d'inscription */
		public function setInscription($inscription) {
			$this->_inscription = $inscription;
		}
		
		/** Assigne l'adresse mail de l'utilisateur */
		public function setEmail($email) {
			if(is_string($email)) {
				htmlspecialchars($email);
				$this->_email = $email;
			}
		}
		
		/** Assigne son pseudo */
		public function setPseudo($pseudo) {
			if(is_string($pseudo)){
				htmlspecialchars($pseudo);
				$this->_pseudo = $pseudo;
			}
		}
		
		/** Assigne son mot de passe*/
		public function setPsw($psw) {
			if(is_string($psw)){
				htmlspecialchars($psw);
				$this->_psw = $psw;
			}
		}
		
		/** Assigne le nbr de commentaires*/
		public function setComment($comment) {
			$comment = (int) $comment;
				$this->_comment = $comment;
			
		}

		/** Assigne le nbr de signalement de ses commentaires*/
		public function setReporting($reporting) {
			$reporting = (int) $reporting;
			$this->_reporting = $reporting;
		}

		/** Assigne son rang en tant qu'utilisateur(0) ou admin(1)*/
		public function setAdmin($admin) {
			$admin = (int) $admin;
			$this->_admin = $admin;
		}

	}
	
