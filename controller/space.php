<?php

# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');
$alertActualize='';

loadClass("User");
loadClass("Input");

$titleH1 = 'Votre espace';
$containSpace = '';


if(isset($_SESSION['idUser']) && isset($_SESSION['pseudo']) && isset($_SESSION['admin']))
{

	$user = new User();
	$getInfosUser = $user->get('id', $_SESSION['idUser']);
	$user-> hydrate($getInfosUser[0]);

	$input = new Input();
	$inputPseudo = $input->get(10); // array contenant les attribut du champs input pseudo

	$inputNewPassword = $input->get(14);// array contenant les attribut du champs input password
	$inputRepeatPassword = $input->get(15);
	array_push($inputNewPassword, $inputRepeatPassword[0]); // assemblage des 2 array

	$icon->getDataToHydrate(7); // icone check
	$iconCheck = $icon->getClasse();

	$icon->getDataToHydrate(11); // icone pen
	$iconPen = $icon->getClasse();

	$icon->getDataToHydrate(8); // icone annuler
	$iconAnnul = $icon->getClasse();

	$containSpace =$user->buildSpace($iconPen, $iconCheck, $iconAnnul, $inputPseudo, $inputNewPassword);



$containSpace .= <<<EOT
			</div>
	 	 </div>
	 </div>
EOT;
}

$headTitle     = 'Bienvenue dans votre espace';
$metaDescription = "";
include ($pgHead);  // <head> de la page   
include ($pgHeader); // <header> de la page
include ("../view/space.php");
include ($pgFooter); // <footer> de la page

