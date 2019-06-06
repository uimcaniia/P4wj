<?php $headTitle = 'Espace Admin'; ?>
<?php $titleH1 = 'Espace Admin'; ?>

<?php ob_start(); ?>


<!-- 				<div>
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
				</div> -->
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