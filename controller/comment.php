<?php

# Lecture du fichier de configuration commune + autoload
require_once ('commonConfig.php');

if(isset($_GET['id'])) // on test si les variable existe
{
	$idIntEpisode = intval($_GET['id']); // on transforme la string en int
	loadClass("Comment");
	loadClass("Reply");
	loadClass("User");

	$comment = new Comment; 	// on récupère tous les commentaires suivant l'id de l'épisode
	$aComment = $comment->getAllCommentOrder($idIntEpisode, 'commentTime');
	//print_r($aComment);
	for ($i = 0 ; $i < count($aComment) ; $i++)
	{
		foreach ($aComment[$i] as $key => $value)
		{
			if($key =='commentTime')
			{		// convertion date US en FR
				$aComment[$i]['commentTime'] = strftime('%d-%m-%Y',strtotime($aComment[$i]['commentTime'])); 
			}
			if($key == 'idUser')
			{
					$user = new User();
					$getInfosUser = $user->get('id', $aComment[$i]['idUser']);
					$aComment[$i]['pseudo'] = $getInfosUser[0]['pseudo'];
			}
			if ($key =='id')
			{ // on ajoute les réponse correspondantes aux commentaires
				$reply = new ReplyManager;
				$aReply = $reply->getAllReplyComment($value);
				for ($j = 0 ; $j < count($aReply) ; $j++)
				{
					foreach ($aReply[$j] as $keyReply => $valueRepy)
					{
						if($keyReply == 'dateReply')
						{
							$aReply[$j]['dateReply'] = strftime('%d-%m-%Y',strtotime($aReply[$j]['dateReply'])); 
						}
						if($keyReply == 'iduser_reply')
						{
							$userReply = new User();
							$getInfosUserReply = $userReply->get('id', $aReply[$j]['iduser_reply']);
							$aReply[$j]['pseudo'] = $getInfosUserReply[0]['pseudo'];
						}
					}
				}
				$aComment[$i]['reply'] = $aReply;
			}

		}
	}

}else{
	$showComment = 'Il n\'y a aucun commentaire pour le moment.';
}
/*echo'<pre>';
print_r($aComment);
echo'</pre>';*/

$icon->getDataToHydrate(6); // icone signaler
$iconSignal = $icon->getClasse();

$icon->getDataToHydrate(5); // icone connexion
$iconConnect = $icon->getClasse();

$icon->getDataToHydrate(7); // icone check
$iconCheck = $icon->getClasse();

$icon->getDataToHydrate(17); // icone plus
$iconPlus = $icon->getClasse();

$icon->getDataToHydrate(18); // icone moins
$iconMinus = $icon->getClasse();

$icon->getDataToHydrate(11); // icone pen
$iconPen = $icon->getClasse();

$icon->getDataToHydrate(8); // icone annuler
$iconAnnul = $icon->getClasse();

loadClass("BuildDivComment");

$divEpisodes = <<<EOT
 	<div id="globalComment">
 		<div id="headerComment">
 			<p>Les commentaires des lecteurs </p>
EOT;

$isConnect = false;
if(isset($_SESSION['idUser']) && isset($_SESSION['pseudo']) && isset($_SESSION['admin']))
{ // On vérifie si l'utilisisateur est connecté.
	$isConnect = true;
	$date = date("d-m-Y");
	$pseudoConnect = $_SESSION['pseudo'];
	$idUser = $_SESSION['idUser'];
	$num = $_GET['id'];
	//echo 'connecté';
	$divEpisodes .=<<<EOT
			<p> - Laissez un message <span class="$iconPen contentInputComment" onclick="javascript:animDivWriteCommentOpen('headerComment', 'contentInputComment')"></span>
			</p>
		</div>
		<div id="contentInputComment">
			<form method="post">
				<div class="formComment">
					<label for="commentUserConnect"></label>
					<div class="hideInfoCommentSend">
						<p id='pseudoComment'> $pseudoConnect </p>
						<p id='idUserComment'> $idUser </p>
						<p id='dateComment'> $date </p>
						<p id='numEpisode'> $num </p>
					</div>
					<textarea id ="commentUserConnect" name ="commentUserConnect" placeholder="Votre commentaire ..." contenteditable ="true">
					</textarea>
					<div class='formColumComment'>
						<span class="$iconAnnul contentInputComment" onclick="javascript:animDivWriteCommentClose('headerComment', 'contentInputComment')"></span>
						<button type="submit" class="$iconCheck" name='sendComment'></button>
					</div>
				</div>
			</form>
	 	</div>
EOT;

}
if($isConnect === false) // Si pas de connexion, on ajoute un lien vers login.php
{
	$pseudoConnect='';
	$divEpisodes .= <<<EOT
 			<a href='$pConnect' alt="Espace connexion"><p> - Vous devez être connecté pour laisser un commentaire ou en signaler un <span class="$iconConnect"></span></p></a>
 		</div>
EOT;
}

//echo $pseudoConnect;
for ($i = 0 ; $i < count($aComment) ; $i++)
{
	$div = new BuildDivComment($aComment[$i]);

	$divComment = $div->build($iconSignal, $iconCheck, $iconAnnul, $iconPlus, $iconMinus, $iconPen, $i, $idIntEpisode, $isConnect, $pseudoConnect);
	$divEpisodes .= $divComment;
}


echo $divEpisodes .=<<<EOT
	</div>
EOT;
