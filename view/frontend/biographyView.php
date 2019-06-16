	 	 <?php $headTitle = 'Biographie'; ?>
	 	 <?php $titleH1 = 'Jean Forteroche'; ?>

	 	 <?php ob_start(); ?>
	 	<section id="biography">
	 		<div class='flexRow'>
		 		<div id='imgBiographie'>
		 			<img src="public/img/portrait.png" alt="Photo portrait de Jean Forteroche">
		 		</div>
		 		<div id='textBiographie'>
		 			<p><?= $biographie[0]['text'] ?></p>
		 		</div>
		 	</div>
	 	 </section>
	 	 <?php $content = ob_get_clean(); ?>
	 	 <?php require('view/template.php'); ?>