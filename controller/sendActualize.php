<?php
# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');
require_once('errorForm.php'); // traitement des erreurs
	

$aTestError=array(
    "tstPseudo" => array("", "Veuillez indiquer un Pseudo", "Ce pseudo existe déjà. Veuillez en choisir un autre", ""),
    "tstPsw"    => array("", "Veuillez indiquer un mot de passe","", "Le mot de passe n'est pas assez sécurisé. Veuillez utiliser 8 caractères minimum avec au moins une majuscule et un chiffre", "Le mot de passe et (ou) l'adresse mail renseigné n'est pas le bon.", "Les 2 mots de passe ne sont pas identiques")
);

if (isset($_POST['valPseudo']))
{

	$pseudo = htmlspecialchars($_POST['valPseudo']);
	//echo $pseudo;
	$errorPseudo = verifChaine($pseudo, '', 'pseudo', ""); //vérification si le nouveau pseudo est déjà utilisé
	if ($errorPseudo !== 0)
	{
		echo $aTestError['tstPseudo'][$errorPseudo];
	}
	else
	{
		$user = new User();
		$user->update('pseudo', $pseudo, $_SESSION['idUser']); // maj du pseudo
		$_SESSION['pseudo'] = $pseudo;
		echo $pseudo;
	}
}



if (isset($_POST['valPsw']) && isset($_POST['valPswConfirm']))
{

	$regexPsw = "#^(?=.*[A-Z])(?=.*[0-9]).{8,}$#";
	$psw = htmlspecialchars($_POST['valPsw']);
	$psw2 = htmlspecialchars($_POST['valPswConfirm']);

	$errorPsw = verifChaine($psw, $regexPsw, '', $psw2, false);
	if ($errorPsw !== 0)
	{
		echo $aTestError['tstPsw'][$errorPsw];
	}
	else
	{
		$pswHash = password_hash($psw, PASSWORD_DEFAULT);
		$user = new User();
		$user->update('psw', $pswHash, $_SESSION['idUser']); // maj du pseudo
		echo '';
	}
}


