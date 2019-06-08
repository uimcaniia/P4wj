<?php $headTitle = 'Espace Admin'; ?>
<?php $titleH1 = 'Espace Admin'; ?>

<?php ob_start(); ?>

				<section id="messageAdmin">
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
				</section>
				<section id='containtAdmin'>
					<?php include ('adminEpisodeView.php'); ?>
				</section>
				<section id="containtAdminComment">
					<?php include ('adminCommentView.php'); ?>
				</section>
				<section id="containtAdminMessage">
					<?php include ('adminMessageView.php'); ?>
				</section>
				<section id='containtSpace'>
					<?php include ('adminGestionView.php'); ?>
				</section>

<?php $content = ob_get_clean(); ?>
<?php require('view/template.php'); ?>