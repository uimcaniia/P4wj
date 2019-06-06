
 	<div id="globalComment">
 		<div id="headerComment">
 			<p>Les commentaires des lecteurs </p>

 	<?php 
	 	$isConnect = false;
		if(isset($_SESSION['idUser']) && isset($_SESSION['pseudo']) && isset($_SESSION['admin']))
		{ // On vérifie si l'utilisisateur est connecté.
			$isConnect = true;
	?>


			<p> - Laissez un message <span class="fas fa-pen-nib contentInputComment" onclick="javascript:animDivWriteCommentOpen('headerComment', 'contentInputComment')"></span>
			</p>
		</div>
		<div id="contentInputComment">
			<form method="post">
				<div class="formComment">
					<label for="commentUserConnect"></label>
					<div class="hideInfoCommentSend">
						<p id='pseudoComment'><?= $_SESSION['pseudo'] ?></p>
						<p id='idUserComment'><?= $_SESSION['idUser'] ?></p>
						<p id='dateComment'><?= date("d-m-Y") ?></p>
						<p id='numEpisode'><?= $_GET['idEpisode'] ?></p>
					</div>
					<input type="text" id ="commentUserConnect" value="" name ="commentUserConnect" placeholder="Votre commentaire ...">
					<div class='formColumComment'>
						<span class="fas fa-times contentInputComment" onclick="javascript:animDivWriteCommentClose('headerComment', 'contentInputComment')"></span>
						<button type="submit" class="fas fa-check" name='sendComment'></button>
					</div>
				</div>
			</form>
	 	</div>

	<?php
		}
		if($isConnect === false) // Si pas de connexion, on ajoute un lien vers login.php
		{
			$pseudoConnect='';
	?>
			<a href='index.php?action=login' alt="Espace connexion"><p> - Vous devez être connecté pour laisser un commentaire<span class="fas fa-user"></span></p></a>
		</div>
	<?php
		}
		if(empty($aComment))
		{
	?>
			<p> Il n'y a aucun commentaire pour le moment. </p>
	<?php
		}
		else
		{
/*			echo '<pre>';
			print_r($aComment);
			echo '</pre>';*/
			for ($i = 0 ; $i < count($aComment) ; $i++)
			{
	?>
		 	 	<div class="commentSignal" id ='signal$i'>
		 	 		<p> De </p>
		 	 		<p><?= $aComment[$i]['pseudo'] ?></p>
		 	 		<p> le </p>
		 	 		<p><?= $aComment[$i]['commentTime'] ?></p>
	<?php
				if(($isConnect === true) && ($aComment[$i]['reporting'] == 0)&&($aComment[$i]['idUser'] != $_SESSION['idUser']))
				{
	?>
					<p>- Signaler le commentaire </p>
					<span id =<?= $aComment[$i]['id'] ?> class=fas fa-bell <?= $aComment[$i]['idUser'] ?> onclick="javascript:animPopup('signal<?=$i?>')"></span>
					<div class="popupSignal">
						<p> Merci de nous avoir prévenu.</p>
					</div>
	<?php
				}
				elseif(($isConnect == true) && ($aComment[$i]['reporting'] != 0) && ($aComment[$i]['idUser'] != $_SESSION['idUser']))
				{
	?>
					<p class="messSignal">- Commentaire signalé.</p>
	<?php
				}
				elseif(($isConnect == true) && ($aComment[$i]['reporting'] != 0) && ($aComment[$i]['idUser']== $_SESSION['idUser']))
				{
	?>
					<p class="messSignal">- Votre commentaire a été signalé.</p>
	<?php
				}
				elseif($isConnect == false)
				{
	?>
					<p class="messSignal"></p>
	<?php
				}
				else
				{ 			
	?>
					<p class="messSignal"></p>
	<?php
				}
	?>
				</div>
				<div class="comment">
					<p><?= $aComment[$i]['comment']?></p>
				</div>
	<?php
		 		if($isConnect === true)
				{
	?>
				<p> Répondre <span id="btnOpen<?=$i?>" class="fas fa-pen-nib contentInputReply" onclick="javascript:animDivWriteReplyOpen('replyDiv<?=$i?>', btnOpen<?=$i?>, btnClose<?=$i?>)"></span>
				</p>
				<div class="contentInputReply" id="replyDiv<?=$i?>">
					<form method="post" action="comment.php">
						<div class="formComment">
							<label for="replyUserConnect"></label>
							<input type="text" id ="replyUserConnect" name ="replyUserConnect" placeholder="Votre commentaire ...">
							<div class='formColumComment'>
								<span id="btnClose<?=$i?>" class="fas fa-times contentInputReply" onclick="javascript:animDivWriteReplyClose('replyDiv<?=$i?>', btnOpen<?=$i?>, btnClose<?=$i?>)"></span>
								<button type="submit" class="fas fa-check" name='sendReply'></button>
							</div>
						</div>
					</form>
			 	</div>
	<?php
				}

				if(!empty($aComment[$i]['reply']))
				{
	?>
				<div class='lookReply' id='part<?=$i?>'>
					<p> Voir les réponses </p>
					<div class="plusMoins">
						<span class="fa fa-plus-circle" onclick="javascript:animCommentPlus('part<?=$i?>')"></span>
						<span class="fas fa-minus-circle" onclick="javascript:animCommentMoins('part<?=$i?>')"></span>
					</div>
				</div>

				<div class="globalReply">			
	<?php
					for( $j = 0 ; $j <= count($aComment[$i]['reply'])-1 ; $j++)
					{
	?>
					<div class="replySignal" id="replySignal<?=$j?>">
						<p> De </p>
						<p> <?=$aComment[$i]['reply'][$j]['pseudo']?> </p>
						<p> le </p>
						<p> <?=$aComment[$i]['reply'][$j]['dateReply']?> </p>
	<?php
						if($aComment[$i]['reply'][$j]['reporting_reply'] == 0)
						{
	?>
						<p>- Signaler la réponse </p>
						<span id =<?=$aComment[$i]['reply'][$j]['id']?> class=fas fa-bell <?=$aComment[$i]['reply'][$j]['iduser_reply']?> onclick="javascript:animPopupReply('part<?=$i?>', 'replySignal<?=$j?>')"></span>
						<div class="popupSignal">
							<p> Merci de nous avoir prévenu.</p>
						</div>
					</div>

	<?php
						}else
						{
	?>
						<p class="messSignal">- Réponse signalée.</p>
					</div>

	<?php
						}
	?>
					<div class="reply">
						<p><?=$aComment[$i]['reply'][$j]['reply']?></p>
					</div>

	<?php
					}
	?>
				</div>
	<?php
					
				}
			}
		}


			?>
		</div>
	

			<?php
		
	?>
