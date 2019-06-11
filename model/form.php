<?php

	class form extends UserManager{

		// **************************************************
		// attribut  de l'objet
		// **************************************************
		private $_regMail ="#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#"; // regex mail
		private $_regPsw  = "#^(?=.*[A-Z])(?=.*[0-9]).{8,}$#"; //regex pssword

		private $_aTestError = array( // array contenant les différente erreur a afficher
		    "tstMail"   => array("","Veuillez indiquer un e-mail", "Ce mail existe déjà. Vous avez déjà un compte?" , "Adresse mail invalide."),
		    "tstPseudo" => array("", "Veuillez indiquer un Pseudo", "Ce pseudo existe déjà. Veuillez en choisir un autre", ""),
		    "tstPsw"    => array("", "Veuillez indiquer un mot de passe","", "Le mot de passe n'est pas assez sécurisé. Veuillez utiliser 8 caractères minimum avec au moins une majuscule et un chiffre", "Le mot de passe et (ou) l'adresse mail renseigné n'est pas le bon.", "Les 2 mots de passe ne sont pas identiques", 'veuillez remplir les champs', 'ce compte a été supprimé!')
		);

		// **************************************************
		// Methode
		// **************************************************

		public function tstLog($email, $psw)
		{
			$emailClean    = htmlspecialchars($email);
			$pswClean      = htmlspecialchars($psw);
			$errorConnexion = self::verifUserInfos($pswClean, $emailClean, 'email', 'psw');
			return $this->_aTestError['tstPsw'][$errorConnexion];
		}

		// **************************************************
		public function tstSubMail($email)
		{
			$emailClean    = htmlspecialchars($email);
			$errorMail   = self::verifChaine($emailClean,  $this->_regMail, 'email' , "" , true); // vérification des infos
			return $this->_aTestError['tstMail'][$errorMail];
		}
		// **************************************************
		public function tstSubPseudo($pseudo)
		{
			$pseudoClean   = htmlspecialchars($pseudo);
			$errorPseudo = self::verifChaine($pseudoClean, '', 'pseudo', "" , true);
			return $this->_aTestError['tstPseudo'][$errorPseudo];
		}
		// **************************************************
		public function tstSubPsw($psw, $pswAgain)
		{
			$pswClean      = htmlspecialchars($psw);
			$pswAgainClean = htmlspecialchars($pswAgain);
			$errorPsw    = self::verifChaine($pswClean, $this->_regPsw , '', $pswAgainClean, false);
			return $this->_aTestError['tstPsw'][$errorPsw];
		}

		// **************************************************
		public function verifChaine ($chaine, $regex, $paramBdd, $confirm, $empty)
		{
//echo $confirm; 
			$numError= 0;
			$aResultError=array();
			if(empty($chaine))
			{
				$numError = 1;
				array_push($aResultError, $numError);
			}
			else{
				if($paramBdd != '')
				{
					$user = new User();
					$verifInfo = parent::get($paramBdd, $chaine);
					//print_r($verifInfo);
					if (!empty($verifInfo))
					{
						$numError = 2;
						array_push($aResultError, $numError);
					}
				}
				if (!empty($regex))
				{
					if(preg_match($regex, $chaine) == FALSE)
					{
						$numError = 3;
						array_push($aResultError, $numError);
					}
				}
				if (!empty($confirm))
				{
					if(($empty == false) && ($chaine != $confirm))
					{
						$numError = 5;
						array_push($aResultError, $numError);
					}
				}

			}
			if(count($aResultError) == 0)
			{
				return 0;
			}
			else{
				return $numError;
			}
		}

		// **************************************************
		public function verifUserInfos($psw, $mail, $paramBdd, $pswCompare)
		{
			$numError= 0;
			$aResultError=array();

			if(empty($mail) || empty($psw))
			{
				$numError = 6;
				array_push($aResultError, $numError);
			}
			else
			{
				$verifInfo = parent::get($paramBdd, $mail);
				if (is_array($verifInfo))
				{
					if ($verifInfo[0]['deleteUser'] == 1)
					{
						$numError = 7;
						array_push($aResultError, $numError);
					}
					elseif(($verifInfo[0]['deleteUser'] == 0) && (password_verify($psw,$verifInfo[0][$pswCompare])))
					{
						$numError = 0;
					}
					else{
						$numError= 4;
						array_push($aResultError, $numError);
					}
				}
				else
				{
					$numError= 4;
					array_push($aResultError, $numError);
				}
			}
			if(count($aResultError) == 0)
			{
				return 0;
			}
			else{
				return $numError;
			}

		}

	}
	