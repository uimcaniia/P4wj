<?php

// Chargement des classes

/*	loadClass("Episode");
		echo 'coucou';*/
	loadClass("Input");

function listLastEpisode($nbr)
{
	$episodes = new Episode;
	$aEpisode = $episodes->getSomeEpisode(4);// on récupère les 4 derniers épisode
	if($aEpisode === false)
	{
		throw new Exception('Impossible de charger les '.$nbr.' épisodes');
	}

	$aEpisodeExtract = $episodes->makeExtractEpisode($aEpisode);
	$link = 'episode.php?id=$aEpisode[$i]["id"]';

	require('view/frontend/listLastEpisodeView.php');
}
//********************************************************
function extractAllEpisode()
{
	$episodes = new Episode;
	$aEpisode = $episodes->getAllEpisode();// on récupère tous les épisodes
	if($aEpisode === false)
	{
		throw new Exception('Impossible de charger la liste complètes des épisodes');
	}

	$aEpisodeExtract = $episodes->makeExtractEpisode($aEpisode);
	//$link = 'episode.php?id=$aEpisode[$i]["id"]';

	require('view/frontend/extractAllEpisodeView.php');
}
//********************************************************
function showEpisode($idEpisode)
{
	$idEpisode = intval($idEpisode);
	$episode       = new Episode;
	$aEpisode      = $episode->getOneEpisode($idEpisode); // on appelle l'épisode concerné'
	$linkEpisodePrev = $episode->getPrevIdEpisode($idEpisode);
	$linkEpisodeNext = $episode->getNextIdEpisode($idEpisode);

	$aComment = listNewCommentEpisode($idEpisode);

	require('view/frontend/showEpisodeView.php');
}
//********************************************************
function spaceConnect()
{
	$alertConnectionMail='';
	$alertConnectionPsw='';
	$alertConnectionPseudo='';
	$alert ='';

	$aIdInputLog = array(8, 9); // id des input a charger pour se connecter
	$aIdInputSub = array(8, 10, 9, 15); // id des input a charger pour s'inscrire
		
	$aInputLog = login($aIdInputLog);
	$aInputSub = login($aIdInputSub);

	require('view/frontend/loginView.php');
}
	//********************************************************
function login($aIdInput)
{
	$input= new Input;
	$aInput = $input ->getInput($aIdInput);
	return $aInput;
}
//*******************************************************
function testErrorLog($email, $psw)
{
	$form = new Form;
	$alert = $form->tstLog($email, $psw);
	//echo $alert;
	$alertConnectionMail='';
	$alertConnectionPsw='';
	$alertConnectionPseudo='';

	if($alert !== '')
	{
		$aIdInputLog = array(8, 9); // id des input a charger pour se connecter
		$aIdInputSub = array(8, 10, 9, 15); // id des input a charger pour s'inscrire

		$aInputLog = login($aIdInputLog);
		$aInputSub = login($aIdInputSub);

		require('view/frontend/loginView.php');
	}
	else{
		$user = new User();
		$getInfosUserConnect = $user->get('email', $email);
		makeSession($email);
		//print_r($_SESSION);
		header ('location: index.php?action=space');
	}
}
//*******************************************************
function testErrorSubscribe($email, $pseudo, $psw, $pswAgain)
{

	$form = new Form;
	$alertConnectionMail   = $form->tstSubMail($email);
	$alertConnectionPsw    = $form->tstSubPseudo($pseudo);
	$alertConnectionPseudo = $form->tstSubPsw($psw, $pswAgain);
	$alert ='';

	if(($alertConnectionMail != "")&&($alertConnectionMail != "")&&($alertConnectionMail != ""))
	{
		$aIdInputLog = array(8, 9); // id des input a charger pour se connecter
		$aIdInputSub = array(8, 10, 9, 15); // id des input a charger pour s'inscrire

		$aInputLog = login($aIdInputLog);
		$aInputSub = login($aIdInputSub);
		require('view/frontend/loginView.php');
	}
	else{
		echo 'coucou';
		subscribe($email, $pseudo, $psw);
		makeSession($email);
		//print_r($_SESSION);
		header ('location: index.php?action=space');
	}
}
//*****************************************************
function makeSession($mail){
	$user = new User();
	$getInfosUserConnect = $user->get('email', $mail);

	$_SESSION['idUser'] = $getInfosUserConnect[0]['id'];
	$_SESSION['pseudo'] = $getInfosUserConnect[0]['pseudo'];
	$_SESSION['admin']  = $getInfosUserConnect[0]['admin'];
	$_SESSION['email']  = $getInfosUserConnect[0]['email'];
}
//*******************************************************
function subscribe($email, $pseudo, $psw)
{
	$pswHash = password_hash($psw, PASSWORD_DEFAULT);
	$aDataUser=array(
	"email"  => "'$email'",
	"pseudo" => "'$pseudo'",
	"psw"    => "'$pswHash'",
	"admin"  => 0);

	$user = new User();
	$user-> hydrate($aDataUser);
	$user->add($user);
}

//*******************************************************
function disconnect()
{
	$_SESSION = array();
	session_destroy();
	header ( 'Location: index.php');
}
//********************************************************
function listNewCommentEpisode($idEpisode)
{
	$idIntEpisode = intval($idEpisode); // on transforme la string en int
	$comment = new Comment; 	// on récupère tous les commentaires suivant l'id de l'épisode
	$aComment = $comment->getAllCommentOrder($idIntEpisode, 'commentTime');
	//print_r($aComment);
	if($aComment === false)
	{
		throw new Exception('Impossible de charger la liste des commentaires');
	}

	for ($i = 0 ; $i < count($aComment) ; $i++)
	{
		foreach ($aComment[$i] as $key => $value)
		{
			if($key == 'idUser')
			{
				$user = new User(); // on récupère le pseudo de l'utilisateur qui a commenté
				$getInfosUser = $user->get('id', $aComment[$i]['idUser']);
				$aComment[$i]['pseudo'] = $getInfosUser[0]['pseudo'];
			}
			if ($key =='id')
			{ 
				$reply = new Reply; // on ajoute les réponse correspondantes aux commentaires
				$aReply = $reply->getAllReplyComment($value);
				for ($j = 0 ; $j < count($aReply) ; $j++)
				{
					foreach ($aReply[$j] as $keyReply => $valueRepy)
					{
						if($keyReply == 'iduser_reply')
						{
							$userReply = new User(); // on récupère le pseudo de l'utilisateur qui a répondu
							$getInfosUserReply = $userReply->get('id', $aReply[$j]['iduser_reply']);
							$aReply[$j]['pseudo'] = $getInfosUserReply[0]['pseudo'];
						}
					}
				}
				$aComment[$i]['reply'] = $aReply;
			}
		}
	}
	return $aComment;
}
//********************************************************
function listOldCommentEpisode($idEpisode)
{
	require('view/frontend/commentView.php');
}
//********************************************************
function addComment($idEpisode, $idseudo, $comment)
{
	require('view/frontend/commentView.php');
}
//********************************************************
function addReply($idEpisode, $idseudo, $comment, $reply)
{
	require('view/frontend/commentView.php');
}
//********************************************************
function signalComment($idEpisode, $idComment)
{
	require('view/frontend/commentView.php');
}
//********************************************************
function signalReply($idEpisode, $idComment, $idReply)
{
	require('view/frontend/commentView.php');
}
//********************************************************
function biography()
{
	require('view/frontend/biographyView.php');
}