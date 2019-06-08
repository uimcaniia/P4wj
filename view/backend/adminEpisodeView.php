<?php
	 		$divHidenEpisode = "navComment,navMessage";
	 		$divHidenEdit = 'divModifSelectEp,divDelSelectEp,hideWriteEpisodeModif';
	 		$divHidenModif = 'hideWriteEpisode,divDelSelectEp';
	 		$divHidenDel = 'divModifSelectEp,hideWriteEpisode,hideWriteEpisodeModif';
?>

	 			<div class="whiteBlock">
	 				<p> Bienvenue dans votre espace <?=$getInfosAdmin[0]['pseudo']?></p>
	 			</div>

		 		<div id="EpisodeWork">

	 				<div class="whiteBlock">
		 				<span onclick="animShowAdminMenu('navEpisode','<?= $divHidenEpisode?>');"><p>Episodes :</p>
		 				</span>
		 			</div>

		 			<div id="navEpisode"> 
		 				<div id="EpisodeMenu" >

		 					<div id='editEp'>
			 					<div class="whiteBlock">
			 						<span id='btnEditEp' onclick="animShowAdminMenu('hideWriteEpisode','<?=$divHidenEdit?>');" ><p>Editer un épisode</p>
			 						</span>
			 					</div>
		 					</div>

		 					<div id="modifEp">
			 					<div class="whiteBlock">
		 							<span id='btnModifEp' onclick="animShowAdminMenu('divModifSelectEp','<?=$divHidenModif?>');" ><p>Modifier un épisode </p>
		 							</span>
				 				</div>
				 				<div id="divModifSelectEp">
					 				<div class="flexRow">
				 						<div class="whiteBlock">
				 							<p>Modifier l'épisode n°:<p>
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
												  <option value="<?=$idep?>"><?=$num?> : <?=$title?></option>
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
			 						<span onclick="animShowAdminMenu('divDelSelectEp','<?=$divHidenDel?>');" ><p>Supprimer un épisode</p>
			 						</span>
			 					</div>
		 						<div id='divDelSelectEp'>
		 							<div class="flexRow">
				 						<div class="whiteBlock"><p>Suprrimer l'épisode n°:</p>
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
												  <option value="<?=$idep?>"><?=$num?> : <?=$title?></option>
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
		 							<input type='texte' name='blockWriteTitleEpisode' id='blockWriteTitleEpisode'>
		 						</div>
		 						<div id='blockWriteEpisode'>
		 							<textarea id='blockWriteEpisode' class='text' name='elem1'>Votre texte...</textarea>
		 						</div>
		 						<div id='ctrlWriteEpisode'>
		 							<span id='saveEdit' onclick="save();">Enregistrer</span>
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
		 							<textarea id='blockWriteEpisodeModif' class='text' name='elem2'>Votre texte...</textarea>
		 						</div>
		 						<div id='ctrlWriteEpisodeModif'>
		 							<span id='saveModif' onclick="save();">Enregistrer</span>
		 						</div>
		 					</div>
			 			</div>
			 		</div>
		 		</div>
	 		