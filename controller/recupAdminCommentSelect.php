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
			$table.='<thead><tr><th colspan = 4>'.$_POST['title'].'</th></tr></thead><tbody>';
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
					$table.= '<tr><td> Le '.$aComment[$i]['commentTime'].'</td><td> de '.$aUser[0]['pseudo'].' : </td><td> '.$aComment[$i]['comment'].'</td><td><span class="'.$iconSend.'" onclick="animSendMessageUser(\''.$aUser[0]['id'].'\',\''.$aUser[0]['pseudo'].'\', );"></span></td></tr>';

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
									$table.= '<tr><td> Réponse le '.$aComment[$i]['reply'][$k]['dateReply'].'</td><td> de '.$aComment[$i]['reply'][$k]['pseudo'].' : </td><td> '.$aComment[$i]['reply'][$k]['reply'].'</td><td><span class="'.$iconSend.'" onclick="animSendMessageUser(\''.$aComment[$i]['reply'][$k]['iduser_reply'].'\',\''.$aComment[$i]['reply'][$k]['pseudo'].'\');" ></span></td></tr>';	
								}
							}
							
						}
					}
				}
			}
			$table.='</tbody>';
			echo $table;
		}

		// recupère les commentaires et les réponses en fonction du pseudo selectionné et les affiche dans une <table>
		if($_POST['valBddSelect'] == 'pseudo')
		{
			$comment = new Comment();
			$aComment = $comment->getAllCommentSelect('idUser', $_POST['valCommentSelect']);

			$table.='<thead><tr><th>'.$_POST['title'].'</th><th><span class="'.$iconSend.'" onclick="animSendMessageUser(\''.$_POST['valCommentSelect'].'\',\''.$_POST['title'].'\');" ></span></th></tr></thead><tbody>';

			for($i = 0 ; $i < count($aComment); $i++)
			{
				$aComment[$i]['commentTime'] = strftime('%d-%m-%Y',strtotime($aComment[$i]['commentTime']));
				$table.= '<tr><td> Commentaire du '.$aComment[$i]['commentTime'].'</td><td> '.$aComment[$i]['comment'].'</td></tr>';
			}

			$reply = new ReplyManager;
			$aReply = $reply->getAllReplySelect('iduser_reply', $_POST['valCommentSelect']);

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
					}
					$table.= '<tr><td> Réponse du '.$aReply[$j]['dateReply'].'</td><td> '.$aReply[$j]['reply'].'</td></tr>';
				}
			}		
			
			$table.='</tbody>';
			echo $table;
		}
		//*****************************************
		// recupère les commentaires et les réponses signalées en fonction de l'épisode selectionné et les affiche dans une <table>
		if($_POST['valBddSelect'] == 'episodeSignal')
		{
			$comment = new Comment();
			$aComment = $comment->getAllCommentSignalSelect('idEpisode', $_POST['valCommentSelect']);
			$table.='<thead><tr><th  colspan = 4>'.$_POST['title'].'</th></tr></thead><tbody>';
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
					$table.= '<tr><td> Le '.$aComment[$i]['commentTime'].'</td><td> de '.$aUser[0]['pseudo'].' : </td><td> '.$aComment[$i]['comment'].'</td><td><span class="'.$iconSend.'" onclick="animSendMessageUser(\''.$aUser[0]['id'].'\',\''.$aUser[0]['pseudo'].'\');" ></span></td</tr>';

					foreach ($aComment[$i] as $keyComment => $valueComment)
					{
						if($keyComment == 'id')
						{
							$reply = new ReplyManager;
							$aReply = $reply->getAllReplySignalSelect('idcomment_reply', $valueComment);
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
									$table.= '<tr><td> Réponse le '.$aComment[$i]['reply'][$k]['dateReply'].'</td><td> de '.$aComment[$i]['reply'][$k]['pseudo'].' : </td><td> '.$aComment[$i]['reply'][$k]['reply'].'</td><td><span class="'.$iconSend.'" onclick="animSendMessageUser(\''.$aComment[$i]['reply'][$k]['iduser_reply'].'\',\''.$aComment[$i]['reply'][$k]['pseudo'].'\');" ></span></td></tr>';	
								}
							}
							
						}
					}
				}
			}
			$table.='</tbody>';
			echo $table;
		}

		// recupère les commentaires et les réponses signalées en fonction du pseudo selectionné et les affiche dans une <table>
		if($_POST['valBddSelect'] == 'pseudoSignal')
		{
			$comment = new Comment();
			$aComment = $comment->getAllCommentSignalSelect('idUser', $_POST['valCommentSelect']);

			$table.='<thead><tr><th>'.$_POST['title'].'</th><th><span class="'.$iconSend.'" onclick="animSendMessageUser(\''.$_POST['valCommentSelect'].'\',\''.$_POST['title'].'\');" ></span></th></tr></thead><tbody>';

			for($i = 0 ; $i < count($aComment); $i++)
			{
				$aComment[$i]['commentTime'] = strftime('%d-%m-%Y',strtotime($aComment[$i]['commentTime']));
				$table.= '<tr><td> Commentaire du '.$aComment[$i]['commentTime'].'</td><td> '.$aComment[$i]['comment'].'</td></tr>';
			}

			$reply = new ReplyManager;
			$aReply = $reply->getAllReplySignalSelect('iduser_reply', $_POST['valCommentSelect']);

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
					}
					$table.= '<tr><td> Réponse du '.$aReply[$j]['dateReply'].'</td><td> '.$aReply[$j]['reply'].'</td></tr>';
				}
			}		
			
			$table.='</tbody>';
			echo $table;
		}


	}