<?php

	class BuildDivComment extends Bdd{

		
		// **************************************************
		// Attributs de l'objet
		// **************************************************
		
		 private $_id;
	  	 private $_commentTime;
		 private $_comment;
	  	 private $_idEpisode;
	 	 private $_reporting;
	 	 private $_pseudo;
	 	 private $_idUser;
	 	 private $_reply;

		// **************************************************
		// Methode
		// **************************************************

	 	 public function __construct($aDataComment)
	 	 {
	 	 	foreach ($aDataComment as $key => $value){
	 	 		$method = 'set'.ucfirst($key);
	 	 		if(method_exists($this, $method)){
	 	 			$this->$method($value);
	 	 		}
	 	 	}
	 	 }


	 	public function build($iconSignal, $iconCheck, $iconAnnul, $iconPlus, $iconMinus, $iconPen, $i, $idEpisode, $isConnect, $pseudoConnect)
	 	{


			if(empty($this->_comment))
			{
				$div=<<<EOT
				<p> Il n'y a aucun commentaire pour le moment. </p>
EOT;
			}
			else
			{
				$idUser = $this->_idUser;
				$pseudo = $this->_pseudo;
				$date   = $this->_commentTime ;
				$comment = $this->_comment;
				$idComment = $this->_id;
				//echo $pseudo;
				$div=<<<EOT

		 	 	<div class="commentSignal" id ='signal$i'>
		 	 		<p> De </p>
		 	 		<p> $pseudo </p>
		 	 		<p> le </p>
		 	 		<p> $date </p>
EOT;

				if(($isConnect === true) && ($this->_reporting == 0)&&($this->_pseudo != $pseudoConnect))
				{

					$div.=<<<EOT
					<p>- Signaler le commentaire </p>
					<span id =$idComment class="$iconSignal $idUser" onclick="javascript:animPopup('signal$i')"></span>
					<div class="popupSignal">
						<p> Merci de nous avoir prévenu.</p>
					</div>

EOT;
				}
				elseif(($isConnect == true) && ($this->_reporting != 0) && ( $this->_pseudo != $pseudoConnect))
				{
					$div.=<<<EOT
					<p class="messSignal">- Commentaire signalé.</p>
EOT;
				}
				elseif(($isConnect == true) && ($this->_reporting != 0) && ($this->_pseudo == $pseudoConnect))
				{
					$div.=<<<EOT
					<p class="messSignal">- Votre commentaire a été signalé.</p>
EOT;
				}
				elseif($isConnect == false)
				{
					$div.=<<<EOT
					<p class="messSignal"></p>
EOT;
				}
				else
				{ 			
					$div.=<<<EOT
					<p class="messSignal"></p>
EOT;
				}
					$div.=<<<EOT
				</div>
				<div class="comment">
					<p>$this->_comment</p>
				</div>

EOT;
		 		if($isConnect === true)
				{
					$div.=<<<EOT
				<p> Répondre <span id="btnOpen$i" class="$iconPen contentInputReply" onclick="javascript:animDivWriteReplyOpen('replyDiv$i', btnOpen$i, btnClose$i)"></span>
				</p>

				<div class="contentInputReply" id="replyDiv$i">
					<form method="post" action="comment.php">
						<div class="formComment">
							<label for="replyUserConnect"></label>
							<textarea id ="replyUserConnect" name ="replyUserConnect" placeholder="Votre commentaire ..." contenteditable ="true">
							</textarea>
							<div class='formColumComment'>
								<span id="btnClose$i" class="$iconAnnul contentInputReply" onclick="javascript:animDivWriteReplyClose('replyDiv$i', btnOpen$i, btnClose$i)"></span>
								<button type="submit" class="$iconCheck" name='sendReply'></button>
							</div>
						</div>
					</form>
			 	</div>
EOT;
				}

				if(!empty($this->_reply))
				{
					$divReply = <<<EOT
				<div class='lookReply' id='part$i'>
					<p> Voir les réponses </p>
					<div class="plusMoins">
						<span class="$iconPlus" onclick="javascript:animCommentPlus('part$i')"></span>
						<span class="$iconMinus" onclick="javascript:animCommentMoins('part$i')"></span>
					</div>
				</div>

				<div class="globalReply">
						
EOT;
					for( $j = 0 ; $j <= count($this->_reply)-1 ; $j++)
					{
						$idReply     = $this->_reply[$j]['id'];
						$idUserReply = $this->_reply[$j]['iduser_reply'];
						$pseudoReply = $this->_reply[$j]['pseudo'];
						$dateReply   = $this->_reply[$j]['dateReply'];
						$reply       = $this->_reply[$j]['reply'];
						$divReply.=<<<EOT

					<div class="replySignal" id="replySignal$j">
						<p> De </p>
						<p> $pseudoReply </p>
						<p> le </p>
						<p> $dateReply </p>

EOT;
						if($this->_reply[$j]['reporting_reply'] == 0)
						{
							$divReply.=<<<EOT
						<p>- Signaler la réponse </p>
						<span id =$idReply class="$iconSignal $idUserReply" onclick="javascript:animPopupReply('part$i', 'replySignal$j')"></span>
						<div class="popupSignal">
							<p> Merci de nous avoir prévenu.</p>
						</div>
					</div>

EOT;
						}else
						{
							$divReply.=<<<EOT
						<p class="messSignal">- Réponse signalée.</p>
					</div>

EOT;
						}
						$divReply.=<<<EOT
					<div class="reply">
						<p>$reply</p>
					</div>

EOT;
					}
					$divReply.=<<<EOT
				</div>
EOT;
					$div.=$divReply;
				}
			}
			return $div;
	 	}



		// **************************************************
		// GETTERS
		// **************************************************
		
		/** Retourne l'ID' de l'item */
		public function getId()
		{
			return $this->_id;
		}
		
		/** Retourne la date du commentaire */
		public function getCommentTime()
		{
			return $this->_commentTime;
		}
		
		/** Retourne le texte du commentaire  */
		public function getComment()
		{
			return $this->_comment;
		}
		
		/** Retourne id de l'épisode concerné par le commentaire */
		public function getIdEpisode()
		{
			return $this->_idEpisode;
		}
		
		/** Retourne commentaire signalé (1) ou non (0) */
		public function getReporting()
		{
			return $this->_reporting;
		}

		/** Retourne pseudo de l'utilisateur responsable du commentaire */
		public function getPseudo()
		{
			return $this->_pseudo;
		}

		/** Retourne id de l'utilisateur responsable du commentaire */
		public function getIdUser()
		{
			return $this->_idUser;
		}
		
		/** Retourne un array de réponse au commentaire */
		public function getReply()
		{
			return $this->_reply;
		}

		// **************************************************
		// SETTERS
		// **************************************************

		/** Assigne l'ID' de l'item */
		public function setId($id)
		{
			$id = (int) $id;
			$this->_id = $id;
		}
		
		/** Assigne la date du commentaire  */
		public function setCommentTime($commentTime)
		{
			if(is_string($commentTime)) {
				htmlspecialchars($commentTime);
				$this->_commentTime = $commentTime;
			}
		}
		
		/** Assigne le texte du commentaire */
		public function setComment($comment)
		{
			if(is_string($comment)) 
			{
				htmlspecialchars($comment);
				$this->_comment = $comment;
			}
		}
		
		/** Assigne id de l'épisode concerné par le commentaire */
		public function setIdEpisode($idEpisode)
		{
			$this->_idEpisode = $idEpisode;
		}
		
		/** Assigne commentaire signalé (1) ou non (0) */
		public function setReporting($reporting)
		{
			$this->_reporting = $reporting;
		}

		/** Assigne pseudo de l'utilisateur responsable du commentaire */
		public function setPseudo($pseudo)
		{
				$this->_pseudo = $pseudo;
		}

		/** Assigne id de l'utilisateur responsable du commentaire */
		public function setIdUser($idUser)
		{
				$this->_idUser = $idUser;
		}

		/** Assigne un array de réponse au commentaire */
		public function setReply($reply)
		{
			if(is_array($reply)) 
			{
				$this->_reply = $reply;
			}
		}
	}
	