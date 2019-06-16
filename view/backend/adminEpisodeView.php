
	 			<div class="whiteBlock">
	 				<p> Bienvenue dans votre espace <?=$getInfosAdmin[0]['pseudo']?></p>
	 			</div>

		 		<div id="EpisodeWork">

	 				<div class="whiteBlock">
		 				<span id='showNavEpisode'><p>Episodes :</p>
		 				</span>
		 			</div>

		 			<div id="navEpisode"> 
		 				<div id="EpisodeMenu" >

		 					<div id='editEp'>
			 					<div class="whiteBlock">
			 						<span id='btnEditEp'><p>Ajouter un épisode</p>
			 						</span>
			 					</div>
		 					</div>

		 					<div id="modifEp">
			 					<div class="whiteBlock">
		 							<span id='btnModifEp' ><p>Modifier un épisode </p>
		 							</span>
				 				</div>
				 				<div id="divModifSelectEp">
					 				<div class="flexRow">
				 						<div class="whiteBlock">
				 							<p>Titre de l'épisode :<p>
				 						</div>
					 					<div class='customSelect'>
					 						<label for="selectEpModif"></label>
					 						<select id="selectEpModif" name="selectEpModif">
<?php
			for($i = 0 ; $i < count($aEpisode) ; $i++)
			{
				$num = $i+1;
				$idep = $aEpisode[$i]['id'];
				$title = $aEpisode[$i]['title'];
?>
												  <option value="<?=$idep?>"><?=$title?></option>
<?php
			}
?>
											</select>
											<span id="goEpModif" class="fas fa-check"></span>
										</div>
									</div>
								</div>
				 			</div>

		 					<div id='delEp'>
			 					<div class="whiteBlock">
			 						<span id ="btnDelEp"><p>Supprimer un épisode</p>
			 						</span>
			 					</div>
		 						<div id='divDelSelectEp'>
		 							<div class="flexRow">
				 						<div class="whiteBlock"><p>Titre de l'épisode :</p>
				 						</div>
				 						<div class='customSelect'>
					 						<label for="selectEpDel"></label>
					 						<select id="selectEpDel" name="selectEpDel">
<?php
			for($i = 0 ; $i < count($aEpisode) ; $i++)
			{
				$num = $i+1;
				$idep = $aEpisode[$i]['id'];
				$title = $aEpisode[$i]['title'];
?>
												  <option value="<?=$idep?>"><?=$title?></option>
<?php
			}
?>
											</select>
											<span id="goEpDel" class="fas fa-check"></span>
										</div>
									</div>
			 					</div>
			 				</div>
		 				</div>
		 			</div>

		 			<div id='hideWriteEpisode'>
			 			<div id='writeEpisode'>
			 				<hr>
			 				<div id='containtEpisodeAdmin'>
			 					<div id='blockWriteIdEp'>
			 					</div>
			 					<p></p>
		 						<div>
		 							<input type='texte' name='blockWriteTitleEpisode' id='blockWriteTitleEpisode' value='' placeholder="Votre titre">
		 						</div>
		 						<div id='blockWriteEpisode'>
		 							<textarea id='blockWriteEpisode' class='text' name='elem1'>Votre texte...</textarea>
		 						</div>
		 						<div id='ctrlWriteEpisode'>
		 							<span id='saveEdit'>Enregistrer</span>
		 							<span id='showEdit'>Publier</span>
		 							<span id='quitEdit'>Quitter</span>
		 						</div>
			 				</div>
			 			</div>
			 		</div>

			 		<div id='hideWriteEpisodeModif'>
			 			<div id='writeEpisodeModif'>
			 				<hr>
			 				<div id='containtEpisodeAdminModif'>
			 					<div id='blockWriteIdEpModif'>
			 					</div>
			 					<p></p>
		 						<div>
		 							<input type='texte' name='blockWriteTitleEpisodeModif' id='blockWriteTitleEpisodeModif'>
		 						</div>

		 						<div id='blockWriteEpisodeModif'>
		 							<textarea id='blockWriteEpisodeModif' class='text' name='blockWriteEpisodeModif'>Votre texte...</textarea>
		 						</div>
		 						<div id='ctrlWriteEpisodeModif'>
		 							<span id='saveModif'>Enregistrer</span>
									<span id='PublishModif'>Publier</span>
		 						</div>
		 					</div>
			 			</div>
			 		</div>
		 		</div>
	 		