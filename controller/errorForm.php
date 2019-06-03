<?php

# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');
loadClass("User");


function verifChaine ($chaine, $regex, $paramBdd, $confirm, $empty)
{
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
			$verifInfo = $user->get($paramBdd, $chaine);
			if (is_array($verifInfo))
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
		if (empty($confirm))
		{
			if(($empty == false) && ($chaine !== $confirm))
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


function verifUserInfos($psw, $mail, $paramBdd, $pswCompare)
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
		$user = new User();
		$verifInfo = $user->get($paramBdd, $mail);
		if (is_array($verifInfo))
		{
			if(password_verify($psw,$verifInfo[0][$pswCompare]))
			{

				return 0;
			}
			else{
				return $numError= 4;
				array_push($aResultError, $numError);
			}
		}
		else
		{
			return $numError= 4;
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