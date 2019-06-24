<?php $headTitle = 'Votre espace'; ?>
<?php $titleH1 = 'Votre espace'; ?>

<?php ob_start(); ?>

	<article>
		<div id="messageUser">
			<div class="whiteBlock">
 			
 		</div>
	</article>

	 <article id='containtSpace'>
	 	 <div id='globalSpace'>
	 	 	<hr>
	 	 	<div id='infoSpaceOne'>
	 	 		<p> Bienvenue dans votre espace <?=$getInfosUser[0]['pseudo']?></p>
	 	 		<p> Vous pouvez à tout moment, changer votre mot de passe</p>
	 	 		
<?php
			if($getInfosUser[0]['comment'] == 0)
			{
?>
				<p>Vous n'avez pas encore posté de commentaires. N'hésitez pas à nous laisser votre avis.
<?php
			}
			else{
?>
				<p> Vous avez posté <em><?= $getInfosUser[0]['comment']?></em> commentaire(s) et
<?php
			}
			if($getInfosUser[0]['reporting'] == 0)
			{
?>
				</p>
<?php
			}
			else{
?>
				vous avez eu<em> <?=$getInfosUser[0]['reporting']?> </em>commentaire(s) de signalé</p>
<?php
			}
?>
	 	 		<p>Voici les informations que nous avons</p>
	 	 	</div>
	 	 	<div id='infoSpaceTwo'>
	 	 		<p>Votre adresse mail de connection : <em><?=$getInfosUser[0]['email']?></em></p>
	 	 		<div id='changePseudo'>
		 	 		<p>Votre pseudo : <em><?=$getInfosUser[0]['pseudo']?></em></p>
				</div>
				<div id='changePsw'>
					<p>Voulez-vous changer de mot de passe? <span id="spanChangePsw" class="fas fa-pen-nib"></span><em></em></p>
		 	 		<form id='contentFormChangePsw'>
<?php
				for ($i = 0 ; $i <= count($inputNewPassword)-1 ; $i++)
				{
?>	
						<div class='flexRow'>
							<label for="<?=$inputNewPassword[$i]['id_style']?>"></label>
							<input type ="<?=$inputNewPassword[$i]['type']?>" id ="<?=$inputNewPassword[$i]['id_style']?>" name ="<?=$inputNewPassword[$i]['name']?>" value="" placeholder="<?=$inputNewPassword[$i]['placeholder']?>" contenteditable ="<?=$inputNewPassword[$i]['contenteditable']?>" autocomplete="off">
<?php
				}
?>
							<div id='btnNewPsw'>
								<span id='spanCloseChangePsw' class="fas fa-times contentInputComment"></span>
								<span id='validChangeMdp' class="fas fa-check"></span>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</article>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>