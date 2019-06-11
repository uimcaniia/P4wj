<?php
$divHidenMessage = 'navEpisode,hideWriteEpisode,hideWriteEpisodeModif,navComment';

$divHidenReceive = 'arrayMessageSend,selectPseudoSignalModerate,infoPseudoModerate';
$divHidenSend    = 'arrayMessageReceive,selectPseudoSignalModerate,infoPseudoModerate';
$divHidenModerateUser = 'arrayMessageReceive,arrayMessageSend'
?>


				<div id="messageWork">
	 				<div class="whiteBlock">
		 				<span onclick="animShowAdminMenu('navMessage', '<?=$divHidenMessage?>');"><p>Modération des lecteurs:</p>
		 				</span>
		 			</div>

		 			<div id="navMessage"> 
		 				<div id="messageMenu">
		 					<div id="showMessage">
		 						<div class="flexRow">
		 							<div class="whiteBlock">
			 							<span onclick="animShowAdminMenu('selectPseudoSignalModerate', '<?=$divHidenModerateUser?>');" ><p>Lecteurs</p>
			 							</span>
			 						</div>
					 				
				 					<div class='flexColumn'>
<?php
			if(count($aUserModerate) == 0)
			{
?>
												<p> Il n'y a utilisateur à modérer</p>
<?php        
			}
			else
			{
?>
						 				<div id="selectPseudoSignalModerate">
					 						<label for="selectPseudoSignalModo"></label>
								 			<select id="selectPseudoSignalModo" name="selectPs">
<?php
				for($i = 0 ; $i < count($aUserModerate) ; $i++)
				{
					$idUser = $aUserModerate[$i]['id'];
					$pseudo = $aUserModerate[$i]['pseudo'];
					$nbrComSign = $aUserModerate[$i]['reporting'];
?>
												<option value="<?=$idUser?>"><?=$pseudo?></option>
<?php
				}
			
?>
											</select>
											<span id="goSelectPseudoModerate" class="fas fa-check" onclick="givePseudoDetail()";></span>
					 					</div>
<?php
			}
?>
					 				</div>

					 			</div>
		 						<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('arrayMessageReceive', '<?=$divHidenReceive?>');" ><p>Message reçut</p>
		 							</span>
				 				</div>
				 				<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('arrayMessageSend', '<?=$divHidenSend?>');" ><p>Message envoyés</p>
		 							</span>
				 				</div>

		 						<div class='flexColumn'>
			 						<div class="flexRow">
<?php
			if(count($aMessageReceive) == 0)
			{
?>
												<p> Il n'y a aucun message pour le moment</p>
<?php        
			}
			else
			{
?>
					 					<div id='infoPseudoModerate' class='flexColumn'>
					 					</div>
										<table id='arrayMessageReceive'>
											<thead>
												<tr>
													<th>Date <span id='messReceiveOrderBydate' class='fas fa-angle-down'></span></th>
													<th>De</th>
													<th>Sujet</th>
													<th>Message</th>
													<th>Supprimer</th>
													<th>repondre</th>
												</tr>
											</thead>
											<tbody>
<?php
				for($i = 0 ; $i < count($aMessageReceive) ; $i++)
				{
					$idMess      = $aMessageReceive[$i]['id'];
					$idSend      = $aMessageReceive[$i]['send'];
					$dateReceive = $aMessageReceive[$i]['date'];
					$pseudo      = $aMessageReceive[$i]['pseudo'];
					$subject     = $aMessageReceive[$i]['subject'];
					$txt         = $aMessageReceive[$i]['text'];
?>
												<tr>
													<td><?=$dateReceive?></td>
													<td><?=$pseudo?> </td>
													<td><?=$subject?></td>
													<td><?=$txt?></td>
													<td>
														<span class="fas fa-times" onclick="animDelMessage('<?=$idMess?>');">
														</span>
													</td>
													<td>
														<span class="fas fa-envelope" onclick="animSendMessageUser('<?=$idSend?>','<?=$pseudo?>','<?=$_SESSION['idUser']?>');">
														</span>
													</td>
												</tr>
<?php
				}
?>
											</tbody>
										</table>
<?php
			}
			if(count($aMessageSend) == 0)
			{
?>
												<p> Il n'y a aucun message pour le moment</p>
<?php        
			}
			else
			{
?>
										<table id='arrayMessageSend'>
											<thead>
												<tr>
													<th>Date <span id='messSendOrderBydate' class='fas fa-angle-down'></span></th>
													<th>De</th>
													<th>Sujet</th>
													<th>Message</th>
												</tr>
											</thead>
											<tbody>
<?php
				for($i = 0 ; $i < count($aMessageSend) ; $i++)
				{
					$dateReceive = $aMessageSend[$i]['date'];
					$pseudo      = $aMessageSend[$i]['pseudo'];
					$subject     = $aMessageSend[$i]['subject'];
					$txt         = $aMessageSend[$i]['text'];
?>
												<tr>
													<td><?=$dateReceive?></td>
													<td><?=$pseudo ?></td>
													<td><?=$subject?></td>
													<td><?=$txt?></td>
												</tr>
<?php
				}
?>
											</tbody>
										</table>
<?php
				}
?>
									</div>
					 				<div id="ShowMessage" class="flexRow">
						 			</div>
								</div>
				 			</div>
		 				</div>
		 			</div>
		 		</div>

	 		