<?php $headTitle = 'Espace Admin'; ?>
<?php $titleH1 = 'Espace Admin'; ?>

<?php ob_start(); ?>
				<!-- <p id='confirmSendMess'></p> -->
				<!-- <article id="messageAdmin">
					<div>
						<span class="fas fa-times"  onclick="closeMessageDiv()"></span>
						<div class='flexRow'>
							<p>Vous allez envoyer un message </p>
							<p id='pseudoMessage'></p>
						</div>
						<p id='alertMessage'></p>

						<div id='containMess'>
							<div>
								<label for='subjectMess'>Sujet : </label>
								<input type='text' id='subjectMess' name='subjectMess' value="">
							</div>
							<div>
								<label for='textMess'>Message : </label>
								<textarea id='textMess' name='textMess' value="" class="mceNoEditor"></textarea>
							</div>
						</div>
						<div id="messageBtn" class="flexRow">
							<p>Envoyer</p>
							<span id='sendMess' class="fas fa-check"></span>
						</div>
					</div>
				</article> -->
				<article id="confirmDeleteComment">
					<div>
						<span class="fas fa-times"  onclick="closeDeleteCommentDiv()"></span>
							<p>Voulez-vous vraiment supprimer ce commentaire?</p>
							<p>Les réponses qui y sont associés, seront supprimer en même temps.</p>
						<p id='alertMessage'></p>
						<div id="messageBtn" class="flexRow">
							<p>supprimer</p>
							<span id='delCom' class="fas fa-check"></span>
						</div>
					</div>
				</article>
				<article id="confirmDeleteCommentReply">
					<div>
						<span class="fas fa-times"  onclick="closeDeleteCommentReplyDiv()"></span>
							<p>Voulez-vous vraiment supprimer ce commentaire?</p>
							
						<p id='alertMessage'></p>
						<div id="messageBtn" class="flexRow">
							<p>supprimer</p>
							<span id='delRepCom' class="fas fa-check"></span>
						</div>
					</div>
				</article>
				<article id="confirmDeleteEpisode">
					<div>
						<span class="fas fa-times"  onclick="closeDeleteEpisodeDiv()"></span>
							<p>Voulez-vous vraiment supprimer cet épisode?</p>
						<p id='alertMessage'></p>
						<div id="messageBtn" class="flexRow">
							<p>supprimer</p>
							<span id='delEpConfirm' class="fas fa-check"></span>
						</div>
					</div>
				</article>
				<article id="confirmDeletePseudo">
					<div>
						<span class="fas fa-times"  onclick="closeDeletePseudoDiv()"></span>
							<p>Voulez-vous vraiment supprimer ce compte?</p>
							<p>Les commentaires qui y sont associés, seront encore visible.</p>
							<p>Le pseudonyme sera modifié et le compte sera bloqué.</p>
						<p id='alertMessage'></p>
						<div id="messageBtn" class="flexRow">
							<p>supprimer</p>
							<span id='delPseudo' class="fas fa-check"></span>
						</div>
					</div>
				</article>
				<section id='containtAdmin'>
					<?php include ('adminEpisodeView.php'); ?>
				</section>
				<section id="containtAdminComment">
					<?php include ('adminCommentView.php'); ?>
				</section>
				<section id="containtAdminMessage">
					<?php include ('adminMessageView.php'); ?>
				</section>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>