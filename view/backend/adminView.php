<?php $headTitle = 'Espace Admin'; ?>
<?php $titleH1 = 'Espace Admin'; ?>

<?php ob_start(); ?>
				<!-- <p id='confirmSendMess'></p> -->

				<article id="confirmPublishEpisode">
					<div>
						<span id='closePublishConfirm' class="fas fa-times"></span>
							<p>Une fois la publication activée,</p>
							<p>le nouvel épisode sera visible par tous.</p>
							<p>Voulez-vous publier l'épisode?</p>
						<p id='alertMessage'></p>
						<div id="messageBtn" class="flexRow">
							<p>Publier</p>
							<span id='publishEp' class="fas fa-check"></span>
						</div>
					</div>
				</article>
				<article id="confirmDeleteComment">
					<div>
						<span class="fas fa-times"></span>
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
						<span class="fas fa-times"></span>
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
						<span class="fas fa-times"></span>
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
						<span class="fas fa-times"  id='closeDeletePseudoDiv'></span>
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