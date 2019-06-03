<?php

	class Admin extends AdminManager {

		
		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
		 private $_id; // Nom de la colonne id de la table locale
	  	 private $_inscription; // date d'inscription (datetime)
		 private $_email;  //  email de l'utilisateur 
	  	 private $_pseudo; // pseudo de l'utilisateur
	 	 private $_psw;// mot de pass de l'utilisateur
	 	 private $_comment;//  nbr de commentaire laissé 
	 	 private $_reporting;// nbr de signal reçut
	 	 private $_admin;// autorisation admin (0=utilisateur ; 1=admin

		// **************************************************
		// Methode
		// **************************************************


	 	 public function getDataToHydrate($mail, $psw){

	 	 		$aData = parent::get($mail, $psw);
	 	 		self::hydrate($aData);
	 	 }

	 	 public function hydrate($aData){
	 	 	foreach ($aData as $key => $value){
	 	 		 // On récupère le nom du setter correspondant à l'attribut en mettant sa première lettre en majuscule. 
	 	 		$method = 'set'.ucfirst($key);
	 	 		if(method_exists($this, $method)){
	 	 			$this->$method($value);
	 	 		}
	 	 	}
	 	 }

	 	 public function buildAdminMessage($iconSend, $iconAnnul)
	 	 {
	 	 		$div =<<<EOT
				<div>
					<p>Vous allez envoyer un message à</p>
					<p id='pseudoMessage'></p>
					<p id='alertMessage'></p>

					<div id='containMess'>
						<div>
							<label for='subjectMess'>Sujet : </label>
							<input type='text' id='subjectMess' name='subjectMess' value="">
						</div>
						<div>
							<label for='textMess'>Message : </label>
							<textarea id='textMess' name='textMess' value=""></textarea>
						</div>
					</div>
					<div id="messageBtn">
						<span id='annulMess' class="$iconAnnul"></span>
						<button id='sendMess' class="$iconSend" type='submit' name='sendMess'></button>
					</div>
				</div>
EOT;
				return $div;


	 	 }

	 	public function buildAdminEpisode($aEpisode, $iconCheck, $iconAnnul)
	 	{
	 		// div à cacher
	 		$divHidenEpisode = "navComment,navMessage";
	 		$divHidenEdit = 'divModifSelectEp,divDelSelectEp,hideWriteEpisodeModif';
	 		$divHidenModif = 'hideWriteEpisode,divDelSelectEp';
	 		$divHidenDel = 'divModifSelectEp,hideWriteEpisode,hideWriteEpisodeModif';

	 		$div = <<<EOT
	 		<div id='containGlobalAdmin'>

	 			<div class="whiteBlock">
	 				<p> Bienvenue dans votre espace $this->_pseudo</p>
	 			</div>

		 		<div id="EpisodeWork">

	 				<div class="whiteBlock">
		 				<span onclick="animShowAdminMenu('navEpisode','$divHidenEpisode');"><p>Episodes :</p>
		 				</span>
		 			</div>

		 			<div id="navEpisode"> 
		 				<div id="EpisodeMenu" >

		 					<div id='editEp'>
			 					<div class="whiteBlock">
			 						<span id='btnEditEp' onclick="animShowAdminMenu('hideWriteEpisode','$divHidenEdit');" ><p>Editer un épisode</p>
			 						</span>
			 					</div>
		 					</div>

		 					<div id="modifEp">
			 					<div class="whiteBlock">
		 							<span id='btnModifEp' onclick="animShowAdminMenu('divModifSelectEp','$divHidenModif');" ><p>Modifier un épisode </p>
		 							</span>
				 				</div>
				 				<div id="divModifSelectEp">
					 				<div class="flexRow">
				 						<div  class="whiteBlock"><p>Modifier l'épisode n°:<p>
				 						</div>
					 					<div class='customSelect'>
					 						<label for="selectEpModif"></label>
					 						<select id="selectEpModif" name="selectEpModif">
EOT;
			for($i = 0 ; $i < count($aEpisode) ; $i++)
			{
				$num = $i+1;
				$idep = $aEpisode[$i]['id'];
				$title = $aEpisode[$i]['title'];
				$div.=<<<EOT
												  <option value="$idep">$num : $title</option>
EOT;
			}
				$div.=<<<EOT
											</select>
											<span id="goEpModif" class="$iconCheck"></span>
										</div>
									</div>
								</div>
				 			</div>

		 					<div id='delEp'>
			 					<div class="whiteBlock">
			 						<span onclick="animShowAdminMenu('divDelSelectEp','$divHidenDel');" ><p>Supprimer un épisode</p>
			 						</span>
			 					</div>
		 						<div id='divDelSelectEp'>
		 							<div class="flexRow">
				 						<div class="whiteBlock"><p>Suprrimer l'épisode n°:</p>
				 						</div>
				 						<div class='customSelect'>
					 						<label for="selectEpDel"></label>
					 						<select id="selectEpDel" name="selectEpDel">
EOT;
			for($i = 0 ; $i < count($aEpisode) ; $i++)
			{
				$num = $i+1;
				$idep = $aEpisode[$i]['id'];
				$title = $aEpisode[$i]['title'];
				$div.=<<<EOT
												  <option value="$idep">$num : $title</option>
EOT;
			}
				$div.=<<<EOT
											</select>
											<span id="goEpDel" class="$iconCheck"></span>
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
			 					
		 						<div>
		 							<div id='blockWriteTitleEpisode' contentEditable>
		 							</div>
		 						</div>

		 						<div id='ctrlWrite'>
		 							<input type="button" value="G" style="font-weight: bold;" onclick="commande('bold');" />
		 							<input type="button" value="I" style="font-style: italic;" onclick="commande('italic');" />
		 							<input type="button" value="S" style="text-decoration: underline;" onclick="commande('underline');" />
		 							<input type="button" value="Lien" onclick="commande('createLink');" />
									<input type="button" value="Image" onclick="commande('insertImage');"/>
								</div>

		 						<div id='blockWriteEpisode' contentEditable>
		 						</div>

		 						
		 						<div id='ctrlWriteEpisode'>
		 							<span id='quitEdit'>Nouveau</span>
		 							<span id='saveEdit'>Enregistrer</span>
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
		 							<div id='blockWriteTitleEpisodeModif' contentEditable>
		 							</div>
		 						</div>

		 						<div id='ctrlWrite'>
		 							<input type="button" value="G" style="font-weight: bold;" onclick="commande('bold');" />
		 							<input type="button" value="I" style="font-style: italic;" onclick="commande('italic');" />
		 							<input type="button" value="S" style="text-decoration: underline;" onclick="commande('underline');" />
		 							<input type="button" value="Lien" onclick="commande('createLink');" />
									<input type="button" value="Image" onclick="commande('insertImage');"/>
								</div>

		 						<div id='blockWriteEpisodeModif' contentEditable>
		 						</div>

		 						
		 						<div id='ctrlWriteEpisodeModif'>
		 							<span id='saveModif' onclick="save();">Enregistrer</span>
		 						</div>
		 					</div>
			 			</div>
			 		</div>
		 		</div>
		 	</div>
	 		

EOT;
			return $div;
 	 	}

 	 	public function buildAdminComment($aEpisode, $aUser, $aUserSignal, $aEpisodeSignal, $iconCheck, $iconAnnul){
 	 		$divHidenComment = 'navEpisode,hideWriteEpisode,hideWriteEpisodeModif,navMessage';

 	 		$divHidenSelCom       = 'divSelectComSignal,arrayPseudoSignal,arrayCommentSignal';
 	 		$divHidenDivSelCom    = 'selectSortComPs,arrayPseudo';
 	 		$divHidenDivSelPseudo = 'selectSortComEp,arrayComment';

 	 		$divHidenSelComSign       = 'divSelectCom,arrayPseudo,arrayComment';
 	 		$divHidenDivSelComSign    = 'selectSortComSignPs,arrayPseudoSignal';
 	 		$divHidenDivSelPseudoSign = 'selectSortComSignEp,arrayCommentSignal';

 	 		$div = <<<EOT

		 		<div id="CommentWork">

	 				<div class="whiteBlock">
		 				<span onclick="animShowAdminMenu('navComment', '$divHidenComment');"><p>Commentaires :</p>
		 				</span>
		 			</div>

		 			<div id="navComment"> 
		 				<div id="CommentMenu" >

		 					<div id="showComment">
			 					<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('divSelectCom', '$divHidenSelCom');" ><p>Les commentaires</p>
		 							</span>
				 				</div>
				 				<div id="divSelectCom">
					 				<div class='flexColumn'>
						 				<div class="flexRow">
					 						<div>
						 						<button id ='sortEp' class="whiteBlock" type='submit' name='sortEp' onclick="animShowAdminMenu('selectSortComEp','$divHidenDivSelCom');" >Par épisode</button>
						 						<button id ='sortPs' class="whiteBlock" type='submit' name='sortPs' onclick="animShowAdminMenu('selectSortComPs','$divHidenDivSelPseudo');" >Par pseudo</button>
					 						</div>
						 					<div id ='selectSortComEp'class='customSelect'>
						 						<label for="selectCom"></label>
						 						<select id="selectCom" name="selectEp">
EOT;
			for($i = 0 ; $i < count($aEpisode) ; $i++)
			{
				$num = $i+1;
				$idep = $aEpisode[$i]['id'];
				$title = $aEpisode[$i]['title'];
				$div.=<<<EOT
													  <option value="$idep">$num : $title</option>
EOT;
			}
				$div.=<<<EOT
												</select>
												<span id="goComByEp" class="$iconCheck"></span>
											</div>

						 					<div id ='selectSortComPs'class='customSelect'>
						 						<label for="selectPseudo"></label>
						 						<select id="selectPseudo" name="selectEp">
EOT;
			for($i = 0 ; $i < count($aUser) ; $i++)
			{
				$idUser = $aUser[$i]['id'];
				$pseudo = $aUser[$i]['pseudo'];
				$nbrCom = $aUser[$i]['comment'];
				$div.=<<<EOT
													  <option value="$idUser">$pseudo</option>
EOT;
			}
				$div.=<<<EOT
												</select>
												<span id="goComByPs" class="$iconCheck"></span>
											</div>
										</div>
										<div class="flexRow">
											<table id='arrayComment'>
											</table>
											<table id='arrayPseudo'>
											</table>
										</div>
									</div>
								</div>

				 			</div>

				 			<div id="showCommentSignal">
			 					<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('divSelectComSignal','$divHidenSelComSign');" ><p>Commentaires signalés</p>
		 							</span>
				 				</div>
				 				<div id="divSelectComSignal">
				 					<div class='flexColumn'>
						 				<div class="flexRow">
					 						<div>
						 						<button id ='sortEpRep' class="whiteBlock" type='submit' name='sortEpRep' onclick="animShowAdminMenu('selectSortComSignEp','$divHidenDivSelComSign');" >Par épisode</button>
						 						<button id ='sortPsRep' class="whiteBlock" type='submit' name='sortPsRep' onclick="animShowAdminMenu('selectSortComSignPs','$divHidenDivSelPseudoSign');" >Par pseudo</button>
					 						</div>
						 					<div id ='selectSortComSignEp'class='customSelect'>
						 						<label for="selectComSignal"></label>
						 						<select id="selectComSignal" name="selectEp">
EOT;
			for($i = 0 ; $i < count($aEpisodeSignal) ; $i++)
			{
				$num=$i+1;
				$idep = $aEpisodeSignal[$i]['id'];
				$title = $aEpisodeSignal[$i]['title'];
				$div.=<<<EOT
													  <option value="$idep">$num : $title</option>
EOT;
			}
				$div.=<<<EOT
												</select>
												<span id="goComSignByEp" class="$iconCheck"></span>
											</div>

						 					<div id ='selectSortComSignPs'class='customSelect'>
						 						<label for="selectPseudoSignal"></label>
						 						<select id="selectPseudoSignal" name="selectEp">
EOT;
			for($i = 0 ; $i < count($aUserSignal) ; $i++)
			{
				$idUser = $aUserSignal[$i]['id'];
				$pseudo = $aUserSignal[$i]['pseudo'];
				$nbrComSign = $aUserSignal[$i]['reporting'];
				$div.=<<<EOT
													  <option value="$idUser">$pseudo</option>
EOT;
			}
				$div.=<<<EOT
												</select>
												<span id="goComSignByPs" class="$iconCheck"></span>
											</div>

										</div>
									</div>
									<div class="flexRow">
										<table id='arrayCommentSignal'>
										</table>
										<table id='arrayPseudoSignal'>
										</table>
									</div>
								</div>
				 			</div>
		 				</div>
		 			</div>
		 		</div>
	 		
EOT;

 	 		return $div;
 	 	}

 	 	public function buildAdminMessagePlace($aMessageSend, $aMessageReceive, $iconAnnul, $iconPen){
 	 		$divHidenMessage = 'navEpisode,hideWriteEpisode,hideWriteEpisodeModif,navComment';

 	 		$divHidenReceive = 'arrayMessageSend,messageAdmin';
 	 		$divHidenSend    = 'arrayMessageReceive,messageAdmin';
 	 		$divHidenWrite   = 'arrayMessageReceive,arrayMessageSend';

 	 		$div = <<<EOT

		 		<div id="messageWork">

	 				<div class="whiteBlock">
		 				<span onclick="animShowAdminMenu('navMessage', '$divHidenMessage');"><p>Message :</p>
		 				</span>
		 			</div>

		 			<div id="navMessage"> 
		 				<div id="messageMenu">
		 					<div id="showMessage">
		 						<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('arrayMessageReceive', '$divHidenReceive');" ><p>Message reçut</p>
		 							</span>
				 				</div>
				 				<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('arrayMessageSend', '$divHidenSend');" ><p>Message envoyés</p>
		 							</span>
				 				</div>
				 				<div class="whiteBlock">
		 							<span onclick="animShowAdminMenu('messageAdmin', '$divHidenWrite');" ><p>Envoyer un message</p>
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
EOT;
			for($i = 0 ; $i < count($aMessageReceive) ; $i++)
			{
				$dateReceive = $aMessageReceive[$i]['date'];
				$pseudo      = $aMessageReceive[$i]['pseudo'];
				$subject     = $aMessageReceive[$i]['subject'];
				$txt         = $aMessageReceive[$i]['text'];
				$div .= <<<EOT
												<tr>
													<td>$dateReceive</td>
													<td>$pseudo </td>
													<td>$subject</td>
													<td>$txt</td>
												</tr>
EOT;
			}

			$div .= <<<EOT
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
EOT;
			for($i = 0 ; $i < count($aMessageSend) ; $i++)
			{
				$dateReceive = $aMessageSend[$i]['date'];
				$pseudo      = $aMessageSend[$i]['pseudo'];
				$subject     = $aMessageSend[$i]['subject'];
				$txt         = $aMessageSend[$i]['text'];
				$div .= <<<EOT
												<tr>
													<td>$dateReceive</td>
													<td>$pseudo </td>
													<td>$subject</td>
													<td>$txt</td>
												</tr>
EOT;
			}

			$div .= <<<EOT
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
	 		
EOT;

 	 		return $div;
 	 	}

	 	 public function buildSpace($write, $iconCheck, $iconAnnul, $aInputPseudo, $aInputPsw){
	 	 	//print_r($aInputPseudo);
	 	 	$div = <<<EOT
	 <div id='containtGlobalSpace'>
	 	 <div id='globalSpace'>
	 	 	<hr>
	 	 	<div id='infoSpaceOne'>
	 	 		<p> Vous pouvez à tout moment, changer votre mot de passe et votre pseudo. Voici les informations vous concernant : </p>
	 	 	</div>
	 	 	<div id='infoSpaceTwo'>
	 	 		<p>Votre adresse mail de contact (Ne peut être changée) : <em>$this->_email</em></p>
	 	 		<div id='changePseudo'>
		 	 		<p>Votre pseudo : <em>$this->_pseudo</em></p>
		 	 		<p> Voulez-vous changer de pseudo? <span id="spanChangePseudo" class="$write" onclick="javascript:animDivWriteNewInfoOpen('changePseudo', 'contentFormChangePseudo')"></span></p>

					<div id='contentFormChangePseudo'>
						<form method="post">
							<label for="{$aInputPseudo[0]['id_style']}"></label>
							<input type ="{$aInputPseudo[0]['type']}" id ="{$aInputPseudo[0]['id_style']}" name ="{$aInputPseudo[0]['name']}" value="" placeholder="{$aInputPseudo[0]['placeholder']}" contenteditable ="{$aInputPseudo[0]['contenteditable']}">
							<span class="$iconAnnul contentInputComment" onclick="javascript:animDivWriteNewInfoClose('changePseudo', 'contentFormChangePseudo')"></span>
							<button type="submit" class="$iconCheck" name='sendNewPseudo'></button>
						</form>
					</div>
				</div>

				<div id='changePsw'>
					<p>Voulez-vous changer de mot de passe? <span id="spanChangePsw" class="$write" onclick="javascript:animDivWriteNewInfoOpen('changePsw', 'contentFormChangePsw')"></span><em></em></p>
		 	 		
		 	 		<div id='contentFormChangePsw'>
		 	 			<form method="post">
EOT;

				for ($i = 0 ; $i <= count($aInputPsw)-1 ; $i++)
				{
					$div.=<<<EOT
							<label for="{$aInputPsw[$i]['id_style']}"></label>
							<input type ="{$aInputPsw[$i]['type']}" id ="{$aInputPsw[$i]['id_style']}" name ="{$aInputPsw[$i]['name']}" value="" placeholder="{$aInputPsw[$i]['placeholder']}" contenteditable ="{$aInputPsw[$i]['contenteditable']}">
EOT;
				}
			$div.=<<<EOT
							<div id='btnNewPsw'>
								<span class="$iconAnnul contentInputComment" onclick="javascript:animDivWriteNewInfoClose('changePsw', 'contentFormChangePsw')"></span>
								<button type="submit" class="$iconCheck" name='sendNewPsw'></button>
							</div>
						</form>
					</div>
				</div>
EOT;
				
			$div.=<<<EOT

EOT;

			return $div;
	 	}




		// **************************************************
		// GETTERS
		// **************************************************
		
		/** Retourne l'ID' de l'item */
		public function getId() {
			return $this->_id;
		}
		
		/** Retourne la date d'inscription */
		public function getInscription() {
			return $this->_inscription;
		}
		
		/** Retourne l'adresse mail de l'utilisateur */
		public function getEmail() {
			return $this->_email;
		}
		
		/** Retourne son pseudo */
		public function getPseudo() {
			return $this->_pseudo;
		}
		
		/** Retourne son mot de passe*/
		public function getPsw() {
			return $this->_psw;
		}
		
		/** Retourne les commentaires*/
		public function getComment() {
			return $this->_comment;
		}

		/** Retourne le nbr de signalement de ses commentaires*/
		public function getReporting() {
			return $this->_reporting;
		}

		/** Retourne son rang en tant qu'utilisateur(0) ou admin(1)*/
		public function getAdmin() {
			return $this->_admin;
		}

		// **************************************************
		// SETTERS
		// **************************************************

		/** Assigne l'ID' de l'item */
		public function setId($id) {
			$id = (int) $id;
			$this->_id = $id;
		}
		
		/** Assigne la date d'inscription */
		public function setInscription($inscription) {
			$this->_inscription = $inscription;
		}
		
		/** Assigne l'adresse mail de l'utilisateur */
		public function setEmail($email) {
			if(is_string($email)) {
				htmlspecialchars($email);
				$this->_email = $email;
			}
		}
		
		/** Assigne son pseudo */
		public function setPseudo($pseudo) {
			if(is_string($pseudo)){
				htmlspecialchars($pseudo);
				$this->_pseudo = $pseudo;
			}
		}
		
		/** Assigne son mot de passe*/
		public function setPsw($psw) {
			if(is_string($psw)){
				htmlspecialchars($psw);
				$this->_psw = $psw;
			}
		}
		
		/** Assigne le nbr de commentaires*/
		public function setComment($comment) {
			$comment = (int) $comment;
				$this->_comment = $comment;
			
		}

		/** Assigne le nbr de signalement de ses commentaires*/
		public function setReporting($reporting) {
			$reporting = (int) $reporting;
			$this->_reporting = $reporting;
		}

		/** Assigne son rang en tant qu'utilisateur(0) ou admin(1)*/
		public function setAdmin($admin) {
			$admin = (int) $admin;
			$this->_admin = $admin;
		}

	}
	
