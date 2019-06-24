<?php
function spaceUser()
{
	$user         = new User();
	$getInfosUser = $user->get('id', $_SESSION['idUser']);
	$user-> hydrate($getInfosUser[0]);

	$input       = new Input();
	//$inputPseudo = $input->get(10); // array contenant les attribut du champs input pseudo

	$inputNewPassword    = $input->get(14);// array contenant les attribut du champs input password
	$inputRepeatPassword = $input->get(15);
	array_push($inputNewPassword, $inputRepeatPassword[0]); // assemblage des 2 array
	require('view/backend/spaceView.php');
}
//**********************************************************************
function admin()
{
	$admin         = new Admin();
	$getInfosAdmin = $admin->get('id', $_SESSION['idUser']);
		if($getInfosAdmin === false)
	{
		throw new Exception('Impossible de charger les information de l\'administrateur');
	}
	else{
		$reply = new Reply; // on recupère les réponse correspondantes aux commentaires + pseudo dans la table user
		$aReply = $reply->getAllReply();
		if($aReply === false){
			$aReply = array();
		}

		$comment        = new Comment; 	
		$aCommentSignal = $comment->getAllCommentSignal(); // array contennt tous les commentaires signalés
		if($aCommentSignal === false){
			$aCommentSignal = array();
		}
		$aAllCommentCompare = $comment->getAllComment();
		if($aAllCommentCompare === false){
			$aAllCommentCompare = array();
		}

		$aUser = getUserHadPostComment($aAllCommentCompare, $aReply); // array contennt tous les utilisateurs qui ont posté des commentaire où répondut
		$episode = new Episode;
		$aEpisode = $episode ->getAllEpisode();
		$aEpisodeHaveComment = getEpisodeHaveComment($aAllCommentCompare); // array contenant tous les épisode ayant reçut des commentaires

		$aUserSignal     = getUserSignal($aUser);// on récupère tous les utilisateur signalés

		$aEpisodeSignal  = getEpisodeSignal($aCommentSignal, $episode);  // on récupère tous les épisodes ayant uncomment signalés

		$user = new User;
		$aUserModo   = $user ->getAllUserExist();
		$aUserModerate   = $user ->getOnlyUserSignalExist($aUserModo);// on récupère tous les utilisateurs ayant un comment signalés

		require('view/backend/adminView.php');
	}


}
//**********************************************************************
function getEpisodeHaveComment($aComment)
{
	$aEpisode = array();
	$akeyDoble = array(); // array qui contiendra les id des episode déjà chargé pour éviter les doublons

	for($i = 0 ; $i < count($aComment) ; $i++)
	{
		foreach ($aComment[$i] as $key => $value)
		{
			if($key =='idEpisode')
			{
				if(!in_array($value, $akeyDoble))
				{
					$episode = new Episode; 
					$aEpisode2 = $episode-> get($value);
					array_push($aEpisode, $aEpisode2[0]);
					array_push($akeyDoble, $value);
				}
			}
		}
	}

	return $aEpisode;
}
//**********************************************************************
function getUserHadPostComment($aComment, $aReply)
{
	$aUser = array();
	$akeyDoble = array(); // array qui contiendra les id des pseudo déjà chargé pour éviter les doublons

	for($i = 0 ; $i < count($aComment) ; $i++)
	{
		foreach ($aComment[$i] as $keyComment => $valueComment)
		{
			if($keyComment =='idUser')
			{
				if(!in_array($valueComment, $akeyDoble))
				{
					$user  = new User();
					$aUser2 = $user->get('id', $valueComment); 
					array_push($aUser, $aUser2[0]);
					array_push($akeyDoble, $valueComment);
				}
			}
		}
	}
		for($j = 0 ; $j < count($aReply) ; $j++)
	{
		foreach ($aReply[$j] as $keyReply => $valueReply)
		{
			if($keyReply =='iduser_reply')
			{
				if(!in_array($valueReply, $akeyDoble))
				{
					$user  = new User();
					$aUser3 = $user->get('id', $valueReply); 
					array_push($aUser, $aUser3[0]);
					array_push($akeyDoble, $valueReply);
				}
			}
		}
	}
	return $aUser;
}
//**********************************************************************
function getEpisodeSignal($aCommentSignal, $episode)
{
	$aEpisodeSignal = array();
	$akeyDoble = array(); // array qui contiendra les id des episode déjà chargé pour éviter les doublons

	for($i = 0 ; $i < count($aCommentSignal) ; $i++)
	{
		foreach ($aCommentSignal[$i] as $key => $value)
		{
			if($key =='idEpisode')
			{
				if(!in_array($value, $akeyDoble))
				{
					$episode = new Episode; 
					$aEpisode2 = $episode-> get($value);
					array_push($aEpisodeSignal, $aEpisode2[0]);
					array_push($akeyDoble, $value);
				}
			}
		}
	}
	return $aEpisodeSignal;
}
//**********************************************************************
function getUserSignal($aUser)
{
	$aUserSignal = array();  
	for($i = 0 ; $i < count($aUser) ; $i++) 
	{
		foreach ($aUser[$i] as $key => $value)
		{
			if($key =='reporting')
			{
				if($value != 0)
				array_push($aUserSignal, $aUser[$i]);
			}
		}
	}
	return $aUserSignal ;
}

//**********************************************************************
function recupEpisodeSelect($valEpModif)
{
	$episode = new Episode();
	$aEpisode = $episode->getForModif($_POST['valEpModif']);
	if($aEpisode === false){
		$aEpisode = array();
	}
	echo json_encode($aEpisode);
	//echo ' '.$aEpisode[0]['title'].'`'.$aEpisode[0]['episode'].'`'.$aEpisode[0]['id'].'';
}
//***********************************************************************
function delEpisodeSelect($valEpDel)
{
	$episode  = new Episode();
	$aEpisode = $episode->delete($valEpDel);
	$comment  = new Comment; // on supprime aussi les commentaires et les réponses des épisodes supprimé
	$deletCom = $comment->deleteByEpisode($valEpDel);
	$reply    = new Reply;
	$deletRep = $reply->deleteByComment($valEpDel);

}
//**********************************************************************
function commentEpisodeSelect($idEpisode) //(requete AJAX)
{
	$table = '';
	$comment = new Comment(); // on recup les commentaire + le pseudo dans la table user
	$aComment = $comment->getAllCommentOrderJoin('idEpisode', $idEpisode, 'commentTime', 'user', 'idUser', 'id', 'pseudo');
	if($aComment === false){
		$aComment = array();
	}
	foreach ($aComment as $key => $value)
	{
		$date=strftime('%d-%m-%Y',strtotime($value['commentTime']));
		$aComment[$key]['commentTime'] = $date;
		$reply = new Reply; // on recupère les réponse correspondantes aux commentaires + pseudo dans la table user
		$aReply = $reply->getAllReplyOrderJoin('idcomment_reply', $value['id'], 'dateReply', 'user', 'iduser_reply', 'id', 'pseudo');
		$aComment[$key]['reply'] = $aReply;
	}
	echo json_encode($aComment);
}
//**********************************************************************
function commentPseudoSelect($idPseudo)//(requete AJAX)
{
	$table = '';
	$comment  = new Comment();
	$aComment = $comment->getAllCommentSelect('idUser', $idPseudo);
	if($aComment === false){
		$aComment = array();
	}
	foreach($aComment as $key => $value)
	{
		$date=strftime('%d-%m-%Y',strtotime($value['commentTime']));
		$aComment[$key]['commentTime'] = $date;
	}
	$reply    = new ReplyManager;
	$aReply   = $reply->getAllReplySelect('iduser_reply', $idPseudo);
	if($aReply === false){
		$aReply = array();
	}
	foreach($aReply as $key2 => $value2)
	{
		$date2=strftime('%d-%m-%Y',strtotime($value2['dateReply']));
		$aReply[$key2]['dateReply'] = $date2;
	}
	$aAll = array(
		0=>$aComment,
		1=>$aReply);

	echo json_encode($aAll);
}
//**********************************************************************
function commentSignalEpisodeSelect($idEpisodeSignal)//(requete AJAX)
{
	$table = '';
	$comment = new Comment(); // on recup les commentaire + le pseudo dans la table user
	$aComment = $comment->getAllCommentSignalSelectJoin('idEpisode', $idEpisodeSignal, 'user', 'idUser', 'id', 'pseudo');
	if($aComment === false){
		$aComment = array();
	}
	foreach ($aComment as $key => $value)
	{
		$date=strftime('%d-%m-%Y',strtotime($value['commentTime']));
		$aComment[$key]['commentTime'] = $date;
		$reply = new Reply; // on recupère les réponse correspondantes aux commentaires + pseudo dans la table user
		$aReply = $reply->getAllReplySignalSelectJoin('idcomment_reply', $value['id'], 'user', 'iduser_reply', 'id', 'pseudo');
		if($aReply === false){
			$aReply = array();
		}
		foreach($aReply as $key2 => $value2)
		{
			$dateRe=strftime('%d-%m-%Y',strtotime($value2['dateReply']));
			$aReply[$key2]['dateReply'] = $dateRe;
		}
		$aComment[$key]['reply'] = $aReply;
	}
	//print_r($aComment);
	echo json_encode($aComment);
}
//**********************************************************************
function commentSignalPseudoSelect($idPseudoSignal)//(requete AJAX)
{
	$table = '';
	$comment  = new Comment();
	$aComment = $comment->getAllCommentSignalSelect('idUser', $idPseudoSignal);
	if($aComment === false){
		$aComment = array();
	}
	foreach($aComment as $key => $value)
	{
		$date=strftime('%d-%m-%Y',strtotime($value['commentTime']));
		$aComment[$key]['commentTime'] = $date;
	}

	$reply    = new Reply;
	$aReply   = $reply->getAllReplySelect('iduser_reply', $idPseudoSignal);
	if($aReply === false){
		$aReply = array();
	}
		foreach($aReply as $key2 => $value2)
		{
			$date2=strftime('%d-%m-%Y',strtotime($value2['dateReply']));
			$aReply[$key2]['dateReply'] = $date2;
		}

	$aAll = array(
		0=>$aComment,
		1=>$aReply);


	echo json_encode($aAll); 
}

//**********************************************************************
function deleteCommentReply($idComment, $idUser)
{
	$comment  = new Comment;
	$deletCom = $comment->delete($idComment);

	$reply    = new Reply;
	$deletRep = $reply->deleteByComment($idComment);

	$user              = new User;
	$getInfosUser      = $user->get('id', $idUser);
	$actualiseModerate = $getInfosUser[0]['moderate'] + 1;
	$moderUser         = $user->update('moderate', $actualiseModerate, $idUser);
}
//**********************************************************************
function deleteReply($idReply, $idUser)
{
	$reply    = new Reply;
	$deletRep = $reply->delete($idReply);

	$user              = new User;
	$getInfosUser      = $user->get('id', $idUser);
	$actualiseModerate = $getInfosUser[0]['moderate'] + 1;
	$moderUser         = $user->update('moderate', $actualiseModerate, $idUser);
}

//**********************************************************************
function getPseudoModerate($idUser)
{
	$user  = new User();
	$aUserInfos = $user->get('id', $idUser); 
	$aUserInfos[0]['inscription']=strftime('%d-%m-%Y',strtotime($aUserInfos[0]['inscription']));
	echo json_encode($aUserInfos[0]);
}
//**********************************************************************
function deletePseudo($idUser)
{
	$user = new User; // on ne supprime pas le compte, mais on le bloque
	$user-> update('pseudo', 'Profil supprimé', $idUser);
	$user-> update('deleteUser', '1', $idUser);
}
//********************************************************************
function updatePswUser($psw, $pswAgain, $idUser)
{

	$form = new Form;
	$alertConnectionPseudo = $form->tstSubPsw($psw, $pswAgain);
	if ($alertConnectionPseudo == '')
	{
		$pswHash = password_hash($psw, PASSWORD_DEFAULT);
		$user = new User;
		$user-> update('psw', $pswHash, $idUser);
	}
	echo $alertConnectionPseudo;
}
//*********************************************************************
function removeCommentSignal($idComment, $idUser)
{
	$majSignalComment = new Comment;
	$commentReporting = $majSignalComment->update($idComment, '0');

	$user              = new User;
	$getInfosUser      = $user->get('id', $idUser);
	$actualiseModerate = $getInfosUser[0]['reporting'] - 1;
	$moderUser         = $user->update('reporting', $actualiseModerate, $idUser);
}
//*********************************************************************
function removeReplySignal($idReply, $idUser)
{
	$majSignalReply = new Reply;
	$commentReporting = $majSignalReply->update($idReply, '0');;

	$user              = new User;
	$getInfosUser      = $user->get('id', $idUser);
	$actualiseModerate = $getInfosUser[0]['reporting'] - 1;
	$moderUser         = $user->update('reporting', $actualiseModerate, $idUser);
}
//*****************************************************************************
function saveNewEpisodeWrite($texteEpisode, $titleEpisode){

	$aDataEpisode=array(
	"episode"    => $texteEpisode,
	"showEpisode"=> '0',
	"title"      => $titleEpisode);

	$episode = new Episode;
	$episode -> hydrate($aDataEpisode);
	$episode -> add($episode);
	$episode2 = new episode;
	$newId = $episode2 -> getLastEpisodeNoShow();
	echo $newId[0]['MAX(id)'];
}
//*****************************************************************************
function saveEpisodeWrite($texteEpisode, $titleEpisode, $idepisode){

	$aDataEpisode2=array(
	"episode" => $texteEpisode,
	"id"      => $idepisode,
	"title"   => $titleEpisode);

	$episode2 = new Episode;
	$episode2 -> hydrate($aDataEpisode2);
	$episode2 -> update($episode2);
}
//*****************************************************************************
function publishEpisodeWrite($idepisode){
	$idepisode = (int) $idepisode;
	$episode = new Episode;
	$episode -> updatePublish($idepisode);
}