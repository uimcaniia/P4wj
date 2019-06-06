<?php

# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');
require_once('errorForm.php'); // traitement des erreurs

// array contenant les erreur possible lors de la saisie du formulaire
$regexMail ="#^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#"; // regex mail
$regexPsw = "#^(?=.*[A-Z])(?=.*[0-9]).{8,}$#";
$aTestError=array(
    "tstMail"   => array("","Veuillez indiquer un e-mail", "Ce mail existe déjà. Vous avez déjà un compte?" , "Adresse mail invalide."),
    "tstPseudo" => array("", "Veuillez indiquer un Pseudo", "Ce pseudo existe déjà. Veuillez en choisir un autre", ""),
    "tstPsw"    => array("", "Veuillez indiquer un mot de passe","", "Le mot de passe n'est pas assez sécurisé. Veuillez utiliser 8 caractères minimum avec au moins une majuscule et un chiffre", "Le mot de passe et (ou) l'adresse mail renseigné n'est pas le bon.", "Les 2 mots de passe ne sont pas identiques", 'veuillez remplir les champs')
);

$alert='';
$alertConnectionMail='';
$alertConnectionPsw='';
$alertConnectionPseudo='';

loadClass("Input");
$input = new Input();

$inputMail = $input->get(8); // array contenant les attribut du champs input email
$inputPsw = $input->get(9); // array contenant les attribut du champs input password
array_push($inputMail, $inputPsw[0]); // assemblage des 2 array

$inputNewEmail = $input->get(13);
$inputNewPassword = $input->get(14);
$inputRepeatPassword = $input->get(15);
$inputPseudo = $input->get(10); // array contenant les attribut du champs input pseudo
array_push($inputNewEmail, $inputNewPassword[0], $inputRepeatPassword[0], $inputPseudo[0]);

if (isset($_POST["registration"]))
{ // si le bouton s'inscrire est activé
	if (isset($_POST['email']) && isset($_POST['psw']) && isset($_POST['pseudo']) && isset($_POST['pswAgain']))
	{
		$mail = htmlspecialchars($_POST['email']); 
		$psw = htmlspecialchars($_POST['psw']);
		$psw2 = htmlspecialchars($_POST['pswAgain']);
		$pseudo = htmlspecialchars($_POST['pseudo']);

		$errorMail = verifChaine($mail, $regexMail, 'email', "", true); // vérification des 
		$errorPsw = verifChaine($psw, $regexPsw, '', $psw2, false);
		$errorPseudo = verifChaine($pseudo, '', 'pseudo', "", true);
		
		if($errorMail !== 0)
		{
			$alertConnectionMail = $aTestError['tstMail'][$errorMail];
		}
		elseif ($errorPsw  !== 0)
		{
			$alertConnectionPsw = $aTestError['tstPsw'][$errorPsw];
		}
		elseif ($errorPseudo !== 0)
		{
			$alertConnectionPseudo = $aTestError['tstPseudo'][$errorPseudo];
		}
		else
		{
			$pswHash = password_hash($psw, PASSWORD_DEFAULT);

			$aDataUser=array(
			"email" => "'$mail'",
			"pseudo" => "'$pseudo'",
			"psw" => "'$pswHash'",
			"admin" => 0);

			$user = new User();
			$user-> hydrate($aDataUser);
			$user->add($user);
			$getInfosNewUser = $user->get('email', $mail);

			$_SESSION['email']  = $getInfosNewUser[0]['email'];
			$_SESSION['idUser'] = $getInfosNewUser[0]['id'];
			$_SESSION['pseudo'] = $getInfosNewUser[0]['pseudo'];
			$_SESSION['admin']  = $getInfosNewUser[0]['admin'];
			header ('location: space.php');
		}
	}
	else
	{
		$alertConnection = 'Erreur lors de l\'envoie du formulaire. Merci de réésayer plus tard.';
	}
}
if (isset($_POST["connect"]))
{ // si le bouton s'inscrire est activé
	if (isset($_POST['email']) && isset($_POST['psw']))
	{
		$mail = htmlspecialchars($_POST['email']); 
		$psw = htmlspecialchars($_POST['psw']);
		
		$errorConnexion = verifUserInfos($psw, $mail, 'email', 'psw');
		if($errorConnexion !== 0)
		{
			$alert = $aTestError['tstPsw'][$errorConnexion];
		}
		else
		{
			$user = new User();
			$getInfosUserConnect = $user->get('email', $mail);

			$_SESSION['idUser'] = $getInfosUserConnect[0]['id'];
			$_SESSION['pseudo'] = $getInfosUserConnect[0]['pseudo'];
			$_SESSION['admin']  = $getInfosUserConnect[0]['admin'];
			$_SESSION['email']  = $getInfosUserConnect[0]['email'];
			//echo $_SESSION['admin'];
			if($_SESSION['admin'] === '1')
			{
				header ('location: admin.php');
			}
			else
			{
				header ('location: space.php');
			}
			
		}
	}
	else
	{
		$alertConnection = 'Erreur lors de l\'envoie du formulaire. Merci de réésayer plus tard.';
	}
}


$icon->getDataToHydrate(5); // icone connexion
$iconConnect = $icon->getClasse();
$value = "";

$loginInput = <<<EOT
	<p>$alert</p>
	<form method="post" action="login.php#titlePage">
		<div class="form">
			<fieldset>
				<legend> Vous avez déjà un compte ? </legend>
EOT;

for ($i = 0 ; $i <= count($inputMail)-1 ; $i++)
{
	if (isset($_POST["connect"]) && isset($_POST['email']) && isset($_POST['psw']))
	{
		$value = $_POST[$inputMail[$i]['name']];
	}
	$loginInput.=<<<EOT
				<label for="{$inputMail[$i]['id_style']}"></label>
				<input type ="{$inputMail[$i]['type']}" id ="{$inputMail[$i]['id_style']}" name ="{$inputMail[$i]['name']}" value="$value" placeholder="{$inputMail[$i]['placeholder']}" contenteditable ="{$inputMail[$i]['contenteditable']}">
EOT;
}

$loginInput.=<<<EOT
				<input type="submit" value='Se connecter' name='connect'>
			</fieldset>
		</div>
	</form>
	<p>$alertConnectionMail</p>
	<p>$alertConnectionPsw</p>
	<p>$alertConnectionPseudo</p>
	<p>Vous avez oublié votre mot de passe?</p>
	<form method="post" action="login.php">
		<div class="form">
			<fieldset>
				<legend> Créer votre compte <span class='$iconConnect'></span></legend>
EOT;


for ($j = 0 ; $j <= count($inputNewEmail)-1 ; $j++)
{
		if (isset($_POST["registration"]) && isset($_POST['email']) && isset($_POST['psw']) && isset($_POST['pseudo']))
	{
		$value = $_POST[$inputNewEmail[$j]['name']];
	}
	else
	{
		$value = "{$inputNewEmail[$j]['value']}";
	}
	$loginInput.=<<<EOT
				<input type ="{$inputNewEmail[$j]['type']}" id ="{$inputNewEmail[$j]['id_style']}" name ="{$inputNewEmail[$j]['name']}" value="$value" placeholder="{$inputNewEmail[$j]['placeholder']}" contenteditable ="{$inputNewEmail[$j]['contenteditable']}">
EOT;
}

$loginInput.=<<<EOT
				<input type="submit" value="S'inscrire" name='registration'>
			</fieldset>
		</div>
	</form>
EOT;


	$titleH1       = 'Espace connexion';
	$headTitle     = 'Accedez à votre espace';

$metaDescription = "";
include ($pgHead);  // <head> de la page   
include ($pgHeader); // <header> de la page*/
include ("../view/login.php");
include ($pgFooter); // <footer> de la page

