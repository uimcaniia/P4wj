<?php $headTitle = 'Mentions légales'; ?>
<?php $titleH1 = 'Mentions légales'; ?>

<?php ob_start(); ?>
	 	<div id="mention">
		 	<div id='contentmention'>
<?php 
	for ($i = 0 ; $i < count($aMention) ; $i++)
	{
		$titre = $aMention[$i]['titre'];
		$texte = $aMention[$i]['texte'];
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