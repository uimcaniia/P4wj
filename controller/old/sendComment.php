<?php
# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');

	loadClass("Comment");
	loadClass("Reply");
	loadClass("User");

echo $_POST['valDivComment'];

	if (isset($_POST['valDivComment']) && isset($_POST['pseudo']) && isset($_POST['idUser']) &&isset($_POST['idEpisode']))
	{
		$commentTrim = trim($_POST['valDivComment']); // on supprime les espace blanc en début et fin de chaine
		$comment = htmlspecialchars($commentTrim); // on sécurise le commentaire
		$idIntUser = intval($_POST['idUser']); 
		$idIntEpisode = intval($_POST['idEpisode']); 

		$majCommentUser = new User;
		$userComment = $majCommentUser->get('id', $idIntUser); // on récup le nbr de commentaire qu'il a posté
		$userComment[0]['comment'] = $userComment[0]['comment'] +1; // on ajoute +1 de commentaire
		$userComment = $majCommentUser->update('comment', $userComment[0]['comment'], $idIntUser); // maj du nbr de commentaire
		$aDataComment=array(
			array(
				"comment"   => "'$comment'",
				"idEpisode" => "'$idIntEpisode'",
				"idUser"    => "'$idIntUser'"));

		$comment = new Comment; // on ajoute le nouveau commentaire
		$commentReporting = $comment->hydrate($aDataComment);
		$comment->add($comment);
	}
	else{
		echo "- Une erreur est survenue !";
	}



