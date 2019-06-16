<?php

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
	$aEpisode = $episodes->getAllEpisodePublish();// on récupère tous les épisodes

	if($aEpisode === false)
	{
		throw new Exception('Impossible de charger la liste complètes des épisodes');
	}

	$aEpisodeExtract = $episodes->makeExtractEpisode($aEpisode);

	require('view/frontend/extractAllEpisodeView.php');
}
//********************************************************
function showEpisode($idEpisode)
{
	$idEpisode = intval($idEpisode);
	$episode   = new Episode;
	$aEpisode  = $episode->getOneEpisode($idEpisode); // on appelle l'épisode concerné'
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
		header ('location: index.php?action=space');
	}
}
//*******************************************************
function testErrorSubscribe($email, $pseudo, $psw, $pswAgain)
{
	//echo $email;
	$form = new Form;
	$alertConnectionMail   = $form->tstSubMail($email);
	$alertConnectionPsw    = $form->tstSubPseudo($pseudo);
	$alertConnectionPseudo = $form->tstSubPsw($psw, $pswAgain);
	//	echo $alertConnectionPseudo;
	$alert ='';

	if(($alertConnectionMail != "") || ($alertConnectionPsw != "") || ($alertConnectionPseudo != ""))
	{
		$aIdInputLog = array(8, 9); // id des input a charger pour se connecter
		$aIdInputSub = array(8, 10, 9, 15); // id des input a charger pour s'inscrire

		$aInputLog = login($aIdInputLog);
		$aInputSub = login($aIdInputSub);
		require('view/frontend/loginView.php');
	}
	else{
		subscribe($email, $pseudo, $psw);
		makeSession($email);
		header ('location: index.php?action=space');
	}
}
//*****************************************************
function makeSession($mail)
{
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
	"email"  => "$email",
	"pseudo" => "$pseudo",
	"psw"    => "$pswHash",
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

	$aComment = $comment->getAllCommentOrderJoin('idEpisode', $idIntEpisode, 'commentTime', 'user', 'idUser', 'id', 'pseudo');
	if($aComment === false){
		$aComment = array();
	}
	else
	{
		foreach ($aComment as $key => $value)
		{
			$reply = new Reply; // on recupère les réponse correspondantes aux commentaires
			$aReply = $reply->getAllReplyOrderJoin('idcomment_reply', $value['id'], 'dateReply', 'user', 'iduser_reply', 'id', 'pseudo');
			$aComment[$key]['reply'] = $aReply;
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
function addComment($idEpisode, $idPseudo, $comment)
{
	$comment = trim($comment);
	if(!empty($comment)) // on s'assure de ne pas avoir de réponse vide
	{
		$majCommentUser = new User;
		$userComment = $majCommentUser->get('id', $idPseudo); // on récup le nbr de commentaire qu'il a posté
		$userComment[0]['comment'] = $userComment[0]['comment'] +1; // on ajoute +1 de commentaire
		$userComment = $majCommentUser->update('comment', $userComment[0]['comment'], $idPseudo); // maj du nbr de commentaire

		$aDataComment=array(
			array(
				"comment"   => "$comment",
				"idEpisode" => "$idEpisode",
				"idUser"    => "$idPseudo"));

		$comment = new Comment; // on ajoute le nouveau commentaire
		$comment->hydrate($aDataComment);
		$comment->add($comment);

		$comment2 = new Comment;
		$aLastCom = $comment2 -> getLastComment(); // on récupère le résultat pour récupérer la date de l'enregistrement en BDD
		$aLastCom[0]['commentTime']=strftime('%d-%m-%Y',strtotime($aLastCom[0]['commentTime']));
		echo json_encode($aLastCom[0]);
	}
}
//********************************************************
function addReply($idEpisode, $idPseudo, $comment, $reply)
{
	$reply = trim($reply);
	if(!empty($reply)) // on s'assure de ne pas avoir de réponse vide
	{
		$majCommentUser = new User;
		$userComment = $majCommentUser->get('id', $idPseudo); // on récup le nbr de commentaire qu'il a posté
		$userComment[0]['comment'] = $userComment[0]['comment'] +1; // on ajoute +1 de commentaire
		$userComment = $majCommentUser->update('comment', $userComment[0]['comment'], $idPseudo); // maj du nbr de commentaire

		$aDataReply=array(
			array(
				"reply"          => "$reply",
				"id_episode"     => "$idEpisode",
				"idcomment_reply"=> "$comment",
				"iduser_reply"   => "$idPseudo"));

		$reply = new Reply; // on ajoute le nouveau commentaire
		$reply->hydrate($aDataReply);
		$reply->add($reply);

		$reply2 = new Reply; // on ajoute le nouveau commentaire
		$aLastReply = $reply2 -> getLastReply(); // on récupère le résultat pour récupérer la date de l'enregistrement en BDD
 		$aLastReply[0]['dateReply']=strftime('%d-%m-%Y',strtotime($aLastReply[0]['dateReply']));
		echo json_encode($aLastReply[0]);
	}
}
//********************************************************
function signalComment($idEpisode, $idComment, $idUserSignal)
{
	$majSignalUser = new User;
	$userReporting = $majSignalUser->get('id', $idUserSignal); // on récup le nbr de signalement qu'il a reçut
	$userReporting[0]['reporting'] = $userReporting[0]['reporting'] +1; // on ajoute +1 de signalement
	$userReporting = $majSignalUser->update('reporting', $userReporting[0]['reporting'], $idUserSignal); // maj du signalement

	$majSignalComment = new Comment;
	$commentReporting = $majSignalComment->update($idComment, '1');
}
//********************************************************
function signalReply($idEpisode, $idComment, $idReply, $idUserSignal)
{
	$majSignalUser = new User;
	$userReporting = $majSignalUser->get('id', $idUserSignal); // on récup le nbr de signalement qu'il a reçut
	$userReporting[0]['reporting'] = $userReporting[0]['reporting'] +1; // on ajoute +1 de signalement
	$userReporting = $majSignalUser->update('reporting', $userReporting[0]['reporting'], $idUserSignal); // maj du signalement

	$majSignalReply = new Reply;
	$commentReporting = $majSignalReply->update($idReply, '1');
}
//********************************************************
function biography()
{
	$bio = new Author;
	$biographie = $bio->get();
	require('view/frontend/biographyView.php');
}
//********************************************************
function mention()
{
	$mention = new Mention;
	$aMention = $mention->get();
	require('view/frontend/mentionView.php');
}
//********************************************************
function politique()
{
	$politique = new Politique;
	$aPolitique = $politique->get();
	require('view/frontend/politiqueView.php');
}
