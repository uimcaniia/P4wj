	 	 <?php $headTitle = 'Biographie'; ?>
	 	 <?php $titleH1 = 'Jean Forteroche'; ?>
	 	 <?php $metaDes = 'Biographie de Jean Forteroche. Sa vie... et une de ses oeuvres.'; ?>

	 	 <?php ob_start(); ?>
	 	<div id="biography">
	 		<div class='flexRow'>
		 		<div id='imgBiographie'>
		 			<img src="public/img/portrait.png" alt="Photo portrait de Jean Forteroche">
		 		</div>
		 		<div id='textBiographie'>
		 			<p><?= $biographie[0]['text'] ?></p>
		 		</div>
		 	</div>
	 	 </div>
	 	 <?php $content = ob_get_clean(); ?>
	 	 <?php require('view/template.php'); ?>