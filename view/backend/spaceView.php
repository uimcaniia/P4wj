	<div id="bckBody">

		<div id="titlePage">
			<h1>$titleH1</h1>
			<img src="$imgTitle" alt="petits flocon">
		</div>
		<div id="barre">
			<hr>
			<hr>
		</div>

		<div id="containtSpace">
			 <div id='containtGlobalSpace'>
	 	 <div id='globalSpace'>
	 	 	<hr>
	 	 	<div id='infoSpaceOne'>
	 	 		<p> Bienvenue dans votre espace $this->_pseudo</p>
	 	 		<p> Vous pouvez à tout moment, changer votre mot de passe et votre pseudo</p>
	 	 		
<?php
			if($this->_comment == 0)
			{
?>
				<p>Vous n'avez pas encore posté de commentaires. N'hésitez pas à nous laisser votre avis.
<?php
			}
			else{
?>
				<p> Vous avez posté<em> $this->_comment </em>commentaire(s) et
<?php
			}
			if($this->_reporting == 0)
			{
?>
				</p>
<?php
			}
			else{
?>
				vous avez eu<em> $this->_reporting </em>commentaire(s) de signalé</p>
<?php
			}

?>
	 	 		<p>Voici les informations que nous avons</p>
	 	 	</div>
	 	 	<div id='infoSpaceTwo'>
	 	 		<p>Votre adresse mail de contact (Ne peut être changée) : <em>$this->_email</em></p>
	 	 		<div id='changePseudo'>
		 	 		<p>Votre pseudo : <em>$this->_pseudo</em></p>
		 	 		<p> Voulez-vous changer de pseudo? <span id="spanChangePseudo" class="$write" onclick="javascript:animDivWriteNewInfoOpen('changePseudo', 'contentFormChangePseudo')"></span></p>
	 	 		

<?php

?>
					<div id='contentFormChangePseudo'>
						<form method="post">
							<label for="{$aInputPseudo[0]['id_style']}"></label>
							<input type ="{$aInputPseudo[0]['type']}" id ="{$aInputPseudo[0]['id_style']}" name ="{$aInputPseudo[0]['name']}" value="" placeholder="{$aInputPseudo[0]['placeholder']}" contenteditable ="{$aInputPseudo[0]['contenteditable']}">
							<span class="$iconAnnul contentInputComment" onclick="javascript:animDivWriteNewInfoClose('changePseudo', 'contentFormChangePseudo')"></span>
							<button type="submit" class="$iconCheck" name='sendNewPseudo'></button>
						</form>
					</div>
				</div>
<?php

?>
				<div id='changePsw'>
					<p>Voulez-vous changer de mot de passe? <span id="spanChangePsw" class="$write" onclick="javascript:animDivWriteNewInfoOpen('changePsw', 'contentFormChangePsw')"></span><em></em></p>
		 	 		
		 	 		<div id='contentFormChangePsw'>
		 	 			<form method="post">
<?php

				for ($i = 0 ; $i <= count($aInputPsw)-1 ; $i++)
				{
?>
							<label for="{$aInputPsw[$i]['id_style']}"></label>
							<input type ="{$aInputPsw[$i]['type']}" id ="{$aInputPsw[$i]['id_style']}" name ="{$aInputPsw[$i]['name']}" value="" placeholder="{$aInputPsw[$i]['placeholder']}" contenteditable ="{$aInputPsw[$i]['contenteditable']}">
<?php
				}
?>
							<div id='btnNewPsw'>
								<span class="$iconAnnul contentInputComment" onclick="javascript:animDivWriteNewInfoClose('changePsw', 'contentFormChangePsw')"></span>
								<button type="submit" class="$iconCheck" name='sendNewPsw'></button>
							</div>
						</form>
					</div>
				</div>
<?php
				
?>

<?php

			return $div;
	 	}
		</div>

	</div>