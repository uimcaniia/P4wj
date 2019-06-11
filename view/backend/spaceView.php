<?php $headTitle = 'Espace connexion'; ?>
<?php $titleH1 = 'Espace connexion'; ?>

<?php ob_start(); ?>

	<section>
		<div id="messageUser">
			<div class="whiteBlock">
 				<span onclick="animShowAdminMenu('navMessage', '<?=$divHidenMessage?>');"><p>vos messages:</p>
 				</span>
 		</div>
	</section>

	 <section id='containtSpace'>
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
					<p>Voulez-vous changer de mot de passe? <span id="spanChangePsw" class="fas fa-pen-nib" onclick="javascript:animDivWriteNewInfoOpen('changePsw', 'contentFormChangePsw')"></span><em></em></p>
		 	 		<div id='contentFormChangePsw'>
<?php
				for ($i = 0 ; $i <= count($inputNewPassword)-1 ; $i++)
				{
?>	
						<div class='flexRow'>
							<label for="<?=$inputNewPassword[$i]['id_style']?>"></label>
							<input type ="<?=$inputNewPassword[$i]['type']?>" id ="<?=$inputNewPassword[$i]['id_style']?>" name ="<?=$inputNewPassword[$i]['name']?>" value="" placeholder="<?=$inputNewPassword[$i]['placeholder']?>" contenteditable ="<?=$inputNewPassword[$i]['contenteditable']?>">
<?php
				}
?>
							<div id='btnNewPsw'>
								<span class="fas fa-times contentInputComment" onclick="javascript:animDivWriteNewInfoClose('changePsw', 'contentFormChangePsw')"></span>
								<span id='validChangeMdp' class="fas fa-check"></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>