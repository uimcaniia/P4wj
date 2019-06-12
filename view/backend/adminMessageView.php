
				<div id="messageWork">
	 				<div class="whiteBlock">
		 				<span id='showDivMess'><p>Modération des lecteurs:</p>
		 				</span>
		 			</div>

		 			<div id="navMessage"> 
		 				<div id="messageMenu">
		 					<div id="showMessage">
		 						<div class="flexRow">
		 							<div class='flexColumn'>
			 							<div class="whiteBlock">
				 							<span id='btnSelectPseudoSignModo'><p>Lecteurs</p>
				 							</span>
				 						</div>
					 				
				 					
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
											<span id="goSelectPseudoModerate" class="fas fa-check"></span>
					 					</div>
					 				</div>
<?php
			}
?>
					 				<div id='infoPseudoModerate'>
					 				</div>

					 				
								</div>
				 			</div>
		 				</div>
		 			</div>
		 		</div>