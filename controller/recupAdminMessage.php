<?php

require_once ('commonConfig.php');

	loadClass("Comment");
	loadClass("Episode");
	loadClass("User");
	loadClass("Reply");

	$icon->getDataToHydrate(13); // icone enveloppe
	$iconSend = $icon->getClasse();

//**********************************************************
	// recupère les commentaire et les réponses en fonction de l'épisode selectionné et les affiche dans une <table>
	
	if(isset($_POST['valCommentSelect']) && isset($_POST['valBddSelect']))
	{
		$table = '';
		if($_POST['valBddSelect'] == 'episode')
		{
			$comment = new Comment();
			$aComment = $comment->getAllCommentSelect('idEpisode', $_POST['valCommentSelect']);
			$table.='<thead colspan = 3><tr><th>'.$_POST['title'].'</th></tr></thead><tbody>';
			if (empty($aComment))
			{
				$table.= '<tr><td> Il n\'y a aucun commentaire pour le moment</td></tr>';
			}
			else
			{
				for($i = 0 ; $i < count($aComment); $i++)
				{
					$user = new User();
					$aUser = $user->get('id', $aComment[$i]['idUser']); // récupère le pseudo 
					$aComment[$i]['commentTime'] = strftime('%d-%m-%Y',strtotime($aComment[$i]['commentTime']));
					$table.= '<tr><td> Le '.$aComment[$i]['commentTime'].'</td><td> de '.$aUser[0]['pseudo'].' : </td><td> '.$aComment[$i]['comment'].'</td><td><span class="'.$iconSend.'" onclick="animSendMessageUser('.$aUser[0]['id'].','.$aUser[0]['pseudo'].');" ></span></td></tr>';

					foreach ($aComment[$i] as $keyComment => $valueComment)
					{
						if($keyComment == 'id')
						{
							$reply = new ReplyManager;
							$aReply = $reply->getAllReplyComment($valueComment);
							if (!empty($aReply))
							{
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
								for($k = 0 ; $k < count($aComment[$i]['reply']); $k++)
								{
									$table.= '<tr><td> Réponse le '.$aComment[$i]['reply'][$k]['dateReply'].'</td><td> de '.$aComment[$i]['reply'][$k]['pseudo'].' : </td><td> '.$aComment[$i]['reply'][$k]['reply'].'</td><td><span class="'.$iconSend.'" onclick="animSendMessageUser('.$aComment[$i]['reply'][$k]['iduser_reply'].','.$aComment[$i]['reply'][$k]['pseudo'].');" ></span></td></tr>';	
								}
							}
							
						}
					}
				}
			}
			$table.='</tbody>';
			echo $table;
		}