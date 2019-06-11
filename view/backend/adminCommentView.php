<?php
$divHidenComment = 'navEpisode,hideWriteEpisode,hideWriteEpisodeModif,navMessage';

$divHidenSelCom       = 'divSelectComSignal,arrayPseudoSignal,arrayCommentSignal';
$divHidenDivSelCom    = 'selectSortComPs,arrayPseudo';
$divHidenDivSelPseudo = 'selectSortComEp,arrayComment';

$divHidenSelComSign       = 'divSelectCom,arrayPseudo,arrayComment';
$divHidenDivSelComSign    = 'selectSortComSignPs,arrayPseudoSignal';
$divHidenDivSelPseudoSign = 'selectSortComSignEp,arrayCommentSignal';

?>

				<div id="CommentWork">
	 				<div class="whiteBlock">
		 				<span onclick="animShowAdminMenu('navComment', '<?=$divHidenComment?>');"><p>Modération des commentaires :</p>
		 				</span>
		 			</div>

		 			<div id="navComment"> 
		 				<div id="CommentMenu" >

		 					<div id="showComment">
			 					<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('divSelectCom', '<?=$divHidenSelCom?>');" ><p>Les commentaires</p>
		 							</span>
				 				</div>
				 				<div id="divSelectCom">
					 				<!-- <div class='flexColumn'> -->
						 				<div class="flexRow">
					 						<div>
						 						<button id ='sortEp' class="whiteBlock" type='submit' name='sortEp' onclick="animShowAdminMenu('selectSortComEp','<?=$divHidenDivSelCom?>');" >Par épisode</button>
						 						<button id ='sortPs' class="whiteBlock" type='submit' name='sortPs' onclick="animShowAdminMenu('selectSortComPs','<?=$divHidenDivSelPseudo?>');" >Par pseudo</button>
					 						</div>
						 					<div id ='selectSortComEp'class='customSelect'>
<?php
			if(count($aEpisodeHaveComment) == 0)
			{
?>
												<p> Il n'y a aucun commentaire pour le moment</p>
<?php        
			}
			else
			{
?>
						 						<label for="selectCom"></label>
						 						<select id="selectCom" name="selectEp">
<?php
				for($i = 0 ; $i < count($aEpisodeHaveComment) ; $i++)
				{
					$idep = $aEpisodeHaveComment[$i]['id'];
					$title = $aEpisodeHaveComment[$i]['title'];
?>
													  <option value="<?=$idep?>"><?=$title?></option>
<?php
				}
?>
												</select>
												<span id="goComByEp" class="fas fa-check"></span>
<?php 
			}
?>
											</div>

						 					<div id ='selectSortComPs'class='customSelect'>
<?php
			if(count($aEpisodeHaveComment) == 0)
			{
?>
												<p> Aucun utilisateur n'a posté de commentaire</p>
<?php        
			}
			else
			{
?>
						 						<label for="selectPseudo"></label>
						 						<select id="selectPseudo" name="selectEp">
<?php
			for($i = 0 ; $i < count($aUser) ; $i++)
			{
				$idUser = $aUser[$i]['id'];
				$pseudo = $aUser[$i]['pseudo'];
				$nbrCom = $aUser[$i]['comment'];
?>
													  <option value="<?=$idUser?>"><?=$pseudo?></option>
<?php
			}
?>
												</select>
												<span id="goComByPs" class="fas fa-check"></span>
<?php 
			}
?>
											</div>
										</div>

									<!-- </div> -->
								</div>

				 			</div>

				 			<div id="showCommentSignal">
			 					<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('divSelectComSignal','<?=$divHidenSelComSign?>');" ><p>Commentaires signalés</p>
		 							</span>
				 				</div>
<?php
			if(count($aEpisodeHaveComment) == 0)
			{
?>
												<p> Il n'y a aucun commentaire signalé</p>
<?php        
			}
			else
			{
?>
				 				<div id="divSelectComSignal">
				 					<div class='flexColumn'>
						 				<div class="flexRow">
					 						<div>
						 						<button id ='sortEpRep' class="whiteBlock" type='submit' name='sortEpRep' onclick="animShowAdminMenu('selectSortComSignEp','<?=$divHidenDivSelComSign?>');" >Par épisode</button>
						 						<button id ='sortPsRep' class="whiteBlock" type='submit' name='sortPsRep' onclick="animShowAdminMenu('selectSortComSignPs','<?=$divHidenDivSelPseudoSign?>');">Par pseudo</button>
					 						</div>
						 					<div id ='selectSortComSignEp'class='customSelect'>
						 						<label for="selectComSignal"></label>

						 						<select id="selectComSignal" name="selectEp">
<?php
				for($i = 0 ; $i < count($aEpisodeSignal) ; $i++)
				{
					$num=$i+1;
					$idep = $aEpisodeSignal[$i]['id'];
					$title = $aEpisodeSignal[$i]['title'];
?>
													  <option value="<?=$idep?>"><?=$title?></option>
<?php
				}
?>
												</select>
												<span id="goComSignByEp" class="fas fa-check"></span>
											</div>

						 					<div id ='selectSortComSignPs'class='customSelect'>
						 						<label for="selectPseudoSignal"></label>
						 						<select id="selectPseudoSignal" name="selectEp">
<?php
				for($i = 0 ; $i < count($aUserSignal) ; $i++)
				{
					$idUser = $aUserSignal[$i]['id'];
					$pseudo = $aUserSignal[$i]['pseudo'];
					$nbrComSign = $aUserSignal[$i]['reporting'];
?>
													  <option value="<?=$idUser?>"><?=$pseudo?></option>
<?php
				}
?>
												</select>
												<span id="goComSignByPs" class="fas fa-check"></span>
											</div>

										</div>
									</div>

								</div>
<?php 
			}
?>

				 			</div>
		 					<div class="flexRow">
								<table id='arrayComment'>
								</table>
								<table id='arrayPseudo'>
								</table>
							</div>
							<div class="flexRow">
								<table id='arrayCommentSignal'>
								</table>
								<table id='arrayPseudoSignal'>
								</table>
							</div>
		 				</div>
		 			</div>
	 			<div>