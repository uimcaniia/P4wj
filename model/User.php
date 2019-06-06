<?php

	class User extends UserManager {

		
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


/*	 	 public function getDataToHydrate($mail, $psw){

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
*/
/*	 	 public function buildSpace($write, $iconCheck, $iconAnnul, $aInputPseudo, $aInputPsw){
	 	 	//print_r($aInputPseudo);
	 	 	$div = <<<EOT
	 <div id='containtGlobalSpace'>
	 	 <div id='globalSpace'>
	 	 	<hr>
	 	 	<div id='infoSpaceOne'>
	 	 		<p> Bienvenue dans votre espace $this->_pseudo</p>
	 	 		<p> Vous pouvez à tout moment, changer votre mot de passe et votre pseudo</p>
	 	 		
EOT;
			if($this->_comment == 0)
			{
				$div.=<<<EOT
				<p>Vous n'avez pas encore posté de commentaires. N'hésitez pas à nous laisser votre avis.
EOT;
			}
			else{
				$div.=<<<EOT
				<p> Vous avez posté<em> $this->_comment </em>commentaire(s) et
EOT;
			}
			if($this->_reporting == 0)
			{
				$div.=<<<EOT
				</p>
EOT;
			}
			else{
				$div.=<<<EOT
				vous avez eu<em> $this->_reporting </em>commentaire(s) de signalé</p>
EOT;
			}

	 	 		 $div.=<<<EOT
	 	 		<p>Voici les informations que nous avons</p>
	 	 	</div>
	 	 	<div id='infoSpaceTwo'>
	 	 		<p>Votre adresse mail de contact (Ne peut être changée) : <em>$this->_email</em></p>
	 	 		<div id='changePseudo'>
		 	 		<p>Votre pseudo : <em>$this->_pseudo</em></p>
		 	 		<p> Voulez-vous changer de pseudo? <span id="spanChangePseudo" class="$write" onclick="javascript:animDivWriteNewInfoOpen('changePseudo', 'contentFormChangePseudo')"></span></p>
	 	 		

EOT;

			$div.=<<<EOT
					<div id='contentFormChangePseudo'>
						<form method="post">
							<label for="{$aInputPseudo[0]['id_style']}"></label>
							<input type ="{$aInputPseudo[0]['type']}" id ="{$aInputPseudo[0]['id_style']}" name ="{$aInputPseudo[0]['name']}" value="" placeholder="{$aInputPseudo[0]['placeholder']}" contenteditable ="{$aInputPseudo[0]['contenteditable']}">
							<span class="$iconAnnul contentInputComment" onclick="javascript:animDivWriteNewInfoClose('changePseudo', 'contentFormChangePseudo')"></span>
							<button type="submit" class="$iconCheck" name='sendNewPseudo'></button>
						</form>
					</div>
				</div>
EOT;

			$div.=<<<EOT
				<div id='changePsw'>
					<p>Voulez-vous changer de mot de passe? <span id="spanChangePsw" class="$write" onclick="javascript:animDivWriteNewInfoOpen('changePsw', 'contentFormChangePsw')"></span><em></em></p>
		 	 		
		 	 		<div id='contentFormChangePsw'>
		 	 			<form method="post">
EOT;

				for ($i = 0 ; $i <= count($aInputPsw)-1 ; $i++)
				{
					$div.=<<<EOT
							<label for="{$aInputPsw[$i]['id_style']}"></label>
							<input type ="{$aInputPsw[$i]['type']}" id ="{$aInputPsw[$i]['id_style']}" name ="{$aInputPsw[$i]['name']}" value="" placeholder="{$aInputPsw[$i]['placeholder']}" contenteditable ="{$aInputPsw[$i]['contenteditable']}">
EOT;
				}
			$div.=<<<EOT
							<div id='btnNewPsw'>
								<span class="$iconAnnul contentInputComment" onclick="javascript:animDivWriteNewInfoClose('changePsw', 'contentFormChangePsw')"></span>
								<button type="submit" class="$iconCheck" name='sendNewPsw'></button>
							</div>
						</form>
					</div>
				</div>
EOT;
				
			$div.=<<<EOT

EOT;

			return $div;
	 	}
*/

		// **************************************************
		// GETTERS
		// **************************************************
		
		/** Retourne l'ID' de l'item */
		public function getId() {
			return $this->_id;
		}
		
		/** Retourne la date d'inscription */
		public function getInscription() {
			return strftime('%d-%m-%Y',strtotime($this->_inscription));
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
	
