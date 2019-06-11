<?php

function space()
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

	$reply = new Reply; // on recupère les réponse correspondantes aux commentaires + pseudo dans la table user
	$aReply = $reply->getAllReply();

	$comment        = new Comment; 	
	$aCommentSignal = $comment->getAllCommentSignal(); // array contennt tous les commentaires signalés
	$aAllCommentCompare = $comment->getAllComment();

	$aUser = getUserHadPostComment($aAllCommentCompare, $aReply); // array contennt tous les utilisateurs qui ont posté des commentaire où répondut
	$episode = new Episode;
	$aEpisode = $episode ->getAllEpisode();
	$aEpisodeHaveComment = getEpisodeHaveComment($aAllCommentCompare); // array contenant tous les épisode ayant reçut des commentaires
	$message         = new Message; 
	$aMessageSend    = $message->get('send', $_SESSION['idUser'], 'date ASC'); // array qui contiendra tout les message envoyés
	$aMessageReceive = $message->get('receive', $_SESSION['idUser'], 'date ASC'); // et les message reçut

	$aUserSignal     = getUserSignal($aUser);// on récupère tous les utilisateur signalés

	$aEpisodeSignal  = getEpisodeSignal($aCommentSignal, $episode);  // on récupère tous les épisodes ayant uncomment signalés

	$user = new User;
	$aUserModo   = $user ->getAllUserExist();
	$aUserModerate   = $user ->getOnlyUserSignalExist($aUserModo);// on récupère tous les épisodes ayant uncomment signalés

	$aMessageSend    = getMessageSend($aMessageSend);
	$aMessageReceive = getMessageReceive($aMessageReceive);

	require('view/backend/adminView.php');
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
function getMessageSend($aMessageSend)
{
	for($i = 0 ; $i < count($aMessageSend) ; $i++)
	{
		foreach ($aMessageSend[$i] as $key => $value)
		{
			if($key =='receive')
			{
				$user = new User; 
				$aPseudo = $user-> get('id', $value);
				$aMessageSend[$i]['pseudo'] = $aPseudo[0]['pseudo'];
			}

		}
	}
	return $aMessageSend;
}
//**********************************************************************
function getMessageReceive($aMessageReceive)
{
	for($i = 0 ; $i < count($aMessageReceive) ; $i++)
	{
		foreach ($aMessageReceive[$i] as $key => $value)
		{
			if($key =='send')
			{
				$user = new User; 
				$aPseudo = $user-> get('id', $value);
				$aMessageReceive[$i]['pseudo'] = $aPseudo[0]['pseudo'];
			}

		}
	}
	return $aMessageReceive;
}
//**********************************************************************
function recupEpisodeSelect($valEpModif)
{
	$episode = new Episode();
	$aEpisode = $episode->get($_POST['valEpModif']);
	echo ' '.$aEpisode[0]['title'].'`'.$aEpisode[0]['episode'].'`'.$aEpisode[0]['id'].'';
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

	foreach ($aComment as $key => $value)
	{
		$reply = new Reply; // on recupère les réponse correspondantes aux commentaires + pseudo dans la table user
		$aReply = $reply->getAllReplyOrderJoin('idcomment_reply', $value['id'], 'dateReply', 'user', 'iduser_reply', 'id', 'pseudo');
		$aComment[$key]['reply'] = $aReply;
	}

	$table.='<thead><tr><th colspan = 4>TITRE</th></tr></thead><tbody>';

	for($i = 0 ; $i < count($aComment); $i++)
	{
		$table.= '<tr><td> Le '.$aComment[$i]['commentTime'].'</td><td> de '.$aComment[$i]['pseudo'].' : </td><td> '.$aComment[$i]['comment'].'</td><td><span class="fas fa-envelope" onclick="animSendMessageUser(\''.$aComment[$i]['idUser'].'\',\''.$aComment[$i]['pseudo'].'\', \''.$_SESSION['idUser'].'\');"></span></td></tr>';

		for($k = 0 ; $k < count($aComment[$i]['reply']); $k++)
		{
			$table.= '<tr><td> Réponse le '.$aComment[$i]['reply'][$k]['dateReply'].'</td><td> de '.$aComment[$i]['reply'][$k]['pseudo'].' : </td><td> '.$aComment[$i]['reply'][$k]['reply'].'</td><td><span class="fas fa-envelope" onclick="animSendMessageUser(\''.$aComment[$i]['reply'][$k]['iduser_reply'].'\',\''.$aComment[$i]['reply'][$k]['pseudo'].'\', \''.$_SESSION['idUser'].'\');"></span></td></tr>';	
		}
	}
	$table.='</tbody>';
	echo $table;
}
//**********************************************************************
function commentPseudoSelect($idPseudo)//(requete AJAX)
{
	$table = '';
	$comment  = new Comment();
	$aComment = $comment->getAllCommentSelect('idUser', $idPseudo);
	$reply    = new ReplyManager;
	$aReply   = $reply->getAllReplySelect('iduser_reply', $idPseudo);

	$table.='<thead><tr></tr></thead><tbody>';

	for($i = 0 ; $i < count($aComment); $i++)
	{
		$table.= '<tr><td> Commentaire du '.$aComment[$i]['commentTime'].'</td><td> '.$aComment[$i]['comment'].'</td><td></td></tr>';
	}

	if (!empty($aReply))
	{
		for ($j = 0 ; $j < count($aReply) ; $j++)
		{
			$table.= '<tr><td> Réponse du '.$aReply[$j]['dateReply'].'</td><td> '.$aReply[$j]['reply'].'</td><td></td></tr>';
		}
	}		
	
	$table.='</tbody>';
	echo $table;
}
//**********************************************************************
function commentSignalEpisodeSelect($idEpisodeSignal)//(requete AJAX)
{
	$table = '';
	$comment = new Comment(); // on recup les commentaire + le pseudo dans la table user
	$aComment = $comment->getAllCommentSignalSelectJoin('idEpisode', $idEpisodeSignal, 'user', 'idUser', 'id', 'pseudo');
	foreach ($aComment as $key => $value)
	{
		$reply = new Reply; // on recupère les réponse correspondantes aux commentaires + pseudo dans la table user
		$aReply = $reply->getAllReplySignalSelectJoin('idcomment_reply', $value['id'], 'user', 'iduser_reply', 'id', 'pseudo');;
		$aComment[$key]['reply'] = $aReply;
	}

	$table.='<thead><tr><th colspan = 6>TITRE</th></tr></thead><tbody>';
	
	for($i = 0 ; $i < count($aComment); $i++)
	{
		$table.= '<tr><td> Le '.$aComment[$i]['commentTime'].'</td><td> de '.$aComment[$i]['pseudo'].' : </td><td> '.$aComment[$i]['comment'].'</td><td><span class="fas fa-envelope" onclick="animSendMessageUser(\''.$aComment[$i]['idUser'].'\',\''.$aComment[$i]['pseudo'].'\');"></span></td><td><span class="fas fa-times" onclick="delComAndRep(\''.$aComment[$i]['id'].'\',\'comment\',\'\',\''.$aComment[$i]['idUser'].'\',\'byEpisode\');"></span></td><td><span class="fas fa-bell-slash" onclick="removeSignal(\''.$aComment[$i]['id'].'\',\'comment\',\'\',\''.$aComment[$i]['idUser'].'\',\'byEpisode\');"></span></td></tr>';

		for($k = 0 ; $k < count($aComment[$i]['reply']); $k++)
		{
			$table.= '<tr><td> Réponse le '.$aComment[$i]['reply'][$k]['dateReply'].'</td><td> de '.$aComment[$i]['reply'][$k]['pseudo'].' : </td><td> '.$aComment[$i]['reply'][$k]['reply'].'</td><td><span class="fas fa-envelope" onclick="animSendMessageUser(\''.$aComment[$i]['reply'][$k]['iduser_reply'].'\',\''.$aComment[$i]['reply'][$k]['pseudo'].'\');"></span></td><td><span class="fas fa-times" onclick="delComAndRep(\''.$aComment[$i]['id'].'\',\'reply\',\''.$aComment[$i]['reply'][$k]['id'].'\',\''.$aComment[$i]['reply'][$k]['iduser_reply'].'\',\'byEpisode\');"></span></td><td><span class="fas fa-bell-slash" onclick="removeSignal(\''.$aComment[$i]['id'].'\',\'reply\',\''.$aComment[$i]['reply'][$k]['id'].'\',\''.$aComment[$i]['reply'][$k]['iduser_reply'].'\',\'byEpisode\');"></span></td></tr>';	
		}
	}

	$table.='</tbody>';
	echo $table;
}
//**********************************************************************
function commentSignalPseudoSelect($idPseudoSignal)//(requete AJAX)
{
	$table = '';
	$comment  = new Comment();
	$aComment = $comment->getAllCommentSignalSelect('idUser', $idPseudoSignal);
	$reply    = new Reply;
	$aReply   = $reply->getAllReplySelect('iduser_reply', $idPseudoSignal);

	$table.='<thead><tr></tr></thead><tbody>';

	for($i = 0 ; $i < count($aComment); $i++)
	{
		$table.= '<tr"><td> Commentaire du '.$aComment[$i]['commentTime'].'</td><td> '.$aComment[$i]['comment'].'</td><td><span class="fas fa-times" onclick="delComAndRep(\''.$aComment[$i]['id'].'\',\'comment\',\'\',\''.$aComment[$i]['idUser'].'\',\'byPseudo\');"></span></td><td><span class="fas fa-bell-slash" onclick="removeSignal(\''.$aComment[$i]['id'].'\',\'comment\',\'\',\''.$aComment[$i]['idUser'].'\',\'byPseudo\');"></span></td></tr>';
	}

	if (!empty($aReply))
	{
		for ($j = 0 ; $j < count($aReply) ; $j++)
		{
			$table.= '<tr><td> Réponse du '.$aReply[$j]['dateReply'].'</td><td> '.$aReply[$j]['reply'].'</td><td><span class="fas fa-times" onclick="delComAndRep(\''.$aReply[$j]['idcomment_reply'].'\',\'reply\',\''.$aReply[$j]['id'].'\',\''.$aReply[$j]['iduser_reply'].'\' ,\'byPseudo\');"></span></td><td><span class="fas fa-bell-slash" onclick="removeSignal(\''.$aReply[$j]['idcomment_reply'].'\',\'reply\',\''.$aReply[$j]['id'].'\',\''.$aReply[$j]['iduser_reply'].'\' ,\'byPseudo\');"></span></td></tr>';
		}
	}	
			$table.='</tbody>';
			echo $table;
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
function sendMessage($idUser, $idrecipient, $subject, $text) //(requete AJAX)
{
		$aDataMessage=array(
			"send"    => $idUser,
			"subject" => "'$subject'",
			"receive" => $idrecipient,
			"text"    => "'$text'");

		$message = new Message();
		$hydrateMess = $message->hydrate($aDataMessage);
		$message->add($message);
		$aLastMess = $message->getLastMessage();
		$mess = getMessJustSend($aLastMess[0]);
		echo $mess;
}
//**********************************************************************
function getMessJustSend($aDataMessage)
{
	$table=	'<tr><td>'.$aDataMessage['date'].'</td><td>'.$aDataMessage['pseudo'].'</td><td>'.$aDataMessage['subject'].'</td><td>'.$aDataMessage['text'].'</td></tr>';
	return $table;
}
//********************************************************************
function changeOrderMessage($colBdd, $sens, $idUser)
{
	$table = '';
	$message       = new Message; 
	$aMessage = $message->get($colBdd, $idUser, 'date '.$sens.''); // array qui contiendra tout les message 
	if($colBdd == 'receive')
	{
		$aMessageOrder = getMessageReceive($aMessage);
		for($i = 0 ; $i < count($aMessageOrder) ; $i++)
		{
			$idMess      = $aMessageOrder[$i]['id'];
			$idSend      = $aMessageOrder[$i]['send'];
			$dateReceive = $aMessageOrder[$i]['date'];
			$pseudo      = $aMessageOrder[$i]['pseudo'];
			$subject     = $aMessageOrder[$i]['subject'];
			$txt         = $aMessageOrder[$i]['text'];

			$table .='<tr><td>'.$dateReceive.'</td><td>'.$pseudo.'</td><td>'.$subject.'</td><td>'.$txt.'</td><td><span class="fas fa-times" onclick="animDelMessage(\''.$idMess.'\');"></span></td><td><span class="fas fa-envelope" onclick="animSendMessageUser(\''.$idSend.'\',\''.$pseudo.'\',\''.$_SESSION['idUser'].'\');"></span></td></tr>';
		}
	}
	elseif($colBdd == 'send')
	{
		$aMessageOrder = getMessageSend($aMessage);
			for($i = 0 ; $i < count($aMessageOrder) ; $i++)
			{
				$dateReceive = $aMessageOrder[$i]['date'];
				$pseudo      = $aMessageOrder[$i]['pseudo'];
				$subject     = $aMessageOrder[$i]['subject'];
				$txt         = $aMessageOrder[$i]['text'];

				$table .='<tr><td>'.$dateReceive.'</td><td>'.$pseudo.'</td><td>'.$subject.'</td><td>'.$txt.'</td>';
			}
	}
	echo $table;
}
//**********************************************************************
function deleteMessage($idMess)
{
	$message = new Message();
	$message->delete($idMess);
}
//**********************************************************************
function getPseudoModerate($idUser)
{
	$user  = new User();
	$aUserInfos = $user->get('id', $idUser); 

		$div ='<p>Pseudo : '.$aUserInfos[0]['pseudo'].'</p><p>Nombre de modération actuelle : '.$aUserInfos[0]['moderate'].'</p><p>Ce lecteur à posté '.$aUserInfos[0]['comment'].' commentaire dont '.$aUserInfos[0]['reporting'].' ont été signalé(s)</p><p>Il est inscrit depuis le '.$aUserInfos[0]['inscription'].'</p><div class="flexRow"><p>Voulez-vous bloquer ce lecteur?</p><span id="goDeletPseudoModerate" class="fas fa-user-slash" onclick="deletePseudo(\''.$aUserInfos[0]['id'].'\');"></span>';

	echo $div;
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
		//echo 'La mise a jour a bien été effectuée.';
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