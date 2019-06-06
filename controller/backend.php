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

function admin()
{
	$admin         = new Admin();
	$getInfosAdmin = $admin->get('id', $_SESSION['idUser']);
	$admin-> hydrate($getInfosAdmin[0]);

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
	$aEpisode = $episode->getAllEpisode(); // array contennt tous les épisodes

	$message         = new Message; 
	$aMessageSend    = $message->get('send', $_SESSION['idUser']);
	$aMessageReceive = $message->get('receive', $_SESSION['idUser']);





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
			if($key =='date')
			{
				$aMessageSend[$i]['date'] = strftime('%d-%m-%Y',strtotime($aMessageSend[$i]['date'])); 
			}
		}
	}

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
			if($key =='date')
			{
				$aMessageReceive[$i]['date'] = strftime('%d-%m-%Y',strtotime($aMessageReceive[$i]['date'])); 
			}
		}
	}
/*	echo '<pre>';
	print_r($aMessageSend);
	echo '</pre>';*/

	$aUserSignal = array();  
	$aEpisodeSignal = array();

	for($i = 0 ; $i < count($aUser) ; $i++) // on récupère tous les utilisateur signalés
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

	 // on récupère tous les épisodes ayant reçut uncommentaire signalés
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



	

	require('view/backend/adminView.php');
}

function allReceiveMessage($idUser)
{
	require('view/backend/commonView.php');
}

function allSendMessage($idUser)
{
	require('view/backend/commonView.php');
}

function sendMessage($idUser, $idrecipient)
{
	require('view/backend/commonView.php');
}

function deleteMessage($idMess)
{
	require('view/backend/commonView.php');
}


function showCommentEpisode($idEpisode)
{
	require('view/backend/adminView.php');
}

function showCommentPseudo($idseudo)
{
	require('view/backend/adminView.php');
}

function showCommentCommentSignal($idEpisodeSignal)
{
	require('view/backend/adminView.php');
}

function showCommentPseudoSignal($idPseudoSignal)
{
	require('view/backend/adminView.php');
}