<?php $headTitle = 'Espace connexion'; ?>
<?php $titleH1 = 'Espace connexion'; ?>

<?php ob_start(); ?>

	 <section id='containtSpace'>
	 	 <div id='globalSpace'>
	 	 	<hr>
	 	 	<div id='infoSpaceOne'>
	 	 		<p> Bienvenue dans votre espace <?=$getInfosUser[0]['pseudo']?></p>
	 	 		<p> Vous pouvez à tout moment, changer votre mot de passe et votre pseudo</p>
	 	 		
<?php
			if($getInfosUser[0]['comment'] == 0)
			{
?>
				<p>Vous n'avez pas encore posté de commentaires. N'hésitez pas à nous laisser votre avis.
<?php
			}
			else{
?>
				<p> Vous avez posté<em><?= $getInfosUser[0]['comment']?></em>commentaire(s) et
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
	 	 		<p>Votre adresse mail de contact (Ne peut être changée) : <em><?=$getInfosUser[0]['email']?></em></p>
	 	 		<div id='changePseudo'>
		 	 		<p>Votre pseudo : <em><?=$getInfosUser[0]['pseudo']?></em></p>
		 	 		<p> Voulez-vous changer de pseudo? <span id="spanChangePseudo" class="fas fa-pen-nib" onclick="javascript:animDivWriteNewInfoOpen('changePseudo', 'contentFormChangePseudo')"></span></p>
	 	 		

<?php

?>
					<div id='contentFormChangePseudo'>
						<form method="post">
							<label for="<?=$inputPseudo[0]['id_style']?>"></label>
							<input type ="<?=$inputPseudo[0]['type']?>" id ="<?=$inputPseudo[0]['id_style']?>" name ="<?=$inputPseudo[0]['name']?>" value="" placeholder="<?=$inputPseudo[0]['placeholder']?>" contenteditable ="<?=$inputPseudo[0]['contenteditable']?>">
							<span class="fas fa-times contentInputComment" onclick="javascript:animDivWriteNewInfoClose('changePseudo', 'contentFormChangePseudo')"></span>
							<button type="submit" class="fas fa-check" name='sendNewPseudo'></button>
						</form>
					</div>
				</div>
<?php

?>
				<div id='changePsw'>
					<p>Voulez-vous changer de mot de passe? <span id="spanChangePsw" class="fas fa-pen-nib" onclick="javascript:animDivWriteNewInfoOpen('changePsw', 'contentFormChangePsw')"></span><em></em></p>
		 	 		
		 	 		<div id='contentFormChangePsw'>
		 	 			<form method="post">
<?php

				for ($i = 0 ; $i <= count($inputNewPassword)-1 ; $i++)
				{
?>
							<label for="<?=$inputNewPassword[$i]['id_style']?>"></label>
							<input type ="<?=$inputNewPassword[$i]['type']?>" id ="<?=$inputNewPassword[$i]['id_style']?>" name ="<?=$inputNewPassword[$i]['name']?>" value="" placeholder="<?=$inputNewPassword[$i]['placeholder']?>" contenteditable ="<?=$inputNewPassword[$i]['contenteditable']?>">
<?php
				}
?>
							<div id='btnNewPsw'>
								<span class="fas fa-times contentInputComment" onclick="javascript:animDivWriteNewInfoClose('changePsw', 'contentFormChangePsw')"></span>
								<button type="submit" class="fas fa-check" name='sendNewPsw'></button>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</section>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>