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
	$aComment = $comment->getAllCommentOrderJoin('idEpisode', $idIntEpisode, 'commentTime', 'user', 'idUser', 'id', 'pseudo');

	foreach ($aComment as $key => $value)
	{
		$reply = new Reply; // on recupère les réponse correspondantes aux commentaires
		$aReply = $reply->getAllReplyOrderJoin('idcomment_reply', $value['id'], 'dateReply', 'user', 'iduser_reply', 'id', 'pseudo');
		$aComment[$key]['reply'] = $aReply;
	}

	if($aComment === false)
	{
		throw new Exception('Impossible de charger la liste des commentaires');
	}
/*	echo '<pre>';
	print_r($aComment);
	echo '</pre>';*/
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
	$majCommentUser = new User;
	$userComment = $majCommentUser->get('id', $idPseudo); // on récup le nbr de commentaire qu'il a posté
	$userComment[0]['comment'] = $userComment[0]['comment'] +1; // on ajoute +1 de commentaire
	$userComment = $majCommentUser->update('comment', $userComment[0]['comment'], $idPseudo); // maj du nbr de commentaire

	$aDataComment=array(
		array(
			"comment"   => "'$comment'",
			"idEpisode" => "$idEpisode",
			"idUser"    => "$idPseudo"));

	$comment = new Comment; // on ajoute le nouveau commentaire
	$comment->hydrate($aDataComment);
	$comment->add($comment);

	$comment2 = new Comment;
	$aLastCom = $comment2 -> getLastComment(); // on récupère le résultat pour récupérer la date de l'enregistrement en BDD

	$resComment = '<div class="commentSignal"><p> De </p><p>'.$aLastCom[0]['pseudo'].'</p><p> le </p><p>'.strftime('%d-%m-%Y',strtotime($aLastCom[0]['commentTime'])).'</p></div><div class="comment"><p id="commentUserConnectSend">'.$aLastCom[0]['comment'].'</p></div>';

	echo $resComment;
}
//********************************************************
function addReply($idEpisode, $idPseudo, $comment, $reply)
{
	$majCommentUser = new User;
	$userComment = $majCommentUser->get('id', $idPseudo); // on récup le nbr de commentaire qu'il a posté
	$userComment[0]['comment'] = $userComment[0]['comment'] +1; // on ajoute +1 de commentaire
	$userComment = $majCommentUser->update('comment', $userComment[0]['comment'], $idPseudo); // maj du nbr de commentaire

	$aDataReply=array(
		array(
			"reply"          => "'$reply'",
			"id_episode"     => "$idEpisode",
			"idcomment_reply"=> "$comment",
			"iduser_reply"   => "$idPseudo"));

	$reply = new Reply; // on ajoute le nouveau commentaire
	$reply->hydrate($aDataReply);
	$reply->add($reply);

	$reply2 = new Reply; // on ajoute le nouveau commentaire
	$aLastReply = $reply2 -> getLastReply(); // on récupère le résultat pour récupérer la date de l'enregistrement en BDD

	$resReply = '<div id="replySignal" class="replySignal"><p> De </p><p>'.$aLastReply[0]['pseudo'].'</p><p> le </p><p>'.strftime('%d-%m-%Y',strtotime($aLastReply[0]['dateReply'])).'</p></div><div class="reply"><p>'.$aLastReply[0]['reply'].'</p></div>';

	echo $resReply;
}
//********************************************************
function signalComment($idEpisode, $idComment, $idUserSignal)
{
	$majSignalUser = new User;
	$userReporting = $majSignalUser->get('id', $idUserSignal); // on récup le nbr de signalement qu'il a reçut
	$userReporting[0]['reporting'] = $userReporting[0]['reporting'] +1; // on ajoute +1 de signalement
	$userReporting = $majSignalUser->update('reporting', $userReporting[0]['reporting'], $idUserSignal); // maj du signalement

	$majSignalComment = new Comment;
	$commentReporting = $majSignalComment->update($idComment);
}
//********************************************************
function signalReply($idEpisode, $idComment, $idReply, $idUserSignal)
{
	$majSignalUser = new User;
	$userReporting = $majSignalUser->get('id', $idUserSignal); // on récup le nbr de signalement qu'il a reçut
	$userReporting[0]['reporting'] = $userReporting[0]['reporting'] +1; // on ajoute +1 de signalement
	$userReporting = $majSignalUser->update('reporting', $userReporting[0]['reporting'], $idUserSignal); // maj du signalement

	$majSignalReply = new Reply;
	$commentReporting = $majSignalReply->update($idReply);
}
//********************************************************
function biography()
{
	require('view/frontend/biographyView.php');
}