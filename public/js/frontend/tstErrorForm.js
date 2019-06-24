	var regMail = /^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$/;
	var regPsw  = /^(?=.*[A-Z])(?=.*[0-9]).{8,}$/; 
	var regPseudo  = /^[a-zA-Z0-9]{3,}$/; 
	var btnSub = document.getElementsByName('registration');

	$('#subPassword').change(function(){
		var value = $('#subPassword').val();
		if(value.length == 0)
		{
			$('p.subPassword').text('Veuillez saisir un email');
		}
		else if(!regPsw.test(value))
		{
			$('p.subPassword').text('Le mot de passe n\'est pas assez sécurisé. Veuillez utiliser 8 caractères minimum avec au moins une majuscule et un chiffre');
		}
		else
		{
			$('p.subPassword').text('');

		}
	});

	$('#subEmail').change(function(){
		var value = $('#subEmail').val();
		if(value.length == 0){
			$('p.subEmail').text('Veuillez saisir un mot de pass');
		}
		else if(!regMail.test(value)){
			$('p.subEmail').text('Le format du mail n\'est pas valide');
		}
		else
		{
			$('p.subEmail').text('');

		}		
	});

	$('#repassword').change(function(){
		var valuePsw = $('#subPassword').val();
		var value = $('#repassword').val();
		if(value.length == 0)
		{
			$('p.repassword').text('Veuillez confirmer le mot de pass');
		}
		else if(value != valuePsw)
		{
			$('p.repassword').text('Les deux mots de pass sont différents');

		}		
	});

	$('#pseudo').change(function(){
		var value = $('#pseudo').val();
		if(value.length == 0)
		{
			$('p.pseudo').text('Veuillez renseigner un pseudo');
		}
		else if(!regPseudo.test(value))
		{
			$('p.pseudo').text('Le pseudo doit avoir au moins 3 caractères valides');
		}
		else{
			$('p.pseudo').text('');

		}		
	});


	

/*			private $_regMail ="#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#"; // regex mail
		private $_regPsw  = "#^(?=.*[A-Z])(?=.*[0-9]).{8,}$#"; 
		{ 
			$numError= 0;
			$aResultError=array();

			if(empty($chaine)) // test si chaine vide
			{
				$numError = 1;
				array_push($aResultError, $numError);
			}
			else{
				if($paramBdd != '') // test en base de donnée si le mail ou le pseudo existe déjà
				{
					$user = new User();
					$verifInfo = parent::get($paramBdd, $chaine);
					if (is_array($verifInfo))
					{
						$numError = 2;
						array_push($aResultError, $numError);
					}
				}
				if (!empty($regex)) // test sécurité mot de passe et conformité adresse mail avec regex
				{
					if(preg_match($regex, $chaine) == FALSE)
					{
						$numError = 3;
						array_push($aResultError, $numError);
					}
				}
				if ($empty == false) // test si le mot de passe et sa confirmation sont identique
				{
					if($chaine != $confirm)
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
		}*/