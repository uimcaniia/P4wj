		<div id='globalSpace'>
	 	 	<hr>
	 	 	<div id='infoSpaceOne'>
	 	 		<p> Vous pouvez à tout moment, changer votre mot de passe et votre pseudo. Voici les informations vous concernant : </p>
	 	 	</div>
	 	 	<div id='infoSpaceTwo'>
	 	 		<p>Votre adresse mail de contact (Ne peut être changée) : <em><?$getInfosAdmin[0]['email']?></em></p>
	 	 		<div id='changePseudo'>
		 	 		<p>Votre pseudo : <em><?=$getInfosAdmin[0]['pseudo']?></em></p>
		 	 		<p> Voulez-vous changer de pseudo? <span id="spanChangePseudo" class="fas fa-pen-nib" onclick="javascript:animDivWriteNewInfoOpen('changePseudo', 'contentFormChangePseudo')"></span></p>

					<div id='contentFormChangePseudo'>
						<form method="post">
							<label for="<?=$inputPseudo[0]['id_style']?>"></label>
							<input type ="<?=$inputPseudo[0]['type']?>" id ="<?=$inputPseudo[0]['id_style']?>" name ="<?=$inputPseudo[0]['name']?>" value="" placeholder="<?=$inputPseudo[0]['placeholder']?>" contenteditable ="<?=$inputPseudo[0]['contenteditable']?>">
							<span class="fas fa-times contentInputComment" onclick="javascript:animDivWriteNewInfoClose('changePseudo', 'contentFormChangePseudo')"></span>
							<button type="submit" class="fas fa-check" name='sendNewPseudo'></button>
						</form>
					</div>
				</div>

				<div id='changePsw'>
					<p>Voulez-vous changer de mot de passe? <span id="spanChangePsw" class="fas fa-pen-nib" onclick="javascript:animDivWriteNewInfoOpen('changePsw', 'contentFormChangePsw')"></span><em></em></p>
		 	 		
		 	 		<div id='contentFormChangePsw'>
		 	 			<form method="post">
<?php

				for ($i = 0 ; $i <= count($inputNewPassword)-1 ; $i++)
				{
?>
							<label for="<?=$inputNewPassword[$i]['id_style']?>"></label>
							<input type ="<?=$inputNewPassword[$i]['type']?>" id ="<?=$inputNewPassword[$i]['id_style']?>" name ="{$inputNewPassword[$i]['name']?>" value="" placeholder="<?=$inputNewPassword[$i]['placeholder']?>" contenteditable ="<?=$inputNewPassword[$i]['contenteditable']?>">
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
