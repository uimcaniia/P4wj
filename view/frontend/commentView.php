
 	<div id="globalComment">
 		<div id="headerComment">
 			<p>Les commentaires des lecteurs </p>

<?php 
 	$isConnect = false;
	if(isset($_SESSION['idUser']) && isset($_SESSION['pseudo']) && isset($_SESSION['admin']))
	{ // On vérifie si l'utilisisateur est connecté.
		$isConnect = true;
?>
			<p> - Laissez un message <span id='btnOpenDivComment' class="fas fa-comment contentInputComment"></span>
			</p>
		</div>
		<div id="contentInputComment">
			
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
					<span class="fas fa-times contentInputComment" id='btnCloseDivComment'></span>
					<span id="sendCommentEpisode" class="fas fa-check"></span>
				</div>
			</div>
			
	 	</div>
<?php
	}
	if($isConnect === false) // Si pas de connexion, on ajoute un lien vers login.php
	{
		$pseudoConnect='';
?>
			<a href='index.php?action=login'><p> - Vous devez être connecté pour laisser un commentaire<span class="fas fa-user"></span></p></a>
			<div class="hideInfoCommentSend">
				<p id='dateComment'><?= date("d-m-Y") ?></p>
				<p id='numEpisode'><?= $_GET['idEpisode'] ?></p>
			</div>
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
		for ($i = 0 ; $i < count($aComment) ; $i++)
		{
?>
		 	 	<div class="commentSignal" id ='signal<?=$i?>'>
		 	 		<p> De </p>
		 	 		<p><?= $aComment[$i]['pseudo'] ?></p>
		 	 		<p> le </p>
		 	 		<p><?= strftime('%d-%m-%Y',strtotime($aComment[$i]['commentTime'] ))?></p>
<?php
			if(($aComment[$i]['reporting'] == 0) && ($isConnect == true) && ($aComment[$i]['idUser'] == $_SESSION['idUser']))
			{
?>
<?php
			}
			elseif(($aComment[$i]['reporting'] == 0) && ($isConnect == true) && ($aComment[$i]['idUser'] != $_SESSION['idUser']))
			{
?>
					<p>- Signaler le commentaire </p>
					<span id ="<?= $aComment[$i]['id'] ?>" class="fas fa-bell <?=$aComment[$i]['idUser']?> signal<?=$i?>"></span>
					<div class="popupSignal">
						<p> Merci de nous avoir prévenu.</p>
					</div>
<?php
			}
			elseif(($aComment[$i]['reporting'] == 0) && ($isConnect == false))
			{
?>
					<p>- Signaler le commentaire </p>
					<span id ="<?= $aComment[$i]['id'] ?>" class="fas fa-bell <?=$aComment[$i]['idUser']?>"></span>
					<div class="popupSignal">
						<p> Merci de nous avoir prévenu.</p>
					</div>
<?php
			}
			elseif(($isConnect == true) && ($aComment[$i]['reporting'] != 0) && ($aComment[$i]['idUser'] == $_SESSION['idUser']))
			{
?>
					<p class="messSignal">- Votre commentaire a été signalé.</p>
<?php
			}
			elseif(($isConnect == true) && ($aComment[$i]['reporting'] != 0) && ($aComment[$i]['idUser'] != $_SESSION['idUser']))
			{
?>
					<p class="messSignal">- Commentaire signalé.</p>
<?php
			}
			else
			{
?>
					<p class="messSignal">- Commentaire signalé.</p>
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
				<p><span class="far fa-hand-point-right"></span> Répondre <span id="btnOpen<?=$i?>" class="fas fa-comment contentInputReply replyDiv<?=$i?> btnOpen<?=$i?>" ></span>
				</p>
				<div class="contentInputReply" id="replyDiv<?=$i?>">
					
					<div class="formComment">
						<label for="replyUserConnect"></label>
						<input type="text" id ="replyUserConnect<?=$i?>" name ="replyUserConnect" placeholder="Répondre...">
						<div class='formColumComment'>
							<span id="btnCloseReply<?=$i?>" class="fas fa-times contentInputReply replyDiv<?=$i?> btnOpen<?=$i?>"></span>
							<span id="btnValidReply<?=$i?>" class="fas fa-check <?=$aComment[$i]['id']?> replyUserConnect<?=$i?> replyDiv<?=$i?> btnOpen<?=$i?> part<?=$i?>"></span>
						</div>
					</div>
					
			 	</div>
<?php
			}
			if(empty($aComment[$i]['reply']))
			{
?>
					<div class='lookReply' id='part<?=$i?>'>
					</div>
					<div class="globalReply">
					</div>
<?php
			}
			if(!empty($aComment[$i]['reply']))
			{
?>
				<div class='lookReply' id='part<?=$i?>'>
					<p><span class="far fa-hand-point-right"></span> Voir les réponses </p>
					<div class="plusMoins">
						<span class="fa fa-plus part<?=$i?>"></span>
						<span class="fas fa-minus part<?=$i?>"></span>
					</div>
				</div>

				<div class="globalReply">			
<?php
				for( $j = 0 ; $j <= count($aComment[$i]['reply'])-1 ; $j++)
				{
?>
					<div class="replySignal">
						<p> De </p>
						<p> <?=$aComment[$i]['reply'][$j]['pseudo']?> </p>
						<p> le </p>
						<p> <?=strftime('%d-%m-%Y',strtotime($aComment[$i]['reply'][$j]['dateReply']))?> </p>
<?php
					if(($aComment[$i]['reply'][$j]['reporting_reply'] == 0) && ($isConnect == true) && ($aComment[$i]['reply'][$j]['iduser_reply'] != $_SESSION['idUser']))
					{
?>
						<p>- Signaler la réponse </p>
						<span id ="<?=$aComment[$i]['reply'][$j]['id']?>" class="fas fa-bell <?=$aComment[$i]['reply'][$j]['iduser_reply']?>"></span>
						<div class="popupSignal">
							<p> Merci de nous avoir prévenu.</p>
						</div>
					</div>
<?php
					}
					elseif(($aComment[$i]['reply'][$j]['reporting_reply'] == 0) && ($isConnect == false))
					{
?>
						<p>- Signaler la réponse </p>
						<span id ="<?=$aComment[$i]['reply'][$j]['id']?>" class="fas fa-bell <?=$aComment[$i]['reply'][$j]['iduser_reply']?>"></span>
						<div class="popupSignal">
							<p> Merci de nous avoir prévenu.</p>
						</div>
					</div>
<?php
					}
					elseif(($isConnect == true) && ($aComment[$i]['reply'][$j]['reporting_reply'] != 0) && ($aComment[$i]['reply'][$j]['iduser_reply'] == $_SESSION['idUser']))
					{
?>
						<p class="messSignal">- Votre réponse a été signalée.</p>
					</div>

<?php
					}
					elseif(($isConnect == true) && ($aComment[$i]['reply'][$j]['reporting_reply'] == 0) && ($aComment[$i]['reply'][$j]['iduser_reply'] == $_SESSION['idUser']))
					{
?>
					</div>
<?php
					}
					else
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
		
