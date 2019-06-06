<?php

// Chargement des classes
require_once('model/Episode.php');

function space()
{
	require('view/backend/spaceView.php');
}

function admin()
{
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