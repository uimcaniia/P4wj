<?php

function space()
{
	$user         = new User();
	$getInfosUser = $user->get('id', $_SESSION['idUser']);
	$user-> hydrate($getInfosUser[0]);

	$input       = new Input();
	$inputPseudo = $input->get(10); // array contenant les attribut du champs input pseudo

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

	$input       = new Input();
	$inputPseudo = $input->get(10); // array contenant les attribut du champs input pseudo

	$inputNewPassword    = $input->get(14);// array contenant les attribut du champs input password
	$inputRepeatPassword = $input->get(15);
	array_push($inputNewPassword, $inputRepeatPassword[0]); // assemblage des 2 array

	$user  = new User();
	$aUser = $user->getAllUser(); // array contennt tous les utilisateurs

	$comment        = new Comment; 	
	$aCommentSignal = $comment->getAllCommentSignal(); // array contennt tous les commentaires signalés

	$episode  = new Episode; 
	$aEpisode = $episode->getAllEpisode(); // array contenant tous les épisodes

	$message         = new Message; 
	$aMessageSend    = $message->get('send', $_SESSION['idUser']); // array qui contiendra tout les message envoyés
	$aMessageReceive = $message->get('receive', $_SESSION['idUser']); // et les message reçut

	$aUserSignal     = getUserSignal($aUser);// on récupère tous les utilisateur signalés
	$aEpisodeSignal  = getEpisodeSignal($aCommentSignal, $episode);  // on récupère tous les épisodes ayant uncomment signalés
	$aMessageSend    = getMessageSend($aMessageSend);
	$aMessageReceive = getMessageReceive($aMessageReceive);

	require('view/backend/adminView.php');
}
//**********************************************************************
/*$aEpisode, $aUser, $aUserSignal, $aEpisodeSignal,*/
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
	$episode = new Episode();
	$aEpisode = $episode->delete($valEpDel);
//	echo $aEpisode;
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
		$table.= '<tr><td> Le '.$aComment[$i]['commentTime'].'</td><td> de '.$aComment[$i]['pseudo'].' : </td><td> '.$aComment[$i]['comment'].'</td><td><span class="fas fa-envelope" onclick="animSendMessageUser(\''.$aComment[$i]['id'].'\',\''.$aComment[$i]['pseudo'].'\', );"></span></td></tr>';

		for($k = 0 ; $k < count($aComment[$i]['reply']); $k++)
		{
			$table.= '<tr><td> Réponse le '.$aComment[$i]['reply'][$k]['dateReply'].'</td><td> de '.$aComment[$i]['reply'][$k]['pseudo'].' : </td><td> '.$aComment[$i]['reply'][$k]['reply'].'</td><td><span class="fas fa-envelope" onclick="animSendMessageUser(\''.$aComment[$i]['reply'][$k]['iduser_reply'].'\',\''.$aComment[$i]['reply'][$k]['pseudo'].'\');"></span></td></tr>';	
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
		$table.= '<tr><td> Commentaire du '.$aComment[$i]['commentTime'].'</td><td> '.$aComment[$i]['comment'].'</td></tr>';
	}

	if (!empty($aReply))
	{
		for ($j = 0 ; $j < count($aReply) ; $j++)
		{
			$table.= '<tr><td> Réponse du '.$aReply[$j]['dateReply'].'</td><td> '.$aReply[$j]['reply'].'</td></tr>';
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

	$table.='<thead><tr><th colspan = 4>TITRE</th></tr></thead><tbody>';
	
	for($i = 0 ; $i < count($aComment); $i++)
	{
		$table.= '<tr><td> Le '.$aComment[$i]['commentTime'].'</td><td> de '.$aComment[$i]['pseudo'].' : </td><td> '.$aComment[$i]['comment'].'</td><td><span class="fas fa-envelope" onclick="animSendMessageUser(\''.$aComment[$i]['id'].'\',\''.$aComment[$i]['pseudo'].'\', );"></span></td></tr>';

		for($k = 0 ; $k < count($aComment[$i]['reply']); $k++)
		{
			$table.= '<tr><td> Réponse le '.$aComment[$i]['reply'][$k]['dateReply'].'</td><td> de '.$aComment[$i]['reply'][$k]['pseudo'].' : </td><td> '.$aComment[$i]['reply'][$k]['reply'].'</td><td><span class="fas fa-envelope" onclick="animSendMessageUser(\''.$aComment[$i]['reply'][$k]['iduser_reply'].'\',\''.$aComment[$i]['reply'][$k]['pseudo'].'\');"></span></td></tr>';	
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
	$reply    = new ReplyManager;
	$aReply   = $reply->getAllReplySelect('iduser_reply', $idPseudoSignal);

	$table.='<thead><tr></tr></thead><tbody>';

	for($i = 0 ; $i < count($aComment); $i++)
	{
		$table.= '<tr><td> Commentaire du '.$aComment[$i]['commentTime'].'</td><td> '.$aComment[$i]['comment'].'</td></tr>';
	}

	if (!empty($aReply))
	{
		for ($j = 0 ; $j < count($aReply) ; $j++)
		{
			$table.= '<tr><td> Réponse du '.$aReply[$j]['dateReply'].'</td><td> '.$aReply[$j]['reply'].'</td></tr>';
		}
	}	
			$table.='</tbody>';
			echo $table;
		}

//**********************************************************************

function allReceiveMessage($idUser)
{
	require('view/backend/commonView.php');
}
//**********************************************************************
function allSendMessage($idUser)
{
	require('view/backend/commonView.php');
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
		$table=	'<tr><td>'.$aDataMessage['date'].'</td><td>'.$aDataMessage['receive'].'</td><td>'.$aDataMessage['subject'].'</td><td>'.$aDataMessage['text'].'</td></tr>';
	return $table;
}
//**********************************************************************
function deleteMessage($idMess)
{
	$message = new Message();
	$message->delete($idMess);
}
