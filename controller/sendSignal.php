<?php
# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');

	loadClass("Comment");
	loadClass("Reply");
	loadClass("User");


/*echo $_POST['idCommentSignal'];
echo $_POST['idUserSignal'];*/


	if(isset($_POST['idUserSignal']) && isset($_POST['idCommentSignal']) )
	{
		$idIntUser = intval($_POST['idUserSignal']); // on transforme la string en int

		$majSignalUser = new User;
		$userReporting = $majSignalUser->get('id', $idIntUser); // on récup le nbr de signalement qu'il a reçut
		$userReporting[0]['reporting'] = $userReporting[0]['reporting'] +1; // on ajoute +1 de signalement
		$userReporting = $majSignalUser->update('reporting', $userReporting[0]['reporting'], $idIntUser); // maj du signalement

		$majSignalComment = new Comment;
		$commentReporting = $majSignalComment->update($_POST['idCommentSignal']);
	}
	//echo "- Commentaire signalé !";



	if(isset($_POST['idReplySignal']) && isset($_POST['idUserReplySignal']) )
	{
		$idIntUser = intval($_POST['idUserReplySignal']); // on transforme la string en int

		$majSignalUser = new User;
		$userReporting = $majSignalUser->get('id', $idIntUser); // on récup le nbr de signalement qu'il a reçut
		$userReporting[0]['reporting'] = $userReporting[0]['reporting'] +1; // on ajoute +1 de signalement
		$userReporting = $majSignalUser->update('reporting', $userReporting[0]['reporting'], $idIntUser); // maj du signalement

		$majSignalReply = new Reply;
		$commentReporting = $majSignalReply->update($_POST['idReplySignal']);
	}

	