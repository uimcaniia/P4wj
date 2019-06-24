<?php
// affiche les derniers épisodes
function listLastEpisode($nbr) 
{
	$episodes = new Episode;
	$aEpisode = $episodes->getSomeEpisode(4);// on récupère les 4 derniers épisode
	if($aEpisode === false)
	{
		throw new Exception('Impossible de charger les '.$nbr.' épisodes');
	}

	$aEpisodeExtract = $episodes->makeExtractEpisode($aEpisode); // on récupère un extrait de l'épisode
	$link = 'episode.php?id=$aEpisode[$i]["id"]';

	require('view/frontend/listLastEpisodeView.php');
}
//********************************************************
// affiche tous les épisodes
function extractAllEpisode()
{
	$episodes = new Episode;
	$aEpisode = $episodes->getAllEpisodePublish();// on récupère tous les épisodes

	if($aEpisode === false)
	{
		throw new Exception('Impossible de charger la liste complètes des épisodes');
	}

	$aEpisodeExtract = $episodes->makeExtractEpisode($aEpisode); // on récupère un extrait de l'épisode

	require('view/frontend/extractAllEpisodeView.php');
}
//********************************************************
//affiche un épisode sélectionné
function showEpisode($idEpisode)
{
	$idEpisode = intval($idEpisode);
	$episode   = new Episode;
	$aEpisode  = $episode->getOneEpisode($idEpisode); // on appelle l'épisode concerné'
	$linkEpisodePrev = $episode->getPrevIdEpisode($idEpisode); // récupère le lien précédent
	$linkEpisodeNext = $episode->getNextIdEpisode($idEpisode); // récupère le lien d'après

	$aComment = listNewCommentEpisode($idEpisode); // récupère les commentaires de l'épisode

	require('view/frontend/showEpisodeView.php');
}
//********************************************************
//espace pour se connecter 
function spaceConnect()
{
	$alertConnectionMail=''; // messages d'erreurs
	$alertConnectionPsw='';
	$alertConnectionPseudo='';
	$alert ='';

	$aIdInputLog = array(8, 9); // id des input a charger pour se connecter
	$aIdInputSub = array(13, 10, 14, 15); // id des input a charger pour s'inscrire
		
	$aInputLog = login($aIdInputLog);
	$aInputSub = login($aIdInputSub);

	require('view/frontend/loginView.php');
}
//********************************************************
//chargement des champs input de la partie connexion
function login($aIdInput)
{
	$input= new Input;
	$aInput = $input ->getInput($aIdInput);
	return $aInput;
}
//*******************************************************
//test les erreur à la connexion
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
		$aIdInputSub = array(13, 10, 14, 15); // id des input a charger pour s'inscrire

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
//test les erreurs à l'inscription
function testErrorSubscribe($email, $pseudo, $psw, $pswAgain)
{
	$form = new Form;
	$alertConnectionMail   = $form->tstSubMail($email);
	$alertConnectionPsw    = $form->tstSubPseudo($pseudo);
	$alertConnectionPseudo = $form->tstSubPsw($psw, $pswAgain);
	$alert ='';
	// si on a des erreurs à l'inscription, on relance la zone de connexion et on affiche les messages d'erreurs
	if(($alertConnectionMail != "") || ($alertConnectionPsw != "") || ($alertConnectionPseudo != ""))
	{
		$aIdInputLog = array(8, 9); // id des input a charger pour se connecter
		$aIdInputSub = array(13, 10, 14, 15); // id des input a charger pour s'inscrire

		$aInputLog = login($aIdInputLog);
		$aInputSub = login($aIdInputSub);
		require('view/frontend/loginView.php');
	}
	else{ // si on réussit, on incrit l'utilisateur, on enregistre les données en session et on le redirige vers son compte
		subscribe($email, $pseudo, $psw);
		makeSession($email);
		header ('location: index.php?action=space');
	}
}
//*****************************************************
//mise en session des infos de l'utilisateur ou de l'amin
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
//inscription d'un utilisateur
function subscribe($email, $pseudo, $psw)
{
	$pswHash = password_hash($psw, PASSWORD_DEFAULT); // on sécurise le mot de pass
	$aDataUser=array(
	"email"  => "$email",
	"pseudo" => "$pseudo",
	"psw"    => "$pswHash",
	"admin"  => 0);

	$user = new User();
	$user-> hydrate($aDataUser);
	$user->add($user); //on ajoute un user à la bdd
}

//*******************************************************
//déconnection de l'utilisateur
function disconnect()
{
	$_SESSION = array();
	session_destroy(); //on détruit la session
	header ( 'Location: index.php'); //on le redirige vers l'accueil
}
//********************************************************
//récupère les commentaire d'un épisode en function de l'id de l'épisode
function listNewCommentEpisode($idEpisode)
{
	$idIntEpisode = intval($idEpisode); // on transforme la string en int
	$comment = new Comment; 	// on récupère tous les commentaires suivant l'id de l'épisode

	$aComment = $comment->getAllCommentOrderJoin('idEpisode', $idIntEpisode, 'commentTime', 'user', 'idUser', 'id', 'pseudo');
	if($aComment === false){ // si il n'y a pas de commentaire, on affiche un array vide.
		$aComment = array();
	}
	else
	{
		foreach ($aComment as $key => $value) // on récupère les réponses aux commentaires si il y en a
		{
			$reply = new Reply; 
			$aReply = $reply->getAllReplyOrderJoin('idcomment_reply', $value['id'], 'dateReply', 'user', 'iduser_reply', 'id', 'pseudo');
			$aComment[$key]['reply'] = $aReply;
		}
	}
	return $aComment;
}
//********************************************************
// function en attente qui servira à afficher les commentaire du plus vieux au plus récent
function listOldCommentEpisode($idEpisode)
{
	require('view/frontend/commentView.php');
}
//********************************************************
//AJAX, insère un commentaire en BDD et retourne le commentaire en JSON
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

		$comment2 = new Comment;// on récupère le dernier commentaire
		$aLastCom = $comment2 -> getLastComment(); // on récupère le résultat pour récupérer la date de l'enregistrement en BDD
		$aLastCom[0]['commentTime']=strftime('%d-%m-%Y',strtotime($aLastCom[0]['commentTime']));
		echo json_encode($aLastCom[0]); 
	}
}
//********************************************************
//AJAX, insère une réponse à un commentaire en BDD et retourne le commentaire en JSON
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

		$reply2 = new Reply; // on récupère le dernier commentaire
		$aLastReply = $reply2 -> getLastReply(); // on récupère le résultat pour récupérer la date de l'enregistrement en BDD
 		$aLastReply[0]['dateReply']=strftime('%d-%m-%Y',strtotime($aLastReply[0]['dateReply']));
		echo json_encode($aLastReply[0]);
	}
}
//********************************************************
//permet de signaler un commentaire et l'utilisateur. MAJ en BDD (reporting)
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
//permet de signaler une réponse et l'utilisateur. MAJ en BDD (reporting)
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
//affiche la biography de l'écrivain
function biography()
{
	$bio = new Author;
	$biographie = $bio->get();
	require('view/frontend/biographyView.php');
}
//********************************************************
// affiche les mentiosn légales
function mention()
{
	$mention = new Mention;
	$aMention = $mention->get();
	require('view/frontend/mentionView.php');
}
//********************************************************
//affiche la politique de confidentialité
function politique()
{
	$politique = new Politique;
	$aPolitique = $politique->get();
	require('view/frontend/politiqueView.php');
}
