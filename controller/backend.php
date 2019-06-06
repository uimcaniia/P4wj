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
	$aUser = $user->getAllUser();

	$comment        = new Comment; 	
	$aCommentSignal = $comment->getAllCommentSignal();

	$episode  = new Episode; 
	$aEpisode = $episode->getAllEpisode();

	$message         = new Message; 
	$aMessageSend    = $message->get('send', $_SESSION['idUser']);
	$aMessageReceive = $message->get('receive', $_SESSION['idUser']);

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