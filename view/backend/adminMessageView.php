<?php
$divHidenMessage = 'navEpisode,hideWriteEpisode,hideWriteEpisodeModif,navComment';

$divHidenReceive = 'arrayMessageSend,messageAdmin';
$divHidenSend    = 'arrayMessageReceive,messageAdmin';
$divHidenWrite   = 'arrayMessageReceive,arrayMessageSend';
?>


				<div id="messageWork">
	 				<div class="whiteBlock">
		 				<span onclick="animShowAdminMenu('navMessage', '<?=$divHidenMessage?>');"><p>Message :</p>
		 				</span>
		 			</div>

		 			<div id="navMessage"> 
		 				<div id="messageMenu">
		 					<div id="showMessage">
		 						<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('arrayMessageReceive', '<?=$divHidenReceive?>');" ><p>Message reçut</p>
		 							</span>
				 				</div>
				 				<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('arrayMessageSend', '<?=$divHidenSend?>');" ><p>Message envoyés</p>
		 							</span>
				 				</div>
				 				<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('messageAdmin', '<?=$divHidenWrite?>');" ><p>Envoyer un message</p>
		 							</span>
				 				</div>
		 						<div class='flexColumn'>
			 						<div class="flexRow">
										<table id='arrayMessageReceive'>
											<thead>
												<tr>
													<th>Date</th>
													<th>De</th>
													<th>Sujet</th>
													<th>Message</th>
												</tr>
											</thead>
											<tbody>
<?php
			for($i = 0 ; $i < count($aMessageReceive) ; $i++)
			{
				$dateReceive = $aMessageReceive[$i]['date'];
				$pseudo      = $aMessageReceive[$i]['pseudo'];
				$subject     = $aMessageReceive[$i]['subject'];
				$txt         = $aMessageReceive[$i]['text'];
?>
												<tr>
													<td>$dateReceive</td>
													<td>$pseudo </td>
													<td>$subject</td>
													<td>$txt</td>
												</tr>
<?php
			}

?>
											</tbody>
										</table>
										<table id='arrayMessageSend'>
											<thead>
												<tr>
													<th>Date</th>
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
													<td>$dateReceive</td>
													<td>$pseudo </td>
													<td>$subject</td>
													<td>$txt</td>
												</tr>
<?php
			}

?>
											</tbody>
										</table>
									</div>
					 				<div id="ShowMessage" class="flexRow">
						 			</div>
								</div>
				 			</div>
		 				</div>
		 			</div>
		 		</div>

	 		