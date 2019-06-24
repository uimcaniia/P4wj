	 	 <?php $headTitle = 'Politique de confidentialité'; ?>
	 	 <?php $titleH1 = 'Politique de confidentialité'; ?>

	 	 <?php ob_start(); ?>
	 	<div id="politique">
		 	<div id='contentPolitique'>
<?php 
	for ($i = 0 ; $i < count($aPolitique) ; $i++)
	{
		$titre = $aPolitique[$i]['titre'];
		$texte = $aPolitique[$i]['texte'];
?>
				<div class='flexRow'>
					<p class='titleInfos'><?=$titre?></p>
					<p class='texteInfos'><?=$texte?></p>
				</div>
<?php
	}
?>

		 	</div>
	 	 </div>
	 	 <?php $content = ob_get_clean(); ?>
	 	 <?php require('view/template.php'); ?>