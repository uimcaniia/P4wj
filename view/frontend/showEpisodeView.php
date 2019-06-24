	 	 <?php $headTitle = $aEpisode[0]['title']; ?>
	 	 <?php $titleH1 = $aEpisode[0]['title']; ?>
	 	 <?php $metaDes = 'Retrouver l\'épisode complet du chapitre \''.$aEpisode[0]['title'].'\' tiré du roman \'Un billet simple pour l\'Alaska\' par Jean Forteroche'; ?>

	 	 <?php ob_start(); ?>

	 	 	<div id="containtChapitre">
		 	 	<div id='bkgEpisode'>
		 	 		<div class='scotch'> 
		 	 			<img src="public/img/scotch.png" alt="un morceau de scotch qui tient l'épisode">
		 	 		</div>
	 	 			<hr>
	 	 			<div id='episode'>
	 	 				<?= html_entity_decode($aEpisode[0]['episode']) ?>
	 	 			</div>

	 	 			<div class='datePublication'>
	 	 				<div>
			<?php 
			if($linkEpisodePrev != '')
			{
			?> 	
	 	 					<a href='index.php?action=ShowEpisode&amp;idEpisode=<?= $linkEpisodePrev ?>'>Précédent</a>
			<?php 
			}
			?>
						</div>
						<div>
	 	 					<p>Publié le <?= strftime('%d-%m-%Y',strtotime($aEpisode[0]['publication'] ))?></p>
	 	 					<span class='fas fa-thumbtack'></span>
	 	 				</div>
	 	 				<div>
			<?php 
			if($linkEpisodeNext != '')
			{
			?>
	 	 					<a href='index.php?action=ShowEpisode&amp;idEpisode=<?= $linkEpisodeNext ?>'>Suivant</a>
	 	 				

	 	 	<?php
			}
			?>

						</div>
				 	</div>
		 	 	</div>
		 	 </div>
		 	 <div id='containtComment'>
		 <?php include ('commentView.php'); ?>
			</div>
	 	 <?php $content = ob_get_clean(); ?>
	 	 <?php require('view/template.php'); ?>